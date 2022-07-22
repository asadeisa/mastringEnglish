<div>
    <header class="header-area header-sticky wow slideInDown" >
        <div class="mx-5">
          <div class="row">
            <div class="col-12">
              <nav class="main-nav d-flex  gap-7 justify-content-space-between">
                <!-- ***** Logo Start ***** -->
                <a  class="logo">
                  <img width="150" height="150" src="{{ asset('images/logo/log.jpg') }}">
                </a>
                <!-- ***** Logo End ***** -->
                <!-- ***** Menu Start ***** -->
                <ul class="nav">
                  <li class="scroll-to-section"><a href="{{ route("welcome") }}" 
                    @if(url('/') == url()->current()  )
                    class="active"
                    @endif
                    >Home</a>
                  </li>
                  <li class="scroll-to-section"><a href="#services">Services</a></li>
                  <li class="scroll-to-section"><a href="#about">About</a></li>
                  <li class="scroll-to-section"><a href="{{ route("register") }}">Contact Us</a></li> 
                  <li class="scroll-to-section"><a href="{{route("login")}}">log in </a></li>  
                  <li class="scroll-to-section"><div class="main-red-button-hover"><a href="{{ route("register") }}">Regester</a></div></li>
                </ul>        
                <a class='menu-trigger'>
                    <span>Menu</span>
                </a>
                <!-- ***** Menu End ***** -->
              </nav>
            </div>
          </div>
        </div>
      </header>
      <script>
        let alllink =  document.querySelectorAll(".main-nav ul a ")
        alllink.forEach(link => {
          link.addEventListener("click",()=>{
            for(let i=0;i<alllink.length ; i++)
            {
              alllink[i].classList.remove("active")

            }
                link.classList.add("active");
              })
        });
      </script>
</div>