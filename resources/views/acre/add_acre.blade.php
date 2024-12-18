@extends('dashboard.user_dashboard')
@section('user')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@if ($errors->any())
    <script>
        $(document).ready(function () {
            console.log('Errors detected');
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        });
    </script>
@endif
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="d-md-flex align-items-center justify-content-between mb-7">
      <div class="mb-4 mb-md-0">
        <h4 class="fs-6 mb-0">Acre</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Add Acre</li>
          </ol>
        </nav>
      </div>
        <div class="d-flex align-items-center justify-content-between gap-6">
          <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('acre.list')}}" id="get-url" aria-expanded="false">
          Acre
          </a>
        </div>
      </div>
          <div class="col-12">
            <div class="card">
              <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Add Acre</h4>
              </div>
              <div class="card-body p-4 border-bottom">
                <h5 class="fs-4 fw-semibold mb-4"></h5>
            <form action="{{route('store.acre')}}" method="POST">
              @csrf
                <div class="row">
                  <div class="form-group col-md-6">
                      <label for="input13" class="form-label">Select Client</label>
                      <select  name="client_id" class="form-select mb-3"  required>
                          <option selected="" disabled> --select Client-- </option>
                          @foreach($clientuser as $blocks)
                            <option value="{{$blocks->id}}">{{ $blocks->name }}</option>
                          @endforeach
                      </select>                               
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Title</label>
                      <input type="number" class="form-control" id="exampleInputtext3" name="title" placeholder="Acre...." min="1" oninput="this.value = this.value.replace(/^0+/, '');" required>
                      </div>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="input1" class="form-label">Ranch</label>
                      <select  name="ranch_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected="" disabled>Select Ranch</option>
                          @foreach($ranch as $item)
                          <option value="{{$item->id}}">{{$item->title}}</option>
                          @endforeach
                      </select>                           
                  </div>
                  <div class="form-group col-md-6">
                      <label for="input1" class="form-label">Block</label>
                      <select  name="block_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected="" disabled> --select block-- </option>
                          @foreach($block as $blocks)
                            <option value="{{$blocks->id}}">{{ $blocks->title }}</option>
                          @endforeach
                      </select>                               
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Description</label>
                      <input type="text" class="form-control" name="description" id="exampleInputtext3"  placeholder="Description....">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="lat" class="form-label">Latitude</label>
                      <input type="text" class="form-control" id="lat" name="lat"  placeholder="Latitude...." required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="lng" class="form-label">Longitude</label>
                      <input type="text" class="form-control" id="lng" name="lng"  placeholder="Longitude...." required>
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
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
            $('select[name="ranch_id"]').on('change', function(){
                var ranch_id = $(this).val();
                if (ranch_id) {
                    $.ajax({
                        url: "{{ url('/block/ajax') }}/"+ranch_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="block_id"]').html('');
                            var d =$('select[name="block_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="block_id"]').append('<option value="'+ value.id + '">' + value.title + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });
</script>
@endsection