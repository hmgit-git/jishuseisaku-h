<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ユーザー一覧画面を表示
    public function index(Request $request)
    {
         // 全ユーザーを取得
        $users = User::all();
        // 検索キーワードを取得
        $search = $request->input('search');

        // クエリビルダを使って名前で検索
        $users = User::when($search, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('users.index', compact('users', 'search'));
    }


    // ユーザー編集画面を表示
    public function edit($id)
    {
        // IDでユーザーを取得
        $user = User::findOrFail($id);
   
        return view('users.edit', compact('user'));
    }
    
    // ユーザー情報を更新
    public function update(Request $request, $id)
    {
      // dd($request->all()); // デバッグのためリクエストデータを表示

    // IDでユーザーを取得
    $user = User::findOrFail($id);

    // フォームデータのバリデーション
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id, // 現在のユーザーを除外して重複チェック
    ],[
        'email.unique' => 'このメールアドレスは既に使用されています。',
        'name.required' => '名前は必須項目です。',
    ]);
    
   // 管理者権限のチェックボックス処理
   $validatedData['role'] = $request->has('role') ? 1 : 0; // チェックされていない場合は 0
    // ユーザー情報を更新
    $user->update($validatedData);

    // ユーザー一覧ページにリダイレクト
    return redirect()->route('users.index')->with('success', 'ユーザー情報が更新されました。');
}

    public function destroy($id)
    {
    // ユーザーをIDで取得
    $user = User::findOrFail($id);
   

    // ユーザーを削除
    $user->delete();

    // ユーザー一覧ページにリダイレクト
    return redirect()->route('users.index')->with('success', 'ユーザーが削除されました。');
}

}
