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
#alt_pagination_paginate {
  margin-bottom: 25px;
}

</style>
@section('user')



      <div class="body-wrapper">
        <div class="container-fluid">
        <!-- Display Custom Error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

          <!-- Display Validation Errors -->
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Labor Allocate</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Allocate</li>
                </ol>
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              <button type="submit" class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" id="addLaborButton">
                <i class="ti ti-plus fs-4"></i>
                Add 
              </button>
            </div>
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 d-flex justify-content-between align-items-center">
              <h4 class="card-title mb-0">Allocate List</h4>
              <button id="InvoiceSelectionbtn" class="btn btn-primary" style="display: none;">Save</button>
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
                          <h6 class="fs-4 fw-semibold mb-0">Description</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Time</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Total Amount</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                        </th>
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
                              <h6 class="fs-4 fw-normal mb-0 edittable ranch_id" data-labor-id="{{ $labor->id }}">{{$labor->ranchuser ? $labor->ranchuser->title : ''}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0 edittable block_id" data-labor-id="{{ $labor->id }}">{{$labor->blockuser ? $labor->blockuser->title : ''}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <h6 class="fs-4 fw-normal mb-0">{{$labor->jobuser ? $labor->jobuser->name : $labor->description}}</h6>
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
                        <td>
                            <ul class="list-inline mb-0 alltheinvloice">
                              
                              <!-- <li class="list-inline-item">
                                <button type="button" id="editrole" class="dropdown-item d-flex align-items-center gap-3 edit-btn" data-index="{{ $index }}" data-labor-id="{{ $labor->id }}">
                                  <i class="fs-4 ti ti-edit"></i>
                                </button>
                              </li> -->
                              <li class="list-inline-item">
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('delete.allocate', $labor->id) }}">
                                    <i class="fs-4 ti ti-trash"></i>
                                  </a>
                                </li>
                              <li class="list-inline-item">
                                <input type="checkbox" class="select-labor" data-price="{{ $labor->total_amount }}" data-labor-id="{{ $labor->id }}">
                                <!-- <button id="{{$labor->id}}" onclick="liveuser('{{ $labor->crew_boss }}', '{{ $labor->id }}')" class="dropdown-item d-flex align-items-center gap-3" href="">
                                  <i class="fs-4 ti ti-arrow-right"></i>
                                </button> -->
                              </li>
                              <!-- <li class="list-inline-item">
                                <a class="dropdown-item d-flex align-items-center gap-3" href="" onclick="sendLaborData('{{ $labor }}')">
                                  <i class="fs-4 ti ti-arrow-right"></i>
                                </a>
                              </li> -->
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
            <form action="{{ url('allocateadd') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">New Allocate Labor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role name input -->
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
                        <input type="text" class="form-control" id="people" name="people">
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
                      <label for="acre" class="form-label">Select Acre</label>
                      <select class="form-control" id="acre" name="acre" required>
                          <option value="" disabled selected>Select Acre</option>
                          @foreach($acres as $acre)
                            <option value="{{ $acre->id }}" data-block-id="{{ $acre->block_id }}">{{ $acre->title }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Job Description</label>
                        <select class="form-control" id="description" name="description" required>
                          <option value="" disabled selected>Select Job</option>
                          @foreach($jobs as $job)
                            <option value="{{ $job->id }}">{{ $job->name }}</option>
                          @endforeach
                      </select>
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


<!-- Bootstrap Modal Structure -->
<!-- Modal structure -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="invoiceModalLabel">Invoice Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Input fields and textarea for invoice details -->
        <div class="mb-3">
          <label for="invoiceDate" class="form-label">Invoice Date</label>
          <input type="date" class="form-control" id="invoiceDate" name="invoiceDate">
        </div>

        <div class="mb-3">
          <label for="invoiceNumber" class="form-label">Invoice Number</label>
          <input type="number" class="form-control" id="invoiceNumber" name="invoiceNumber">
        </div>

        <div class="mb-3">
          <label for="invoiceDescription" class="form-label">Description</label>
          <textarea class="form-control" id="invoiceDescription" name="invoiceDescription" rows="4"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveInvoiceSelection">Save</button>
      </div>
    </div>
  </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function() {

  $('.select-labor').on('change', function () {
      const anyChecked = $('.select-labor:checked').length > 0;
      $('#InvoiceSelectionbtn').css('display', anyChecked ? 'block' : 'none');
    });

  var clientId = "{{ session('client_id') }}"; 

    $('#addRoleModal').on('show.bs.modal', function() {
        $('#client_id').val(''); 
        $('#clientSelection').hide(); 

        if (clientId) {
            $('#client_id').val(clientId); 
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

        if (userRole == 1 || userRole == 7) {
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


      $('#block').change(function(){
        var selectedRanchID = $(this).val();  
        $('#acre option').each(function() {
            var blockRanchID = $(this).data('block-id');  

            if(blockRanchID == selectedRanchID) {
                $(this).show();  
            } else {
                $(this).hide();  
            }
        });

        // Reset the Block dropdown to the default "Select Block" option
        $('#acre').val('').prop('selectedIndex', 0);
      });


      $('#InvoiceSelectionbtn').click(function() {
        $('#invoiceModal').modal('show');
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
        $('#client_id').val(data.client_id);
        $('#job_name').val(data.name);
        $('#addRoleModalLabel').text('Edit Job');
        $('#addRoleModal').modal('show');
      }
  });

  $.get('/users/' + userId + '/edit', function(data) {
      
  });
}

 function liveuser(UserId, laborId) {
    //event.preventDefault(); 
    
    var crewUserId = UserId;
    var laborId = laborId;
  
    $.ajax({
      url: '/getinvoicestatus',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
      },
      data: {
        client_id: crewUserId
      },
      success: function(response) {
        if (response.success) {
          var invoices = response.invoices;
          var tableBody = $('.invoiceTable tbody');
          tableBody.empty(); 
          $('#invoiceModal h3').text(laborId);
          invoices.forEach(function(invoice, index) {
            var row = `<tr>
                        <td><input type="checkbox" class="invoice-checkbox" value="${index}"></td>
                        <td>${invoice.invoice}</td>
                        <td>${invoice.total_amount}</td>
                      </tr>`;
            tableBody.append(row); // Append row to the table body
          });

          // Handle the "Select All" checkbox
          $('#selectAll').off('click').on('click', function() {
            var isChecked = $(this).is(':checked');
            $('.invoice-checkbox').prop('checked', isChecked);
          });

          $('#invoiceModal').modal('show');
        } else {
          handleNoInvoices(response.invoices, laborId);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error fetching invoices:', error);
        alert('An error occurred while fetching invoices.');
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
        url: '/updateLabor', 
        method: 'POST',
        data: {
          id: Id,
          field: field,
          value: newValue,
          _token: $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
          toastr.success('Updated successfully');
        },
        error: function(xhr, status, error) {
          toastr.error('Error updating field');
        }
      });
      $td.html(`<h6 class="fs-4 fw-normal mb-0">${newValue}</h6>`);
    });
    input.on('keypress', function(e) {
      if (e.which === 13) { // Enter key
        input.trigger('blur');
      }
    });
  });
});




