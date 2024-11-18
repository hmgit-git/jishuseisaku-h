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
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">製品登録</a>
                            </div>
                        </div>
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
                                <th>編集</th>
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
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-sm">編集</a> 
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
