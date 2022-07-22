

let pageOFContext  = 0;
let userUIData = null ; 
let allpargrafs = null ; 
if(localStorage.getItem("pageOFContext") != null)
{

  pageOFContext  =localStorage.getItem("pageOFContext") ; // this index indecate where user arraive in solving question  ;
}

const studentLevel = document.querySelector(".user-level-number").id; 
const  WordsMeaning  = fetch("../../json/questionAndAns.json") ;
async function getdata(){
  await WordsMeaning  
  .then(response => response.json())
  .then(allpargraf =>{
    allpargrafs = allpargraf ; 
     manageData()
    });
}
getdata()

function manageData()
{
  pargraf =allpargrafs ;
  FitDataWithStudentLevel  =    filterData(pargraf) ;
  // the data is ready to use her  : 
  
  userUIData = FitDataWithStudentLevel ;
  console.log(FitDataWithStudentLevel  , "from final func");
  if (FitDataWithStudentLevel != null) {
    showToUser(userUIData)
  }
}

function filterData(unvaledData)
{
  let context  ; 
  let allAcceptscontext = [] ; 
  
  for(let i=0 ; i<unvaledData.data[pageOFContext].paragraphs.length ;  i++)
  {
 
    context = unvaledData.data[pageOFContext].paragraphs[i].context ; 
    //  tokens = RiTa.tokens(context); 

     let isfitUser  = classifySentenses(context) ;
  
     if(isfitUser)
     {
      allAcceptscontext.push(unvaledData.data[pageOFContext].paragraphs[i]);
      
     }
  }
  if(allAcceptscontext.length == 0 && pageOFContext < unvaledData.data.length -1)
  {
   
    incresPageOfContext(unvaledData)
  }
  else{

    return allAcceptscontext ; 
  }

}

