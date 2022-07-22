<div class="my-4">
    <div class="nav w-100">
        <div class="card-title card-delete w-100
        show-button-form remove-margen aligne-center d-flex p-2">
         <div class="title mx-1 ">
           Dachbord /
         </div>
         <div class="title mx-1 ">
           <h6> Teacher</h6>
         </div>
       </div>
    </div>
    <div class="container mt-4">
        <div class="card p-2">
            <div class="alert alert-success hidden-m status-massege">account <span></span> successfully  </div>
            <div class="alert alert-success  hidden-m delete-massege">account deleted successfully  </div>
            <table class="table table-striped tacher-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">rank</th>
                    <th scope="col">status</th>
                    <th scope="col">mange</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($allTeacher as $key => $teacher )
                    <tr class="remove-p">
                    <td class="text-center"><p>{{ $key+1 }}</p></td>
                    <td class="text-center"><p>{{ $teacher->user->name }}</p></td>
                    <td class="text-center"><p>{{ $teacher->user->email }}</p></td>
                    <td class="text-center"><p>{{ $teacher->rank }}</p></td>
                    <td class="text-center d-flex justify-content-center">
                        <div class="form-check form-switch">
                            <input wire:click="changeStatus({{ $teacher->id }},{{ $teacher->status }})" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" 
                            @if($teacher->status ==1)
                            {{ "checked" }}
                            @endif
                            >
                            <label class="form-check-label" for="flexSwitchCheckChecked"> </label>
                        </div>
                    </td>
                        <td class="text-center">
                            <div>
                                <button wire:click="deleteTeacher({{ $teacher->user_id  }})" class="btn btn-danger btn-sm">delete</button>

                            </div>
                        </td>
                    </tr>
                    @empty
                        
                    @endforelse
             
                </tbody>
              </table>

        </div>
    </div>
    <input type="hidden" class="status-value" value="{{ $stut }}" >
    <script>

        window.addEventListener("status",()=>{
            let success  =  document.querySelector(".status-massege");
            let status  = document.querySelector(".status-value").value;
            console.log(status);
            let massege = null;
            if(status == 1)
            {
                 massege  = `activated`;
            }
            else{
                massege  = `deactivated`;
    
            }
            let pmassege = document.querySelector(".status-massege span");
            pmassege.innerText = massege;
            success.style.display = "block";
            setTimeout(() => {
            success.style.display = "none";
              
            }, 2000);
          });

        window.addEventListener("delete",()=>{
            let success  =  document.querySelector(".delete-massege");
            success.style.display = "block";
            setTimeout(() => {
            success.style.display = "none";
              
            }, 2000);
          });
    </script>
    
</div>
