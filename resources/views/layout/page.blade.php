<div class="row">
    <div class="col-xs-12 text-center">
        <div class="pagination">
            <ul>
                @if(!empty($page_info['prev_page_url']))
                <li class="previous"><a href="{{ $page_info['prev_page_url'] }}" class="fui-arrow-left"></a></li>
                @endif

                @foreach($page_info['page_range'] as $page_index)
                <li
                    @if($page_index == $page_info['current_page'])
                    class="active"
                    @endif
                ><a href="{{ $page_info['page_url'] . '?page=' . $page_index }}">{{ $page_index }}</a></li>
                @endforeach

                @if(!empty($page_info['next_page_url']))
                <li class="next"><a href="{{ $page_info['next_page_url'] }}" class="fui-arrow-right"></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
