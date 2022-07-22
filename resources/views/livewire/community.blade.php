
<div class='main-content'
x-data="{
    
    showimptymessage: @js($showimptymessage),

}"
@change-alpine.window="showimptymessage = false"
>
@php
use Carbon\Carbon;
		
@endphp

	<section   wire:ignore.self class="d-flex split-screen ">
		<div wire:ignore.self class="chat-contnet card  ">
			<div class="card-head"></div>
			<div class="card-body">

					<div x-cloak x-show="showimptymessage " class="no-masseg p-5 ">
							drag the chat to start
					</div>
					<section x-show="!showimptymessage ">

							@foreach ($alluser as $user)
									@if($Targetid == $user->id)
							<div class="chat-massenger d-flex">
									<div class="user-data d-flex   flex-direction-coloumn">
													<div class="profile  mt-3 ">
															<section id="user{{$user->id}}" class=" chat-image "  wire:ignore.self>
																<img width="100" height="100" src="{{ asset($user->img) }}" >
															</section>
														</div>
														<div class="text-lg  h5 text-center">
															{{ $user->name }} <span class="text-primary text-sm text-shadow">
																({{ $user->teacher ==1?"teacher":"student" }})
															</span>
														</div>
												<section  >
													<p class="mx-1 my-3">{{ $user->email }}</p>
													<p>
														joined at {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d ');  }}
													</p>
													<div class="vidoe-chat d-flex mx-2 my-3 align-items-center justify-content-center">
														{{-- {{ dd($user) }} --}}
													<span class=" flex-1 ">
														<button id="create-offer" class="unset text-primary font-20 "
														 >
															<i class="fa-solid fa-video fa-lg"></i>
														</button>
												
													</span>	
													</div>
												</section>
									</div>
									<div class="messages mx-1 pb-5">
										<section class="message-chat">
							
											<ul   class="px-2">
												@if($chatUser != null && count($chatUser) != 0)
												@foreach($chatUser as $onemessage)
											<li 
												@if($onemessage['user_id']== auth()->user()->id)
												class="user-chat"
												@else
												class="target-chat"
												@endif
											>{{ $onemessage['body'] }}</li>
												@endforeach
												@endif
												@if( count($tempMessage) != 0)
												@for ($i = 0; $i < count($tempMessage); $i++)
												<li class="user-chat">{{ $tempMessage[$i] }}</li>
														
												@endfor
												@endif
											</ul>
										</section>
											<div class="p-under-n w-95 d-flex gap-3">
													<input type="text" 
													wire:model.defer="theMessage"
													class=" form-control"  plassholder="start masseging ...">
													<button class="unset font-20 text-primary sent-message"
													type="button"
													wire:click="sentText({{$user->id}})"
													>
															<i class="fa-solid fa-paper-plane"></i>

													</button>

											</div>
									</div>
							</div>
							@endif
							@endforeach
					</section>
			</div>
		</div>
		
		<div wire:ignore.self class="all-chat-info position-relative  card " >
			<div class="card-body d-flex gap-3 py-1  px-2">
					@foreach ($alluser as $user)
						@if($user->id != auth()->user()->id) 
							@livewire("chat-user" ,["userInfo"=>$user],key($user->id))  
		        @endif
					@endforeach
			</div>
		</div>

	</section>
	<div wire:ignore class="full-scren-dark">

		<section  wire:ignore  class="vidoe-strem">
			<div class="videos d-flex ">
				<video class="video-player vidoe-user-2" id="vidoe-user-2" autoplay playsinline></video>
				<video class="video-player vidoe-user-1" id="vidoe-user-1" autoplay playsinline></video>
			
		</div>
	<div class="calls-options d-flex gap-4 p-2">
		<span class="text-success vidoes-staff">
			<span><i class="fa-solid fa-video"></i></span>
		<span class="disabled">	<i class="fa-solid fa-video-slash  "></i></span>
		</span>
		
	<span class="text-success calls-staff">
		<span>	<i id="close-connection" class="fa-solid fa-microphone"></i></span>
	<span class="disabled">	
		<i class="fa-solid fa-microphone-slash "></i>
	</span>
		
	</span>
	<span class="text-danger " id="end-stream-call">
			<i class="fa-solid fa-phone"></i>

		</span>

	</div>
		</section>
	</div>

<section class="message-joine-for-stream mt-2 p-5 card w-50 margin-auto ">
	
	<div class="card-body">
		<p class="font-16 text-center mb-3"><span class="text-primary"></span> wont to start chat vidoe with you </p>
		<div class="button-group d-flex gap-4 justify-content-center mt-5 w-100 ">
			<button id="reject-offer" class="btn btn-outline-danger" type="button">close</button>
			<button id="create-answer"  class="btn btn-primary ">joine</button>
		</div>

	</div>
</section>

</div>
