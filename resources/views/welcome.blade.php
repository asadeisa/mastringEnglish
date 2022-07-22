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
        <h2 class="mt-5">
          learn English with  ultimate  options 

        </h2>
         <article class="my-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. At voluptas officiis quibusdam excepturi, voluptatem ratione, eveniet ad doloribus velit vero dicta quae, voluptatibus neque doloremque cupiditate iure blanditiis dolores et?</article>
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
      <section class="services d-flex justify-content-space-between ">

        <img width="300" height="300" src="{{ asset("images/about-left-image.png") }}" >
         <div class="flex-1 d-flex align-items-center">
          <article class="p-3 mx-5">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. In expedita doloribus ea culpa eligendi illum, ducimus et tempora blanditiis totam veritatis officia repellat sint beatae? Nisi dolores similique neque cupiditate!
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
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium velit aliquam dolores ut. Ut totam eaque quas voluptas, vitae, illo accusantium adipisci facere est repudiandae aliquam cumque, obcaecati aspernatur!
          </article>
        </div>
        <div class="ask box-shadow-orang py-2">
          <div class="icon mb-3 text-center">
            <span class="font-25 text-pink">
              <i class="fa-solid fa-question"></i>
            </span>
          </div>

          <article class="p-3 mx-5 ">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium velit aliquam dolores ut. Ut totam eaque quas voluptas, vitae, illo accusantium adipisci facere est repudiandae aliquam cumque, obcaecati aspernatur!
          </article>
        </div>
        <div class="analyze box-shadow-orang py-2">
          <div class="icon mb-3 text-center">
            <span class="font-25 text-pink">
              <i class="fa-solid fa-atom"></i></span>
            </span>
          </div>

          <article class="p-3 mx-5 ">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium velit aliquam dolores ut. Ut totam eaque q
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
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium velit aliquam dolores ut. Ut totam eaque q
          </article>
        </div>
      </section>
    </div>
  </div>

  <div id="about" class="about-us section mt-5">
    <div class="container ">
      

    </div>
  </div>

  <div class="footer-dec">
    <img src="{{ asset("images/footer-dec.png") }}" alt="">
  </div>
  <x-footer/>
@endsection


