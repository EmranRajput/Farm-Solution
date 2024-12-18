@extends('dashboard.user_dashboard')
<style>
  .modal-backdrop {
    z-index: 1040; /* Ensure correct stacking */
}

.modal-open {
    overflow: auto !important; 
}
.custom-success {
    background-color: #04b440 !important;
}


</style>
@section('user')
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">TO Do List</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">todo list</li>
                </ol>
              </nav>
            </div>
            <!-- <div class="d-flex align-items-center justify-content-between gap-6">
              <button type="submit" class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9"  aria-expanded="false" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                <i class="ti ti-plus fs-4"></i>
                Add 
              </button>
            </div> -->
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">TODO List</h4>
            </div>
            <div class="card-body p-4">
              <div class="mb-4 border rounded-1">
                <div class="table-responsive">
                  <table id="alt_pagination" class="table  table-bordered display" aria-describedby="alt_pagination_info">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">No</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Date</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Client Name</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Crew Boss</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0"># People</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Ranch</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Block</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Job</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Time</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Total Amount</h6>
                      </th>
                      <!-- <th>
                        <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                      </th> -->
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($labors as $index => $labor)
                    <tr class="{{ $labor->status == 1 ? 'custom-success' : '' }}">
                      <td><?= $index+1;?></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{ $labor->date }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$labor->clientuser ? $labor->clientuser->name : ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$labor->crewuser ? $labor->crewuser->name : ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0 editable people" data-labor-id="{{ $labor->id }}">{{ $labor->people }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$labor->ranchuser ? $labor->ranchuser->title : ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$labor->blockuser ? $labor->blockuser->title : ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0">{{$labor->job_description_name }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0 editable time" data-labor-id="{{ $labor->id }}">{{$labor->time}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <h6 class="fs-4 fw-normal mb-0 editable total_amount" data-labor-id="{{ $labor->id }}"><span>$</span>{{$labor->total_amount}}</h6>
                          </div>
                        </div>
                      </td>                      
                      <!-- <td>
                          <ul class="list-inline mb-0">
                            
                            <li class="list-inline-item">
                              <button type="button" id="editrole" class="dropdown-item d-flex align-items-center gap-3 edit-btn" data-index="{{ $index }}" data-labor-id="{{ $labor->id }}">
                                <i class="fs-4 ti ti-edit"></i>
                              </button>
                            </li>
                            <li class="list-inline-item">
                              <button id="{{$labor->id}}" onclick="liveuser('{{ $labor->id }}')" class="dropdown-item d-flex align-items-center gap-3" href="">
                                <i class="fs-4 ti ti-arrow-right"></i>
                              </button>
                            </li>
                            <li class="list-inline-item">
                              <a class="dropdown-item d-flex align-items-center gap-3" href="" onclick="sendLaborData('{{ $labor }}')">
                                <i class="fs-4 ti ti-arrow-right"></i>
                              </a>
                            </li>
                          </ul>
                      </td> -->
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
            <form action="{{ url('allocateadd') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add New Allocate Labor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role name input -->
                    <div class="mb-3">
                        <label for="job_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="job_date" name="date" required>
                    </div>
                    <div class="mb-3">
                      <label for="crew_boss" class="form-label">Crew Boss</label>
                      <select class="form-control" id="crew_boss" name="crew_boss" required>
                          <option value="" disabled selected>Select Crew Boss</option>
                          @foreach($crewboss as $boss)
                              <option value="{{ $boss->id }}">{{ $boss->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="people" class="form-label"># People </label>
                        <input type="text" class="form-control" id="people" name="people" required>
                    </div>
                    <div class="mb-3">
                      <label for="ranch" class="form-label">Select Ranch</label>
                      <select class="form-control" id="ranch" name="ranch" required>
                          <option value="" disabled selected>Select Ranch</option>
                          @foreach($ranch as $ranchs)
                              <option value="{{ $ranchs->id }}">{{ $ranchs->title }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="block" class="form-label">Select Block</label>
                      <select class="form-control" id="block" name="block" required>
                          <option value="" disabled selected>Select Block</option>
                          @foreach($block as $blocks)
                            <option value="{{ $blocks->id }}" data-ranch-id="{{ $blocks->ranch_id }}">{{ $blocks->title }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Job Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
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



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    $(document).on('change', '.acttoge', function() {
        var roleId = $(this).attr('id').split('-').pop();
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/allocate/' + roleId + '/update-status',
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

        // Reset the Block dropdown to the default "Select Block" option
        $('#block').val('').prop('selectedIndex', 0);
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


function liveuser(labor) {
  // e.preventDefault();
    $.ajax({
      url: '/allocatedetailsdata', 
      type: 'POST',
      headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}' // Set the CSRF token in the request headers
    },
      data: {
      id: labor, 
    },
      success: function(response) {
        if (response.data == true) {
            window.location.href = '{{ route("invoice.entry") }}';
        } else {
            alert(response.data);  
        }
      }
    });
}


$(document).ready(function() {
  $('.editable').on('dblclick', function() {
    let $td = $(this);
    let currentValue = $td.text().trim();
    let Id = $(this).data('labor-id');
    let input = $('<input>', {
      type: 'text',
      class: 'form-control',
      value: currentValue
    });

    $td.html(input);
    input.focus();

    input.on('blur', function() {
      let newValue = input.val().trim();
      let laborId = $td.closest('tr').data('labor-id'); 
      let field = $td.hasClass('people') ? 'people' :
                  $td.hasClass('time') ? 'time' : 'total_amount';

      $.ajax({
        url: '/updateLabor', // Adjust URL for your save route
        method: 'POST',
        data: {
          id: Id,
          field: field,
          value: newValue,
          _token: $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
        },
        success: function(response) {
          // Show success message if needed
          toastr.success('Updated successfully');
        },
        error: function(xhr, status, error) {
          toastr.error('Error updating field');
          console.error('Error:', error);
        }
      });

      // Revert back to text display
      $td.html(`<h6 class="fs-4 fw-normal mb-0">${newValue}</h6>`);
    });

    // Save the value on pressing Enter key
    input.on('keypress', function(e) {
      if (e.which === 13) { // Enter key
        input.trigger('blur');
      }
    });
  });
});


</script>

@endsection
