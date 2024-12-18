@extends('dashboard.user_dashboard')
@section('user')
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Ranch</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Ranch</li>
                </ol>
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('add.ranch')}}"  aria-expanded="false">
                <i class="ti ti-plus fs-4"></i>
              Add Ranch
              </a>
            </div>
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Ranch List</h4>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive mb-4 border rounded-1">
                <table id="alt_pagination" class="table table-bordered text-nowrap display " aria-describedby="alt_pagination_info">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">No</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Ranch</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Description</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                      </th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    @foreach($ranches as $index => $ranch)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$ranch->title}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal">{{$ranch->description}}</p>
                      </td>
                       <td>
                        <div class="form-check form-switch">
                          <input class="form-check-input success acttoge" type="checkbox" id="color-success-{{ $ranch->id }}" {{ $ranch->status == 1 ? 'checked' : '' }} />
                          <label class="form-check-label" for="color-success-{{ $ranch->id }}"></label>
                        </div>                      
                      </td>
                      <td>
                        <a class="" href="{{route('edit.ranch', $ranch->id)}}" style="margin-right: 10px;">
                            <iconify-icon icon="solar:pen-line-duotone" width="24" height="24"></iconify-icon>
                        </a>
                        <a class="" href="{{route('delete.ranch', $ranch->id)}}" style="margin-right: 10px;">
                            <iconify-icon icon="solar:trash-bin-trash-linear" width="24" height="24"></iconify-icon>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    $(document).on('change', '.acttoge', function() {
        var roleId = $(this).attr('id').split('-').pop();
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/ranch/' + roleId + '/update-status',
            type: 'POST',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            },
            success: function(data) {
                if (data.success) {
                    console.log('Status updated successfully');
                } else {
                    console.error('Status update failed');
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });


});

</script>
 
@endsection
