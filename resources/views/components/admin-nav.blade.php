<div>
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
           
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
          </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <!-- this is scane part -->
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" placeholder="Type here...">
              </div>
            </div>
  
            <ul class="navbar-nav  justify-content-end">
              <li class="nav-item d-flex align-items-center">
                <form method="post" action="{{ route("logout") }}">
                  @csrf
                  <button class="nav-link text-body unset font-weight-bold px-0" type="submit" >log out

                    <i class="fa fa-user me-sm-1"></i>
                  </button>
                
                </form>
              
              </li>
            </ul>
          </div>
        </div>
        
      </nav>
      <!-- End Navbar -->
  
</div>