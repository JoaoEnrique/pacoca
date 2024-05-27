<div class="menu-chat-celular col-1" style="margin-right: 30px; align-items: center">
    <a  data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <img src="{{asset('img/menu.png')}}" height="35" style="margin-left: 20px" srcset="">
      </a>
</div>
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Chats</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div style="margin-bottom: 5px!important" class="choose-chat list-chat row" data-bs-dismiss="offcanvas" aria-label="Close" data-chat-id="0">
            <div class="choose-chat col-1" style="margin-right: 30px;display: flex; align-items: center" data-chat-id="0">
                <div class="choose-chat img-list-chat" style="background-image: url({{asset('img/img_account/2.png')}})!important" data-chat-id="0"></div>
            </div>
            <div class="choose-chat col" style="display: flex; align-items: center" data-chat-id="0">
                <h4 class="choose-chat" data-chat-id="0">Paçoca</h4>
            </div>
        </div>
        @foreach ($chats as $chat)
            @foreach ($members as $member)
                @if ($member->chat_id == $chat->chat_id)
                    <div style="margin-bottom: 5px!important" class="choose-chat list-chat row" data-chat-id={{$chat->chat_id}} data-bs-dismiss="offcanvas" aria-label="Close">
                        <div class="choose-chat col-1" style="margin-right: 30px;display: flex; align-items: center" data-chat-id={{$chat->chat_id}}>
                            <div class="choose-chat img-list-chat" style="background-image: url('{{$member->img_account}}')!important" data-chat-id={{$chat->chat_id}}></div>
                        </div>
                        <div class="choose-chat col" style="display: flex; align-items: center" data-chat-id={{$chat->chat_id}}>
                            <h4 class="choose-chat" data-chat-id={{$chat->chat_id}}>{{$member->name}}</h4>
                        </div>
                    </div>

                @endif
            @endforeach
        @endforeach
    </div>
  </div>
