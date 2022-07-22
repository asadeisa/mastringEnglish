<div class="my-4">
    <div class="nav w-100">
        <div class="card-title card-delete w-100
    show-button-form remove-margen aligne-center d-flex p-2">
            <div class="title mx-1 ">
                Dachbord /
            </div>
            @if ($showCoures != false)
                <div class="title mx-1 ">
                    <h6> Courses</h6>
                </div>
            @else
                <div class="title mx-1 ">
                    <p wire:click="goback" class="cursor-pointer"> Courses /</p>
                </div>
                <div class="title mx-1 ">
                    <h6> {{ $title }} </h6>
                </div>
            @endif

        </div>
    </div>

    {{-- {{ dd($AllCoures) }} --}}
    @if ($showCoures == true)
        <div class="container d-flex gap-4 flex-wrap ">
            @foreach ($AllCoures as $coures)
                <div class="card rounded mt-3 p-4  main-cours">
                    <div class="card-title d-flex ">
                        <h4 class="text-center mx-1">{{ $coures->hit_type }}</h4>
                        <p class="text-center my-1 text-sm">
                            @switch($coures->level)
                                @case(1)
                                <p class="text-success my-0">beginner</p>
                            @break

                            @case(2)
                                <p class="text-warning">intermediate 1</p>
                            @break

                            @case(3)
                                <p class="text-info">intermediate 2</p>
                            @break

                            @case(4)
                                <p class="text-dark">expert </p>
                            @break
                        @endswitch

                        </p>
                    </div>
                    <div class="card-body">
                        <div class="discription">
                            <h6> {{ $coures->description }} <span class="text-primary"> with Teacher</span></h6>
                        </div>
                        <div class="d-flex gap-4">
                            <h6 class="text-center">{{ $coures->UName }}</h6>
                            {{-- <h6 class="text-center">{{ $coures->email }}</h6> --}}
                            <div class="progress">
                                <div @if ($coures->t_rank < 4) class="progress-bar   bg-gradient-danger" @endif
                                    @if ($coures->t_rank <= 6 && $coures->t_rank >= 4) class="progress-bar  bg-gradient-info" @endif
                                    @if ($coures->t_rank <= 10 && $coures->t_rank > 6) class="progress-bar bg-gradient-success" @endif
                                    role="progressbar" aria-valuenow="{{ $coures->t_rank }}" aria-valuemin="0"
                                    aria-valuemax="10" style="width: {{ $coures->t_rank }}0%;">
                                </div>
                            </div>
                            <span @if ($coures->t_rank < 4) class="text-danger" @endif
                                @if ($coures->t_rank <= 6 && $coures->t_rank >= 4) class="text-info" @endif
                                @if ($coures->t_rank <= 10 && $coures->t_rank > 6) class="text-success" @endif>{{ $coures->t_rank }}</span>
                        </div>

                        <div class="contetn-corus d-flex">
                            <div class="d-flex mx-1 flex-cloumn">
                                @foreach ($coures->coursContent as $content)
                                    <div class="text-dark d-flex align-center cours-content-style">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        <p class="mx-1">
                                            {{ $content->grammar_type != null ? $content->grammar_type : $content->voc_type }}
                                        </p>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="card-foter d-flex gap-3 align-items-center">
                        <div class="d-flex align-items-center">

                            <i
                                class="fa-solid fa-medal f-x-lg 
        
        @if ($coures->crank == 5) text-success
        @elseif($coures->crank < 5 && $coures->crank >= 3)
        text-warning
        @else
        text-danger @endif

        "></i>
                            <span
                                class="
       @if ($coures->crank == 5) text-success
       @elseif($coures->crank < 5 && $coures->crank >= 3)
       text-warning
       @else
       text-danger @endif
       ">
                                {{ $coures->crank }}</span>
                        </div>
                        <div class="mange">
                            <button wire:click="showCoursContent({{ $coures->id }},
         '{{ $coures->description }}')" class="btn btn-outline-dark to-lower mb-0">preview</button>
                        </div>
                        <div class="setting">
                            <i class="fa-solid fa-gear positions text-dark"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- the cours contetn page --}}
        <div class="card w-100">
            @foreach ($coursContent as $key => $Content)
                <div class="h4 py-1 px-2">
                    <span class="text-start text-primary w-50 mx-3">lesson {{ $key + 1 }}</span>
                </div>
                <div class="card-title ">

                    <h6 class="text-center">
                        {{ $Content->grammar_type == null ? $Content->voc_type : $Content->grammar_type }}
                    </h6>
                </div>
                <div class="card-body mb-5">
                    <div class="d-grid grid-content">
                        <div class="details  text-info ">
                            <p class="font-15">
                                {{ $Content->description }}
                            </p>
                        </div>
                        <div class="image">
                            <div class="card-image">
                                @if ($Content->img != null)
                                    <img height="400px" width="423" src="{{ asset($Content->img) }}" alt="">
                                @elseif($Content->video != null)
                                    <video width="423" height="400px" src="{{ asset($Content->video) }}" alt="">
                                    @else
                                        <div class="no-image">
                                            <p> no image or video </p>
                                        </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-cours grid-start">
                            <article class="px-4 py-1">
                                {{ $Content->text }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Id
                                necessitatibus quaerat minus beatae. Possimus commodi, voluptate qui molestias eum
                                explicabo iure ducimus quas excepturi dignissimos vitae amet tenetur, temporibus
                                expedita?
                            </article>
                        </div>

                    </div>

                    <div class="questions mt-5">
                        <h4 class="text-info py-1 px-2">Questions</h4>
                        <div class="content d-flex  gap-4">
                            @if (count($Content->test) != null)
                                @forelse ($Content->test[0]->questions as $question)
                                    <section class="flex-1">


                                        <div>
                                            <h6>
                                                <i class="fa-solid fa-lg fa-clipboard-question"></i>
                                                {{ $question->question }}
                                            </h6>
                                        </div>
                                        <div class="d-flex flex-items-column p-2 text-option">
                                            @if ($question->translat_sent == 0 && $question->sortabll == 0)
                                                <p> <i class="fa-solid fa-check"></i> {{ $question->option1 }}</p>
                                                <p> <i class="fa-solid fa-check"></i> {{ $question->option2 }}</p>
                                                <p> <i class="fa-solid fa-check"></i> {{ $question->option3 }}</p>
                                                <p> <i class="fa-solid fa-check "></i> {{ $question->option4 }}</p>

                                                <p class="mb-0 text-success">
                                                    <i class="fa-solid fa-circle-check text-success"></i>
                                                    {{ $question->true_ans }}
                                                </p>
                                            @elseif ($question->translat_sent == 1)
                                                <h6 class="rtl pr-2"> الترجمة: <p class="pr-2">
                                                        {{ $question->true_ans }}</p>
                                                </h6>
                                            @else
                                            @endif
                                        </div>
                                    </section>
                                @empty
                                @endforelse
                            @else
                                <div class="text-center">
                                    <p>
                                        No Question related to this cours yet !
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif


</div>
