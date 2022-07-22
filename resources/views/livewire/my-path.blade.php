<div class="mt-5">
    <section class="container holder d-flex flex-dierction-column   gap-6">
      @foreach($allCours as $key =>$cours)
      
      <div class="icon-card d-flex gap-3">
        <div class="card custom-card-border pb-2  w-100">
          <div class="card-head-title d-flex justify-content-between">
            <h5 class="p-2 text-center">{{ $cours["description"] }}</h5>
      
          </div>
          <div class="card-body  ">
            <div class="d-flex gap-4">
            @foreach($cours['cours_content'] as $keyc => $content )
            {{-- {{ dd($content) }} --}}
            <form class="unset" action="{{ route("gototest") }}" method="post">
              @csrf
                <input type='hidden' name="contentid" value="{{ $content['id'] }}" />
              <button class="unset" type="submit" >
              
                  <div @if($content['student_progress']!=null && $content['student_progress'][0]['complet'] == 100)
                  class="inbox compolet"
                  @elseif($content['student_progress']!=null && $content['student_progress'][0]['complet'] >=1)
                  class="inbox n-compolet" 
                  @else
                  class="inbox"
                  @endif  
                  >
                @if($content['grammar_type'] != null)
                    <span >{{$content['grammar_type']}}</span>
                  
                  @else
                
                    <span >{{$content['voc_type']}}</span>
                    @endif
                  </div>
              </button>
            </form>
              @endforeach
            </div>
          </div>
        </div>

          <div class="icon-grammer">
            @if($cours['hit_type'] =='grammar')
            <img width="70" height="70" src="{{ asset("images/logo/grammar.png") }}" >
            <div class="hit-type">
              <span class="text-primary">grammar</span>
            </div>
            @else
            <img width="70" height="70" src="{{ asset("images/logo/dictionary.png") }}">
            <div class="hit-type">
              <span class="text-primary">{{ $cours['hit_type'] }}</span>
            </div>
            @endif
          </div>
      </div>
      @endforeach
      <div class="next-level text-center mt-5 ">
        <div class="sorry-masseg ">
          <div class="card">
            <article class="p-4">
              you can't go next level yet ! you have to finish those courses first
            </article>
          </div>
        </div>
        <button wire:click="getNextLevel()" class="btn btn-primary font-16">next level</button>
      </div>
    </section>
 
    <script>
      
      window.addEventListener('finesh-content', event => {
      
        sorryMasseg = document.querySelector(".sorry-masseg");
        
          sorryMasseg.style.opacity =`1`;

        
        setTimeout(() => {
        sorryMasseg.style.opacity = "0";
          
        }, 1500);

      
      })
      
      </script>
</div>
