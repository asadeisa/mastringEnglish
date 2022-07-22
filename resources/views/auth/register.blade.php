@extends("layout.homelayout")

@section("home")
<link rel="stylesheet" href={{ asset("css/templatemo-onix-digital.css") }}>
<link rel="stylesheet" href={{ asset("css/welcome.css") }}>
<x-header/>
  <div id="contact" class="contact-us section mb-5">
    <div class="container mb-4">
      <div class="row gap-7 mb-5">
        <div class="col-lg-6  mt-5  d-flex  align-items-center">
          <div class="section-heading">
            <h3>Feel free to <em>Contact</em> us via the <span>HTML form</span></h3>
            <div id="map">
             
            </div>
            <div class="info">
              <span><i class="fa fa-phone"></i> <a href="#">010-020-0340<br>090-080-0760</a></span>
              <span><i class="fa fa-envelope"></i> <a href="#">info@company.com<br>mail@company.com</a></span>
            </div>
          </div>
         
        </div>

        <div class="col-lg-5 align-self-center">
          <form id="contact" action="{{ route("register") }}" method="post" enctype="multipart/form-data">
            @csrf
          
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  @error('name')
                  <div class="error">{{ $message }}</div>
                    @enderror
                  <input type="name" name="name" id="name" placeholder="Name" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  @error('password')
                  <div class="error">{{ $message }}</div>
                    @enderror
                  <input type="password" name="password" placeholder="password"  required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  @error('password_confirmation')
                  <div class="error">{{ $message }}</div>
                    @enderror
                  <input type="password" name="password_confirmation" placeholder="confirm password"  required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  @error('email')
                  <div class="error">{{ $message }}</div>
                    @enderror
                  <input type="email" name="email"  pattern="[^ @]*@[^ @]*" placeholder="Your Email" required>
                </fieldset>
              </div>
              
              <div class="col-lg-12">
                <fieldset>
                  @error('file')
                  <div class="error">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                      <label for="formFile" class="form-label text-gray">Drop your Image</label>
                      <input class="form-control" type="file" id="formFile" name="file"
                    </div>
                </fieldset>
              </div>
              
            <div class="col-lg-12 d-flex my-4">
             <div class="radio px-3 ">
              <label for="student">student</label>
              <input checked type="radio" value="0" name="student" id="student" 
                >
             </div>
               <div class="radio px-3">
                <label for="teacher">teacher</label>
                <input type="radio"  name="student" value="1" id="teacher">
            
               </div>
            </div>

              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="main-button">Submit Request</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="contact-dec">
      <img src="{{ asset("images/contact-dec.png") }}" alt="">
    </div>
    <div class="contact-left-dec">
      <img src="{{ asset("images/contact-left-dec.png") }}" alt="">
    </div>
  </div>
  
  <x-footer/>
@endsection