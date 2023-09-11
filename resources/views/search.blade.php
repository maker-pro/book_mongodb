@extends('layout.app')

@section('title', '查询关键字：' . $keyword)

@section('content')
    <style>
        .search-title {
            font-size: 20px;
        }
    </style>
    @if($search_list['press'])
        <p class="search-title">关于“{{ $keyword }}” 出版社 共有 <b>{{ count($search_list['press']) }}</b> 条搜索结果</p>
        <div class="row">
            @foreach($search_list['press'] as $press)
            <div class="col-sm-6 col-md-4" style="margin-bottom: 8px">
                <div class="thumbnail">
                    <div class="caption">
                        <div class="text-left">
                            <h4 class="ellipsis" style="width: 100%">{{ $press['PressName'] }}</h4>
                        </div>
                        <div class="text-left" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 5; height: 160px; overflow: hidden; text-overflow: ellipsis;word-break: break-all;">{{ $press['PressDesc'] }}</div>
                        <p><a target="_blank" class="btn btn-primary btn-block" role="button" href="/press/{{ $press['PressName'] }}" style="margin-top: 8px;">查看详情</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if($search_list['author'])
        <p class="search-title">关于“{{ $keyword }}” 作者 共有 <b>{{ count($search_list['author']) }}</b> 条搜索结果</p>
        <div class="row">
            @foreach($search_list['author'] as $author)
                <div class="col-sm-6 col-md-4" style="margin-bottom: 8px">
                    <div class="thumbnail">
                        <div class="caption">
                            <div class="text-left">
                                <h4>{{ $author['AuthorName'] }}</h4>
                            </div>
                            <div class="text-left" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 5; height: 160px; overflow: hidden; text-overflow: ellipsis;word-break: break-all;">{{ $author['AuthorDesc'] }}</div>
                            <p><a target="_blank" class="btn btn-primary btn-block" role="button" href="/author/{{ $author['AuthorName'] }}" style="margin-top: 8px;">查看详情</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($search_list['book'])
        <br><p class="search-title">关于“{{ $keyword }}” 书籍共有 <b>{{ count($search_list['book']) }}</b> 条搜索结果</p>
        <div class="row">
            @foreach($search_list['book'] as $book_item)
                @include('layout.book_item', ['book_item' => $book_item])
            @endforeach
        </div>
    @endif

    @if(empty($search_list['book']) and empty($search_list['author']) and empty($search_list['press']))
        <div class="not-date">
            <span>没有找到关于 <span style="color: #646464">{{ $keyword }}</span> 的数据！</span>
        </div>
    @endif
@endsection
