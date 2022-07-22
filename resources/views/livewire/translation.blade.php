<div>
    <span wire:click="viewTranslate">
        <i class="fa-solid fa-language"></i>
    </span>
  
    <div class="show-translat-data"
  
    >
    <div class="show-rezalt rtl">
        @if ($theArabicRez != null )
        <article class="show-trans">

            {{  $theArabicRez }}
        </article>
            
        @endif
    </div>

    </div>
</div>
