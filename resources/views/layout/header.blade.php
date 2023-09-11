<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="/index" class="navbar-brand">Joe书店</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/category/list">全部分类</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                <li>
                    <form class="navbar-form navbar-left" action="/search">
                        <div class="form-group">
                            <input name="keyword" type="text" class="form-control" placeholder="输入关键字查询" required oninvalid="setCustomValidity('输入至少两个文字');" minlength="2" oninput="setCustomValidity('');">
                        </div>
                        <button type="submit" class="btn btn-primary">搜索</button>
                    </form>
                </li>
                <li>
                    <a href="/index">欢迎您关顾本店！</a>
                </li>
            </ul>
        </div>
    </div>
</div>
