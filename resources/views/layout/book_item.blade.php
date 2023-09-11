<div class="col-sm-4 col-md-3">
    <div class="thumbnail">
        <a target="_blank" href="/book/{{$book_item['ID']}}">
            <img style="width: 100%; height: 240px; display: block; border-radius: 10px" alt="100%x200"
                 src="{{ is_file(public_path('/images/' . $book_item['Sku'] . '.jpg')) ? 'http://cdn.bookk.top/images/' . $book_item['Sku'] . '.jpg' : 'http://cdn.bookk.top/images/not_image.jpg' }}"
                 data-src="{{$book_item['Sku']}}.js/100%x200" data-holder-rendered="true">
        </a>
        <div class="caption">
            <div class="text-left ellipsis" title="{{ $book_item['Title'] }}">{{ $book_item['Title'] }}</div>
            <div>
                <span class="text-left text-danger">￥{{$book_item['Price']}}</span>
            </div>
            <div class="small ellipsis">
                作者：
                @if($book_item['NewAuthor'])
                    {{ $book_item['NewAuthor'] }}
                @else
                    无
                @endif
            </div>
            <div class="small ellipsis">
                出版社：{{$book_item['Press']}}
            </div>
            <p><a class="btn btn-primary btn-block" target="_blank" role="button" href="/book/{{$book_item['ID']}}">查看详情</a>
        </div>
    </div>
</div>
