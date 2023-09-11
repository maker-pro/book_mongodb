@extends('layout.app')

@section('title', 'Joe书店首页')

@section('content')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($carousel as $index => $item)
            <li data-target="#carousel-example-generic" data-slide-to="{{ $index }}"
                @if($index == 0)
                class="active"
                @endif
            ></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($carousel as $index => $item)
            <div class="item {{ $index == 0 ? 'active' : '' }}">
                <a target="_blank" href="/book/{{ $item }}">
                    <img src="dist/img/carousel/{{ $item }}.jpg" alt="" style="height: 500px;width: 100%;">
                </a>
                <div class="carousel-caption"></div>
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="card">
        <div class="panel panel-info">
            <div class="panel-heading">热门推荐</div>
            <div class="panel-body">
                <div class="row">
                    @foreach($hot_recommend_res as $index => $book_item)
                        @include('layout.book_item', ['book_item' => $book_item])
                    @endforeach
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">新书上架</div>
            <div class="panel-body">
                <div class="row">
                    @foreach($new_book_recommend_res as $index => $book_item)
                        @include('layout.book_item', ['book_item' => $book_item])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
