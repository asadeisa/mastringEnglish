
let alert  = document.querySelector(".alert-success");
if(alert !== null){
  fadAlert();
}
function fadAlert()
{
  setTimeout(()=>{
    alert.style.display = "none";
  },2000);
}

// fade the card manger 

let cards = document.querySelectorAll(".card-test .card");

cards.forEach((card)=>{
  card.addEventListener("mouseenter",(e)=>{
   
    let tollquestion = e.target.querySelector(".customize-questions");
    if(tollquestion != null)
    {

      for(let i=-400;i<=0; i+=10 )
      {
  
        tollquestion.style.top = `${i}px`;
        // tollquestion.style.opacity = `${1-(i+400)*.0007}`;
      }
      tollquestion.style.backgroundColor = 'rgba(210,224,250,.5)'  ;
    }
  });
  card.addEventListener("mouseleave",(e)=>{
    let tollquestion = e.target.querySelector(".customize-questions");
    if(tollquestion != null)
    {

    tollquestion.style.backgroundColor = '#fff'  ;
      tollquestion.style.top = `-400px`;
    for(let i=0;i>=-400; i-=10 )
    {

      
        tollquestion.style.top = `${i}px`;
       
    }
    }
  });


})
let showButtonForm = document.querySelectorAll(".show-button-form");




showButtonForm.forEach((showButton)=>{
  showButton.addEventListener("mouseenter",(e)=>{
   
    for(let j=0;j<=1; j+=.1)
    {
      let formCoursContent = e.target.querySelector(".form-cours-content")
      if(formCoursContent != null)
      {

        formCoursContent.style.opacity = `${j}`;
      }
  
    }
  })
});
showButtonForm.forEach((showButton)=>{
  showButton.addEventListener("mouseleave",(e)=>{
    for(let j=1;j >=0; j-=.1)
    {
      let formCoursContent = e.target.querySelector(".form-cours-content")

      if(formCoursContent != null)
      {

        formCoursContent.style.opacity = `${j}`;
      }
  
    }
  })
});

