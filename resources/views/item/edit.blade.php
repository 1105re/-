@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集 商品ID:{{$item->id}}</h1>
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

      div class="card card-primary">
        <form action = "{{ route('item.update' ,['id' =>$item->id])}}" method = "POST" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
            </div>

            <div class="form-group">
              <label for="type">種別</label>
              <input type="number" class="form-control" id="type" name="type" value="{{ $item->type }}">
            </div>

            <div class="form-group">
              <label for="detail">詳細</label>
              <input type="text" class="form-control" id="detail" name="detail" value="{{ $item->detail }}">
            </div>
          </div>
          <!-- 編集ボタン -->
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
              <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> 編集
              </button>
            </div>
          </div>
        </form>
        <!-- 削除ボタン -->
        <form action="{{ route('item.destroy',['id' =>$item->id])}}" method="POST">
          {{ csrf_field() }}
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" id="delete-item-{{ $item->id }}" class="btn btn-danger">
                  <i class="fa fa-plus"></i> 削除
                </button>
              </div>
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
