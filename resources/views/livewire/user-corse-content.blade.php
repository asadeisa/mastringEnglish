<div>
	<section class="hidden-teacher-card">

    <div wire:ignore class="card teacher-card hidden-teacher-card d-flex  mt-5">
			<div class="profile">
			
					<img width="100" src="{{ asset($coursContent["teacher"]["user"]["img"]) }}">
			</div>

			<div class="contact-with w-75">
					<h6>{{ $coursContent["teacher"]["user"]['name'] }} <span class="ml-2  ">
									<a href="#" class="text-primary text-sm">{{ $coursContent["teacher"]["user"]['email']  }}</a>
							</span></h6>
					<div class="progress">
							<div @if ($coursContent["teacher"]['rank'] < 4) class="progress-bar   bg-gradient-danger" @endif
									@if ($coursContent["teacher"]['rank'] <= 6 && $coursContent["teacher"]['rank'] >= 4) class="progress-bar  bg-gradient-info" @endif
									@if ($coursContent["teacher"]['rank'] <= 10 && $coursContent["teacher"]['rank'] > 6) class="progress-bar bg-gradient-success" @endif
									role="progressbar" aria-valuenow="{{ $coursContent["teacher"]['rank'] }}" aria-valuemin="0"
									aria-valuemax="10" style="width: {{ $coursContent["teacher"]['rank'] }}0%;">
							</div>
					</div>
			</div>
	</div>
	</section>
	@php
   $isfollow = session('myFollowTeacher') == null ? false:true;
	@endphp
	<div wire:ignore class="content"
		x-data="{
			key: 0,
			isfollow:@js($isfollow),
			question:0,
			Qustionoutline:false,
			totleContent : @js(count($coursContent['cours_content'])),
			showqustion:false,
			finishCours : false,
			qustionturn: false,
			treggerfunction: @entangle("treggerFowllowQ"),

			getnextPart: function() {
				if(this.finishCours == true && this.isfollow == true)
				{
					this.treggerfunction = true; 
				}else if(this.totleContent == 1 && this.isfollow == true)
				{
					this.treggerfunction = true; 

				}
				
				else{
					
					if(this.totleContent -1 == this.key )
					{
						this.showqustion = false;
						this.finishCours = true;
						let heddendiv = document.querySelector('.hidden-teacher-card');
						heddendiv.style.display = 'none';
					}else{
						this.key++;
	
					}
				}
			},
			showQuestion: function(){
				this.showqustion = true;
				this.qustionturn = true;
			},
			goback : function (){
				this.showqustion = false;
				this.key--;

			},
			endQustion: function(){
				this.showqustion = false;
				this.Qustionoutline = true ;
				this.qustionturn = false;

			}

			}"
			@finish-qustion.window="endQustion()"
		>
	<template x-cloak  x-if="!finishCours">
		<section>
			@foreach ($coursContent['cours_content'] as $key => $content)
	
			<template wire:ignore x-if="key=={{ $key }}">
			
				<div class="all-content ">
						<h2 class="text-center text-primary  mb-0 text-title-count"><span>Lesson
										{{ $key + 1 }}</span></h2>
						@if ($content['video'] != null)
								<h6 class="text-center py-2"> Read and listen to the word .
								</h6>
								<div class="card video-card margin-auto w-75 ">
										<video src="{{ asset($content['video']) }}"></video>
								</div>
						@elseif($content['img'] != null)
							<div class="mb-5">
									<h3 class="text-primary">
											look to the image and read the note
									</h3>
							</div>
								<div class="card image-card margin-auto mt-2  ">
										<div class="image-container">
												<img width="900" height="800" src="{{ asset($content['img']) }}"/>
		
										</div>
								</div>
								<div class="note-next-image my-4">
										<div class="h5 p-2 ml-2 ">
												{{ $content['description']  }}
										</div>
								</div>
						@else
						
		
								<div class="card article-card margin-auto w-75 p-4 ">
										<div class="discription d-flex justify-content-between">
												<p class="font-16 text-dark">{{ $content['description'] }}</p> 
												<span  class="d-flex gap-3">
														
														<span  class="sound d-flex gap-3" x-data="{open:false}">
															<span @click="open=!open" x-show="open">
															<i class="fa fa-chevron-right"></i>
															</span>
															<span id="speak" >
																	<span @click="open=true">
		
																			<i class="fa-solid fa-volume-high"></i>
																	</span>
															</span  >
																<span x-show="open" id="stop"><i class="fa-solid fa-circle-stop"></i>
															</span>
																<span id="pause"  x-show="open">
																	<i class="fa-solid fa-circle-pause"></i>
																</span>
																<span  x-show="open" class="input-style"><input type="number" name="namber" id="namber" max="3" min=".5" step=".5" value="1" div="">
															</span>
															</span>
																<span class="translate">
																
																	<livewire:translation :textvalue="$content['text']" :wire:key="$key" >
																
																</span>
												</span>
										</div>
										<article class="articals-to-read">
												{{ $content['text']}} Lorem ipsum dolor sit amet
												consectetur adipisicing elit. Repellendus doloribus optio consequatur voluptatum,
												architecto totam laborum vero earum corrupti fugiat, ex vel aliquid atque,
												distinctio explicabo cum et quaerat velit?
										</article>
								</div>
		
					<script>
							setTimeout(()=>{
		
								defineProperty()
		
							
						},400)
					</script>
							@endif
				</div>
			</template>
		
				<div wire:ignore x-cloak  x-show="key=={{ $key }} && !qustionturn"
						class="next-content left-shadow bg-white mt-5 mb-1 p-5 w-100" >
						<div x-cloak  x-show="question !=-1" class="d-flex flex-end gap-3">
							<div x-cloak  x-show="key>0" class="back">
								<button @click="goback" class="btn btn-outline-warning btn-lg">back</button>
							</div>
								<div class="question">
										<button @click="showQuestion"  :class="Qustionoutline?'btn btn-outline-info btn-lg':'btn btn-info btn-lg'">
												Questions
										</button>
	
								</div>
								<button @click="getnextPart" :class="!Qustionoutline?'btn btn-outline-info btn-lg font-16 ':'btn btn-info font-16 btn-lg'">Continuo</button>
						</div>
				</div>
			
	
			<template x-if="key=={{ $key }}">
				<section wire:ignore  x-cloak x-show="showqustion" class="section-of-q">
					<div   class="all-qustion bg-dark d-flex align-time-center"	>
						@foreach ($content["test"] as  $test)
					
							<div class="card card-question pt-4" id="qustion-hidden{{ $key }}" 
							x-data = "{
									qustionkey: 0,
									seclectedOption:'',
									ErrorMasseg:false,
									SuccessMasseg:false,
									checkOut:true,
									ErrorAnswerQueue:[],
									maxCountQustion: @js(count($test['questions'])),
									finalQustion: false,
									contentid : @js($content['id']),
									getNextQustion : function(){
										
										this.ErrorMasseg = false;
										this.checkOut = true;
										this.seclectedOption = '';
										this.SuccessMasseg = false;
										this.qustionkey++;
										if(this.maxCountQustion -1 ==this.qustionkey )
										{
											this.finalQustion = true;
										}
	
									},
									exameTheAnswer: function(rightanswer,id){
	
										 if(this.seclectedOption.trim()== rightanswer){
												this.SuccessMasseg = true;
												
										 }else{
											this.ErrorMasseg = true;
											this.ErrorAnswerQueue.push(id);
										 }
										 this.checkOut = false;
										 if(this.maxCountQustion == 1)
										 {
											this.finalQustion = true;

										 }
	
									},
									accesstoRoot : function() {
										if(this.ErrorAnswerQueue.length == 0 ||this.ErrorAnswerQueue[0] == -1){
	
											this.ErrorQueu = -1;
										}else{
	
											this.ErrorQueu = this.ErrorAnswerQueue;
										}
									},
									resetdata:  function()	{  
										this.qustionkey = 0;
										this.ErrorAnswerQueue =	[];
										this.finalQustion =	false;
										this.checkOut =	true;
										this.ErrorMasseg =	false;
										this.SuccessMasseg =	false;
										this.seclectedOption =	'';
			
									},
					
							}"
							@finish-qustion.window=" resetdata()"
							
							>
				
						@foreach ($test['questions'] as $keyqustion => $qustion  )
						{{-- <template  x-if="qustionkey == {{ $keyqustion }}"> --}}
							<div wire:ignore x-cloak x-show="qustionkey == {{ $keyqustion }}" class="card-head">
								<div class="h4 under-line p-3">
										<div> Qustion {{ $keyqustion+1 }}</div>
								</div>
								<div class="contant">
									@if ($qustion['translat_sent'] == 0 && $qustion['sortabll'] ==0)
										<div class="ml-2">
											<h4 class="p-1 my-3 text-primary "> chooes the Corecte answer </h4>
											<form  :class="!checkOut?'blouk-input':''">
												<div class="question-text ml-2">
													<div class="label mb-4">
														<h5 >{{ $qustion['question'] }}</h5>
														<template x-cloak  x-if="SuccessMasseg">
		
															<div class="show-succes margin-auto text-success w-50 d-flex gap-3 rounded">
															 <span class="round-curcil">	<i class="fa-solid fa-check"></i></span>
															<h4 class=" ">	well done !	the answer is correct .</h4>
															</div>
														</template>
														<template x-cloak  x-if="ErrorMasseg">
		
															<div class="show-Error margin-auto text-danger w-50 d-flex gap-3 rounded">
															 <span class="round-curcil"> <i class="fa-solid fa-xmark margen-left-3"></i></span>
															<h4 class=" "> the wright answer is ` {{  $qustion['true_ans'] }}	` </h4>
															</div>
														</template>
		
													</div>
		
													<div class="d-flex justify-content-around w-90">
														<div class="option">
															<input type="radio" name="option"
															x-model="seclectedOption" id="option1{{ $qustion['id'] }}"
													
																value="{{ $qustion['option1'] }}"  >
															<label for="option1{{ $qustion['id'] }}">{{ $qustion['option1'] }}</label> 
															
														</div>
														<div class="option">
															<input type="radio" name="option" id="option2{{ $qustion['id'] }}"
															x-model="seclectedOption"
															value="{{ $qustion['option2'] }}"  >
															<label for="option2{{ $qustion['id'] }}">{{ $qustion['option2'] }}</label> 
															
														</div>
														<div class="option">
															<input type="radio" name="option" id="option3{{ $qustion['id']}}"
															x-model="seclectedOption"
															value="{{ $qustion['option3'] }}"  >
															<label for="option3{{ $qustion['id'] }}">{{ $qustion['option3'] }}</label> 
															
														</div>
														<div class="option"><input type="radio" name="option" id="option4{{$qustion['id'] }}"
															x-model="seclectedOption"
															value="{{ $qustion['option4'] }}"  >
															<label for="option4{{ $qustion['id'] }}">{{ $qustion['option4'] }}</label> 
															
														</div>
													
													</div>
												</div>
											</form>
										</div>
									@elseif ($qustion['translat_sent'] == 1) 
									<div class="ml-2">
										<h4 class="p-1 my-3 text-primary ">Translate this sentence to Arabic </h4>
										<form   :class="!checkOut?'blouk-input':''">
											<div class="question-text ml-2">
												<div class="label mb-4">
													<h5 >{{ $qustion['question'] }}</h5>
												</div>
												<div class="massage-text mb-5">
		
													<template x-cloak  x-if="SuccessMasseg">
		
														<div class="show-succes margin-auto text-success w-50 d-flex gap-3 rounded">
														 <span class="round-curcil">	<i class="fa-solid fa-check"></i></span>
														<h4 class=" ">	well done !	the answer is correct .</h4>
														</div>
													</template>
													<template x-cloak  x-if="ErrorMasseg">
		
														<div class="show-Error margin-auto text-danger w-50 d-flex gap-3 rounded">
														 <span class="round-curcil"> <i class="fa-solid fa-xmark margen-left-3"></i></span>
														<h4 class=" "> the wright answer is ` {{  $qustion['true_ans'] }}	` </h4>
														</div>
													</template>
												</div>
												<div class="the-answoer rtl d-flex gap-4 flex-end">
													<label class="mb-0 font-16"> : الترجمة</label>
													<input class="form-control w-50" type="text" x-model="seclectedOption" >
												</div>
											</div>
										</form>
									</div>
									@elseif ($qustion['sortabll'] == 1)
									<div class="ml-2">
										<h4 class="p-1 my-3 text-primary ">sort this sentence to have maning 
											</h4> 
										
										@php
											$sentenses = explode(" ",$qustion['question']);
											$shfilledSentents =shuffle($sentenses) ;
										@endphp
										<div class="label mb-4">
		
										 @for ($i =0 ; $i < count($sentenses) ; $i++) <span class="word-shuffle font-14"> {{ $sentenses[$i]  }} </span>
										 <span>|</span>
										 @endfor
										 <div class="massage-text my-5">
		
											<template x-cloak  x-if="SuccessMasseg">
		
												<div class="show-succes margin-auto text-success w-50 d-flex gap-3 rounded">
												 <span class="round-curcil">	<i class="fa-solid fa-check"></i></span>
												<h4 class=" ">	well done !	the answer is correct .</h4>
												</div>
											</template>
											<template x-cloak  x-if="ErrorMasseg">
		
												<div class="show-Error margin-auto text-danger w-50 d-flex gap-3 rounded">
												 <span class="round-curcil"> <i class="fa-solid fa-xmark margen-left-3"></i></span>
												<h4 class=" "> the wright answer is ` {{  $qustion['question'] }}	` </h4>
												</div>
											</template>
										</div>
										 <div class="ansower my-3 mx-2">
											 <form  :class="!checkOut?'blouk-input':''" >
		
												 <input type="text" class="form-control w-50" x-model="seclectedOption" >
											 </form>
										 </div>
										</div>
		
									</div>
										 
									@endif
								</div>
		
								<div  class="next-question mt-5 p-5 d-flex flex-end gap-3">
								
										<button x-cloak x-show="!checkOut && !finalQustion"  @click="getNextQustion" class="btn btn-dark btn-lg" >next</button>
										<a x-cloak x-show="checkOut"  
										@if ($qustion['sortabll'] == 1)
										 @click="exameTheAnswer( @js($qustion['question']), @js($qustion['id']))"
										 @else
										 @click="exameTheAnswer( @js($qustion['true_ans']), @js($qustion['id']))"
										 @endif
										 :class=" seclectedOption ==''?' btn btn-success btn-lg disable-btn': 'btn btn-success btn-lg' " >check out</a>
									
										 <button x-cloak x-show="!finalQustion" @click="$wire.closeQustion()" class="btn btn-outline-danger btn-lg font-16" >close</button>
										 <template x-if="!checkOut && finalQustion">
											<button @click="$wire.EndTasek(ErrorAnswerQueue,contentid,maxCountQustion)" class="btn btn-info btn-lg font-16" >finish</button>	 
										 </template>
										
								</div>
							</div>
						{{-- </template> --}}
					
						@endforeach
						
						</div>
					
						@endforeach
					</div>
	
				</section>
			</template>
			@endforeach

		</section>

	</template>
	{{-- end of cours content  --}}
		<div x-cloak x-show="finishCours" class="finesh-cours p-5">
			<section class="sentralize-content"
			x-data="{
					showfollowMesseg : @entangle('showfollowMesseg'),

			}"
			>
				<div class="card d-flex gap-3 p-4">
					<div class="image-card image-width">
						<img width="300" src="{{ asset($coursContent["teacher"]["user"]["img"]) }}">
					</div>
					<div class="information p-2">
						<h5> {{ $coursContent["teacher"]["user"]["name"] }}</h5>
						<div class="email">
							<small>
								<a href="#" class="text-primary text-sm">{{ $coursContent["teacher"]["user"]['email']  }}</a>
							</small>
						</div>
						<div class="glimpse p-1 font-16">
							{{ $coursContent["teacher"]["glimpse"] }}
					</div>

					<div class="contact mt-5 d-flex gap-4 mx-5 ">
						<template x-if="showfollowMesseg">
							
							<div class="followe-section w-100">
								<div class="show-succes margin-auto text-success w-50 d-flex gap-3 rounded">
									<span class="normalize-check">	<i class="fa-solid fa-check"></i></span>
								 <h6 class="text-success ">	you are following  {{ $coursContent["teacher"]["user"]["name"] }}.</h4>
								 </div>
								 <div class="show-related-cours mt-5">
									 <button @click="$wire.gotoTeacherCourses()"  class="btn btn-info block  font-16 btn-lg">Contenuo with  {{ $coursContent["teacher"]["user"]["name"] }}</button>
								 </div>
							</div>
						</template>
						<template x-if="!showfollowMesseg">
							<div class="d-flex gap-4">

								<button  @click="$wire.followTeacher()" class="btn btn-info   font-14 "> follow</button>
								<button type="button"  @click="$wire.getNewCours()" class="btn btn-outline-primary   font-14 "> get new Course
									
								</button>
							</div>
						</template>
					</div>
				</div>
			</section>
		</div>
	
			
	</div>
</div>
