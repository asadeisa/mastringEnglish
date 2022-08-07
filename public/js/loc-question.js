const hostName = window.location.hostname; 

let pageOFContext  = 0;
let userUIData = null ; 
let allpargrafs = null ; 
if(localStorage.getItem("pageOFContext") != null)
{

  pageOFContext  =localStorage.getItem("pageOFContext") ; // this index indecate where user arraive in solving question  ;
}

const studentLevel = document.querySelector(".user-level-number").id; 
const  WordsMeaning  = fetch(`../../json/questionAndAns.json`) ;
async function getdata(){
  await WordsMeaning  
  .then(response => response.json())
  .then(allpargraf =>{
    allpargrafs = allpargraf ; 
    filterData(allpargrafs)
    });
}
getdata()




function filterData(unvaledData)
{
  let context  ; 
  let allAcceptscontext = [] ; 
 
  for(let i=0 ; i<unvaledData.data[pageOFContext].paragraphs.length ;  i++)
  {
 
    context = unvaledData.data[pageOFContext].paragraphs[i].context ; 
    //  tokens = RiTa.tokens(context); 

     let isfitUser  = classifySentenses(context) ;

    
     if(isfitUser == true)
     {
      allAcceptscontext.push(unvaledData.data[pageOFContext].paragraphs[i]);
     }

  }
    // console.log(allAcceptscontext ,"this is pageOFContext@@@");
  if(allAcceptscontext.length != 0 ){
    console.log(allAcceptscontext , "allAcceptscontext %%%");
    // data ready to show to user 
    userUIData = allAcceptscontext ;
    if (userUIData != null) {
      showToUser(userUIData)
    }
  }
 else if(allAcceptscontext.length == 0 && pageOFContext < unvaledData.data.length -1)
  {
   console.log("if is working ");
    incresPageOfContext(unvaledData)
  }
 

  

}

function classifySentenses(allsentanses)
{
  let   totalDifficulty = 0 ; 
  let countOfdif =0  ; 
  let   allsentansesArray  =  RiTa.sentences(allsentanses); 

  for (let k = 0; k < allsentansesArray.length; k++) {

   let dif =  clcDifucalty(allsentansesArray[k]);
  
  console.log(dif ,"difficalty for each sentences");
   countOfdif += dif  ; 
  }
  
  totalDifficulty = countOfdif/allsentansesArray.length ; 
 console.log(totalDifficulty , "##totalDifficulty##");
  if(studentLevel == 1)
  {
    if(totalDifficulty < 0.3)
    {
      return true ; 
    }
    else{
      return false
    }

  }
 else if(studentLevel == 2)
  {
    if(totalDifficulty < 0.5 && totalDifficulty > 0.3)
    {
      return true ; 
    }
    else{
      return false
    }
  }
  
  else if(studentLevel == 3)
  {
    if(totalDifficulty < 0.75 && totalDifficulty >= 0.5)
    {
      return true ; 
    }
    else{
      return false
    }
  }
 else if(studentLevel == 4)
  {
    if(totalDifficulty >= 0.75)
    {
      return true ; 
    }
    else{
      return false
    }
  }
  else {
    return false;
  } 
}

