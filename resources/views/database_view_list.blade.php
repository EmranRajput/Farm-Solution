@extends('dashboard.user_dashboard')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">


@section('user')
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="d-md-flex align-items-center justify-content-between mb-7">
      <div class="mb-4 mb-md-0">
        <h4 class="fs-6 mb-0">Database</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Batebase</li>
          </ol>
        </nav>
      </div>
      
    </div>
    <div class="card w-100 position-relative overflow-hidden">
      <div class="px-4 py-3 border-bottom">
        <div class="card-body p-4">
          <form id="databaseForm" method="POST" action="{{ route('data.base') }}">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-4">
                  <label for="exampleInputtext3" class="form-label">Company</label>
                  <input type="text" class="form-control" id="exampleInputtext3" name="name" placeholder="Enter Company Here">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-4">
                  <label class="form-label">Select Ranch</label>
                  <select class="form-select" name="ranch" id="ranch" >
                  <option value="" selected>Select Ranch</option>
                    @foreach($ranchs as $ranch)
                        <option value="{{ $ranch->id }}">{{ $ranch->title }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="mb-4">
                  <label class="form-label">Select Block</label>
                  <select class="form-select" name="block" id="block" >
                  <option value="" selected>Select Block</option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}" data-ranch-id="{{ $block->ranch_id }}">{{ $block->title }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-4">
                  <label for="dateRange" class="form-label">Select Date Range</label>
                  <input type="text" id="dateRange" name="date_range" class="form-control" placeholder="Select Date Range">
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
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
                    <h6 class="fs-4 fw-semibold mb-0"># Invoice</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Company</h6>
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
                    <h6 class="fs-4 fw-semibold mb-0">Amount</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($databases->reverse() as $index => $labor)
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
                          <h6 class="fs-4 fw-normal mb-0 editable total_amount" data-labor-id="{{ $labor->id }}"><span>$</span>{{$labor->total_amount}}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                          <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('delete.database', $labor->id) }}" >
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
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">
            <h4 class="mt-3">Total Amount:</h4>
            <h4 id="totalAmountDisplay" class="mt-3">$1000</h4>
        </div>
          
        </div>
      </div>
          
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include JS for daterangepicker -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script>




<script>
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
      $('#block').val('').prop('selectedIndex', 0);
    });

    $(document).ready(function() {
    // Initialize date range picker
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'  // Customize the date format (you can change this as needed)
        },
        opens: 'left' // Set the calendar to open on the left side
    });
});


$(document).ready(function() {
    function calculateTotalAmount() {
        let total = 0;
        $(".total_amount").each(function() {
            let amountText = $(this).text().replace('$', '').trim(); 
            let amount = parseFloat(amountText);

            if (!isNaN(amount)) { 
                total += amount;
            }
        });

        $("#totalAmountDisplay").text("$" + total.toFixed(2));
    }

    calculateTotalAmount();
});
</script>

@endsection
