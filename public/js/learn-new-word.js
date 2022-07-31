const hostName = window.location.hostname; 
// const studentLevel = 1 ; 
let pageOFContext  = 0;
let filterdDataRezalt   = null ; 
const studentLevel = document.querySelector(".user-level-number").id; 
if(localStorage.getItem("pageOFContext") != null)
{

  pageOFContext  =localStorage.getItem("pageOFContext") ; // this index indecate where user arraive in solving question  ;
}

// const  WordsMeaning  = fetch(`http://martring-english.herokuapp.com/json/word-meaning.json`) ;

const  WordsMeaning  = alljsonFile();

async function getdata(){
  await WordsMeaning  
  .then(response => response.json())
  .then(allword =>{ manageData(allword)});
}
getdata()
function manageData(WordMeaning)
{
  FitDataWithStudentLevel  =    filterData(WordMeaning) ;
  console.log(FitDataWithStudentLevel  , "from final func");
  filterdDataRezalt = FitDataWithStudentLevel
  showDatatoUser() ; 
}

function filterData(unvaledData)
{
  let MeanningOfSentensens  ; 
  let allAcceptsSentenese = [] ; 
  for(let i=0 ; i<unvaledData.length/2 ;  i++)
  {
    // console.log(unvaledData[i].Meaning);

     MeanningOfSentensens = unvaledData[i].Meaning ; 
     tokens = RiTa.tokens(MeanningOfSentensens); 
   
     let isfitUser  = classifyWords(tokens) ;
     console.log(isfitUser)
     if(isfitUser)
     {
      allAcceptsSentenese.push(unvaledData[i]);
     }
  }
  
  return allAcceptsSentenese ; 

}

function classifyWords(tokenSentenses)
{
  let totalDifficulty  = 0 ; 
  for(let i=0;i<tokenSentenses.length; i++)
  {
   let  onsiglWord  = tokenSentenses[i];
   let stresses = RiTa.stresses(onsiglWord); // returns -> 1/0
   let stressesCuont;
   if(stresses.split("/").length >= 5 ){
   
      stressesCuont  = 1
   }else{
     stressesCuont = stresses.split("/").length/5;
   }
  //  console.log(stressesCuont); 
   let isAdjective = RiTa.isAdjective(onsiglWord);
   let isAdverb  = RiTa.isAdverb(onsiglWord);
   let isSTopword = RiTa.isStopWord(onsiglWord);
   let LengthWord;
    if(onsiglWord.length > 10 ){
      LengthWord  = 1;
   
    }
    else
    { 
     LengthWord  = onsiglWord.length /10
    } 
    let STopwordValue = 0;
    let AdverbValue = 0;
    let AdjectiveValue = 0;
    let nownOrVerb = 0;
    if(isSTopword == true){
     STopwordValue = 0.1;
    }
    if(isAdverb == true){
      AdverbValue = 0.6
    }
    if(isAdjective == true){
     AdjectiveValue = 0.9;
    }
    if(isSTopword == false && isAdjective == false && isAdverb == false)
    {
      nownOrVerb = 0.4;
    }
   let difficulty  = 2*LengthWord + 3*stressesCuont + STopwordValue +AdverbValue +AdjectiveValue +nownOrVerb ;
   let averdifficulty = parseFloat((difficulty/7).toFixed(2));
   totalDifficulty  += averdifficulty ; 
  
  }
  totalDifficulty =parseFloat( totalDifficulty/tokenSentenses.length.toFixed(2)).toFixed(2) ;

  if(studentLevel == 1)
  {
    if(totalDifficulty <0.25)
    {
      return true ; 
    }

  }
 if(studentLevel == 2)
  {
    if(totalDifficulty <0.45 && totalDifficulty > 0.25)
    {
      return true ; 
    }
  }
  
  if(studentLevel == 3)
  {
    if(totalDifficulty <0.55 && totalDifficulty >= 0.45)
    {
      return true ; 
    }
  }
  if(studentLevel == 4)
  {
    if(totalDifficulty >=0.55)
    {
      return true ; 
    }
  }
  else {
    return false
  } 
}


// view the data to user : 
function showDatatoUser()
{

let DivMainwrodUI  = document.getElementById('the-new-word') ; 
let meaningUI  = document.getElementById("meaning-ui");
let examplesUI = document.getElementById("examples-ui");
// know we will inject them in ui  ;
let  MainWord = filterdDataRezalt[pageOFContext].Word ; 
let  meaningWord = filterdDataRezalt[pageOFContext].Meaning ; 
let  examplesOfWord = filterdDataRezalt[pageOFContext].Examples ;
// console.log(MainWord,meaningWord,examplesOfWord);
DivMainwrodUI.innerText = MainWord ;
meaningUI.innerText = meaningWord ; 
examplesUI.innerHTML ='';
for (let i = 0; i < examplesOfWord.length; i++) {
 if (examplesOfWord[i] =="") {
  break ; 
 }
  examplesUI.innerHTML += `  <li class="list-items my-2"><span class="font-16 text-primary">Example ${i+1} :</span>${examplesOfWord[i]}</li>  ` ;
  
}
document.querySelector('.loader-tump').classList.add("d-none");
document.getElementById("water-fordata").classList.add("show-card")
 
}
// show next info 
document.getElementById("get-next-word").addEventListener("click",getNextSlide)

function getNextSlide()
{
  if(pageOFContext < filterdDataRezalt.length )
  {
    pageOFContext++

    showDatatoUser()
  }
}