<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Support\Facades\Response; // ここを追加

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // クエリビルダーの準備
        $query = Item::query();

        // 検索条件が指定されている場合の処理
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('type', 'LIKE', "%{$keyword}%")
                  ->orWhere('detail', 'LIKE', "%{$keyword}%");
        }

        // ページネーションでデータを取得
        $items = $query->paginate(5);

        // ビューにデータを渡す
        return view('items.index', compact('items'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'type' => 'required|max:100',
                'quantity' => 'required',
                'quantity'=> 'required',
                'leadtime'=> 'required',
                'price'=> 'required',
                'detail' => 'required',

            ]);

            Item::create([
                'user_id' => Auth::user()->id,
                'type' => $request->type,
                'quantity'=> $request->quantity,
                'leadtime'=> $request->leadtime,
                'price'=> $request->price,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('items.add');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return redirect()->route('items.index')->with('error', '製品が見つかりませんでした');
        }
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // IDで製品を取得
        $item = Item::findOrFail($id);

        // バリデーション
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'leadtime' => 'required|numeric',
            'price' => 'required|numeric',
            'detail' => 'required|string|max:255',
        ], [
            'type.required' => '製品名は必須項目です。',
            'quantity.required' => '最小受注数量を入力してください。',
            'quantity.numeric' => '最小受注数量は数値でなければなりません。',
            'leadtime.required' => '納期が何週間か入力してください。',
            'leadtime.numeric' => '納期は数値でなければなりません。',
            'price.required' => '単価を入力してください。',
            'price.numeric' => '単価は数値でなければなりません。',
            'detail.required' => '詳細情報を入力してください。',
        ]);
        
        // 製品情報を更新
        $item->update($validatedData);

        // 製品一覧ページにリダイレクト
        return redirect()->route('items.index')->with('success', '製品情報が更新されました。');
    }   

    public function destroy($id)
    {
        // IDで製品を取得
        $item = Item::find($id);

        // 製品が見つからない場合の処理
        if (!$item) {
            return redirect()->route('items.index')->with('error', '製品が見つかりませんでした');
        }

        // 製品を削除
        $item->delete();

        // 製品一覧ページにリダイレクト
        return redirect()->route('items.index')->with('success', '製品が削除されました');
    }

    //CSVエクスポート
    public function exportCsv()
    {
        // データを取得
        $items = Item::all();

        // CSVヘッダーを定義
        $headers = [
            'Content-Type' => 'application/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="items.csv"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        // CSVデータを生成
        $callback = function () use ($items) {
            $file = fopen('php://output', 'w');

            // BOMを追加 (日本語の文字化けを防止)
            fputs($file, "\xEF\xBB\xBF");

            // ヘッダー行を追加
            fputcsv($file, ['ID', '製品名', '最小受注数', '納期(週)', '単価(円)', '詳細']);

            // データ行を追加
            foreach ($items as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->type,
                    $item->quantity,
                    $item->leadtime,
                    $item->price,
                    $item->detail,
                ]);
            }

            fclose($file);
        };

        // ストリームでCSVを返す
        return Response::stream($callback, 200, $headers);
    }
}
