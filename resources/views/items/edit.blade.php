@extends('adminlte::page')
@section('title', '製品情報編集')
@section('content_header')
    <h1>製品情報編集</h1>
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
                <form method="POST" action="{{ route('items.update', $item->id) }}">
                    @csrf
                    @method('PUT') <!-- PUTメソッドを指定 -->

                    <div class="card-body">
                        <div class="form-group">
                            <label for="type">製品名</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="{{ old('type', $item->type) }}">
                        </div>

                        <div class="form-group">
                            <label for="quantity">最小受注数</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{ old('quantity', $item->quantity) }}">
                        </div>

                        <div class="form-group">
                            <label for="leadtime">納期(週)</label>
                            <input type="text" class="form-control" id="leadtime" name="leadtime" placeholder="Leadtime" value="{{ old('leadtime', $item->leadtime) }}">
                        </div>

                        <div class="form-group">
                            <label for="price">単価(円)</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price', $item->price) }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="Detail" value="{{ old('detail', $item->detail) }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">編集内容を登録</button>
                    </div>
                </form>                

                <div class="card-footer">
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="margin-top: 0px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">製品一覧から削除</button>
                    </form>
                </div>    

                <div class="card-footer">
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">製品一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
