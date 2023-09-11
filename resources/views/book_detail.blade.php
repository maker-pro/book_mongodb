@extends('layout.app')

@section('title', $book_info['Title'])

@section('content')
    <div class="row thumbnail">
        <div class="col-sm-4">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{ is_file(public_path('/images/' . $book_info['Sku'] . '.jpg')) ? 'http://cdn.bookk.top/images/' . $book_info['Sku'] . '.jpg' : 'http://cdn.bookk.top/images/not_image.jpg' }}" alt="暂无封面" style="height: 500px;width: 100%;">
                        <div class="carousel-caption">
                        </div>
                    </div>
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
            <div class="caption center">
                <h5>{{ $book_info['Title'] }}</h5>
                <p>定价：<span class="text-danger">￥{{ $book_info['Price'] }}</span></p>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="caption">
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    基本信息
                </div>
                <div class="panel-body">
                    <div>
                        作者：
                        @if($book_info['NewAuthor'][0])
                            @foreach($book_info['NewAuthor'] as $index => $author_name)
                                @if($index > 0)
                                    |
                                @endif
                                <a target="_blank" href="/author/{{ $author_name }}"><b>{{$author_name}}</b></a>
                            @endforeach
                        @else
                            <b>未知</b>
                        @endif
                    </div>
                    @if($book_info['Press'])
                    <div>
                        出版社：<a target="_blank" href="/press/{{ $book_info['Press'] }}"><b>{{$book_info['Press']}}</b></a>
                    </div>
                    @endif

                    @if($book_info['ReleaseTime'] and $book_info['ReleaseTime'] != '0000-00-00')
                    <div>
                        上架时间：<b>{{$book_info['ReleaseTime']}}</b>
                    </div>
                    @endif

                    <div>
                        所属分类：
                        <a target="_blank" href="/category/detail/{{ $book_info['CategoryOneID'] }}"><b>{{$book_info['CategoryOne']}}</b></a>
                        >
                        <a target="_blank" href="/category/detail/{{ $book_info['CategoryTwoID'] }}"><b>{{$book_info['CategoryTwo']}}</b></a>
                    </div>
                    <div>评分：<b>{{$book_info['Star']}}</b>/5.0 分</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    内容简介
                </div>
                <div class="panel-body">
                    @if($book_info['Detail'])
                        {{$book_info['Detail']}}
                    @else
                        无
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($book_comment_list)
        <link rel="stylesheet" href="/dist/css/star-rating.min.css">
        <script src="/dist/js/star-rating.min.js"></script>
        <div class="row thumbnail" id="book-detail-comment">
            <div class="col-sm-12">
                <div class="caption">
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        评论列表
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach($book_comment_list as $index => $comment_item)
                                <div class="col-sm-12 media" style="border-bottom: 1px solid #cccccc; padding-bottom: 10px">
                                    <div class="media-left">
                                        <div>
                                            <img src="/dist/img/avatar/{{ $comment_item['ID'] % 20 }}.jpg" class="media-object img-rounded" style="max-width: 80px !important;">
                                        </div>
                                        <span class="vip_text {{ $comment_item['MembershipLevelCssClass'] }}">{{$comment_item['MembershipLevel']}}</span>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading comment-item-header" style="font-weight: bold; font-size: 18px">
                                            <span class="username">{{$comment_item['UserName']}}</span>
                                            <input id="input-id" type="number" class="rating comment-star" min=0 max=5 step=0.5 data-size="xs" value="{{intval($comment_item['Star']) / 2}}" >
                                        </div>
                                        <p style="font-size: 16px">{{$comment_item['CommentText']}}</p>
                                        <p class="comment-date">{{$comment_item['CommentDate']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.comment-star').rating({
                readonly: true,
                showClear: false,
                starCaptions: {1: '1 Star', 2: '2 Star', 3: '3 Star', 4: '4 Star', 5: '5 Star'},
            });
        </script>
    @endif

    @if($recommended_book)
    <div class="row thumbnail">
        <div class="col-sm-12">
            <div class="caption">
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    推荐书籍
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($recommended_book as $index => $book_item)
                            @include('layout.book_item', ['book_item' => $book_item])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
