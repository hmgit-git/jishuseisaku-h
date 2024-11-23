@extends('adminlte::page')
@section('title', 'ユーザー情報編集')
@section('content_header')
    <h1>ユーザー情報編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT') <!-- PUTメソッドを指定 -->

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address
" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="department">部署</label>
                            <input type="text" class="form-control" id="department" name="department" placeholder="Department" value="{{ old('department', $user->department) }}">
                        </div>                        
                    </div>

                    <!-- 管理者権限 -->
                    <div class="form-group">
                        <label for="role">　管理者権限</label>
                        <input type="checkbox" id="role" name="role" value="1" {{ old('role', $user->role) ? 'checked' : '' }}>
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">編集内容を登録　</button>
                    </div>
                </form>                
                
                    <div class="card-footer">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="margin-top: 0px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">ユーザーから削除　</button>
                        </form>
                    </div>    

                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">ユーザー一覧に戻る</a>
                    </div>


            </div>
        </div>
    </div>


@stop

@section('css')
@stop

@section('js')
@stop