function clcDifucalty(sentanse)
{
  // the secand way to caluck dificalty 
  let partOfSpeach  = RiTa.pos(sentanse);
  let difLetterlenght  = 0
  let difficultyNewMethod = 0 ; 
  let difstresses = 0;
  let  AvadifficultyNewMethod = 0;
  let  Avadifstresses = 0;
  let  AvadifLetterlenght = 0;
  let avarageOFSLPos = 0 ; 
  let MassevValue  =  0 ; 
  let countofMassiveValue =0 ;
  let numberofRemovedStopwords = 0 ;
  for (let t = 0; t < partOfSpeach.length; t++) {
  //  del with pos things 

  //  loopthrow to pos to indecate the dif 
  switch (partOfSpeach[t]) {
    case "dt"  ||"cd" ||"in" ||"pdt" || "to"||"sym":
      numberofRemovedStopwords ++ ; 
      break;
    
        case "wdt":
        difficultyNewMethod += 0.1; 

      break;
        case "prp":
        difficultyNewMethod += 0.23; 

      break;
  
        case "uh":
          difficultyNewMethod += 0.2; 
  
        break;

      case "ex":
        difficultyNewMethod += 0.3 ; 
        break;

        case "fw":
        difficultyNewMethod += 0.9 ; 
        break;

      case "prp$":
      difficultyNewMethod += 0.23 ; 
      break;

      case "wp$":
      difficultyNewMethod += 0.1 ; 
      break;



      case "jj":
      difficultyNewMethod += 0.65 ; 
      // MassevValue +=0.3 ; 

      break;

      case "jjr":
      difficultyNewMethod += 0.9 ; 
      MassevValue +=0.6 ; 
      countofMassiveValue ++;
      break;

      case "jjs":
      difficultyNewMethod += 1 ; 
      MassevValue ++ ; 
      countofMassiveValue ++;

      break;

      case "nn":
      difficultyNewMethod += 0.3 ; 

      break;

      case "nns":
      difficultyNewMethod += 0.7 ; 
      MassevValue +=0.4 ; 

      break;

      case "nnp":
      difficultyNewMethod += 0.78 ; 
      MassevValue +=0.56 ; 
      countofMassiveValue ++;

      break;

      case "nnps":
      difficultyNewMethod +=1 ; 
      MassevValue +=1; 
      countofMassiveValue ++;

      break;
      case "pos":
        difficultyNewMethod += 0.1 ; 
        
      break;
      case "rp":
        difficultyNewMethod += 0.68; 

      break;
      case "rb":
        difficultyNewMethod += 0.1; 

      break;

      case "rbr":
        difficultyNewMethod += 0.5; 
        MassevValue +=0.45; 
        countofMassiveValue ++;

      break;

      case "rbs":
        difficultyNewMethod += 1; 
      
        MassevValue +=1; 
        countofMassiveValue ++;

      break;
      case "vb":
        difficultyNewMethod += 0.23; 

      break;

      case "vbd":
        difficultyNewMethod += 0.3; 

      break;

      case "vbg":
        difficultyNewMethod += 0.2; 

      break;

      case "vbn"||"vbp"||"vbz":
        difficultyNewMethod += 1; 
        MassevValue +=0.8; 

        countofMassiveValue ++;

      break;
      case "wp":
        difficultyNewMethod += 0.1; 

      break;

      case "cc":
        difficultyNewMethod += 0.1; 

      break;

    default:
      // difficultyNewMethod += 0.1; 
      numberofRemovedStopwords++

      break;
  }

  }

  //   clulc the lenght and stress 

  let snetokens = RiTa.tokens(sentanse); 
  let stressCountForallSent = 0 ;
  for(let i=0;i<snetokens.length; i++)
  {
  let  onsiglWord  = snetokens[i];
  let stresses = RiTa.stresses(onsiglWord).split("/"); // returns -> 1/0
 let  stressesCount = 0 ; 
  for (let index = 0; index < stresses.length; index++) {
    if (stresses[index] == "1") {
      stressesCount ++  ; 
    }
    
  }
 
  if(stressesCount == 2){
    stressCountForallSent  +=2 ; 
  }
  if(stressesCount == 1){
    stressCountForallSent  += 0.5 ; 
  }
  if(stressesCount == 0){
    stressCountForallSent  -- ; 
  }
 
    let letterlenght =  onsiglWord.length
    if(letterlenght > 5){
      difLetterlenght += 1 ; 
    }
  
  
    }
   
    if(stressCountForallSent >=snetokens.lengt*0.46 )
    {
      Avadifstresses = 1 ; 
    } 
    else if(stressCountForallSent >= snetokens.length*0.43 )
    {
      Avadifstresses = 0.6 ; 

    }
    else if(stressCountForallSent >= snetokens.length*0.37 )
    {
      Avadifstresses = 0.5 ; 

    }
    else if(stressCountForallSent >= snetokens.length*0.3 )
    {
      Avadifstresses = 0.4 ; 

    }
    else if(stressCountForallSent >= snetokens.length*0.27 )
    {
      Avadifstresses = 0.3 ; 

    }
    else{
      Avadifstresses = 0.1; 
    }
      // avarag of every var 
      // Avadifstresses = difstresses/snetokens.length;
      if( difLetterlenght/snetokens.length > 0.6)
      {
        AvadifLetterlenght = 1;
      }
      else if(difLetterlenght/snetokens.length > 0.5)
      {
        AvadifLetterlenght = 0.7;

      }
      else if(difLetterlenght/snetokens.length > 0.45)
      {
        AvadifLetterlenght = 0.6;

      }
      else if(difLetterlenght/snetokens.length > 0.4)
      {
        AvadifLetterlenght = 0.5;

      }
      else if(difLetterlenght/snetokens.length > 0.35)
      {
        AvadifLetterlenght = 0.4;

      }
      else if(difLetterlenght/snetokens.length > 0.3)
      {
        AvadifLetterlenght = 0.3;

      }
      else if(difLetterlenght/snetokens.length > 0.2)
      {
        AvadifLetterlenght = 0.2;

      }
      else if(difLetterlenght/snetokens.length > 0)
      {
        AvadifLetterlenght = 0.1;

      }
      // AvadifLetterlenght = difLetterlenght/snetokens.length;
      AvadifficultyNewMethod = parseFloat(difficultyNewMethod)/(partOfSpeach.length - numberofRemovedStopwords);
    
    
        //  add new parametre to dif  is sentanses words number 
  let difOfsentanseLength = 0.2  ; 
   

  let sentanseLength  = snetokens.length;
  if(countofMassiveValue/sentanseLength  >0.5) {
    difOfsentanseLength = 0.9;
  } 
  else if(countofMassiveValue/sentanseLength   > 0.3 )
  {
    difOfsentanseLength = (MassevValue + 0.65)/(countofMassiveValue +1) ;
    
  }
  else if(countofMassiveValue/sentanseLength   >0.1 )
  {
    
    difOfsentanseLength = (MassevValue + 0.2 )/(countofMassiveValue +1) ;
    
  }
  else if(countofMassiveValue/sentanseLength  <=  0.1)
  {
    difOfsentanseLength = 0.1 ;
  }
  // console.log("countofMassiveValue",countofMassiveValue);
  // console.log("MassevValueMassevValueMassevValue",MassevValue);
  // console.log(AvadifLetterlenght , "AvadifLetterlenght $$44");
  // console.log(Avadifstresses , "Avadifstresses ####3");
  // console.log(difOfsentanseLength , "difOfsentanseLength");
  // console.log(AvadifficultyNewMethod ,"AvadifficultyNewMethod &&&&");
  avarageOFSLPos = (2*Avadifstresses + AvadifficultyNewMethod + 2*AvadifLetterlenght + difOfsentanseLength)/6;
 
    return  parseFloat(avarageOFSLPos.toFixed(2)) ; 
}

