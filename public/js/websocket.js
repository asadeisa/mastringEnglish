

let theMessage  = [];
let senderId = null  ; 
let idofActiveuser = [];
let profieleid  = null ;  
let offerKeyChannel  = null ; 
let offerReseved  = null ; 
let activeprofile = document.querySelectorAll(".all-chat-info .profile");

// for vidoe stream 
let startvidoeStream  = null ; 
// this var will init whene the respons get form bordcast to user so we show hem the 
// message of joining vidoe and if he click joine we will create answer .
let acceptOffer  = null ; 


const presentActiveChannel = Echo.join(`home.1`)

presentActiveChannel
  .here((users) => {
    //
    console.log('here');
    console.log(users);
    users.forEach((user) => {
      idofActiveuser.push(user.id);
    })
    setActiveclass(idofActiveuser);

  })
  .joining((user) => {
    console.log('joining');
    console.log(user);
    idofActiveuser.push(user.id);
    setActiveclass(idofActiveuser);
    // set active class to larg image
    let laragImag =  document.querySelector(`.user-data #user${user.id}`);
    if(laragImag != null)
    {
     laragImag.classList.add('active');
    }
  })
  .leaving((user) => {
    console.log('imleving');
    console.log(user);
    for (var i = 0; i < idofActiveuser.length; i++) {

      if (idofActiveuser[i] === user.id) {

        idofActiveuser.splice(i, 1);
      }

    }
    removeActive(user.id);

  })
  .listen('websocketTest',(e)=>{
  console.log(e);
    
  })


function setActiveclass(id) {

//  console.log(id);
  idofActiveuser = id


  activeprofile.forEach(profile => {
    for (let i = 0; i < idofActiveuser.length; i++) {

      if (profile.id == idofActiveuser[i]) {
        profile.classList.add("active");

      }

    }
  });


}
// remove active class  

function removeActive(id) {
  let activeprofile = document.querySelectorAll(`.all-chat-info .active`);
  activeprofile.forEach(active => {
    if (active.id == id) {
      active.classList.remove("active");

    }
  });

 let laragImag =  document.querySelector(`.user-data #user${id}`);
 if(laragImag != null)
 {
  laragImag.classList.remove('active');
 }
}

window.addEventListener('set-active', event => {
  //  console.log("dddd");
   console.log(event.detail.userid);
   for(let i=0;i<idofActiveuser.length;i++)
   {
    if(idofActiveuser[i] == event.detail.userid)
    {
      document.querySelector(`.user-data #user${event.detail.userid}`).classList.add('active');
    }

   }

  //  remove the unreded number ;
  let flashnot= document.querySelector(`#not-${event.detail.userid}`);
  flashnot.style.display = 'none';
  flashnot.textContent = '';

  // assign the id of profile visited  
  profieleid = event.detail.userid ;
  
  // set hover effict
  let allsectinProfile = document.querySelectorAll('.profile-chats') ; 
  allsectinProfile.forEach(sectionProfile => {
    sectionProfile.classList.remove('hover-effect');
  });
  document.querySelector(`.set-active-chat${profieleid}`).classList.add("hover-effect") ; 


  // coll functino generta offer afer the buten initiated 
  runstreameOffer()
  startvidoeStream =  document.getElementById('create-offer');


})

var keysjson =  document.querySelector('.get-all-key-c').id ; 
   

let  keys  = JSON.parse(keysjson)  ; 

console.log(keys);

let allChannelSubscribs  = [];
for(let i=0;i<keys.length;i++)
{
  var chatChannel =  Echo.join(`chat.user.${keys[i]}`)
  
  allChannelSubscribs.push(chatChannel);
}




for(let i=0 ; i<allChannelSubscribs.length; i++)
{
  allChannelSubscribs[i].here((message) => {
    //
    console.log('here from chat');
    console.log(message);



  })
  .joining((message)=>{
    console.log('im joined to chat channel ');
    
  })
   .listen('ChatChennal', (e) => {
    console.log('the event is working ');
    // console.log(e)
    theMessage = e.newmessage.body ;
    senderId = e.newmessage.user_id ; 
    injectChat(theMessage,senderId)
  })
  .listen('StreamOffer',(event)=>{
    console.log("stremoffer is sended ");
    console.log(event);
    reseveOfferFromTarget(event)
  })
  .listen('StreamAnswer',(event)=>{
    console.log("strem answer is sended ");
    console.log(event);
    resaveAnserFromTarget(event)
  })
  .listen('RejectOffer',(event)=>{
    console.log("vidoe call is rejected ");
    console.log(event);
    showRejectOffer(event)
  })
  .listen('EndRTCConnction',(event)=>{
    console.log("vidoe call is down ");
    console.log(event);
    showConnectionDown(event)
  })
}
function injectChat(messageChat,senderId)
{
   if(profieleid != null)
   {
    // make shour the user is on sender profile : 
    if(profieleid == senderId)
    {
      // start inject the message : 
       listOfMessage =document.querySelector('.message-chat ul') ;
       li = document.createElement("li") ; 
      li.classList.add("target-chat");
      li.textContent = messageChat ; 
      listOfMessage.appendChild(li);

    }else{
    increseNot(senderId)

    }
   }else{
    increseNot(senderId)
    
   } 
}
function  increseNot(senderId){
 let notspan  =  document.querySelector(`#not-${senderId}`);
 notspan.style.display = 'inline';
 if(notspan.textContent == null ||notspan.textContent == "" )
 {
  notspan.textContent = 1 ;
 }else{
  notspan.textContent= parseInt( notspan.textContent) +1 ;
 }
 
}



