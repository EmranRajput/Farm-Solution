@extends('dashboard.user_dashboard')
@section('user')
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Crew Setup</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">crewsetup</li>
                </ol>
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('add.crewsetupget')}}"  aria-expanded="false">
                <i class="ti ti-plus fs-4"></i>
                Add Crew
              </a>
            </div>
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Crew Setup List</h4>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive mb-4 border rounded-1">
                <table id="alt_pagination_le" class="table table-bordered display text-nowrap align-middle" aria-describedby="alt_pagination_info">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">No</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Crew Boss</h6>
                      </th>
                      
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Labor Contructor</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Comission Rate</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Wage Rate</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Wage rate High</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Wage rate Low</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Graft/Chainsaw</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Lunch Break</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Break1</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Break2</h6>
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
                  @foreach($crewsetup as $index => $user)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->users ? $user->users->name : ''}}</h6>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->labor_contructor }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                          <h6 class="fs-4 fw-normal mb-0">{{$user->comission_rate }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->wage_rate}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->crewboss_wage_high}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->crewboss_wage_low}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->graft_chainsaw}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->lunch_break}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->break1}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$user->break2}}</h6>
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
                              <a href="{{ route('edit.crewsetup', $user->id) }}" id="editrole" class="dropdown-item d-flex align-items-center gap-3">
                                <i class="fs-4 ti ti-edit"></i>
                              </a>
                            </li>
                            <li class="list-inline-item">
                              <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('delete.crewsetup', $user->id) }}">
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {

    $(document).on('change', '.acttoge', function() {
        var roleId = $(this).attr('id').split('-').pop();
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/crewsetup/' + roleId + '/update-status',
            type: 'POST',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            },
            success: function(data) {
                if (data.success) {
                  toastr.success('Status updated successfully!');

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
