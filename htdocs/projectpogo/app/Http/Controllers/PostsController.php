<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->paginate(9);
        return view('posts/index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName(); 
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = $request->input('category');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('posts/')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts/show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts/edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required', 
            'category' => 'required'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName(); 
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 

        //Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = $request->input('category');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('posts/')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        // Do not destroy the noImage
        if($post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);

        }
        
        $post -> delete();

        return redirect('posts/')->with('success', 'Post Deleted');
    }

    public function search(Request $request)
        {
            $search = $request->input('search');
            $category = $request->input('category');

            if($category !== "All Categories" && empty($search))
                {
                    $posts = Post::where('category', "$category")
                                ->paginate(9);
                }

            else if($category !== "All Categories" && empty($search))
                {
                    $posts = Post::where('category', "$category")
                                ->where('title', 'LIKE', "%$search%")
                                ->orWhere('body', 'LIKE', "%$search%")
                                ->paginate(9);

                }
            else if($category == "All Categories")
                {
                    $posts = Post::where('category', "$category")
                                ->paginate(9);
                }

            else
                {
                    $posts = Post::where('title', 'LIKE', "%$search%")
                                ->orWhere('body', 'LIKE', "%$search%")
                                ->paginate(9);

                }
            return view('posts/search')->with('posts', $posts);

         }
     public function hidePost(Request $request)
       {

            $hide = $request->input('hide');
            $id = $request->input('id');
            
            $post = Post::find($id);
            if($hide == "on")
                {
                    $post->post_state = 1;
                    $post->save();
                }
            else
                {
                    $post->post_state = 0;
                    $post->save();
                }
            
            
            return redirect('/posts')->with('success', 'Post Updated');
       }
    
}