function  incresPageOfContext(allpargrafs)
{
  pageOFContext++  ; 
localStorage.setItem("pageOFContext",pageOFContext)

  filterData(allpargrafs)
}



// display data to user : 

let indexofText = 0  ; 
let ansofq = [];

function showToUser()
{
  let allContext = userUIData ;
  let textPargra = [];
  let questions = [] ;
  for (let i = 0; i < allContext.length; i++) {
    
    textPargra.push( allContext[i].context) ; 
    questions.push(allContext[i].qas)  
    
  } 

// console.log("from hwo func" , textPargra ,questions);
let textUI = document.getElementById("injext-text");
let questionUI = document.getElementById("inject-questions") ;
  if(indexofText >=textPargra.length )
  {
    indexofText = 0;
    ansofq = [] ;
    textPargra = [];
    questions = [] ;
    pageOFContext++
  localStorage.setItem("pageOFContext",pageOFContext)
  textUI.innerText = "";
  questionUI.innerHTML = " ";

  filterData(allpargrafs) ;

  }
  else{

    // show the output to the user : 
    // clean old data 
    questionUI.innerHTML = "";
    ansofq = [] ; 
    console.log(textPargra ,"from array @@@@@");
    textUI.innerText =  textPargra[indexofText] ;
    // hidden the  loader and show the main div 
  document.querySelector('.loader-tump').classList.add("d-none");
  document.getElementById("water-fordata").classList.remove("hidden-teperry")

    // show the qeustion : 
    for (let j = 0; j < questions[indexofText].length && j <4; j++) {

      ansofq.push(questions[indexofText][j].answers[0].text)
      questionUI.innerHTML += ` 
        <div class="one-question my-2">
          <div class="h6 ">${questions[indexofText][j].question} </div>
          <form >
            <input type="text" class="form-group form-control w-75" >

          </form>
          </div>`
      
    }
  }
}
// get next slide or next page : 
// first event off new text : 
document.getElementById("get-next-text").addEventListener("click",getNextText)
function getNextText()
{
  indexofText ++ ;
  showToUser()
}