//  ############################
//  ############################
//  ############################
// heandel the webRTC 
//  ############################
//  ############################
let peerConnection ; 
let localStream ; 
let remoteStream; 
let servers = {
  iceServers:[
      {
          urls:['stun:stun1.1.google.com:19302', 'stun:stun2.1.google.com:19302']
      }
  ]
}

let init = async ()=>{
  localStream  = await navigator.mediaDevices.getUserMedia({video:true,audio:true}) ; 
  document.getElementById('vidoe-user-1').srcObject = localStream ;


}

let createoffer = async ()=>{
 peerConnection = new RTCPeerConnection(servers);
 remoteStream = new MediaStream();
 document.getElementById('vidoe-user-2').srcObject = remoteStream ;
  localStream.getTracks().forEach((track)=>{
    peerConnection.addTrack(track,localStream);
  })

  peerConnection.ontrack = async (event)=>{
    event.streams[0].getTracks().forEach((track)=>{
      remoteStream.addTrack(track);
    })
  }

  // create ice candidate 
  peerConnection.onicecandidate  = async (event)=>{
    if(event.candidate){
      // this offer is ready to sended  to livewire to brodcasted 
      offer  = JSON.stringify(peerConnection.localDescription)
      
      Livewire.emit('sentOffer',{'offer':offer})
    }
  }

 let offer   = await peerConnection.createOffer()
 await peerConnection.setLocalDescription(offer) ;
 console.log(offer);
}

let createAnswerButton  = document.querySelector("#create-answer");

createAnswerButton.addEventListener("click",()=>{
  // first thing first show the vidoe to user 
  let schudelProces  = async()=>{
    await init();
    await createAnswer() ; 
  }
  schudelProces()
  showVidoeScrren();
  
});


let createAnswer = async()=>{
  peerConnection = new RTCPeerConnection(servers);
  remoteStream = new MediaStream();
  document.getElementById('vidoe-user-2').srcObject = remoteStream ;
  localStream.getTracks().forEach((track)=>{
    peerConnection.addTrack(track,localStream);
  })

  peerConnection.ontrack = async (event)=>{
    event.streams[0].getTracks().forEach((track)=>{
      remoteStream.addTrack(track);
    })
  }

  // create ice candidate 
  peerConnection.onicecandidate  = async (event)=>{
    if(event.candidate){
      // the answer now is ready to sent to the target : 

     let finalanswer  = JSON.stringify(peerConnection.localDescription);
      // let data
      console.log(offerKeyChannel);
      Livewire.emit('sentAnswer',{'finalanswer':finalanswer ,'offerKeyChannel':offerKeyChannel})

    }
  }
   offerReseved = JSON.parse(offerReseved.offer);
  // console.log(offerReseved);
  await peerConnection.setRemoteDescription(offerReseved)
  let answer = await peerConnection.createAnswer()
  await peerConnection.setLocalDescription(answer)
}

function reseveOfferFromTarget(event)
{
  offerReseved= event.offer ; 
  let cardMessage = document.querySelector('.message-joine-for-stream');
  cardMessage.style.zIndex = 100;
  cardMessage.style.opacity = 1;
  cardMessage.querySelector("p span ").textContent =event.userName;
  offerKeyChannel = event.key;
  setTimeout(()=>{
    cardMessage.style.zIndex = -1;
    cardMessage.style.opacity = 0;
  },6000)
}


// heandl the resave answer 
function resaveAnserFromTarget(event)
{
  // add the key to global var that will alow user to end call
  offerKeyChannel = event.key
  addAnswer(event)
}
let addAnswer = async (event)=>{
let answerReseved  = JSON.parse(event.Answer);
console.log(answerReseved); 
if(!peerConnection.currentRemoteDescription)
{
  peerConnection.setRemoteDescription(answerReseved)
}
}

// headndl reject offer   : 
// headndl reject offer   : 
let rejectOffer = document.querySelector('.message-joine-for-stream #reject-offer');
rejectOffer.addEventListener("click",()=>{

  Livewire.emit('rejectoffer',{channelKey:offerKeyChannel});

})

