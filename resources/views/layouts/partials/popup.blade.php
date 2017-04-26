<div class="msg-popup {{session('popup')  ? 'popup' : ''}} popup">
    <div class="close-nav {{session('popup')  ? 'popup' : ''}}"></div>
    <div class="popup-inner">
        <div class="title">
            @if(session('popup'))
                {{session('popup.title')}}
            @endif
            Uh - oh!
        </div>
        <div class="caption">
            @if(session('popup'))
                {{session('popup.caption')}}
            @endif
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad tempore nam facilis, laboriosam totam. 
        </div>
    </div>
</div>
