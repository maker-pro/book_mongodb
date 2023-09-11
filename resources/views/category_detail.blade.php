@extends('layout.app')

@section('title', '分类列表')

@section('content')
    <p>分类导航：
        @foreach($category_info['category_nav_bar'] as $index => $category_nav_bar)
            @if($index > 0)
                /
            @endif
            <a href="/category/detail/{{$category_nav_bar['category_id']}}">{{$category_nav_bar['category_name']}}</a>
        @endforeach
    </p>
    @if(empty($category_info['category_book_list']['data']))
        <div class="not-date">
            <span>没有数据！</span>
        </div>
    @else
        <div class="row">
            @foreach($category_info['category_book_list']['data'] as $index => $book_item)
                @include('layout.book_item', ['book_item' => $book_item])
            @endforeach
        </div>
        @include('layout.page', ['page_info' => $category_info['category_book_list']['page']])
    @endif
@endsection
