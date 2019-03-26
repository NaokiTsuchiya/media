<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Http\Requests\PostRequest;

class PostCreateService
{
    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(PostRequest $request)
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
}
