<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    private $contacts;

    public function __construct()
    {
        $this->contacts = Contact::all(); // Retrieve all contacts from the database
    }

    public function index()
    {
        $contacts = Contact::paginate(10); 
        return view('contact-list', compact('contacts'));
    }

    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);

    $contact = new Contact();
    $contact->name = $validatedData['name'];
    $contact->email = $validatedData['email'];
    $contact->subject = $validatedData['subject'];
    $contact->message = $validatedData['message'];
    $contact->user_id = auth()->id(); // Set the user_id field to the current user's ID

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $contact->image = $imageName;
    }

    $contact->save();

    return back()->with('success', 'Contact stored successfully!');
}


    public function show($id)
    {
        $contact = collect($this->contacts)->firstWhere('id', $id);

        if (!$contact) {
            abort(404, 'Contact not found');
        }

        return view('contact-show', ['contact' => $contact]);
    }

    public function myContacts()
    {
         $contacts = Contact::where('user_id', auth()->id())->paginate(4);

        return view('user-contacts', ['contacts' => $contacts]);
    }

    public function edit($id)
{
    $contact = collect($this->contacts)->firstWhere('id', $id);

    if (!$contact) {
        abort(404, 'Contact not found');
    }

    return view('contact-edit', ['contact' => $contact]);
}

public function update(Request $request, $id)
{
    $contact = collect($this->contacts)->firstWhere('id', $id);

    if (!$contact) {
        abort(404, 'Contact not found');
    }

    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'subject' => 'required|string',
        'message' => 'required|string',
'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $contact->name = $validatedData['name'];
    $contact->email = $validatedData['email'];
    $contact->subject = $validatedData['subject'];
    $contact->message = $validatedData['message'];

      // Check if a new image has been uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($contact->image) {
            Storage::disk('public')->delete($contact->image); // Delete the old image
        }

        // Store the new image
        
    }

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $contact->image = $imageName;
    }

    $contact->save();

    return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
}

    public function destroy($id)
    {
        // $contact = collect($this->contacts)->firstWhere('id', $id);
        $contact = Contact::find($id);

        if (!$contact) {
            abort(404, 'Contact not found');
        }

        $contact->delete();
        // // Remove the contact from the collection
        // $this->contacts = $this->contacts->filter(function ($item) use ($id) {
        //     return $item['id'] != $id;
        // });

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }

}
