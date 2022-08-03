@extends("layout.homelayout")
@section('home')


<x-user-nav/>
<div class="user-interface d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  
  <section class=" main-content w-95 px-2 my-4 d-flex justify-content-center align-items-center">
 
  <div class=" card  w-100 practice-page"> 
     <div class="card-body ">
      <div  class="practice-page-holder  d-flex gap-7 w-100 mt-5">
        <div  class="learn-new-phreases p-2"><div class="h4 my-3">learn new phrases</div> <p class="mx-5">we have we have large amount of common phrases that fit your level . click start to start learn
        </p>
        <div id="new-phreases" class="my-4 trans-down"> <a href="{{ route("new-phrases") }}" class="btn btn-info px-5">start</a> </div>
      </div>
        <div  class="practice-wtih-question p-2"><div class="h4 my-3">practice with question </div> 
          <p class="mx-5 text-start">do you won't to incrres your write level her more than 10's pargraph folled with qeustion that can provied you a massive amount of vocabs and gives you a nice totch in caltcher</p>
          <div  id="question-practice" class=" trans-down "> <a href="{{ route("local-question") }}" class="btn btn-info px-5">start</a> </div>
        </div>
      </div>
      <div class="glasses"></div>
     </div>
  </div>
  </section>
  <script>
          let alldivCar =document.querySelectorAll(".practice-page-holder div");
          alldivCar.forEach(divcard => {
            divcard.addEventListener('mouseleave', (e) => {
              
              divcard.querySelector(".trans-down").classList.add("onmouseleaveEffact")
            });
          
            
            
          }); 
  </script>
</div>