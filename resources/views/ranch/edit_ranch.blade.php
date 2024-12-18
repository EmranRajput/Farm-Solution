@extends('dashboard.user_dashboard')
@section('user')

<div class="body-wrapper">
  <div class="container-fluid">
    <div class="d-md-flex align-items-center justify-content-between mb-7">
      <div class="mb-4 mb-md-0">
        <h4 class="fs-6 mb-0">User</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="../main/index.html">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Ranch</li>
          </ol>
        </nav>
      </div>
        <div class="d-flex align-items-center justify-content-between gap-6">
          <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('user.list')}}" id="get-url" aria-expanded="false">
          Ranch
          </a>
        </div>
      </div>
          <div class="col-12">
            <div class="card">
              <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Edit Ranch</h4>
              </div>
              <div class="card-body p-4 border-bottom">
                <h5 class="fs-4 fw-semibold mb-4"></h5>
            <form action="{{route('update.ranch')}}" method="POST">
              @csrf
              <input type="hidden" name="ranch_id" value="{{$ranch->id}}">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Title</label>
                      <input type="text" class="form-control" id="exampleInputtext3" name="title" value="{{$ranch->title}}" placeholder="Ranch....">
                    </div>
                  </div>
                 <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Description</label>
                      <input type="text" class="form-control" name="description" id="exampleInputtext3" value="{{$ranch->description}}"  placeholder="Description....">
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