document.getElementById("conform-question").addEventListener("click",conformans)

function conformans()
{
  let userInputAns =Array.from(document.querySelectorAll("#inject-questions form input")) ;
  console.log(userInputAns);
  console.log(userInputAns.value);
  console.log(userInputAns.values);

  let userAns = [];

  for (let j = 0; j < userInputAns.length; j++) {
    userAns.push(userInputAns[j].value);
    
  }
  console.log(userAns);
  console.log(ansofq);
  let  Ansdifference = ansofq.filter(x => !userAns.includes(x));
console.log(Ansdifference,"shoudled show all input");
 
  // indexofText ++ ;
  // ansofq
 let  messageToUser  = ``
 document.querySelector(".message-ans").classList.add("message-ans-show")
  if (Ansdifference.length == 0) {
    // all ans is true 
    messageToUser = ` <h5 class="text-center"> you are doning grate ! 
    all answoer is true . thats enough tody  <h5>`
    let messageDiv = document.querySelector(".message-ans .successer-ans") ;
    messageDiv.innerHTML = messageToUser ; 
    document.querySelector(".message-ans").classList.add("bg-success")
    document.getElementById("close-message-ans").classList.add('btn-lg')
    document.querySelector(".close-holder").classList.add("text-center");
    document.querySelector(".close-holder").classList.add("mt-5");
  }
  else{
    messageToUser =`you have some mistakes be careful next time`
    document.querySelector(".message-ans").classList.add("bg-warning")

    let messageDiv = document.querySelector(".message-ans .show-the-valed-ans");
    let messageDivTitle = document.querySelector(".message-ans .m-ti");
    messageDivTitle.innerHTML = `${messageToUser}`;

    for (let k = 0; k < Ansdifference.length; k++) {
      messageDiv.innerHTML += `<span>
      ${Ansdifference[k]}
      </span>`
      
    }
  }
  
}
// close the message  : 
document.getElementById("close-message-ans").addEventListener("click",closeMessageDiv)
function closeMessageDiv()
{
  document.querySelector(".message-ans").classList.remove("message-ans-show") ;
  let messageDiv = document.querySelector(".message-ans .show-the-valed-ans");
  messageDiv.innerHTML = "" ;
  let smessageDiv = document.querySelector(".message-ans .successer-ans") ;
  smessageDiv.innerHTML = "" ; 
  document.querySelector(".message-ans").classList.remove("bg-success") ;
  document.querySelector(".message-ans").classList.remove("bg-warning") ;
  document.getElementById("close-message-ans").classList.remove('btn-lg')
  document.querySelector(".close-holder").classList.remove("text-center");
  document.querySelector(".close-holder").classList.remove("mt-5");
  document.querySelector(".message-ans .successer-ans").innerHTML = " " ; 
  document.querySelector(".message-ans .m-ti").innerHTML = ""
}
// the middle way
// eightfold