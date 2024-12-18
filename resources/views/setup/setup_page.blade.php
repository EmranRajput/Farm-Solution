@extends('dashboard.user_dashboard')
@section('user')
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Client Setup</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Client</li>
                </ol>
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('add.setup')}}"  aria-expanded="false">
                <i class="ti ti-plus fs-4"></i>
                Add Labor
              </a>
            </div>
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Client List</h4>
            </div>
            <div class="card-body p-4">
              <div class="mb-4 border rounded-1">
                <div class="table-responsive">
                  <table id="alt_pagination" class="table table-bordered display text-nowrap align-middle" aria-describedby="alt_pagination_info">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">No</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Name</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Ranch</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Block</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Commodity</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Variety</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">#Acres</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">#Rows</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Row Spacing</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Tree Spacing</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Pollinator</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Pollinator Spacing</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Tree/Row</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Tree/Acre</h6>
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
                    @foreach($setup as $index => $user)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->username ? $user->username->name : ''}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->ranch ? $user->ranch->title : ''}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{ $user->block ? $user->block->title : '' }}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->commodity}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->variety}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->acres}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->rows}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->row_spacing}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->tree_spacing}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->pollinator}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->pollinator_spacing}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->trees_row}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$user->trees_acre}}</h6>
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
                                <a href="{{ route('edit.setup', $user->id) }}" id="editrole" class="dropdown-item d-flex align-items-center gap-3">
                                  <i class="fs-4 ti ti-edit"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('delete.setup', $user->id) }}">
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    $(document).on('change', '.acttoge', function() {
        var roleId = $(this).attr('id').split('-').pop();
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/setup/' + roleId + '/update-status',
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
      url: '/get/' + userId + '/job',
      type: 'get',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
          status: status
      },
      success: function(data) {
        $('#job_id').val(data.id);
        $('#job_name').val(data.name);
        $('#addRoleModalLabel').text('Edit Job');
        $('#addRoleModal').modal('show');
      }
  });

  $.get('/users/' + userId + '/edit', function(data) {
      
  });
}

</script>

@endsection
