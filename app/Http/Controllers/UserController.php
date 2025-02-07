<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ユーザー一覧画面を表示
    public function index(Request $request)
{
    // クエリビルダーの準備
    $query = User::query();

    // 検索条件が指定されている場合の処理
    if ($request->filled('keyword')) {
        $keyword = $request->input('keyword');
        $query->where('name', 'LIKE', "%{$keyword}%")
              ->orWhere('department', 'LIKE', "%{$keyword}%");
    }

    // ページネーションでデータを取得
    $users = $query->paginate(5);

    // ビューにデータを渡す
    return view('users.index', compact('users'));
}

    //ユーザ情報編集ページ
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
        'department' => 'required|string|max:255',
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
// IDで製品を取得
$user = User::find($id);

// 製品が見つからない場合の処理
if (!$user) {
    return redirect()->route('users.index')->with('error', 'ユーザが見つかりませんでした');
}

// 製品を削除
$user->delete();

// 製品一覧ページにリダイレクト
return redirect()->route('users.index')->with('success', 'ユーザが削除されました');
}


}