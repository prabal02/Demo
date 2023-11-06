<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Controllers\Response;

class Blog extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard','create','storePost'
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        
        $posts = Post::with(['user'])->where('user_id', '=', $user->id)->get()->toArray();
       
        return view('post.post')->with('posts', $posts);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePost(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'content' => 'required|max:100',
        ]); 
        $data = [
            'user_id' => Auth::id(), //The foreign key of the flight
            'title' => $request->input('title'), 
            'content' => $request->input('content')
        ];

        Post::create($data);
        $user = Auth::user();
        $posts = Post::with(['user'])->where('user_id', '=', $user->id)->get()->toArray();
       
        return redirect('create')->with('success', 'Post Created Successfully')->with('posts', $posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function home()
     {
         dd('You are active');
     }

    /**
     * Get all posts rest API.
     * @return \Illuminate\Http\Response
     */
    public function getAllposts(Request $request)
    {
       
        $items = Post::with(['user'])->get();
        return response()->json($items);
        
    }

     /**
     * Get all posts paginated rest API.
     * @return \Illuminate\Http\Response
     */
    public function getAllpostsPagination(Request $request)
    {
        $data = Post::paginate(request()->all());    
        return Response()->json($data, 200);

        
    }
}
