<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

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
    public function index()
    {
        $newsList = News::latest()->get(); // 最新のニュースを取得
        return view('home', compact('newsList'));
        $newsList = News::latest()->paginate(5); // 1ページあたり5件
        return view('home', compact('newsList'));
    }


}
