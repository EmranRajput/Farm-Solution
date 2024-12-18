@extends('dashboard.user_dashboard')
@section('user')
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="d-md-flex align-items-center justify-content-between mb-7">
      <div class="mb-4 mb-md-0">
        <h4 class="fs-6 mb-0">Block</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="../main/index.html">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Block</li>
          </ol>
        </nav>
      </div>
        <div class="d-flex align-items-center justify-content-between gap-6">
          <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('user.list')}}" id="get-url" aria-expanded="false">
          Block
          </a>
        </div>
      </div>
          <div class="col-12">
            <div class="card">
              <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Edit Block</h4>
              </div>
              <div class="card-body p-4 border-bottom">
                <h5 class="fs-4 fw-semibold mb-4"></h5>
            <form action="{{route('update.block')}}" method="POST">
              @csrf
              <input type="hidden" name="block_id" value="{{$block->id}}">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Title</label>
                      <input type="text" class="form-control" id="exampleInputtext3" name="title" value="{{$block->title}}" placeholder="Ranch....">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="input1" class="form-label">Ranch</label>
                      <select  name="ranch_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected="" disabled>Select Ranch</option>
                          @foreach($ranch as $item)
                          <option value="{{$item->id}}" {{ $item->id == $block->ranch_id ? 'selected' : '' }}>{{$item->title}}</option>
                          @endforeach
                      </select>                            
                  </div>
                 <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="exampleInputtext3" class="form-label">Description</label>
                      <input type="text" class="form-control" name="description" id="exampleInputtext3" value="{{$block->description}}"  placeholder="Description....">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="size" class="form-label">Block Size (in block)</label>
                      <input type="number" class="form-control" step="0.01" value="{{$block->size}}" id="size" name="size"  placeholder="Size...." required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="lat" class="form-label">Latitude</label>
                      <input type="text" class="form-control" id="lat" name="lat"  value="{{$block->lat}}" placeholder="Latitude...." required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-4">
                      <label for="lng" class="form-label">Longitude</label>
                      <input type="text" class="form-control" id="lng" name="lng"  value="{{$block->lng}}" placeholder="Longitude...." required>
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