<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    private const PAGINATE_SIZE = 10;

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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $posts = $request->user()->posts()->orderBy('created_at', 'desc')->simplePaginate(static::PAGINATE_SIZE);
        return view('home', compact('posts'));
    }
}
