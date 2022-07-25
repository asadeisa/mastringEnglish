<div >
  <div x-data="{
      section2 : @entangle('nextGroupeQuestion').defer,
      section1 : !this.section2,
      {{-- nextGroupeQuestion : @js($nextGroupeQuestion), --}}

      toSection1 : function(){
          this.section1 = true;
          this.section2 = false;

      },
      toSection2 : function(){
          this.section1 = false;
          this.section2 = true;

      },


  }">


    <div class="container d-flex align-items-center justify-content-center hight-100">
      <div x-show="section1" class="card w-100 p-5 ">
        <div class="card-head">
          <div class="card-title">
            <h4 class=" d-flex justify-content-center ">
              <div class=" before-underline p-1"> test for indicate your level </div>

              </p>
          </div>
          <div class="card-body d-flex gap-4">
            <div class="with-test w-50">
              <div class="card-image">
                <img loading="eager" width="300" hieght="300" src="{{ asset("svg/undraw_exams_g-4-ow.svg") }}" alt="">
              </div>
              <p class="font-18 mt-3 ">
                it's just take a few mineat
                <button @click="toSection2" class="btn btn-primary text-transform-sm mx-2 my-0">let's get started</button>
              </p>
            </div>
            <div class="no-test w-50 d-flex flex-direction-column gap-4 ">
              <h4 class="text-center">
                are you new to English ?
              </h4>
              <p class="font-18">
                don't worry you can pass the test and start from scratch !
              </p>
              <div class="mt-5 d-flex justify-content-center pt-4">
                <form action="{{ route("start-beginner") }}" method="post">
                  @csrf
                  <button class="btn btn-outline-primary mb-0 mt-5">start</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div x-cloak x-show="section2" wire:key="{{ rand() }}" class="all-test-content w-75">

        <div class="card prespactive-rotae" x-cloak x-data="{
              studentAnswer1 :@entangle('studentAnswers'),
              studentAnswer : [],
              maxkey : {{ count($AllTest["questions"]) }},
              key:0,
              submitButton: false,
              answer : '',
              incresekey: function(){
                if(this.answer == '')
                {
                  this.answer = '-1';
                }
                  this.studentAnswer.push(this.answer.trim());
                  this.answer = '';
                  if(this.key < this.maxkey-2)
                  {

                      this.key++;
                  }else{
                      this.key = this.maxkey-1;  
                  this.submitButton = true;

                  }

              },
              preckTest : function()
              {   
                  this.studentAnswer.push(this.answer);
                  this.answer = '';
                  this.submitButton = false;
                  this.key = -1;
                  this.studentAnswer1 = this.studentAnswer;
                  this.studentAnswer = [];
              },
            
          }">


          @foreach ($AllTest["questions"] as $key=> $question)
          <section x-show="key == {{ $key }}">
            <div class="card-title m-2">
              <h4>
                <div class="before-underline p-1 ">Question{{ $key+1 }}</div>
              </h4>
            </div>

            <div class="card-body">

              @if($question["translat_sent"]==0 && $question["sortabll"] ==0)
              <h5 class="text-center"> <i class="fa-solid fa-lg fa-clipboard-question"></i>
                choose the correct answer
              </h5>
              <h6>

                {{ $question["question"] }}
              </h6>
              <div class="options">
                <div class="option1">
                  <input type="radio" x-model="answer" name="option" id="option1" value="{{ $question["option1"] }}">
                  <label for="option1">{{ $question["option1"] }}</label>

                </div>
                <div class="option1">
                  <input type="radio" x-model="answer" value="{{ $question["option2"] }}" name="option" id="option2">
                  <label for="option2">{{ $question["option2"] }}</label>

                </div>
                <div class="option1">
                  <input type="radio" x-model="answer" value="{{ $question["option3"] }}" name="option" id="option3">
                  <label for="option3">{{ $question["option3"] }}</label>

                </div>
                <div class="option1">
                  <input type="radio" x-model="answer" value="{{ $question["option4"] }}" name="option" id="option4">
                  <label for="option4">{{ $question["option4"]}}</label>

                </div>
              </div>
              @elseif ($question["translat_sent"]==1)
              <h5 class="test-center">
                <i class="fa-solid fa-lg fa-clipboard-question"></i> translate this sentence
              </h5>
              <h6>

                {{ $question["question"] }}
              </h6>
              <div class="rtl answor">
                <input class="form-control mt-2" type="text" x-model="answer" id="">
              </div>
              @else
              <h5 class="test-center">
                <i class="fa-solid fa-lg fa-clipboard-question"></i> sort this sentence
              </h5>
              @php
              $sentenses = explode(" ",$question["question"]);
              $shfilledSentents =shuffle($sentenses) ;

              @endphp
              @for ($i =0 ; $i < count($sentenses) ; $i++) <strong> {{ $sentenses[$i] ." | " }}</strong>
                @endfor
                <div class="sort ">

                  <input class="form-control mt-2" type="text" x-model="answer">
                </div>
                @endif
            </div>

            <div class="card-footer d-flex gap-3">
              <button type="button" x-show="!submitButton" 
              x-on:click="incresekey"  class="btn btn-info text-transform-sm">
                next
              </button>
              <button x-on:click="preckTest" type="button" x-show="submitButton" class="btn btn-dark text-transform-sm">next </button>

              @if ($levelinterface !="expert")
              <button wire:click="InteruptTest" class="btn
              @if($levelinterface =="beginner")
              btn-outline-danger 
              @elseif ($levelinterface =="intermediate 1" )
              btn-outline-warning
              @elseif ($levelinterface =="intermediate 2")
              btn-outline-success
              @endif

               text-transform-sm">start as {{ $levelinterface }}</button>
               @endif
            </div>
          </section>
          @if($key==0)
          <section 
         
          class="
            @if ($levelinterface !="expert")
            d-none 
            @endif
            well-done
            section-rotae
          ">
          <div class="image-and-content d-flex gap-4 align-items-center h-100">
            <div class="image flex-1">
              <img width="300" height="200" src="{{ asset("images/undraw/undraw_things_to_say_re_jpcg.svg") }}" alt="">

            </div>
            <div class="container flex-1">

              <div class="h5 p-3 text-success">  well done you did grate! 
                you can escape the test and start as  expert
              </div>
              <div class="d-flex gap-3 my-2">
                  <button wire:click="InteruptTest" class="btn btn-sm btn-info">Go</button>
                  <button onclick="closeWellDone()" class="btn btn-sm btn-danger">Exit</button>
              </div>
            </div>
        
          </div>

          </section>
          @endif
          @endforeach


        </div>
      </div>
    <script>
      function closeWellDone()
      {

       let section  =  document.querySelector(".well-done");
       section.style.display = "none";
      }

    </script>

    </div>

  </div>
</div>