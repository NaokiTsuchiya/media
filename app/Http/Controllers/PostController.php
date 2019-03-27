<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Media\Post\Application\PostCreateService;
use Media\Post\Application\PostDeleteService;
use Media\Post\Application\PostEditService;
use Media\Post\Application\PostGetRecentListService;
use Media\Post\Application\PostShowService;
use Media\Post\Application\PostUpdateService;


class PostController extends Controller
{

    /**
     * @param PostGetRecentListService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PostGetRecentListService $service)
    {
        return $service->execute();
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
     * @param PostCreateService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(PostRequest $request, PostCreateService $service)
    {
        return $service->execute($request);
    }

    /**
     * @param int $user_id
     * @param string $post_id
     * @param PostShowService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $user_id, string $post_id, PostShowService $service)
    {
        return $service->execute($user_id, $post_id);
    }

    /**
     * @param string $post_id
     * @param PostEditService $service
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(string $post_id, PostEditService $service)
    {
        return $service->execute($post_id);
    }

    /**
     * @param string $post_id
     * @param PostRequest $request
     * @param PostUpdateService $service
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(string $post_id, PostRequest $request, PostUpdateService $service)
    {
        return $service->execute($post_id, $request);
    }

    /**
     * @param string $post_id
     * @param PostDeleteService $service
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function delete(string $post_id, PostDeleteService $service)
    {
        return $service->execute($post_id);
    }
}
