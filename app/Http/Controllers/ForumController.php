<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments')->latest()->get();
        return view('forum-index', compact('posts'));
    }

    public function adminIndex()
    {
        $posts = Post::with('comments')->latest()->get();
        return view('admin-forum', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('forum-show', compact('post'));
    }

    public function create()
    {
        return view('forum-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('forum.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        // Retrieve the post by ID
        $post = Post::find($id);

        // Check if the post exists
        if (!$post) {
            abort(404, 'Post not found');
        }

        // Return the edit view with the post data
        return view('forum-edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post->title = $request->title;
        $post->body = $request->body;
        
        
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image); // Delete the old image
            }
    
            // Store the new image
            
        }
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }
    

        $post->save();

        return redirect()->route('forum.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        // Find the forum post by ID
        $forumPost = Post::find($id);

        if ($forumPost) {
            // Check if the user deleting the post is the same user who created the post
            if ($forumPost->user_id == Auth::id() || Auth::user()->role == 'admin') {
                $forumPost->delete(); // Remove the post
                return redirect()->route('forum.index')->with('success', 'Post deleted successfully!');
            } else {
                return response()->json(['success' => false, 'message' => 'You do not have permission to delete this post.'], 403);
            }
        }

        return response()->json(['success' => false, 'message' => 'Post not found.'], 404);
    }

    public function commentStore(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return response()->json([
            'success' => true,
            'comment' => $comment,
            'user' => $comment->user // Include user data if needed
        ]);
    }

    public function commentDestroy(Request $request, $id)
    {
        // Find the comment by ID
        $comment = Comment::find($id);

        if ($comment) {
            // Check if the user deleting the comment is the same user who created the comment
            if ($comment->user_id == Auth::id() || Auth::user()->role == 'admin') {
                $comment->delete(); // Remove the comment
                return response()->json(['success' => true, 'message' => 'Comment deleted successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'You do not have permission to delete this comment.'], 403);
            }
        }

        return response()->json(['success' => false, 'message' => 'Comment not found.'], 404);
    }

    public function commentUpdate(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return response()->json(['message' => 'Comment updated successfully.', 'comment' => $comment]);
    }
}