@extends('adminlte::page')

@section('title', 'ニュース管理')

@section('content_header')
    <h1>ニュース管理</h1>
@stop

@section('content')
    {{-- 成功メッセージ --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


    {{-- ニュース追加フォーム --}}
    <div class="card mb-4">
        <div class="card-header">ニュースを追加</div>
        <div class="card-body">
            <form action="{{ route('news.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">追加</button>
            </form>
        </div>
    </div>

    {{-- ニュース一覧 --}}
    <div class="card">
        <div class="card-header">ニュース一覧</div>
        <div class="card-body">
            @if($newsList->isEmpty())
                <p>現在、ニュースはありません。</p>
            @else
                <ul class="list-group">
                    @foreach ($newsList as $news)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h5>{{ $news->title }}</h5>
                                <p>{{ $news->content }}</p>
                                <small>投稿日: {{ $news->created_at->format('Y年m月d日') }}</small>
                            </div>
                            <form action="{{ route('news.destroy', $news->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@stop

@section('css')
    <style>
        .list-group-item {
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')
    <script>
        document.querySelectorAll('form.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!confirm('本当に削除しますか？')) {
                    event.preventDefault();
                }
            });
        });
    </script>
@stop
