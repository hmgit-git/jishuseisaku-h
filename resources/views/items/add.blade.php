@extends('adminlte::page')

@section('title', '製品登録')

@section('content_header')
    <h1>製品登録</h1>
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
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="type">製品名</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="製品名">
                        </div>

                        <div class="form-group">
                            <label for="quantity">最小受注数</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="最小受注数">
                        </div>

                        <div class="form-group">
                            <label for="leadtime">納期(週)</label>
                            <input type="text" class="form-control" id="leadtime" name="leadtime" placeholder="納期(週)">
                        </div>

                        <div class="form-group">
                            <label for="price">単価(円)</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="単価(円)">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
