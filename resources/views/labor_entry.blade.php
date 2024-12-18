@extends('dashboard.user_dashboard')

<style>
    .bg-trsuccess {
        background-color: #46eb7e !important; 
        --bs-table-bg : none;
    }
</style>

@section('user')
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Labor Entry</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Labore</li>
                </ol>
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              <button type="submit" class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" id="addLaborButton">
                <i class="ti ti-plus fs-4"></i>
                Add Labor
              </button>
            </div>
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Labor List</h4>
            </div>
            <div class="card-body p-4">
              <div class="mb-4 border rounded-1">
                <div class="table-responsive">
                  <table id="alt_pagination_le" class="table table-bordered display " aria-describedby="alt_pagination_info">
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
                          <h6 class="fs-4 fw-semibold mb-0"># Of People</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Ranch</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Block</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Job Description</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Start Time</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">End Time</h6>
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
        <div class="modal-content" >
            <form action="{{ url('laborestore') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add New Labor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="clientSelection" style="display: none;">
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Select Client</label>
                                <select class="form-select" id="client_id" name="client_id">
                                    <option value="">--Select Client--</option>
                                    @foreach($clientuser as $clientusers)
                                        <option value="{{ $clientusers->id }}">{{ $clientusers->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="labor_id"  name="labor_id">

                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="entrydate" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="crewboss" class="form-label">Crew Boss</label>
                                <select class="form-select" id="crewboss" name="crewboss" aria-label="Default select example">
                                    <option> --Select Crew-- </option>
                                    @foreach($crewboss as $boss)
                                    <option value="{{ $boss->id }}">{{ $boss->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="ofpeople" class="form-label"># Of People</label>
                                <select class="form-select" id="ofpeople" name="ofpeople" aria-label="Default select example">
                                    <option> --Select People-- </option>
                                    @foreach(range(1, 100) as $number)
                                        <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="ranch" class="form-label">Ranch</label>
                                <select class="form-select" id="ranch" name="ranch" aria-label="Default select example">
                                    <option> --Select Ranch-- </option>
                                    @foreach($ranch as $ranchs)
                                    <option value="{{ $ranchs->id }}">{{ $ranchs->title }}</option>
                                    @endforeach
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="block" class="form-label">Block</label>
                                <select class="form-select" id="block" name="blockid" aria-label="Default select example">
                                    <option> --Select Block-- </option>
                                    @foreach($block as $blocks)
                                    <option value="{{ $blocks->id }}" data-ranch-id="{{ $blocks->ranch_id }}">{{ $blocks->title }}</option>
                                    @endforeach
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="acre" class="form-label">Acre</label>
                                <select class="form-select" id="acre" name="acreid" aria-label="Default select example">
                                    <option> --Select Acre-- </option>
                                    @foreach($acres as $blocks)
                                    <option value="{{ $blocks->id }}" data-block-id="{{ $blocks->block_id }}">{{ $blocks->title }}</option>
                                    @endforeach
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="job" class="form-label">Job Description</label>
                                <select class="form-select" id="job" name="jobid" aria-label="Default select example">
                                    <option> --Select Job-- </option>
                                    @foreach($job as $jobs)
                                    <option value="{{ $jobs->id }}">{{ $jobs->name }}</option>
                                    @endforeach
                                </select>                    
                            </div>
                            <div id="amountFields" style="display: none;">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="starttime" class="form-label">Start Time</label>
                                <select class="form-select" id="starttime" name="starttime" aria-label="Default select example">
                                    <option> --Select Time-- </option>
                                    @foreach($timetable as $times)
                                    <option value="{{ $times->time }}">{{ $times->time }}</option>
                                    @endforeach
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="endtime" class="form-label">End Time</label>
                                <select class="form-select" id="endtime" name="endtime" aria-label="Default select example">
                                    <option> --Select Time-- </option>
                                    @foreach($timetable as $times)
                                    <option value="{{ $times->time }}">{{ $times->time }}</option>
                                    @endforeach
                                </select>                    
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin: 15px 0 18px 0;">
                            <span style="font-size: 22px;">Additional Info</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="binspicked" class="form-label">Bins Picked</label>
                                <select class="form-select" id="binspicked" name="binspicked" aria-label="Default select example">
                                    <option> --Select Value-- </option>
                                    @for($i = 0; $i <= 1000; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="treescompleted" class="form-label">Trees Completed</label>
                                <select class="form-select" id="treescompleted" name="treescompleted" aria-label="Default select example">
                                    <option> --Select Value-- </option>
                                    @for($i = 0; $i <= 10000; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="rowscompleted" class="form-label">Rows Completed</label>
                                <select class="form-select" id="rowscompleted" name="rowscompleted" aria-label="Default select example">
                                    <option> --Select Value-- </option>
                                    @for($i = 0; $i <= 100; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>                    
                            </div>
                        </div>
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

    var clientId = "{{ session('client_id') }}"; 
    var clientrole = "{{ auth()->user()->role }}";

    $('#addRoleModal').on('show.bs.modal', function() {
        $('#client_id').val(''); 
        $('#clientSelection').hide(); 

        if (clientId) {
            $('#client_id').val(clientId); 
            $('#clientSelection').show(); 
        } else if(clientrole == 2){
            $('#clientSelection').show(); 
        }
    });

    // Show the selected client name in the modal
    $('#client_id').on('change', function() {
        var selectedClientName = $(this).find('option:selected').text();
        $('#clientSelection').show(); // Ensure it's shown when a client is selected
        $('#clientName').text(selectedClientName); // Update displayed client name if needed
    });

    var userRole = @json(session('user_role'));
    


    $('#addLaborButton').on('click', function(event) {
        event.preventDefault(); 
        

        if (userRole == 1 || userRole == 2 || userRole == 7) {
            $('#clientSelection').show(); 
        } else {
            $('#clientSelection').hide(); 
        }

        $('#addRoleModal').modal('show');
    });

    $(document).on('change', '.acttoge', function() {
        var roleId = $(this).attr('id').split('-').pop();
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/labor/' + roleId + '/update-status',
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

    $('#ranch').change(function() {
        var selectedRanch = $(this).val();
        $('#block option').each(function() {
            var blockRanchId = $(this).data('ranch-id');
            if (selectedRanch == "" || blockRanchId == selectedRanch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('#block').val("");
    });
    $('#block').change(function() {
        var selectedRanch = $(this).val();
        $('#acre option').each(function() {
            var blockRanchId = $(this).data('block-id');
            if (selectedRanch == "" || blockRanchId == selectedRanch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('#acre').val("");
    });

    $('#client_id').change(function() {
        var clientId = $(this).val();
        
        if (clientId) {
            $.ajax({
                url: '/getclientranch', 
                method: 'POST', 
                data: {
                    client_id: clientId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#ranch').empty();
                    $('#ranch').append('<option value=""> --Select Ranch-- </option>');

                    // Populate the dropdown with ranch data from the response
                    $.each(response, function(index, setuppage) {
                        if (setuppage.ranch) {
                            $('#ranch').append('<option value="' + setuppage.ranch.id + '">' + setuppage.ranch.title + '</option>');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        }
    });

});


document.getElementById('job').addEventListener('change', function() {
    var amountFields = document.getElementById('amountFields');
    var selectedValue = this.value; // Get the selected job value
    
    if (selectedValue === '59' || selectedValue === '60' || selectedValue === '61') {
        amountFields.style.display = 'flex'; // Show the amount fields
    } else {
        amountFields.style.display = 'none'; // Hide the amount fields if not selected
    }
});


function getdata(id) {

event.preventDefault();

  var userId = id;

  $.ajax({
      url: '/get/' + userId + '/labor',
      type: 'get',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
          status: status
      },
      success: function(data) {
        $('#labor_id').val(data.id);
        $('#client_id').val(data.client_id);
        $('#date').val(data.entry_date);
        $('#crewboss').val(data.crew_boss).change();
        $('#ofpeople').val(data.of_people).change();
        $('#ranch').val(data.ranch_id).change();
        $('#block').val(data.block_id).change();
        $('#job').val(data.job_id).change();
        $('#starttime').val(data.starttime).change();
        $('#endtime').val(data.endtime).change();
        $('#binspicked').val(data.binspicked).change();
        $('#treescompleted').val(data.treescompleted).change();
        $('#rowscompleted').val(data.rowscompleted).change();

        $('#addRoleModal').modal('show');
      }
  });
}


$(document).ready(function() {
    $('#alt_pagination_le').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        order: [[0, 'asc']],
        
        ajax: {
            url: '/greendatarow',
            method: 'GET',
            dataSrc: ''
        },
        columns: [
            { data: null, render: function(data, type, row, meta) { return meta.row + 1; } }, // Index
            
            { 
                data: 'entry_date',
                render: function(data, type, row) {
                    if (!data) return ''; // Handle null or undefined dates
                    
                    var entry_date = new Date(data);
                    var options = { month: 'short' }; // Get short month name (e.g., 'Jan')
                    var month = new Intl.DateTimeFormat('en', options).format(entry_date); // Format month
                    var day = ("0" + entry_date.getDate()).slice(-2); // Pad day to 2 digits (e.g., '03')
                    var year = entry_date.getFullYear(); // Get full year (e.g., '2024')
                    
                    // Return formatted date as 'Jan/03/2024'
                    return `${month}/${day}/${year}`;
                }
            },
            { data: 'clientuser.name', defaultContent: '' },
            { data: 'laboruser.name', defaultContent: '' },
            { data: 'of_people' },
            { data: 'ranchuser.title', defaultContent: '' },
            { data: 'blockuser.title', defaultContent: '' },
            { data: 'jobuser.name', defaultContent: '' },
            { data: 'starttime' },
            { data: 'endtime' },
            {
                data: 'status',
                render: function(data, type, row) {
                  return `
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input success acttoge" id="color-success-${row.id}" data-id="${row.id}" ${data == 1 ? 'checked' : ''}>
                            <span class="slider round"></span>
                        </div>`;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                  var rowid = row.id;
                  return `<ul class="list-inline mb-0 d-flex">
                          <li class="list-inline-item">
                            <button type="button" id="editrole" onclick="getdata(${rowid});" class="dropdown-item d-flex align-items-center gap-3">
                              <i class="fs-4 ti ti-edit"></i>
                            </button>
                          </li>
                          <li class="list-inline-item">
                            <a class="dropdown-item d-flex align-items-center gap-3" href="/deletelaborsetup/${rowid}">
                              <i class="fs-4 ti ti-trash"></i> 
                            </a>
                          </li>
                          <li class="list-inline-item">
                            <button type="button"  onclick="statusupdate(${rowid});" class="dropdown-item d-flex align-items-center gap-3">
                              <i class="fs-4 ti ti-arrow-right"></i>
                            </button>
                          </li>
                        </ul>`;
                  }


            }
        ],

        rowCallback: function(row, data, index) {
            // Check if status is 1, then add 'bg-trsuccess' class to the row
            if (data.status == 1) {
                $(row).addClass('bg-trsuccess');
            }
        }
        
        // drawCallback: function(settings) {
        //     var api = this.api();
        //     var rows = api.rows().nodes();

        //     $(rows).removeClass('odd even'); // Remove odd and even classes

        //     api.rows().every(function() {
        //         var data = this.data();

        //         var startTime = updatemydate(data.starttime, data.entry_date);
        //         var endTime = updatemydate(data.endtime, data.entry_date);                 
        //         var now = new Date(); // Current date
                
        //         if (isValidDate(startTime) && isValidDate(endTime) && isValidDate(now)) {
        //             if (now.getTime() >= startTime.getTime() && now.getTime() <= endTime.getTime()) {
                        
        //             } else if (now.getTime() >= endTime.getTime()) {
        //             //   alert('ali');
        //             //     statusupdate(data.id);
        //           }
        //         } else {
        //             if (!isValidDate(startTime)) {
        //                 console.error("Invalid startTime:", startTime);
        //             }
        //             if (!isValidDate(endTime)) {
        //                 console.error("Invalid endTime:", endTime);
        //             }
        //             if (!isValidDate(now)) {
        //                 console.error("Invalid current time (now):", now);
        //             }
        //         }
        //     });
        // }
        
    });

    
});

function statusupdate(value){
    var status = 0;

    $.ajax({
            url: '/labor/' + value + '/update-status',
            type: 'POST',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            },
            success: function(data) {
                if (data.success) {
                    window.location.href = "{{ route('labor.allocate') }}";
                } else {
                    alert('Crew setup not found for the selected crew boss.');
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
}

function isValidDate(date) {
    return date instanceof Date && !isNaN(date);
}
function updatemydate(time, date) {
    var dateParts = new Date(date);
    
    if (isNaN(dateParts.getTime())) {
        console.error("Invalid date:", date);
        return new Date(NaN); // Return an invalid date
    }

    var timeString = time;

    var timeParts = /(\d+):(\d+)(\s*)(AM|PM)/.exec(timeString);
    if (!timeParts) {
        console.error("Invalid time format:", time);
        return new Date(NaN); // Return an invalid date
    }

    var hours = parseInt(timeParts[1], 10);
    var minutes = parseInt(timeParts[2], 10);
    var period = timeParts[4]; // AM or PM

    if (period === "PM" && hours < 12) {
        hours += 12; // Convert PM hours to 24-hour format
    }
    if (period === "AM" && hours === 12) {
        hours = 0; // Convert 12 AM to 0 hours
    }

    var combinedDateTime = new Date(dateParts); // Create a new date object based on the provided date
    combinedDateTime.setHours(hours);
    combinedDateTime.setMinutes(minutes);
    combinedDateTime.setSeconds(0); // Set seconds to 0
    combinedDateTime.setMilliseconds(0); // Set milliseconds to 0

    return combinedDateTime; // Return the combined date and time
}



</script>

@endsection
