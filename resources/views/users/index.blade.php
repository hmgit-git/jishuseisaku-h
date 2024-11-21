@extends('adminlte::page')

@section('title', 'ユーザ一覧')

@section('content_header')
    <h1 class="d-inline users-title">ユーザ一覧</h1>
@stop

<style>
    .users-title {
        font-weight: bold;
        color: navy; /* 紺色 */
    }
</style>


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ユーザ一覧</h3>
                    <div class="card-tools">
                        <form action="{{ url('users') }}" method="GET" class="input-group input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="キーワードで検索" value="{{ request('keyword') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">検索</button>
                            </div>
                            <div class="input-group-append ml-2"> <!-- 左にマージンを追加 -->
                                <a href="{{ url('users') }}" class="btn btn-default">リセット</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>部署名</th>
                                <th>メールアドレス</th>
                                <th>登録日時</th>
                                <th>更新日時</th>
                                <th>編集権限</th>
                                @if (auth()->user() && auth()->user()->role == 1) <!-- role=1 の場合 -->
                                <th>編集</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td style="width: 5%;">{{ $user->id }}</td>
                                <td style="width: 15%;">{{ $user->name }}</td>
                                <td style="width: 15%;">{{ $user->department }}</td>
                                <td style="width: 20%;">{{ $user->email }}</td>
                                <td style="width: 23%;">{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                <td style="width: 23%;">{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td style="width: 9%;">
                                @if($user->role)
                                    <span class="badge bg-success">管理者</span>
                                @else
                                    <span class="badge bg-secondary">一般ユーザー</span>
                                @endif
                                </td>                               
                                <td style="width: 5%;">
                                @if (auth()->user() && auth()->user()->role == 1) <!-- role=1 の場合 -->
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">編集</a>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    <!-- ページネーション -->
                    {{ $users->links('pagination::bootstrap-5') }}



            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop