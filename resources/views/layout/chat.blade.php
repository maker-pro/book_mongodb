<style>
    .chatContainer,.chatContainer div, .chatContainer ul, .chatContainer li, .chatContainer p{
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    /* 设置滚动条的样式 */
    ::-webkit-scrollbar {
        width:5px;
    }
    /* 滚动槽 */
    ::-webkit-scrollbar-track {
        border-radius:10px;
    }
    /* 滚动条滑块 */
    ::-webkit-scrollbar-thumb {
        border-radius:10px;
        background:#8C85E6;
        -webkit-box-shadow:#8C85E6;
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: rgba(175, 190, 255, 0.4);
    }
    /*按钮样式*/
    .btn-default-styles {
        outline: none;
        resize: none;
        border: none;
        display: inline-block;
        padding: 5px 10px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        background: #bbb;
        color: #fff;
        border-radius: 4px;
    }
    .btn-default-styles:focus {
        outline: none;
    }
    .btn-default-styles:hover {
        background: #c5c5c5;
        animation: anniu 1s infinite;
    }
    .btn-default-styles:active {
        box-shadow: 0 2px 3px rgba(0, 0, 0, .2) inset;
    }


    .chatContainer{
        position: fixed;
        bottom: 20px;
        right: 20px;
    }
    .chatBtn{
        width: 50px;
        height: 50px;
        background: #01bef0;
        color: #fff;
        line-height: 50px;
        text-align: center;
        border-radius: 50%;
        box-shadow: 2px 2px 2px #d4d4d4;
        cursor: pointer;
        position: fixed;
        bottom: 15px;
        right: 5px;
        overflow: hidden;
        z-index: 999;
    }
    .chatBtn:hover{
        background: #01b3df;
        box-shadow: none;
    }
    .chatBtn>img{
        width: 25px;
    }
    .chatBox{
        width: 370px;
        min-width: 320px;
        height: 570px;
        border-radius: 10px;
        background: #f5ecff;
        position: fixed;
        bottom: 5px;
        right: 70px;
        overflow: hidden;
        border: solid 1px #d5d5d5;
        box-shadow: 1px 1px 2px #c0c0c0;
        z-index: 1005;
        display: none;
    }
    .chatBox-head{
        width: 100%;
        height: 75px;
        background: #01aee0;
        position: absolute;
        top: 0;
        left: 0;
    }
    .chatBox-head-one{
        width: 100%;
        height: 75px;
        line-height: 75px;
        color: #fff;
        font-size: 20px;
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
    }
    .chatBox-head-two{
        width: 100%;
        height: 75px;
        color: #fff;
        padding: 10px 10px;
        display: none;
        position: absolute;
        top: 0;
        left: 0;
    }
    .chat-return{
        float: left;
        width: 55px;
        height: 55px;
        line-height: 55px;
        border-radius: 10px;
        cursor: pointer;
        text-align: center;
    }

    .chat-return:hover{
        background: #0188b7;
    }
    .chat-close{
        float: right;
        width: 55px;
        height: 55px;
        line-height: 55px;
        border-radius: 10px;
        cursor: pointer;
        text-align: center;
    }
    .chat-close:hover{
        background: #0188b7;
    }
    .chat-people{
        float: left;
    }
    .chat-people>div{
        height: 55px;
        display: inline-block;
        vertical-align: middle;
        line-height: 55px;
        margin-left: 5px;
    }
    .chat-people>div:nth-of-type(1){
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #eee;
        overflow: hidden;
    }
    .chat-people>div:nth-of-type(1)>img{
        width: 50px;
        height: 50px;
    }
    .chat-people>div:nth-of-type(2){
        width: 165px;
        text-align: left;
        height: 55px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .chatBox-info{
        width: 100%;
        height: 495px;
        background: #fff;
        text-align: left;
        position: absolute;
        top: 75px;
        left: 0;
    }

    .chatBox-list{
        width: 100%;
        height: 495px;
        overflow-y: scroll;
    }
    .chat-list-people:hover{
        cursor: pointer;
        background: #f8f8f8;
    }
    .chat-list-people>div{
        height: 55px;
        display: inline-block;
        vertical-align: middle;
        margin-left: 10px;
    }
    .chat-list-people>div:nth-of-type(1){
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #eee;
        overflow: hidden;
    }
    .chat-list-people>div:nth-of-type(1)>img{
        width: 40px;
        height: 40px;
    }


    .chat-name{
        width: 230px;
    }
    .chat-name>p{
        margin: 0;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .chat-name>p:nth-of-type(1){
        line-height: 55px;
    }
    .chat-list-people>div.message-num{
        display: inline-block;
        height: auto;
        min-width: 10px;
        padding: 3px 5px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        border-radius: 10px;
        margin-right: 15px;
        margin-top: 14px;
        color: #fff;
        background: #f46266;
        float: right;
    }
    .chat-message-num{
        display: inline-block;
        height: auto;
        min-width: 10px;
        padding: 3px 5px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        border-radius: 10px;
        margin-right: 15px;
        margin-top: 14px;
        color: #fff;
        background: #f46266;
        position: absolute;
        bottom: 40px;
        right: -24px;
    }
    .chatBox-kuang{
        width: 100%;
        height: 495px;
        display: none;
    }
    .chatBox-content{
        width: 100%;
    }
    .chatBox-content-demo{
        width: 100%;
        overflow-y: scroll;
    }

    .clearfloat:after{
        display:block;
        clear:both;
        content:"";
        visibility:hidden;
        height:0
    }
    .clearfloat{
        zoom:1;
        margin: 10px 10px;
    }
    .clearfloat .right{
        float: right;
    }
    .author-name{
        text-align: center;
        margin: 15px 0 5px 0;
        color: #888;
    }

    .clearfloat .chat-message{
        max-width: 252px;
        text-align: left;
        padding: 8px 12px;
        border-radius: 6px;
        word-wrap:break-word;
        display: inline-block;
        position: relative;
    }


    .clearfloat .left .chat-message{
        background: #D9D9D9;
        min-height: 36px;
    }
    .clearfloat .left .chat-message:before{
        position: absolute;
        content: "";
        top: 8px;
        left: -6px;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-right: 10px solid #D9D9D9;
    }

    .clearfloat .right{
        text-align: right;
    }
    .clearfloat .right .chat-message{
        background: #8c85e6;
        color: #fff;
        text-align: left;
        min-height: 36px;
    }
    .clearfloat .right .chat-message:before{
        position: absolute;
        content: "";
        top: 8px;
        right: -6px;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-left: 10px solid #8c85e6;
    }

    .clearfloat .chat-avatars{
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #eee;
        vertical-align: top;
        overflow: hidden;
    }
    .clearfloat .chat-avatars>img{
        width: 30px;
        height: 30px;
    }
    .clearfloat .left .chat-avatars{
        margin-right: 10px;
    }
    .clearfloat .right .chat-avatars{
        margin-left: 10px;
    }

    .chatBox-send{
        width: 100%;
        padding: 10px 5px;
        background: #eee;
        border-top: 1px #D0D0D0 solid;
        position: absolute;
        bottom: 0;
        left: 0;
    }
    .div-textarea{
        width: 260px;
        min-height: 20px;
        max-height: 100px;
        _height: 120px;
        padding: 3px;
        outline: 0;
        background: #fff;
        font-size: 14px;
        line-height: 20px;
        word-wrap: break-word;
        overflow-x: hidden;
        overflow-y: auto;
        user-modify: read-write-plaintext-only;    /*纯文本*/
        -webkit-user-modify: read-write-plaintext-only;
        -moz-user-modify: read-write-plaintext-only;
    }
    .div-textarea:focus{
        box-shadow: 0 0 15px rgba(82, 168, 236, 0.6);
    }
    .chatBox-send>div{
        float: left;
    }
    .chatBox-send>div:nth-of-type(2){
        font-size: 0;
    }
    .chatBox-send>div button{
        padding: 4px 5px;
        margin-left: 3px;
        border: none;
        border-radius: 20%;
    }
    .chatBox-send>div label{
        padding: 1px 5px;
        margin-left: 3px;
    }
    #chat-biaoqing{
        position: relative;

    }
    .hidden{
        display: none;
    }
    .biaoqing-photo{
        width: 200px;
        height: 160px;
        background: #ffffff;
        position: absolute;
        top: -160px;
        right: 40px;
        text-align: left;
        border-radius: 5px;
        border: solid 1px #c5c5c5;
        display: none;
    }
    .biaoqing-photo::before{
        content: '';
        position: absolute;
        border-top: solid 7px #c5c5c5;
        border-left: solid 9px transparent;
        border-right: solid 9px transparent;
        bottom: -7px;
        right: 36px;
    }
    .biaoqing-photo::after{
        content: '';
        position: absolute;
        border-top: solid 7px #fff;
        border-left: solid 10px transparent;
        border-right: solid 10px transparent;
        bottom: -5px;
        right: 35px;
    }
    .biaoqing-photo>ul{
        margin: 0;
        width: 200px;
        height: 160px;
        padding: 3px 2px;
        list-style: none;
    }
    .biaoqing-photo>ul>li{
        float: left;
        height: 30px;
        margin-left: 2px;
    }
    .emoji-picker-image{
        display: inline-block;
        width: 30px;
        height: 30px;
        background: url(/dist/img/AI.png) no-repeat;
        background-size: 200px auto;
        cursor: pointer;
    }
    .biaoqing-photo>ul>li span.emoji-picker-image:hover{
        border: solid 1px #f5f5f5;
    }
    .chat-message img{
        width: 220px;
        height:auto;
    }
    #chat-fasong > img {
        width: 17px;
        height: 17px;
    }
    @media all and (max-width: 768px) {
        .chatBox{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    }
    @media all and (max-width: 370px){
        .chat-name{
            width: 185px;
        }
        .chat-people>div:nth-of-type(2){
            width: 120px;
        }
        .clearfloat .chat-message{
            max-width: 240px;
        }
    }
</style>
<div class="chatBtn">
    <img src="/dist/img/chat_icon.png" alt="">
</div>
<div class="chatBox" ref="chatBox">
    <div class="chatBox-head">
        <div class="chatBox-head-two">
            <div class="chat-people">
                <div class="ChatInfoHead">
                    <img src="" alt="头像"/>
                </div>
                <div class="ChatInfoName">AI</div>
            </div>
            <div class="chat-close">关闭</div>
        </div>
    </div>
    <div class="chatBox-info">
        <div class="chatBox-kuang" ref="chatBoxkuang">
            <div class="chatBox-content">
                <div class="chatBox-content-demo" id="chatBox-content-demo">

{{--                    <div class="clearfloat">--}}
{{--                        <div class="author-name">--}}
{{--                            <small class="chat-date">2017-12-02 14:26:58</small>--}}
{{--                        </div>--}}
{{--                        <div class="left">--}}
{{--                            <div class="chat-avatars"><img src="/dist/img/AI.png" alt="头像"/></div>--}}
{{--                            <div class="chat-message">--}}
{{--                                我是Joe商城助手的阅读助手，请问你有什么问题--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="clearfloat">--}}
{{--                        <div class="author-name">--}}
{{--                            <small class="chat-date">2017-12-02 14:26:58</small>--}}
{{--                        </div>--}}
{{--                        <div class="right">--}}
{{--                            <div class="chat-message">嗯，适合做壁纸</div>--}}
{{--                            <div class="chat-avatars"><img src="/dist/img/User.png" alt="头像"/></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
            <div class="chatBox-send">
                <div class="div-textarea" contenteditable="true"></div>
                <div>
                    <button id="chat-fasong" class="btn-info">
                        <img src="/dist/img/chat_send.png" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var chat_list = [];
    var chat_index = 1;
    screenFuc();

    aiAddChat('我是Joe书店的阅读助手，请问你有什么问题', chat_index);
    chat_list.push({
        type: 'reply',
        text: '我是Joe书店的阅读助手，请问你有什么问题'
    });

    function screenFuc() {
        var topHeight = $(".chatBox-head").innerHeight();//聊天头部高度
        //屏幕小于768px时候,布局change
        var winWidth = $(window).innerWidth();
        if (winWidth <= 768) {
            var totalHeight = $(window).height(); //页面整体高度
            $(".chatBox-info").css("height", totalHeight - topHeight);
            var infoHeight = $(".chatBox-info").innerHeight();//聊天头部以下高度
            //中间内容高度
            $(".chatBox-content").css("height", infoHeight - 46);
            $(".chatBox-content-demo").css("height", infoHeight - 46);

            $(".chatBox-kuang").css("height", totalHeight - topHeight);
            $(".div-textarea").css("width", winWidth - 60);
        } else {
            $(".chatBox-info").css("height", 495);
            $(".chatBox-content").css("height", 448);
            $(".chatBox-content-demo").css("height", 448);
            $(".chatBox-kuang").css("height", 495);
            $(".div-textarea").css("width", 320);
        }
    }
    (window.onresize = function () {
        screenFuc();
    })();
    //未读信息数量为空时
    var totalNum = $(".chat-message-num").html();
    if (totalNum == "") {
        $(".chat-message-num").css("padding", 0);
    }
    $(".message-num").each(function () {
        var wdNum = $(this).html();
        if (wdNum == "") {
            $(this).css("padding", 0);
        }
    });

    //打开/关闭聊天框
    $(".chatBtn").click(function () {
        $(".chatBox").toggle(10);
    })
    $(".chat-close").click(function () {
        $(".chatBox").toggle(10);
    })

    $(".chatBox-head-two").toggle();
    $(".chatBox-kuang").fadeToggle();

    //传头像
    $(".ChatInfoHead>img").attr("src", '/dist/img/AI.png');

    //聊天框默认最底部
    $(document).ready(function () {
        $("#chatBox-content-demo").scrollTop($("#chatBox-content-demo")[0].scrollHeight);
    });

    $(".div-textarea").keypress(function(event) {
        if (event.which === 13) {
            $("#chat-fasong").click();
            event.preventDefault();
        }
    });

    // 发送信息
    $("#chat-fasong").click(function () {
        var textContent = $(".div-textarea").html().replace(/[\n\r]/g, '<br>')
        if (textContent != "") {
            $(".chatBox-content-demo").append("<div class=\"clearfloat\">" +
                "<div class=\"author-name\"><small class=\"chat-date\">2017-12-02 14:26:58</small> </div> " +
                "<div class=\"right\"> <div class=\"chat-message\"> " + textContent + " </div> " +
                "<div class=\"chat-avatars\"><img src=\"/dist/img/User.png\" alt=\"头像\" /></div> </div> </div>");

            let inquire = {
                type: 'inquire',
                text: textContent
            };
            chat_index++;
            chat_list.push(inquire);

            //发送后清空输入框
            $(".div-textarea").html("");

            chat_index++;
            aiAddChat('输入中...', chat_index);
            chatListCcrollTop();

            $.post('/api/chat', {'text': textContent}, function (res) {
                $('#chat-list-' + chat_index.toString()).remove();
                if (res['code'] == 200) {
                    aiAddChat(res['data'], chat_index);
                } else if (res['code'] == 500) {
                    aiAddChat(res.msg, chat_index);
                } else {
                    aiAddChat('抱歉，我不明白，请重新询问。', chat_index);
                }
                chatListCcrollTop();
            });
        }
    });

    function aiAddChat(chat_message, chat_index) {
        $(".chatBox-content-demo").append(`
            <div class="clearfloat" id="chat-list-${chat_index}">
                <div class="author-name">
                    <small class="chat-date">2017-12-02 14:26:58</small>
                </div>
                <div class="left">
                    <div class="chat-avatars"><img src="/dist/img/AI.png" alt="头像"/></div>
                    <div class="chat-message">
                        ${chat_message}
                    </div>
                </div>
            </div>
        `);
    }

    function chatListCcrollTop() {
        //聊天框默认最底部
        $(document).ready(function () {
            $("#chatBox-content-demo").scrollTop($("#chatBox-content-demo")[0].scrollHeight);
        });
    }

</script>

