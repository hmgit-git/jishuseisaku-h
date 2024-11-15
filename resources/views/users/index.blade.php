@extends('adminlte::page')

@section('title', 'ユーザ一覧')

@section('content_header')
    <h1>ユーザ一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ユーザ一覧</h3>
                    <div class="card-tools">
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
                                <th>編集</th>

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
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">編集</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop