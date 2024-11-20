@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="d-inline news-title">ニュース一覧</h1>
    @if (auth()->user() && auth()->user()->role == 1) <!-- role=1 の場合 -->
    <a href="{{ route('news.index') }}" class="btn btn-primary float-right">ニュース登録・削除</a>
    @endif
@stop
<style>
    .news-title {
        font-weight: bold;
        color: navy; /* 紺色 */
    }
</style>




@section('content')
<div class="news-list">
        @if($newsList->isEmpty())
            <p>現在、ニュースはありません。</p>
        @else
            @foreach ($newsList as $news)
                <div class="news-item">
                    <h4>{{ $news->title }}</h4>
                    <p>{{ $news->content }}</p>
                    <small>投稿日: {{ $news->created_at->format('Y年m月d日') }}</small>
                    <hr>
                </div>
            @endforeach
        @endif
</div>

    <!-- ページネーション -->
    {{ $newsList->links('pagination::bootstrap-5') }}


@stop

@section('css')
    <style>
        .news-item {
            margin-bottom: 20px;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
