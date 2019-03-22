<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Media\Post\Domain\PostId;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new()
    {
        return view('post.new');
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(PostRequest $request)
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
        $post = Post::find((new PostId($post_id))->getValue());

        return view('post.show', compact('user', 'post'));
    }

    /**
     * @param string $post_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(string $post_id)
    {
        $post = Post::find((new PostId($post_id))->getValue());

        if (!$this->compareAuthUserIdWith($post->user_id)) {
            return redirect('/home');
        }

        return view('post.edit', compact('post'));
    }

    /**
     * @param string $post_id
     * @param PostRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(string $post_id, PostRequest $request)
    {

        $post = Post::find((new PostId($post_id))->getValue());

        if ($this->compareAuthUserIdWith($post->user_id)) {
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();
        }

        return redirect('/home');
    }

    /**
     * @param string $post_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function delete(string $post_id)
    {
        $post = Post::find((new PostId($post_id))->getValue());

        if ($this->compareAuthUserIdWith($post->user_id)) {
            $post->delete();
        }

        return redirect('/home');
    }

    /**
     * @param int $id
     * @return bool
     */
    private function compareAuthUserIdWith(int $id): bool
    {
        return Auth::id() === $id;
    }

}
