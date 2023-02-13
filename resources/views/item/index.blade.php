@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <div class="input-group-append">
                                    <form method="GET" action="{{ route('item.index') }}">
                                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワード入力">
                                        <input type="submit" class="btn btn-default btn-sm" value="検索">
                                        <a href="{{ route('item.index') }}" class="btn btn-default btn-sm">クリア</a>
                                        <a href="{{ url('items/add') }}" class="btn btn-default btn-sm">商品登録</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>                
            @if (!$items->isEmpty()) 
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{!! nl2br(e($item->detail)) !!}</td>
                                    <td><a href="{{ route('item.edit' ,['id' =>$item->id]) }}" class="btn btn-default btn-sm">編集</a></td>
                                </tr>
                            @endforeach
                            @elseif ($reccount ==1)
                    <h5>【 {{ $keyword }}  】に該当する商品はみつかりませんでした。</h5>
                    @else
                    <h5>商品登録がありません。</h5>
                    @endif
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
