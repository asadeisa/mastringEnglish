
let text;
let button;
let stop;
let pause;
let Snamber;
let currentCharacter;

function  defineProperty()
{
     text = document.querySelector('.articals-to-read');
     button = document.querySelector('#speak');
     stop  =document.getElementById('stop');
     pause = document.getElementById('pause');
     Snamber =document.getElementById('namber');
     currentCharacter ;
    angenSpeak();
    // console.log(text.innerText);
    // console.log("ttttttt");

}

  function angenSpeak(){
      button.addEventListener('click',function(){
        // console.log(text.innerText);
          playText(text.innerText);
        
      });
     pause.addEventListener('click',pauseText);
     stop.addEventListener('click',stopText);
     Snamber.addEventListener('input',()=>{
         stopText()
         playText(utterance.text.substring(currentCharacter))
     })
  }
  
  const utterance = new SpeechSynthesisUtterance(text);
  
  utterance.addEventListener('end',()=>{
      text.disabled = false; 
      // This is for input text but I use <P> so dont effect
  })
  
  
  utterance.addEventListener('boundary',e=>{
      // event End of word
      currentCharacter = e.charIndex
  })
  
  
  function playText(text){
      if(speechSynthesis.paused && speechSynthesis.speaking){
          return speechSynthesis.resume();
      }
      if(speechSynthesis.speaking) return
      utterance.text = text
      utterance.rate = Snamber.value ||1  ;
      text.disabled = true;
      speechSynthesis.speak(utterance);
  }
  function pauseText(){
     if(speechSynthesis.speaking) {
      speechSynthesis.pause()
     }
  }
  function stopText(){
      speechSynthesis.resume();
      speechSynthesis.cancel();
  }