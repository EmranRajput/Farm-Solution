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
        <h4 class="fs-6 mb-0">User</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="{{ route('user.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Add Ranch</li>
          </ol>
        </nav>
      </div>
        <div class="d-flex align-items-center justify-content-between gap-6">
          <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('ranch.list')}}" id="get-url" aria-expanded="false">
          Ranch List
          </a>
        </div>
      </div>
          <div class="col-12">
            <div class="card">
              <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Add Ranch</h4>
              </div>
              <div class="card-body p-4 border-bottom">
                <h5 class="fs-4 fw-semibold mb-4"></h5>
            <form action="{{route('store.ranch')}}" method="POST">
              @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Title</label>
                      <input type="text" class="form-control" id="exampleInputtext3" name="title" placeholder="Ranch...." required>
                    </div>
                  </div>
                 <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Description</label>
                      <input type="text" class="form-control" name="description" id="exampleInputtext3"  placeholder="Description...." required>
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
@endsection