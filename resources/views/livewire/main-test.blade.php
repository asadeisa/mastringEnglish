<div class="mt-4">
  <div class="card">
    <div class="card-title card-delete
     show-button-form remove-margen aligne-center d-flex p-2">
      <div class="title mx-1 ">
        Dachbord /
      </div>
      <div class="title mx-1 ">
        <h6> Main Test </h6>
      </div>

    </div>

<div class="card-body ">
  <div class="alert alert-success w-50 text-center hide-massege">
    <strong>Question Edit successfully!</strong>
  </div>
  <div class="alert alert-warning w-50 text-center hide-massege-d">
    <strong>Question deleted successfully!</strong>
  </div>
  <div class="content d-flex mb-3">
    <div class=" d-flex card-test w-100">
      @if(count($allQustion->questions) != 0 )
     
      @forelse ($allQustion->questions as $questions )
      <div class="card max-width-44" >
        <div class="card-title">
          <div class="h5 text-center">

            @if ($questions->sortabll === 0 && $questions->translat_sent==0)
            choses
            @elseif ($questions->sortabll == true)
            sort
            @elseif ($questions->translat_sent !=0)
            translate
            @endif
          </div>
        </div>
        <div class="card-body">
          @if ($questions->sortabll == 0 && $questions->translat_sent==0)
          <div class="question d-flex gap-2 align-items-center text-dark">
            <i class="fa-solid fa-lg fa-clipboard-question"></i>
            <p class="mb-0">
              <strong>

                {{ $questions->question }}
              </strong>
            </p>
          </div>
          <div class="question d-flex gap-2 align-items-center text-dark">
            <i class="fa-solid fa-check"></i>
            <p class="mb-0"> {{ $questions->option1 }}</p>

          </div>
          <div class="question d-flex gap-2 align-items-center text-dark">
            <i class="fa-solid fa-check"></i>
            <p class="mb-0"> {{ $questions->option2 }}</p>

          </div>
          <div class="question d-flex gap-2 align-items-center text-dark">
            <i class="fa-solid fa-check"></i>
            <p class="mb-0"> {{ $questions->option3 }}</p>

          </div>
          <div class="question d-flex gap-2 align-items-center text-dark">
            <i class="fa-solid fa-check"></i>
            <p class="mb-0"> {{ $questions->option4 }}</p>

          </div>
          <div class="question d-flex gap-2 align-items-center text-success">
            <i class="fa-solid fa-circle-check"></i>
            <p class="mb-0"> {{ $questions->true_ans }}</p>

          </div>
          @elseif ($questions->sortabll == 1)
          <div class="question d-flex gap-2 align-items-center text-dark">
            <i class="fa-solid fa-lg fa-clipboard-question"></i>
            <p class="mb-0">
              <strong>

                {{ $questions->question }}
              </strong>
            </p>
          </div>
          @elseif ($questions->translat_sent==1)
          <div class="question d-flex gap-2 align-items-center text-dark">
            <i class="fa-solid fa-lg fa-clipboard-question"></i>
            <p class="mb-0">
              <strong>

                {{ $questions->question }}
              </strong>
            </p>
          </div>

          <div class="question d-flex gap-2 align-items-center text-success">
            <i class="fa-solid fa-circle-check"></i>
            <p class="mb-0"> {{ $questions->true_ans }}</p>

          </div>
          @endif
        </div>

        <div x-show="open" class="customize-questions d-flex align-items-center justify-content-center p-2 ">
          <div class="d-flex align-items-center">

            <button wire:click="EditQuestion({{$questions->id  }})" class="btn-info btn btn-sm">
              edit
            </button>
           
             
              <button wire:click="distroyQ({{$questions->id  }})" class="btn-danger btn btn-sm">
                delete
              </button>

            
          </div>
        </div>
      </div>
      <div class="edit-question-admin" id="{{ $questions->id }}">
          <div class="all-shadow"></div>
          <div class="content">
            <h6>Edit Question</h6>
            <hr>
            <form  class="pt-5" wire:submit.prevent="save">
              <div class="d-flex rest-lable">
                 @if($sortabll == 0 && $translat_sent == 0)
                  <div class="choice d-flex flex-column w-100 align-items-center 
                       justify-content-center "
                    x-data="{
                       option1: @entangle('option1').defer ,
                       option2: @entangle('option2').defer ,
                       option3: @entangle('option3').defer ,
                       option4: @entangle('option4').defer ,
                     
                      }"
                  >
                    <div class=" my-2 input-group w-80">
                      <label for="description" class="w-25">
                        <p>question</p>
                      </label>
                      <input class="w-50 rounded form-control" type="text" name="question" id="question" wire:model.defer="question">
                    </div>
                    <div class=" my-2 input-group w-80">
                      <label for="description" class="w-25">
                        <p>option 1</p>
                      </label>
                      <input class="w-50 rounded form-control" type="text"  name="option1" x-model="option1" id="option1">
                    </div>
                    <div class=" my-2 input-group w-80">
                      <label for="description" class="w-25">
                        <p>option 2</p>
                      </label>
                      <input class="w-50 rounded form-control" type="text" x-model="option2" name="option2"  id="option2">
                    </div>
                    <div class=" my-2 input-group w-80">
                      <label for="description" class="w-25">
                        <p>option 3</p>
                      </label>
                      <input class="w-50 rounded form-control" type="text"  x-model="option3" name="option3" id="option3">
                    </div>
                    <div class=" my-2 input-group w-80">
                      <label for="description" class="w-25">
                        <p>option 4</p>
                      </label>
                      <input class="w-50 rounded form-control" type="text"  x-model="option4"  name="option4" id="option4">
                    </div>
                    <div class=" my-2 input-group w-80">
                      <label for="description" class="w-25">
                        <p>the right answer</p>
                      </label>
                      <select name="right_answer" 
                      wire:model.defer="trueAnsower" 
                       class="form-control">
                        <option x-model="option1" x-text="option1" ></option>
                        <option x-model="option2" x-text="option2"></option>
                        <option x-model="option3" x-text="option3"></option>
                        <option x-model="option4"x-text="option4" ></option>
                      </select>
                    </div>

                  </div>

                @endif
                @if ( $translat_sent ==1)
                <div class="Translation d-flex flex-column w-100 align-items-center justify-content-center">
                  <div class=" my-2 input-group w-80">
                    <label for="description" class="w-25">
                      <p>origen sentences</p>
                    </label>
                    <input class="w-50 rounded form-control" type="text" name="sentences" wire:model.defer="question" id="question">
                  </div>
                  <div class="direction-right my-2 input-group w-80">
                    <label for="description" class="w-25">
                      <p class="arabicp">الترجمة : </p>
                    </label>
                    <input class="w-50 rounded form-control" type="text" name="translation" wire:model.defer="trueAnsower" id="translation">
                  </div>
                </div>
                @endif
                @if($sortabll==1)
                <div class="order d-flex flex-column w-100 align-items-center justify-content-center ">
                  <h5 class="w-80 py-2 my-1 px-2">write down the sentences that you want to be ordered</h5>
                  <div class=" my-2 input-group w-80">

                    <label for="description" class="w-25">
                      <p> sentences</p>
                    </label>
                    <input class="w-50 rounded form-control" id="question" type="text" 
                      wire:model.defer="question" >
                  </div>
                </div>
                @endif


              </div>
              <div class="submit-button">
                  <hr/>
                  <div class="button d-flex flex-end ">
                    <button type="button" class="btn btn-outlin-dark close-my-model-edit">close</button>
                    <button type="submit" class="btn btn-dark mx-2">change</button>
                  </div>
              </div>
            </form>
          </div>
      </div>

      @empty

      @endforelse
      @endif
      <div class="card col  bg-dark-fade  max-widh-200 center-items ">

        <div class="card-body">
          <button tooltip="New App" data-bs-toggle="modal" data-bs-target="#new-question" class="unset">
          <i class="fa-solid fa-plus"></i>
          </button>
        </div>
      </div>


      {{-- make Question --}}

      <div x-data="{
                            type: 'choice',
                            firstsection: true,
                            mulityChous : false,
                            Translation: false,
                            order:false,
                            changecontetn : function(){
                              this.firstsection = false ;
                              if(this.type == 'choice')
                              {
                                this.mulityChous = true;
                              }
                              if(this.type == 'Translation')
                              {
                                this.Translation = true;
                              }
                              if(this.type == 'order')
                              {
                                this.order = true;
                              }
                            },
                            back: function(){
                            this.firstsection = true ;
                            this.mulityChous = false;
                            this.Translation = false;
                            this.order = false;
                  
                  
                            },
                            option1:'',
                            option2:'',
                            option3:'',
                            option4:'',
                  
                          
                          
                          }">

        <!-- Modal -->
        <div class="modal fade" id="new-question" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="{{ route("creat-emain-question") }}">
                @csrf

                <div class="modal-body">

                  <div class="container">

                    <input type="hidden" name="maintest" value="1">
                    <div class="my-2 input-group d-flex">
                      <label x-show="firstsection" class="w-25">
                        <p>select type of the test</p>
                      </label>
                      <div x-show="firstsection" class="option w-25 mx-4">

                        <div>
                          <label class="text-sm w-80" @click="type = 'choice'" for="choice">Multiple choice </label>
                          <input @click="type ='choice'" id="choice" checked="checked" type="radio" name="type_test" value="choice">
                        </div>
                        <div>
                          <label class="text-sm w-80" @click="type ='Translation'" for="Translation">Translation</label>
                          <input id="Translation" @click="type ='Translation'" type="radio" name="type_test" value="translatsent">
                        </div>
                        <div>
                          <label class="text-sm w-80" @click="type ='order'" for="order">sentence order </label>
                          <input id="order" @click="type ='order'" type="radio" name="type_test" value="sortabll">
                        </div>
                      </div>
                      <div class="next w-30 ml-5 d-flex align-items justify-center">

                      </div>
                    </div>

                    <template x-if="mulityChous">

                      <div class="choice">
                        <div class=" my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p>question</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" name="question" id="question" placeholder="ex:which the following sentences is in the correct form">
                        </div>
                        <div class=" my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p>option 1</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" x-model="option1" name="option1" id="option1">
                        </div>
                        <div class=" my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p>option 2</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" x-model="option2" name="option2" id="option2">
                        </div>
                        <div class=" my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p>option 3</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" x-model="option3" name="option3" id="option3">
                        </div>
                        <div class=" my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p>option 4</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" x-model="option4" name="option4" id="option4">
                        </div>
                        <div class=" my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p>the right answer</p>
                          </label>
                          <select name="right_answer" checked="none" class="form-control">
                            <option x-text="option1"></option>
                            <option x-text="option2"></option>
                            <option x-text="option3"></option>
                            <option x-text="option4"></option>
                          </select>
                        </div>

                      </div>
                    </template>

                    <template x-if="Translation">

                      <div class="Translation">
                        <div class=" my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p>origen sentences</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" name="sentences" id="sentences">
                        </div>
                        <div class="direction-right my-2 input-group w-80">
                          <label for="description" class="w-25">
                            <p class="arabicp">الترجمة : </p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" name="translation" id="translation">
                        </div>
                      </div>
                    </template>

                    <template x-if="order">

                      <div class="order">
                        <h5 class="w-80 py-2 my-1 px-2">write down the sentences that you want to be ordered</h5>
                        <div class=" my-2 input-group w-80">

                          <label for="description" class="w-25">
                            <p> sentences</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" name="order" id="order">
                        </div>
                      </div>
                    </template>

                  </div>

                  {{-- end modal body  --}}
                </div>


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button x-show="firstsection" @click="changecontetn()" type="button" class="btn btn-dark ">Next
                    <i class="fas fa-long-arrow-alt-right"></i></button>
                  <button x-show="!firstsection" @click="back()" type="button" class="btn btn-dark ">
                    <i class="fas fa-long-arrow-alt-left"></i>back</button>
                  <button x-show="!firstsection" type="submit" class="btn btn-success">confirm</button>
                </div>
              </form>

            </div>
          </div>
        </div>


      </div>

    </div>
  </div>
</div>

</div>





<script>

  window.addEventListener('editques',(id) => {
    console.log(id.detail.id);
    let div = document.getElementById(`${id.detail.id}`);
    div.style.display= "block";
  
  });

  let closeButton = document.querySelectorAll(".close-my-model-edit");
  
  closeButton.forEach((button)=>{
    button.addEventListener("click",()=>{
      let myModle = document.querySelectorAll(".edit-question-admin") ;
        myModle.forEach(oneModle => {
          oneModle.style.display = "none";
        });
  })
  });

  window.addEventListener("success",()=>{
    let success  =  document.querySelector(".hide-massege");
    
    success.style.display = "block";
    setTimeout(() => {
    success.style.display = "none";
      
    }, 2000);
  })

  window.addEventListener("deletesuccess",()=>{
    let success  =  document.querySelector(".hide-massege-d");
    
    success.style.display = "block";
    setTimeout(() => {
    success.style.display = "none";
      
    }, 2000);
  })

  </script>

</div>
