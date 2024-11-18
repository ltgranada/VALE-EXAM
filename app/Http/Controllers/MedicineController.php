<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function index()
    {
        // Fetch all medicines from the database
        $medicines = Medicine::all();
        
        // Pass the medicines to the view
        return view('medicines', compact('medicines')); // Ensure this matches the view name
    }

    public function create()
    {
        return view('medicine-create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string', // Validate description
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Initialize image variable
        $imageName = null;

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Create a unique image name
            $image->move(public_path('images'), $imageName); // Move the image to the public/images directory
        }

        // Create a new medicine instance
        $medicine = new Medicine();
        $medicine->name = $request->name;
        $medicine->price = $request->price;
        $medicine->description = $request->description; // Save the description
        $medicine->image = $imageName; // Save the image name to the database
        $medicine->save(); // Save the medicine

        return redirect()->route('medicines.index')->with('success', 'Medicine created successfully!');
    }

    public function show($id)
{
    // Fetch the medicine by ID
    $medicine = Medicine::findOrFail($id);

    // Pass the medicine to the view
    return view('medicine-show', compact('medicine'));
}
}