function showRejectOffer(event)
{
  let Messagerejact = document.querySelector('.message-joine-for-stream');
  Messagerejact.style.zIndex = 100;
  Messagerejact.style.opacity = 1;

  let cardMessage = document.querySelector('.message-joine-for-stream .card-body');
  cardMessage.innerHTML = `<p class="font-16 text-center mb-3"> <span class="text-primary"> 
  ${event.userName}</span> reject yor call  </p>` ;

  setTimeout(()=>{
    Messagerejact.style.opacity = 0;
    Messagerejact.style.zIndex = -1;
    cardMessage.innerHTML = `		<p class="font-16 text-center mb-3"><span class="text-primary"></span> wont to start chat vidoe with you </p>
		<div class="button-group d-flex gap-4 justify-content-center mt-5 w-100 ">
			<button id="reject-offer" class="btn btn-outline-danger" type="button">close</button>
			<button id="create-answer"  class="btn btn-primary ">joine</button>
		</div>
` ;
  },4000)

}
// end reject 



function  runstreameOffer()
{

  startvidoeStream =  document.getElementById('create-offer');
  startvidoeStream.addEventListener('click',()=>{
    let schudelProces  = async()=>{

      await init();
      await createoffer()
    }
    schudelProces()
    showVidoeScrren()
    
  });

}

function showVidoeScrren(){
  let darkSucrren =  document.querySelector(".full-scren-dark")
  darkSucrren.style.display= "block" ; 
  darkSucrren.querySelector(".vidoe-strem").style.opacity = 1;
 
}


// disable the vodie 
document.querySelector(".calls-options .vidoes-staff").addEventListener("click",()=>{
  TdisableVidoe ()
})
 function  TdisableVidoe (){
  
  let videoTrack  =  localStream.getTracks().find(track =>track. kind == 'video')
  let vodieIcon  = document.querySelectorAll(`.calls-options 
  .vidoes-staff span`) ;
  
  
  if( Array.from(vodieIcon[0].classList).includes("disabled"))
  {
    videoTrack.enabled = true ; 
    vodieIcon[0].classList.remove('disabled');
    vodieIcon[1].classList.add('disabled');
  }else{
      
      videoTrack.enabled = false ; 
      vodieIcon[1].classList.remove('disabled');
      vodieIcon[0].classList.add('disabled'); 
  }
 }

 document.querySelector(".calls-options .calls-staff").addEventListener("click",()=>{
  TdisableAdio ()
})

 function  TdisableAdio (){
  
  let audioTrack  =  localStream.getTracks().find(track =>track. kind == 'audio')
  let vodieIcon  = document.querySelectorAll(`.calls-options 
  .calls-staff span`) ;
  
  
  if( Array.from(vodieIcon[0].classList).includes("disabled"))
  {
    audioTrack.enabled = true ; 
    vodieIcon[0].classList.remove('disabled');
    vodieIcon[1].classList.add('disabled');
  }else{
      
      audioTrack.enabled = false ; 
      vodieIcon[1].classList.remove('disabled');
      vodieIcon[0].classList.add('disabled'); 
  }
 }
//  headle end or leaveing the connection 
let endStreamCall = document.getElementById("end-stream-call");
endStreamCall.addEventListener("click",()=>{
// first  send event to another peer to end connection
  // peerConnection.close() ; 
  console.log(offerKeyChannel);
Livewire.emit('connectionRTcDown',{channelKey:offerKeyChannel});


  EndRTCConnection ()

})
function EndRTCConnection(){
  let darkSucrren =  document.querySelector(".full-scren-dark")
  darkSucrren.style.display= "none" ; 
  darkSucrren.querySelector(".vidoe-strem").style.opacity = 0;

  let audioTrack  =  localStream.getTracks().find(track =>track. kind == 'audio');
  let videoTrack  =  localStream.getTracks().find(track =>track. kind == 'video');
  audioTrack.enabled = false ; 
  videoTrack.enabled = false ; 
  // reset all value 
  remoteStream  =  null ; 
 acceptOffer  = null ; 
 startvidoeStream = null ;
 offerKeyChannel  = null ; 
 offerReseved  = null ; 
}

function showConnectionDown(event){
  EndRTCConnection();
  let Messagerejact = document.querySelector('.message-joine-for-stream');
  Messagerejact.style.zIndex = 100;
  Messagerejact.style.opacity = 1;

  let cardMessage = document.querySelector('.message-joine-for-stream .card-body');
  cardMessage.innerHTML = `<p class="font-16 text-center text-dark mb-3">${event.message}</p>` ;

  setTimeout(()=>{
    Messagerejact.style.opacity = 0;
    Messagerejact.style.zIndex = -1;
    cardMessage.innerHTML = `		<p class="font-16 text-center mb-3"><span class="text-primary"></span> wont to start chat vidoe with you </p>
		<div class="button-group d-flex gap-4 justify-content-center mt-5 w-100 ">
			<button id="reject-offer" class="btn btn-outline-danger" type="button">close</button>
			<button id="create-answer"  class="btn btn-primary ">joine</button>
		</div>
` ;
  },4000)
}
// document.onmouseover
