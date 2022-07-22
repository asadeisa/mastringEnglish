<div >

<!-- Modal -->
<div class="modal fade" id="content{{  $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">create new content</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route("create-content") }}" method="post" enctype="multipart/form-data" >

      <div class="modal-body">
        <div class="container">
        
            @php
             if($type == "grammar")
             $list = ["Present simple", "present perfect", "Past simple","Present continuous","Past perfect" ,"present perfect contnuios","past perfect continuous"];
             else {
               # code...
               $list = ["proption","frasal ward","stop word","adverb","adjective","letter","pronunciation","new words"];
             } 
            @endphp
         
            @csrf
            <div class=" my-2 input-group ">
                <label for="description" class="w-25"> <p>description</p>
                </label>
                <input class="w-50 rounded form-control" type="text" name="description" id="description" required>
            </div>

            <div class="input-group mb-3">
              <label for="" class="w-25" for="inputGroupSelect01">
                <p>select subject</p>
              </label>
              <select class="form-select w-50"  name="subject" id="inputGroupSelect01">
                @for($i = 0; $i < count($list); $i++)
                  
                <option value="{{ $list[$i] }}" @if( $list[$i] ==$list[1]) selected  @endif>{{ $list[$i] }}</option>
                @endfor
              
              </select>
            </div>
            <input type="hidden" name="cours_id" value="{{ $id }}">
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="input-group my-2">
              <label for="" class="w-25" >
                <p>upload image or viduo</p> 
              </label>
              <input type="file" name="file" class="form-control w-50" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
              
            </div>

            <div class="input-group my-2">
              <span class="input-group-text">With textarea</span>
              <textarea name="text" class="form-control" aria-label="With textarea"></textarea>
            </div>


        </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark">Save changes</button>
      </div>
    </form>

    </div>
  </div>
</div>
<script >
  var myModalEl = document.getElementById('myModal')
myModalEl.addEventListener('hidden.bs.modal', function (event) {
  // do something...
})

</script>

</div>
