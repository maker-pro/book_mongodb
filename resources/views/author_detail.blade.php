@extends('layout.app')

@section('title', '作者' . $author_info['AuthorName'])

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
                    <div><h4>{{$author_info['AuthorName']}}</h4></div>
                    <div>{{$author_info['AuthorDesc']}}</div>
                </div>
            </div>
            @if($author_book_list)
            <div class="panel panel-default">
                <div class="panel-heading">
                    相关作品
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($author_book_list as $book_item)
                            @include('layout.book_item', ['book_item' => $book_item])
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
