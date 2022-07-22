<div wire:ignore class="user-info profile-chats set-active-chat{{ $userInfo["id"] }}">
    <section wire:ignore class="w-100  d-flex gap-3 align-items-center px-1 py-2 rounded" wire:click="setthischat">

        <div   class="profile ">
           <section  wire:ignore class="profile " id="{{ $userInfo['id'] }}">
            <img width="75" height="75" src="{{ asset($userInfo["img"]) }}" >
           </section>
        </div>
        {{ $userInfo['name'] }}
    
        <span id="not-{{ $userInfo['id'] }}" class="number-unreded-comment mx-3     @if($messageNam == null) tempnone  @endif">{{ $messageNam }}</span>
       
    </section>

</div>