@extends('layout.app')

@section('title', '出版社' . $press_info['PressName'])

@section('content')
    <div class="row thumbnail">
        <div class="col-sm-12">
            <div class="caption">
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    基本信息
                </div>
                <div class="panel-body">
                    <div><h4>{{$press_info['PressName']}}</h4></div>
                    <div>{{$press_info['PressDesc']}}</div>
                </div>
            </div>
            @if($press_book_list['data'])
                <div class="panel panel-default">
                    <div class="panel-heading">
                        相关作品
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach($press_book_list['data'] as $book_item)
                                @include('layout.book_item', ['book_item' => $book_item])
                            @endforeach
                        </div>
                        @include('layout.page', ['page_info' => $press_book_list['page']])
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