function classifySentenses(allsentanses)
{
  let   totalDifficulty = 0 ; 
  let countOfdif =0  ; 
  let   allsentansesArray  =  RiTa.sentences(allsentanses); 

  for (let k = 0; k < allsentansesArray.length; k++) {

   let dif =  clcDifucalty(allsentansesArray[k]);
  
  //  let dif =  clDifucalty(allsentansesArray[k]); 
   countOfdif += dif  ; 
  }
  
  totalDifficulty = countOfdif/allsentansesArray.length ; 

  if(studentLevel == 1)
  {
    if(totalDifficulty < 0.29)
    {
      return true ; 
    }

  }
 else if(studentLevel == 2)
  {
    if(totalDifficulty < 0.4 && totalDifficulty > 0.29)
    {
      return true ; 
    }
  }
  
  else if(studentLevel == 3)
  {
    if(totalDifficulty < 0.6 && totalDifficulty >= 0.4)
    {
      return true ; 
    }
  }
 else if(studentLevel == 4)
  {
    if(totalDifficulty >= 0.6)
    {
      return true ; 
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

  for (let t = 0; t < partOfSpeach.length; t++) {
  //  del with pos things 

  //  loopthrow to pos to indecate the dif 
  switch (partOfSpeach[t]) {
    case "dt":
      difficultyNewMethod += 0.12 ; 
      break;

      case "fw":
      difficultyNewMethod += 1.2 ; 
      break;

      case "ex":
      // difficultyNewMethod += 0.25 ; 
      break;

      case "prp$":
      difficultyNewMethod += 0.66 ; 
      break;

      case "wp$":
      difficultyNewMethod += 0.46 ; 
      break;

      case "cd":
      difficultyNewMethod += 0.03 ; 
      break;

      case "in":
      difficultyNewMethod += 0.06 ; 

      break;

      case "jj":
      difficultyNewMethod += 0.66 ; 

      break;

      case "jjr":
      difficultyNewMethod += 3 ; 
      
      break;

      case "jjs":
      difficultyNewMethod += 3.5 ; 
      MassevValue ++ ; 

      break;

      case "nn":
      difficultyNewMethod += 0.3 ; 

      break;

      case "nns":
      difficultyNewMethod += 0.6 ; 

      break;

      case "nnp":
      difficultyNewMethod += 1 ; 

      break;

      case "nnps":
      difficultyNewMethod +=1.6 ; 

      break;

      case "pdt":
      difficultyNewMethod += 0.2 ; 

      break;

      case "pos":
        difficultyNewMethod += 0.63 ; 
        
      break;

      case "prp":
        difficultyNewMethod += 0.1 ; 

      break;

      case "rb":
        difficultyNewMethod += 0.68; 

      break;

      case "rbr":
        difficultyNewMethod += 0.83; 

      break;

      case "rbs":
        difficultyNewMethod += 2.2; 
      

      break;

      case "sym":
        // difficultyNewMethod += 0.3; 

      break;

      case "to":
        difficultyNewMethod += 0.05; 

      break;

      case "uh":
        difficultyNewMethod += 0.3; 

      break;

      case "vb":
        difficultyNewMethod += 0.4; 

      break;

      case "vbd":
        difficultyNewMethod += .9; 

      break;

      case "vbg":
        difficultyNewMethod += 0.9; 

      break;

      case "vbn":
        difficultyNewMethod += 4.6; 
      MassevValue += 0.5 ; 

      break;

      case "vbp":
        difficultyNewMethod += 4; 
      MassevValue ++ ; 
        
      break;

      case "vbz":
        difficultyNewMethod += 3.7; 
        MassevValue += 0.5 ; 

      break;

      case "wdt":
        difficultyNewMethod += 0.22; 

      break;

      case "wp":
        difficultyNewMethod += 0.35; 

      break;

      case "cc":
        difficultyNewMethod += 0.39; 

      break;

    default:
      difficultyNewMethod += Math.random().toFixed(2); 
      MassevValue -= 0.04 ; 

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
    if(letterlenght > 8){
      difLetterlenght += 1 ; 
    }else{
      difLetterlenght += letterlenght/8; 

    }
  
  
    }
   
    if(stressCountForallSent >=snetokens.lengt*0.8 )
    {
      Avadifstresses = 0.88 ; 
    } 
    else if(stressCountForallSent >= snetokens.length*0.6 )
    {
      Avadifstresses = 0.6 ; 

    }
    else if(stressCountForallSent >= snetokens.length*0.49 )
    {
      Avadifstresses = 0.45 ; 

    }
    else{
      Avadifstresses = 0.22 ; 
    }
      // avarag of every var 
      // Avadifstresses = difstresses/snetokens.length;
      AvadifLetterlenght = difLetterlenght/snetokens.length;
      AvadifficultyNewMethod = parseFloat(difficultyNewMethod)/partOfSpeach.length;
    
    
        //  add new parametre to dif  is sentanses words number 
  let difOfsentanseLength = 0.2  ; 
  let sentanseLength  = snetokens.length;
  if(MassevValue > (sentanseLength /2 + sentanseLength/5) ){
    difOfsentanseLength = 0.9;
  } 
  else if(MassevValue  > (sentanseLength /3 + sentanseLength/5) )
  {
    difOfsentanseLength = 0.75 ;

  }
  else if(MassevValue  > sentanseLength /3 )
  {
    difOfsentanseLength = 0.55 ;

  }
  else if(MassevValue ==  0)
  {
    difOfsentanseLength = 0.1 ;

  }
  else {
    difOfsentanseLength = 0.4 ;

  }
  // console.log("MassevValueMassevValueMassevValue",MassevValue);
  // console.log(AvadifLetterlenght , "AvadifLetterlenght");
  // console.log(Avadifstresses , "Avadifstresses");
  // console.log(difOfsentanseLength , "difOfsentanseLength");
  // console.log(AvadifficultyNewMethod ,"AvadifficultyNewMethod");
  avarageOFSLPos = (Avadifstresses + 2*AvadifficultyNewMethod + AvadifLetterlenght + difOfsentanseLength)/5;
 
    return  parseFloat(avarageOFSLPos.toFixed(2)) ; 
}

function  incresPageOfContext(unvaledData)
{
  pageOFContext++  ; 
localStorage.setItem("pageOFContext",pageOFContext)

  filterData(unvaledData)
}


// // pos sortcat
// const posSortCat = {
//   "dt"  :	'Determiner',
//    "cd" :  "Cardinal number" ,
//   "fw"  :'Foreign word',
//   "in"  :	'Preposition or subordinating conjunction',
//   "jj"  :	'Adjective',
//   "jjr" :	'Adjective, comparative',
//   "jjs" :	'Adjective, superlative',
//   "nn"  :"	Noun, singular or mass",
//   "nns" :	"Noun, plural",
//   "nnp" :	'Proper noun, singular',
//   "nnps"  :	'Proper noun, plural',
//   "pdt" :	"Predeterminer",
//   "pos" :	"Possessive ending",
//   "prp" :	"Personal pronoun",
//   "rb"  :	"Adverb",
//   "rbr" :"	Adverb, comparative",
//   "rbs" :	"Adverb, superlative",
//   "rp"  :	"Particle",
//   "sym" :	"Symbol",
//   "to"  :	"to",
//   "uh"  :	"Interjection",
//   "vb"  :"Verb, base form",
//   "vbd" :	"Verb, past tense",
//   "vbg" :"Verb, gerund or present participle",
//   "vbn" :"Verb, past participle",
//   "vbp" :	"Verb, non-3rd person singular present",
//   "vbz" :	"Verb, 3rd person singular present",
//   "wdt" :'Wh-determiner',
//   "wp"  :	"Wh-pronoun",
//   "wrb" :"	Wh-adverb",
//   "cc"  :	"Coordinating conjunction",
// }


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

  manageData() ;

}
  let textUI = document.getElementById("injext-text");
  let questionUI = document.getElementById("inject-questions") ;
  // show the output to the user : 
  // clean old data 
  questionUI.innerHTML = "";
  ansofq = [] ; 
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
  // showToUser()
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