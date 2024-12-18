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
.table-responsive {
  overflow-y: hidden;
}

#alt_pagination_paginate {
  margin-bottom: 25px;
}

</style>
@section('user')
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Invoice Entry</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                </ol>
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              <button type="submit" class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" id="addLaborButton" >
                <i class="ti ti-plus fs-4"></i>
                Add 
              </button>
            </div>
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Invoice List</h4>
            </div>
            <div class="card-body p-4">
              <div class="mb-4 border rounded-1">
                <div class="table-responsive">
                  <table id="alt_pagination" class="table table-bordered display " aria-describedby="alt_pagination_info">
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
                          <h6 class="fs-4 fw-semibold mb-0"># Invoice</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Company</h6>
                        </th>
<!--                       
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0"># People</h6>
                        </th> -->
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Ranch</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Block</h6>
                        </th>
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Description</h6>
                        </th>
                        <!-- <th>
                          <h6 class="fs-4 fw-semibold mb-0">Time</h6>
                        </th> -->
                        <th>
                          <h6 class="fs-4 fw-semibold mb-0">Amount</h6>
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
                      @foreach($invoice->reverse() as $index => $labor)
                        <tr>
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
                                <h6 class="fs-4 fw-normal mb-0">{{ $labor->invoice }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h6 class="fs-4 fw-normal mb-0">{{ $labor->company }}</h6>
                              </div>
                            </div>
                          </td>
                          <!-- <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h6 class="fs-4 fw-normal mb-0 editable people" data-labor-id="{{ $labor->id }}">{{ $labor->people }}</h6>
                              </div>
                            </div>
                          </td> -->
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
                                <h6 class="fs-4 fw-normal mb-0">{{$labor->crewuser ? $labor->crewuser->name : $labor->description}}</h6>
                              </div>
                            </div>
                          </td>
                          <!-- <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h6 class="fs-4 fw-normal mb-0 editable time" data-labor-id="{{ $labor->id }}">{{$labor->full_time}}</h6>
                              </div>
                            </div>
                          </td> -->
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h6 class="fs-4 fw-normal mb-0 editable total_amount" data-labor-id="{{ $labor->id }}"><span>$</span>{{$labor->total_amount}}</h6>
                              </div>
                            </div>
                          </td>                      
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3" id="amountchange_{{ $labor->id }}" data-labor-id="{{ $labor->id }}">
                                <h6 class="fs-4 fw-normal mb-0">{{ $labor->invoice_category == 1 ? 'Paid' : 'Unpaid' }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="d-flex align-items-center">
                              <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                <!-- liveuser('{{ $labor->id }}') -->
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('delete.invoice', $labor->id) }}">
                                    <i class="fs-4 ti ti-trash"></i>
                                  </a>
                                </li>
                                <!-- <li class="list-inline-item">
                                  <button href="" id="editrole" class="dropdown-item d-flex align-items-center gap-3">
                                    <i class="fs-4 ti ti-edit"></i>
                                  </button>
                                </li> -->
                              
                              </ul>
                            </div>
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
            <form action="{{ url('menualallocateadd') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">New Invoice Entry</h5>
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
                        <label for="invoice" class="form-label"># Invoice </label>
                        <input type="text" class="form-control" id="invoice" name="invoice" required>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company </label>
                        <input type="text" class="form-control" id="company" name="company" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="people" class="form-label"># People </label>
                        <input type="text" class="form-control" id="people" name="people" required>
                    </div> -->
                    <div class="mb-3">
                      <label for="ranch" class="form-label">Select Ranch</label>
                      <select class="form-control" id="ranch" name="ranch" >
                          <option value="" disabled selected>Select Ranch</option>
                          <option value="all">All Ranch</option>
                          @foreach($ranch as $ranchs)
                              <option value="{{ $ranchs->id }}">{{ $ranchs->title }}</option>
                          @endforeach
                          
                      </select>
                    </div> 
                    <div class="mb-3" id="block-container">
                      <label for="block" class="form-label">Select Block</label>
                      <select class="form-control" id="block" name="block" >
                          <option value="" disabled selected>Select Block</option>
                          <option value="all">All Block</option>
                          @foreach($block as $blocks)
                            <option value="{{ $blocks->id }}" data-ranch-id="{{ $blocks->ranch_id }}">{{ $blocks->title }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3" id="acre-container">
                      <label for="acre" class="form-label">Select Acre</label>
                      <select class="form-control" id="acre" name="acre" >
                          <option value="" disabled selected>Select Acre</option>
                          @foreach($acres as $acre)
                            <option value="{{ $acre->id }}" data-block-id="{{ $acre->block_id }}">{{ $acre->title }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                    <label for="crew_boss" class="form-label">Select Job</label>
                      <select class="form-control" id="description" name="description" required>
                          <option value="" disabled selected>Select Job</option>
                          @foreach($jobs as $job)
                              <option value="{{ $job->id }}">{{ $job->name }}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="block" class="form-label">Select Payment</label>
                      <select class="form-control" id="payment" name="payment" required>
                          <option value="" disabled selected>Select Amount</option>
                          <option value="1" >Paid</option>
                          <option value="0" >Pending</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="jobdescription" class="form-label">Description</label>
                      <textarea class="form-control" id="jobdescription" name="jobdescription" rows="4" required></textarea>
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


<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Status Change</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to change the status?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmChangeBtn">Yes, Change Status</button>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function() {

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
                  $td.hasClass('time') ? 'full_time' : 'total_amount';

      $.ajax({
        url: '/updateInvoice', 
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

  $('#ranch').on('change', function() {
    var selectedRanch = $(this).val();

    if (selectedRanch === 'all') {
      // If "All Ranch" is selected, hide Block and Acre
      $('#block-container').hide();
      $('#acre-container').hide();
    }
  });
  $('#block').on('change', function() {
    var selectedRanch = $(this).val();

    if (selectedRanch === 'all') {
      $('#acre-container').hide();
    }
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
            url: '/updateInvoice', 
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

function liveuser(Id) {
 
  event.preventDefault();

  window.location.href = '/getinvoicedata?id=' + Id;

    
}


$('#ranch').change(function() {
    var selectedRanchID = $(this).val();  
    
    // Always show "All Block" option
    $('#block option[value="all"]').show();
    
    if (selectedRanchID === '') {
        $('#block option').show();
    } else {
        $('#block option').each(function() {
            var blockRanchID = $(this).data('ranch-id');  

            if (blockRanchID == selectedRanchID || $(this).val() == 'all') {
                $(this).show();  // Show block related to the selected ranch or the "All Block"
            } else {
                $(this).hide();  // Hide other blocks
            }
        });
    }
    
    // Reset block selection to default
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
  $('#acre').val('').prop('selectedIndex', 0);
});

</script>


<script>
    var selectedLaborId = null; 

    $('[id^="amountchange_"]').on('click', function() {
        selectedLaborId = $(this).data('labor-id');
        $('#confirmModal').modal('show');
    });

    $('#confirmChangeBtn').on('click', function() {
        toggleStatus(selectedLaborId);
        $('#confirmModal').modal('hide');  
    });

    function toggleStatus(laborId) {
        var statusElement = $('#amountchange_' + laborId);
        var currentStatus = statusElement.find('.fw-normal').text().trim();
        var newStatus = currentStatus === 'Paid' ? 'Unpaid' : 'Paid';

        statusElement.find('.status-text').text(newStatus);
        if (currentStatus === 'Paid') {
            alert('This labor status is already marked as Paid!');
        } else if (currentStatus === 'Unpaid') {
            updateStatusOnServer(laborId, 0); // 0 represents Unpaid
        }
    }

    function updateStatusOnServer(laborId, newStatus) {
        $.ajax({
            url: '/invoicestatus', 
            method: 'POST',
            data: {
                labor_id: laborId,
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              var newStatusText = newStatus === 1 ? 'Paid' : 'Unpaid';
              $('#amountchange_' + laborId).find('h6').text(newStatusText);
              window.location.href = "{{ route('data.base') }}";
              //toastr.success('Status updated successfully!');
            },
            error: function(xhr) {
                console.log('Error updating status.');
                var revertStatus = newStatus === 1 ? 'Unpaid' : 'Paid';
                $('#amountchange_' + laborId).find('.status-text').text(revertStatus);
            }
        });
    }


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

</script>



@endsection
