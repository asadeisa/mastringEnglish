@extends("layout.homelayout")

@section("home")
 {{-- <link href={{ asset("bootstrap/css/bootstrap.min.css") }} rel="stylesheet"> --}}
 <link rel="stylesheet" href={{ asset("css/templatemo-onix-digital.css") }}>
 <link rel="stylesheet" href={{ asset("css/welcome.css") }}>
  <!-- ***** Header Area Start ***** -->
<x-header/>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner" id="top">
    <div class="container d-flex  justify-content-space-between ">
      <section class="flex-1 w-50 mt-5 ">
        <h1 class="mt-5">
          learn English with  ultimate  options 

        </h1>
         <article class="my-5 font-16">Welcome to our platform , in EduSmart you will find a variety of options to learn English in a professional and enjoyable way</article>
      </section>
      <section class="playing-icon flex-1">
        <div class="icon-holder">

          <img src="{{ asset('images/logo/log.jpg') }}" alt="">
          <div class="route-image">

            <ul class="icon-lest">
              <li> 
                <a href="">learn</a>
                <span class="icon-side-nav"><i class="fa-solid fa-book-open"></i></span>
              </li>

              <li>  
                <a href="">ask</a>
                <span class="icon-side-nav">
                <i class="fa-solid fa-question"></i>

                </span>
              </li>
              <li> 
                <a href="">analyze</a>
                <span class="icon-side-nav"><i class="fa-solid fa-atom"></i></span>
              </li>
              <li>
                <a href="">chat</a>
                <span class="icon-side-nav">
                <i class="fa-solid fa-comments"></i>
                </span>
              </li>
              <li>
                <a href="">teach</a>
                <span> <i class="fas fa-chalkboard-teacher"></i>
                </span>
              </li>
              <li>
                <a href="">practice</a>
                <span class="icon-side-nav">
                <i class="fa-solid fa-dumbbell"></i>
                </span>
              </li>
              <li>
                <a href="">profile</a>
                <span class="icon-side-nav">
                <i class="fa-solid fa-id-card-clip"></i>
              </span>
            </li>
              <li>
                <a href="">logout</a>
                <span class="icon-side-nav">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
              </span>
            </li>
            </ul>
          </div>
        </div>
     </section>
    </div>
  </div>

  <div id="services" class="our-services section">
 
    <div class="container">
      <section class="services d-flex justify-content-space-between  ">

       <div class="w-50 mb-5 ">
        <img width="300" height="300" src="{{ asset("images/about-left-image.png") }}" >
       </div>
         <div class="flex-1 d-flex align-items-center w-75 mb-5">
          <article class="p-3 mx-5 font-18">
            in EduSmart you will tutors whom will walk you through step by step during your learning process
           ,in addition we have  special AI algorithms to provide you with exercise that fit your level .   
          </article>
         </div>
      </section>
      <section class="services discrip-icon d-flex gap-4  mt-5 ">
        <div class="chat box-shadow-orang py-2">
          <div class="icon mb-3 text-center">
            <span class="font-25 text-pink">
              <i class="fa-solid fa-comments"></i>
            </span>
          </div>

          <article class="p-3 mx-5 ">
            EduSmart provides chat rooms that are made from profound techniques so  tutors and students can communicate with each other very smoothly
          </article>
        </div>
        <div class="ask box-shadow-orang py-2">
          <div class="icon mb-3 text-center">
            <span class="font-25 text-pink">
              <i class="fa-solid fa-question"></i>
            </span>
          </div>

          <article class="p-3 mx-5 ">
            you can also join our community where students like you can communicate and learn from each other
          </article>
        </div>
        <div class="analyze box-shadow-orang py-2">
          <div class="icon mb-3 text-center">
            <span class="font-25 text-pink">
              <i class="fas fa-chalkboard-teacher"></i></span>
            </span>
          </div>

          <article class="p-3 mx-5 ">
            we have a variety of courses that are designed for all the levels so you can start with beginner course and end up with an expert course
          </article>
        </div>
        <div class="practice box-shadow-orang py-2">
          <div class="icon mb-3 text-center">
            <span class="font-25 text-pink">
                <i class="fa-solid fa-dumbbell"></i>
              
            </span>
            </span>
          </div>

          <article class="p-3 mx-5 ">
            EduSmart has AI techniques that are designed for all students , you can practice with reading paragraphs and answering questions that fit your level
          </article>
        </div>
      </section>
    </div>
  </div>


  <div class="footer-dec">
    <img src="{{ asset("images/footer-dec.png") }}" alt="">
  </div>
  
  <x-footer/>
@endsection


