<?php

// app/Http/Controllers/NewsController.php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // ニュース一覧を表示
    public function index()
    {
        $newsList = News::latest()->get();
        return view('news.index', compact('newsList'));
    }

    // ニュースを保存
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        News::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('news.index')->with('success', 'ニュースを追加しました！');
    }

    // ニュースを削除
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

                return redirect()->route('news.index')->with('success', 'ニュースを削除しました！');
    }
}
