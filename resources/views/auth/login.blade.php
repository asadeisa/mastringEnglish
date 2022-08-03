@extends("layout.homelayout")

@section("home")
<link rel="stylesheet" href={{ asset("css/templatemo-onix-digital.css") }}>
<link rel="stylesheet" href={{ asset("css/welcome.css") }}>

<link rel="stylesheet" href="{{ asset("css/login.css") }}">
<x-header/>
 <section class="w-100 all-content-event main-banner d-flex justify-content-center">

   <div class="main-content remove-event w-75 ">
 
 
   <div class="card-login">
     <div class="imgBox">
      <div class="cover-book">
        <div class="front-sectioin">
          <div class="boox-logo">
            <img width="100 " height="100" src="{{ asset("images/logo/log.jpg") }}" >
          </div>
          <div class="book-body">
            <h2 class="text-center book-title">    Education Smart</h2>
            <div class="mx-5">
    
              <small class="text-wight" >start learn with as ,Enjoy with Free courses and comunicat with native spacker around the word</small>
            </div>

          </div>
        </div>
  
      </div>
      
     </div>
     <div class="details">
       <div class="content">
             <h2 class="my-2">log in </h2>
              <img src="{{ asset("images/login4.jpg") }}" alt="">
 
             <form action="{{ route("login") }}" method="post">
             @csrf
 
               <div class="form-group">
                 <label for="exampleInputEmail1">Email address</label>
                 <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                
               </div>
               <div class="form-group">
                 <label for="exampleInputPassword1">Password</label>
                 <input type="password" class="form-control"  name="password" id="exampleInputPassword1" placeholder="Password">
               </div>
              
         <div class="form-group mt-2" >
           <button type="submit" class="btn btn-info">Submit</button>
         </div>
             </form>
 
       </div>
     </div>
   </div>
 
   
     <script>
      let isfocus =false ;
       let CardLogin = document.querySelector(".card-login");
       let imageBox = document.querySelector(".card-login .imgBox ")
       let CoverBook = document.querySelector(".card-login .cover-book ")
       let frontSectioin = document.querySelectorAll(".card-login .front-sectioin div")
       let details = document.querySelector(".card-login .details")
       let imgBox = document.querySelector(".imgBox");
       let allInput = document.querySelectorAll(".form-group input");
       allInput.forEach(input => {
        input.addEventListener("focus",()=>{
          CardLogin.classList.add("card-login-hover");
          imageBox.classList.add("imgBox-hover");
          CoverBook.classList.add("cover-book-hover");
          frontSectioin[0].classList.add("book-body-hover");
          frontSectioin[1].classList.add("book-body-hover");
          details.classList.add("details-hover");
          isfocus = true;
        });

       });
       let allContnet = document.querySelector(".all-content-event");
       allContnet.onmouseenter = ()=>{
        // isfocus = false;
        console.log("working");
        CardLogin.classList.remove("card-login-hover");
          imageBox.classList.remove("imgBox-hover");
          CoverBook.classList.remove("cover-book-hover");
          frontSectioin[0].classList.remove("book-body-hover");
          frontSectioin[1].classList.remove("book-body-hover");
          details.classList.remove("details-hover");
       }
       let removeEventdiv  = document.querySelector(".remove-event");
       removeEventdiv.onmouseenter = ()=>{
        if(isfocus == true )
        {
          CardLogin.classList.add("card-login-hover");
            imageBox.classList.add("imgBox-hover");
            CoverBook.classList.add("cover-book-hover");
            frontSectioin[0].classList.add("book-body-hover");
            frontSectioin[1].classList.add("book-body-hover");
            details.classList.add("details-hover");

        }
       }

     </script>
 
 </div>
</section> 
