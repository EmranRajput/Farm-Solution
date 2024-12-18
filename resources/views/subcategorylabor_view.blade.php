@extends('dashboard.user_dashboard')
<style>
  #alt_pagination_paginate {
  margin-bottom: 25px;
}
</style>
@section('user')
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Sub Category</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Subcategory</li>
                </ol>
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              <button type="submit" class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9"  aria-expanded="false" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                <i class="ti ti-plus fs-4"></i>
                Add Subcategory
              </button>
            </div>
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Subcategory List</h4>
            </div>
            <div class="card-body p-4">
              <div class="mb-4 border rounded-1">
                <div class="table-responsive">
                  <table id="alt_pagination" class="table table-bordered display text-nowrap dataTable" aria-describedby="alt_pagination_info">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">No</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Category</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Subcategory</h6>
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
                    @foreach($job as $index => $user)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">
                                @if ($user->category == 1)
                                    Labor
                                @elseif ($user->category == 2)
                                    Non-Labor
                                @else
                                    Unknown
                                @endif
                              </h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->subcategory}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-check form-switch">
                            <input class="form-check-input success acttoge" type="checkbox" id="color-success-{{ $user->id }}" {{ $user->status == 1 ? 'checked' : '' }} />
                            <label class="form-check-label" for="color-success-{{ $user->id }}"></label>
                          </div>                     
                        </td>
                        <td>
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item">
                                <button href="" id="editrole" onclick="getjobdata(<?= $user->id; ?>);" class="dropdown-item d-flex align-items-center gap-3">
                                  <i class="fs-4 ti ti-edit"></i>
                                </button>
                              </li>
                              <li class="list-inline-item">
                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('delete.subcategory', $user->id) }}">
                                  <i class="fs-4 ti ti-trash"></i>
                                </a>
                              </li>
                            </ul>
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
      </div>



<!-- Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('addsubcategory') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add New Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role name input -->
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id"  name="id">

                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                          <option value="">Select Category</option>
                          <option value="1">Labore</option>
                          <option value="2">Non Labore</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subcategory" class="form-label">Sub Category</label>
                        <input type="text" class="form-control" id="subcategory" name="subcategory" required>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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
            url: '/subcategory/' + roleId + '/update-status',
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



function getjobdata(id) {

event.preventDefault();

  var userId = id;

  $.ajax({
      url: '/get/' + userId + '/subcategory',
      type: 'get',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
          status: status
      },
      success: function(data) {
        $('#id').val(data.id);
        $('#category').val(data.category);
        $('#subcategory').val(data.subcategory);
        $('#addRoleModalLabel').text('Edit Subcategory');
        $('#addRoleModal').modal('show');
      }
  });

  $.get('/users/' + userId + '/edit', function(data) {
      
  });
}

</script>

@endsection