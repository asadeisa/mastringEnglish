const WordnikKEY = 'jqx7ab2maeg1j8r944z7shpq0eixle0xds135rmqvh3t7u5ev';
const symbole = {
"cc"      :	'Coordinating conjunction',
"dt"      :'Determiner',
"fw"      :'Foreign word',
"in"      :	'Preposition',
"jj"      :	'Adjective',
"jjr"     :'Adjective',
"jjs"     :	'Adjective',
"md"      :	'Noun',
"nn"      :'Noun, singular ',
"nns"     :	'Noun, plural',
"pdt"     :	'Predeterminer',
"prp"     :"Personal pronoun",
"prp$"    :	'Possessive pronoun',
"rb"      :	'Adverb',
"rbr"     :'Adverb',
"rbs"     :	'Adverb',
"uh"      :	'Interjection',
"vb"      :	'Verb in base form',
"vbd"     :	'Verb in past tense',
"vbg"     :'Verb in  present participle',
"vbn"     :	'Verb in  past participle',
"vbp"     :	'Verb, non-3rd person singular present',
"vbz"     :	'Verb, 3rd person singular present',



}
// const symbole = {
// "cc"      :	'Coordinating conjunction',
// "dt"      :'Determiner',
// "ex"      :	'Existential there',
// "fw"      :'Foreign word',
// "in"      :	'Preposition or subordinating conjunction',
// "jj"      :	'Adjective',
// "jjr"     :'Adjective, comparative',
// "jjs"     :	'Adjective, superlative',
// "ls"      :	'List item marker',
// "md"      :	'Noun',
// "nn"      :'Noun, singular or mass',
// "nns"     :	'Noun, plural',
// "nnp"     :	'Proper noun, singular',
// "nnps"    :'Proper noun, plural',
// "pdt"     :	'Predeterminer',
// "pos"     :	'Possessive ending',
// "prp"     :"Personal pronoun",
// "prp$"    :	'Possessive pronoun',
// "rb"      :	'Adverb',
// "rbr"     :'Adverb, comparative',
// "rbs"     :	'Adverb, superlative',
// "rp"      :	'Particle',
// "uh"      :	'Interjection',
// "vb"      :	'Verb, base form',
// "vbd"     :	'Verb, past tense',
// "vbg"     :'Verb, gerund or present participle',
// "vbn"     :	'Verb, past participle',
// "vbp"     :	'Verb, non-3rd person singular present',
// "vbz"     :	'Verb, 3rd person singular present',
// "wdt"     :	'Wh-determiner',
// "wp"      :	'Wh-pronoun',
// "wp$"    :	'Possessive wh-pronoun',
// "wrb"     :	'Wh-adverb ',
// }
function analyesMistack (){
  

  sentanses  = sentanses.textContent.split(",") ; 
  // we have sentanses her
  // console.log(sentanses);
  let posSentenses = [];

  sentanses.forEach(onesetntanses => {
    posSentenses.push(RiTa.pos(onesetntanses)) ; 
   

  }); 
// end Rita job : 
  console.log(posSentenses);

  posSentenses.forEach(possent =>{
 

    for (const [key, value] of Object.entries(symbole)) {
     
      // if(i>0 && possent[i-1] == key)
      // {
      //   possent.splice(i-1,1);
      // }
      for ( let i=0 ; i<possent.length ; i++)
      {
        if(possent[i] == key)
        {
          possent[i] = value ;
          
        }
      }
    }
  })
  console.log(posSentenses);
  let totalPos = [];
  for(let i=0;i<posSentenses.length ; i++)
  {
    for(let j=0;j<posSentenses[i].length;j++)
    {

      if(posSentenses[i][j] != "i" && posSentenses[i][j] != "to" )
      {

        totalPos.push(posSentenses[i][j] );
      }


    }
  }
  let uniquetotalPos = [...new Set(totalPos)];
  console.log(totalPos);
  console.log(uniquetotalPos);
  return uniquetotalPos ; 
}





function injectWihtview(uniquetotalPos)
{
  let perntdiv  = document.querySelector(".show-user-error");

   let div = document.createElement('div');
   div.classList.add(["shwo-user-w",'d-flex','gap-3']);
   perntdiv.appendChild(div);
   for(let i=0; i<uniquetotalPos.length ; i++){

     div.innerHTML += ` <a  target="_blank" href="https://www.google.com/${uniquetotalPos[i]} " class="btn btn-success" > ${uniquetotalPos[i]}  </a>` ; 
   }
}
function getdatatfromDom()
{
  return new Promise(resolve => {
    setTimeout(() => {
      resolve('resolved');
      let sentanses  =  document.getElementById('sentanses');
      console.log(sentanses.textContent);
    }, 2000);
  });

}
let wordToSerach  = "sky" ; 

let url = `https://api.wordnik.com/v4/word.json/${wordToSerach}/definitions?limit=10&includeRelated=false&useCanonical=false&includeTags=false&api_key=${WordnikKEY}` ; 
fetch(url)
  .then((response) => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${ response.status }`);
    }

    return response.blob();
  })
  .then((response) => {
    console.log(response);
  });


async function getrezalt(){
  let sentanses = await getdatatfromDom(); 
  uniqePos =  analyesMistack(sentanses) ;
  console.log(uniqePos, "the ddddfdf"); 
  injectWihtview(uniqePos);

}
getrezalt()
