<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        $notifications = Notification::all();
        return view('home' , compact('posts' , 'notifications'));
    }

    public function saveComment(Request $request)
    {
        $data = [
            'comment'=>$request->post_content,
            'user_id'=>Auth::id(),
            'post_id'=>$request->post_id,
        ];

        
        $comment = Comment::create($data);
        
        // $comment = Comment::latest()->first()->id;
        
        Notification::create([
            'comment_id'=>$comment->id,
            'user_id'=>Auth::id(),
            'post_id'=>$request->post_id,
        ]);
        
        event(new NewNotification($data));

        return back();
    }
}
