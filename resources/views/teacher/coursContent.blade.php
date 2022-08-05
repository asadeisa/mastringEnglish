@extends('teacher.controlpanel')


@section( 'content')


<main class="main-content position-relative mt-1 border-radius-lg ">
  <x-admin-nav />

  <div class=" py-4 ">
    <div class="all-content">
      @foreach($allContent as $key=> $content)
      <div class="d-flex w-100">
        <div class="  w-100 col-sm-4 ml-2">
          <div class="card w-100 rounded my-2 shadow-lg">

            <div class="card-title card-delete show-button-form remove-margen aligne-center d-flex p-2">
              <div class="title mx-1 ">
                Courses /
              </div>
              <p>
                @switch($content->cours->level)
                @case(1)
                <p>beginner</p>

                @break
                @case(2)
                <p>intermediate 1</p>
                @break

                @case(3)
                <p>intermediate 2</p>
                @break

                @case(4)
                <p>expert </p>

                @break

                @default

                @endswitch

              </p>
              <strong class="mx-1">/</strong>
              <div class="hit-type ">
                <p>{{ $content->cours->hit_type }}</p>
              </div>
              <strong class="mx-1">/</strong>
              <div class="h6 text-center ">
                {{ $content->cours->description}}
              </div>
              <div class="form-cours-content d-flex">
                <div class="edit mx-2">
                  <button data-bs-toggle="modal" data-bs-target="#editcontent{{ $content->id }}" class="btn btn-info btn-sm">edit</button>

                </div>
                <div class="delete">
                  <form action="{{ route("delete-content") }}" method="post">
                    @csrf
                    <input type="hidden" name="content_id" value="{{ $content->id }}">
                    <button class="btn btn-danger btn-sm" type="submit">delete</button>
                  </form>
                </div>

              </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal fade" 
                id="editcontent{{$content->id }}" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true"
             >
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route("edit-content") }}" method="post" enctype="multipart/form-data">

                    <div class="modal-body">
                      <div class="container">

                        @php
                        $type = $content->cours->hit_type;
                        if($type == "grammar")
                        {

                        $list = ["Present simple", "present perfect", "Past simple","Present continuous","Past perfect" ,"present perfect contnuios","past perfect continuous"];
                        $option = $content->grammar_type;
                        }

                        else {

                        $list = ["phrasal verbs","adverb","adjective","pronunciation","new words"];


                        $option = $content->voc_type;


                        }
                        @endphp

                        @csrf
                        <div class=" my-2 input-group ">
                          <label for="description" class="w-25">
                            <p>description</p>
                          </label>
                          <input class="w-50 rounded form-control" type="text" name="description" value="{{ $content->description }}" id="description" required>
                        </div>

                        <div class="input-group mb-3">
                          <label for="" class="w-25" for="inputGroupSelect01">
                            <p>select subject</p>
                          </label>
                          <select class="form-select w-50" name="subject" id="inputGroupSelect01">
                            @for($i = 0; $i < count($list); $i++) <option value="{{ $list[$i] }}" @if( $list[$i]==$option) selected @endif>
                              {{ $list[$i] }}
                              </option>
                              @endfor

                          </select>
                        </div>

                        <input type="hidden" name="type" value="{{ $content->cours->hit_type }}">
                        <input type="hidden" name="content_id" value="{{$content->id  }}">
                        <div class="input-group my-2">
                          <label for="" class="w-25">
                            <p>upload image or viduo</p>
                          </label>
                          <input type="file" name="file" class="form-control w-50" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                        </div>

                        <div class="input-group my-2">
                          <span class="input-group-text">With textarea</span>
                          <textarea name="text" class="form-control" aria-label="With textarea">
                          {{ $content->text }}
                          </textarea>
                        </div>


                      </div>




                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                    
                  </form>

                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="space-around w-100 d-flex">
                <div class="text-center content-type-g text-light">
                  {{ $content->grammar_type ==null ?null:$content->grammar_type }}
                  {{ $content->voc_type ==null ? null: $content->voc_type }}
                </div>

                <div class="cours-detales  px-2 ml-5 w-60 d-flex">
                  <div class="discription d-flex ">
                    <p class="">

                      {{ $content->description }}
                    </p>

                  </div>

                  @if($content->text != null)
                  <div class=" my-1 d-flex align-items  ">
                    <div class=" ">
                      <div class=" py-1 my-1 ">
                        <p>
                          {{$content->text}}
                        
                        </p>

                      </div>
                    </div>
                  </div>
                  @endif

                </div>
                @if ($content->img != null || $content->video != null )

                <div class="image-video  my-3 col-sm-4 d-flex align-items justify-center ">

                  <div class="image-or-video ">
                    @if($content->img != null)
                    <img width="200" height="200" src="{{asset($content->img)
                                   }}" alt="">
                    @endif

                    @if($content->video != null)
                    <video width="200" height="200" src="{{ asset($content->video) }}">
                    </video>
                    @endif

                  </div>
                </div>
                @else
                <div class="image-content start-end  d-flex align-items-center ">
                  <div class="h5 p-2 text-center">no image or video found!</div>
                </div>
                @endif

              </div>

              @if(session()->has('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}
              </div>
              @endif
              {{-- start test part  --}}
              <div class="test-section col-lg-12 col-lg-8 col-sm-6">
                <hr>
                @if(session()->has('delete'))
                <div class="alert alert-success">
                  {{ session()->get('delete') }}
                </div>
                @endif
                <div class="content d-flex mb-3">

                  <div class=" d-flex card-test w-100">
                    @if(count($content->test) != 0 )
                  
                    
                      @forelse ( $content->test[0]->questions as $questions )
                      <div class="card max-width-44" x-data="{ open: false }" @click="open = ! open">
                        <div class="card-title">
                          <div class="h5 text-center">
                            
                            @if ($questions->sortabll === 0 && $questions->translat_sent==0)
                            choice
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

                            <button class="btn-info btn btn-sm">
                              edit
                            </button>
                            <form action="{{route("delete-question")}}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $questions->id }}" >
                              <button type="submit" class="btn-danger btn btn-sm">
                                delete
                              </button>
                            
                            </form>
                          </div>
                        </div>
                      </div>


                      @empty
                      @endforelse
                
                    @endif
                    <div class="card col  bg-dark-fade  max-widh-200 center-items ">

                      <div class="card-body">
                        <button tooltip="New App" data-bs-toggle="modal" data-bs-target="#content{{ $content->id }}" class="unset">
                          <i class="fa-solid fa-plus"></i>
                        </button>
                      </div>
                    </div>

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
                  <div class="modal fade" id="content{{ $content->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Create New Question</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route("create-question") }}">
                          @csrf
                          
                          <div class="modal-body">

                            <div class="container">

                              <input type="hidden" name="contentId" value="{{ $content->id }}">
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
                                      <p>original sentence</p>
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
      </div>
      @endforeach

    </div>
  </div>
  
</main>

<script>
  var myModalEl = document.getElementById('myModal')
  myModalEl.addEventListener('hidden.bs.modal', function(event) {
    // do something...
  })

</script>


@endsection
