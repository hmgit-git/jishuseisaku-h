@extends('adminlte::page')

@section('title', '製品一覧')

@section('content_header')
    <h1 class="d-inline items-title">製品一覧</h1>
@stop

<style>
    .items-title {
        font-weight: bold;
        color: navy; /* 紺色 */
    }
</style>


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">製品一覧</h3>
                    <div class="card-tools">
                        <form action="{{ url('items') }}" method="GET" class="input-group input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="キーワードで検索" value="{{ request('keyword') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">検索</button>
                            </div>
                            <div class="input-group-append ml-2"> <!-- 左にマージンを追加 -->
                                <a href="{{ url('items') }}" class="btn btn-default">リセット</a>
                            </div>
                            <div class="input-group-append ml-2">
                                <a href="{{ route('items.exportCsv') }}" class="btn btn-success">CSVダウンロード</a>
                            </div>    
                            @if (auth()->user() && auth()->user()->role == 1) <!-- role=1 の場合 -->
                            <div class="input-group-append ml-2"> <!-- 左にマージンを追加 -->
                                <a href="{{ url('items/add') }}" class="btn btn-secondary">製品登録</a>
                            </div>
                            @endif

                        </form>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>製品名</th>
                                <th>最小受注数</th>
                                <th>納期(週)</th>
                                <th>単価(円)</th>
                                <th>詳細</th>
                                @if (auth()->user() && auth()->user()->role == 1) <!-- role=1 の場合 -->
                                <th>編集</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->leadtime }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>
                                        {{-- 編集ボタン --}}
                                        @if (auth()->user() && auth()->user()->role == 1) <!-- role=1 の場合 -->
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-info btn-sm">編集</a> 
                                        @endif
                                    </td>                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

    <!-- ページネーション -->
            {{ $items->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
