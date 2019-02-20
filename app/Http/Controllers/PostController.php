<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\User;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('post');
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $user = $request->user();

        $user->posts()->create([
            'title' => $title,
            'content' => $content,
        ]);

        return redirect('/home');
    }

    /**
     * @param User $user
     * @param string $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user, string $post_id)
    {

        $post = Post::find(hex2bin($post_id));

        return view('post_view', compact('user', 'post'));

    }

}