$(document).ready(function() {
    $(document).on('dblclick', '.edittable.ranch_id, .edittable.block_id', function() {
        var laborId = $(this).data('labor-id'); 
        var currentText = $(this).text().trim(); 
        var fieldType = $(this).hasClass('ranch_id') ? 'ranch_id' : 'block_id'; 

        var selectOptions = fieldType === 'ranch_id' ? @json($ranch) : @json($block); 
        
        var selectHtml = `<select class="form-select form-select-sm save-dropdown" data-labor-id="${laborId}" data-field="${fieldType}">`;

        selectOptions.forEach(option => {
            var selected = option.title === currentText ? 'selected' : ''; 
            selectHtml += `<option value="${option.id}" ${selected}>${option.title}</option>`;
        });

        selectHtml += '</select>'; 

        $(this).html(selectHtml);
    });

    $(document).on('change', '.save-dropdown', function() {
        var laborId = $(this).data('labor-id'); 
        var selectedValue = $(this).val(); 
        var field = $(this).data('field'); 
        var dropdown = $(this); 

        $.ajax({
            url: '/updateLabor', 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', 
                id: laborId, 
                field: field, 
                value: selectedValue 
            },
            success: function(response) {
                if(response.success) {
                    var selectedText = dropdown.find('option:selected').text();
                    dropdown.replaceWith(`<h6 class="fs-4 fw-normal mb-0 editable ${field}" data-labor-id="${laborId}">${selectedText}</h6>`);
                    toastr.success('Updated successfully');
                } else {
                  toastr.error('Error updating field');
                }
            },
            error: function() {
                alert('Error processing request'); 
            }
        });
    });
});


$('#saveInvoiceSelection').on('click', function() {

    var invoiceDate = $('#invoiceDate').val();
    var invoiceNumber = $('#invoiceNumber').val();
    var invoiceDescription = $('#invoiceDescription').val();
    let totalSum = 0;
    let clientNames = new Set(); // To store unique client names
    let selectedRows = [];
    let selectedLaborIds = [];

    $('.select-labor:checked').each(function () {
      totalSum += parseFloat($(this).data('price'));
      let row = $(this).closest('tr'); // Get the parent row of the checkbox
      let clientName = row.find('td:nth-child(3) h6').text().trim(); // Get client name
      selectedLaborIds.push($(this).data('labor-id'));


      if (!clientNames.has(clientName)) { // Check if clientName is not already added
          clientNames.add(clientName); // Add clientName to the Set

          let rowData = {
              clientName: clientName,
              people: row.find('.people').text().trim(),
              ranch: row.find('.ranch_id').text().trim(),
              block: row.find('.block_id').text().trim(), 
              jobdescription: row.find('td:nth-child(8) h6').text().trim(),
              time: row.find('.time').text().trim(),
          };

          selectedRows.push(rowData); // Add row data to the array
      }
    });

    // Log or display the total
    console.log('Total Amount:', selectedRows);

    $.ajax({
        url: '/allocatedetailsdata', 
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            id: selectedLaborIds,
            total_amount: totalSum,
            selectedRows: selectedRows,
            invoiceDate: invoiceDate,
            invoiceNumber: invoiceNumber,
            invoiceDescription: invoiceDescription
        },
        success: function(response) {
            if (response.data) {
                // Redirect to the invoice entry route if successful
                window.location.href = '{{ route("invoice.entry") }}';
            } else {
                alert('Failed to save the invoice data.');
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error saving data:', error);
            alert('An error occurred while saving the data.');
        }
    });
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

    function handleNoInvoices(invoices, laborId) {
      $.ajax({
        url: '/allocatedetailsdata', 
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
        },
        data: {
            id: laborId,
            total_amount: invoices
        },
        success: function(response) {
            if (response.data) {
                // Redirect to the invoice entry route if successful
                window.location.href = '{{ route("invoice.entry") }}';
            } else {
                alert('Failed to save the invoice data.');
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error saving data:', error);
            alert('An error occurred while saving the data.');
        }
    });
}


</script>

@endsection