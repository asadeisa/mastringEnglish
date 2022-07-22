<div class="side-user w-5">
    <div class=" postion-fixed">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  
              @if (url()->current() == url('home') ||Str::startsWith(url()->current(), url("home/my-path"))) 
              active-nav 
              @endif
            
              "
                    href="{{ route('home') }}">
                    <span class="icon-side-nav"><i class="fa-solid fa-book-open"></i></span>
                    <div class="nav-link-text ms-1 hidden-text hover-show"><div> 
                        
                        learn
                        </div>
                    </div>
                </a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link 
              @if (url()->current() == url('home/community')) active-nav @endif
              "
                    href="{{ route('community') }}">
                    <span class="icon-side-nav">
                        <i class="fa-solid fa-comments"></i>
                    </span>
                    <div class="nav-link-text ms-1 hidden-text hover-show"><div> community</div>

                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                @if( Str::startsWith(url()->current(), url("home/practice")) )
                active-nav        
                @endif 
                 " 

                " href="{{ route("practice") }}">
                    <span class="icon-side-nav"><i class="fa-solid fa-dumbbell"></i></span>
                    <div class="nav-link-text ms-1 hidden-text hover-show"><div> practice </div>

                    </div>
                </a>
            </li>
                {{-- {{  dd( url('home/ask-question'))}} --}}
            <li class="nav-item">
                <a    class="nav-link 
                @if (url()->current() == url('home/ask-question'))
                active-nav
                @endif " 

                    href="{{ route('ask-question') }}">
                    <span class="icon-side-nav">
                        <i class="fa-solid fa-question"></i>

                    </span>
                    <div class="nav-link-text ms-1 hidden-text hover-show"><div> ask Questions </div>

                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link 
                @if (url()->current() == url('home/analyze'))
                active-nav
                @endif " 

                " href="{{ route('analyze') }}">
                    <span class="icon-side-nav"><i class="fa-solid fa-atom"></i></span>
                    <div class="nav-link-text ms-1 hidden-text hover-show"><div> analyze mistake </div>

                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  
                @if (url()->current() == url('home/u-profile'))
                active-nav
                @endif " 
                "
                 href="{{ route("u-profile") }}">
                    <span class="icon-side-nav">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </span>
                    <div class="nav-link-text ms-1 hidden-text hover-show"><div> Profile </div>

                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="submit-form">
                    <span class="icon-side-nav">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </span>
                    <div class="nav-link-text ms-1 hidden-text hover-show"><div> log out </div>
                    </div>
                    
                    <form method="post" id="form-logout" class="d-none" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="unset">log out
                        </button>
                    </form>
                </a>
            </li>
        </ul>
    </div>

<script>
    let submitformButton = document.querySelector("#submit-form");
    let formLogout = document.querySelector("#form-logout");

    submitformButton.addEventListener('click',()=>{
        formLogout.submit();
     })
</script>
</div>
