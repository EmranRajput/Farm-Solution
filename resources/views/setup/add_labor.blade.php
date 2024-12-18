@extends('dashboard.user_dashboard')
@section('user')
<link rel="stylesheet" href="https://farmdatasolutions.co/assets/css/styles.css">
<script src="https://farmdatasolutions.co/js/app.js"></script>

<div class="body-wrapper">
  <div class="container-fluid">
    <div class="d-md-flex align-items-center justify-content-between mb-7">
      <div class="mb-4 mb-md-0">
        <h4 class="fs-6 mb-0">Setup Page</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Setup Page</li>
          </ol>
        </nav>
      </div>
        <div class="d-flex align-items-center justify-content-between gap-6">
          <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('setup.page')}}" id="get-url" aria-expanded="false">
          Setup List
          </a>
        </div>
      </div>
          <div class="col-12">
            <div class="card">
              <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Setup</h4>
              </div>
              <div class="card-body p-4 border-bottom">
                <h5 class="fs-4 fw-semibold mb-4"></h5>
            <form action="{{ url('setupstore') }}" method="POST">
              @csrf
                  <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext3" class="form-label">Client Name</label>
                          <select  name="name" class="form-select mb-3" aria-label="Default select example" required>
                            <option> --select client--</option> 
                            @foreach($user as $users)
                              <option value="{{$users->id}}">{{ $users->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                        <label for="exampleInputtext4" class="form-label">Select Ranch</label>
                          <select  name="ranch_id" id="ranch" class="form-select mb-3" aria-label="Default select example" required>
                            <option>Select Ranch</option>
                            @foreach($ranch as $rachns)
                                <option value="{{ $rachns->id }}">{{ $rachns->title }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                        <label for="exampleInputtext5" class="form-label">Select Block</label>
                          <select name="block_id" id="block" class="form-select mb-3" aria-label="Default select example" required>
                            <option>Select Block</option>
                            @foreach($block as $blocks)
                                <option value="{{ $blocks->id }}" data-ranch-id="{{ $blocks->ranch_id }}">{{ $blocks->title }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div class="col-lg-12" style="margin-bottom: 15px;">
                        <span style="font-size:25px;">Block Info</span>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext7" class="form-label">Commodity</label>
                          <input type="text" class="form-control" id="exampleInputtext7" name="commodity" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext8" class="form-label">Variety</label>
                          <input type="text" class="form-control" id="exampleInputtext8" name="variety" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext9" class="form-label">#Acres</label>
                          <input type="text" class="form-control" id="exampleInputtext9" name="acres" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext10" class="form-label">#Rows</label>
                          <input type="text" class="form-control" id="exampleInputtext10" name="rows" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext11" class="form-label">Row Spacing</label>
                          <input type="text" class="form-control" id="exampleInputtext11" name="rowspacing" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext12" class="form-label">Tree Spacing</label>
                          <input type="text" class="form-control" id="exampleInputtext12" name="treespacing" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext13" class="form-label">Pollinator</label>
                          <input type="text" class="form-control" id="exampleInputtext13" name="pollinator" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext14" class="form-label">Pollinator Spacing</label>
                          <input type="text" class="form-control" id="exampleInputtext14" name="pollinatorspacing" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext15" class="form-label">Trees/Row</label>
                          <input type="text" class="form-control" id="exampleInputtext15" name="treesrow" value="" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext16" class="form-label">Trees/Acre</label>
                          <input type="text" class="form-control" id="exampleInputtext16" name="treesacre" value="" >
                        </div>
                      </div>
                    </div>
                      
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-4">
                      <div class="col-12">
                        <div class="d-flex align-items-center gap-3">
                          <button  type="submit" class="btn btn-primary">Submit</button>
                          <button class="btn bg-danger-subtle text-danger">Cancel</button>
                        </div>
                      </div>
                    </div>
              
            </form>
            </div>
          </div>
      </div>
</div>



<!-- Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('storejob') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add New Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role name input -->
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="job_id"  name="job_id">

                        <label for="job_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="job_name" name="job_name" required>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Job</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('#ranch').change(function(){
        var selectedRanchID = $(this).val();  
        $('#block option').each(function() {
            var blockRanchID = $(this).data('ranch-id');  

            if(blockRanchID == selectedRanchID) {
                $(this).show();  
            } else {
                $(this).hide();  
            }
        });

        $('#block').val('').prop('selectedIndex', 0);
    });
  });
</script>


@endsection