<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //  public function __construct()
    //  {
    //     $this->middleware("auth")->only('comment');
    //  }

    
    public function index(Request $request): View

    {

        $posts = Post::query();

        if ($search = $request->search){
            $posts->where(fn(Builder $query)=> $query
            ->where('title','LIKE','%' . $search . '%')
            ->orwhere('content','LIKE','%' . $search . '%')
        );

        // if ($search = $request->search){
        //     $posts = $posts->where('title','LIKE','%' . $search . '%')
        //     ->orwhere('content','LIKE','%' . $search . '%');
        // }
        }

        return view('posts.index', [
            'posts' => $posts->latest()->paginate(10)
        ]);

    }
    

    public function show(Post $post): view
    {
        return view('posts.show', [
            'post' => $post, 
        ]);
    }

    public function comment(Post $post, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'between:2,255'],
        ]);

        Comment::create([

            'content' => $validated['comment'],
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);

        return back()->withStatus('Commentaire publié !');

    }
}
