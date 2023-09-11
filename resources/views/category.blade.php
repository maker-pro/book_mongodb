@extends('layout.app')

@section('title', '分类列表')

@section('content')
    <p>全部分类</p>
    <div class="list-group">
        @foreach($category as $category_id => $category_item)
        <div class="list-group-item">
            <div class="list-group-item-heading">
                <a target="_blank" href="/category/detail/{{$category_id}}"><b>{{$category_item['name']}}</b></a>
            </div>
            <div class="list-group-item-text row">
                @foreach($category_item['child'] as $child_category_id => $child_category_name)
                    <div class="col-md-3 col-xs-6">
                        <a target="_blank" href="/category/detail/{{$child_category_id}}">{{$child_category_name}}</a>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
@endsection
