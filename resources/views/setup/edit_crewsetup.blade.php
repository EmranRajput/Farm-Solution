@extends('dashboard.user_dashboard')
@section('user')
<link rel="stylesheet" href="https://farmdatasolutions.co/assets/css/styles.css">
<script src="https://farmdatasolutions.co/js/app.js"></script>

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
            <li class="breadcrumb-item active" aria-current="page">Crew Setup</li>
          </ol>
        </nav>
      </div>
        <div class="d-flex align-items-center justify-content-between gap-6">
          <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('crew.setup')}}" id="get-url" aria-expanded="false">
          Setup List
          </a>
        </div>
      </div>
          <div class="col-12">
            <div class="card">
              <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Setup</h4>
              </div>
              <div class="card-body p-4 border-bottom">
                <h5 class="fs-4 fw-semibold mb-4"></h5>
            <form action="{{ url('crewsetupstore') }}" method="POST">
              @csrf
                
                  <input type="hidden" name="crewsetup_id" value="{{ $editsetup->id }}">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-4">
                        <label for="exampleInputtext4" class="form-label">Select Crew</label>
                        <select id="crewSelect" name="crew_id" class="form-select mb-3" aria-label="Default select example">
                          <option>Select Crew</option>
                          @foreach($user as $users)
                              <option value="{{ $users->id }}"{{ $editsetup->crewboss_id == $users->id ? 'selected' : '' }}>{{ $users->name }}</option>
                          @endforeach
                        </select>
                        </div>
                      </div>
                      <!-- <div class="col-lg-6">
                        <div class="mb-4">
                        <label for="exampleInputtext5" class="form-label">Select Block</label>
                          <select  name="job_id" class="form-select mb-3" aria-label="Default select example">
                            <option>Select Block</option>
                            @foreach($jobs as $jobss)
                            <option value="{{ $jobss->id }}"{{ $editsetup->job_id == $jobss->id ? 'selected' : '' }}>{{ $jobss->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div> -->
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext7" class="form-label">Labor Constructor</label>
                          <input type="text" class="form-control" id="exampleInputtext7" name="contructor" value="{{ $editsetup->labor_contructor }}" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext8" class="form-label">Comission Rate</label>
                          <input type="number" class="form-control" id="exampleInputtext8" name="commission" value="{{ $editsetup->comission_rate }}" >
                        </div>
                      </div> 
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext9" class="form-label">Wage Rate</label>
                          <input type="number" class="form-control" id="exampleInputtext9" name="wagerate" value="{{ $editsetup->wage_rate }}" >
                        </div>
                      </div> 
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext10" class="form-label">Crew Boss Wage</label>
                          <span>if > <span id="maxCrewHigh" onclick="updatePeopleData()"></span> people</span>
                          <input type="number" class="form-control" id="exampleInputtext10" name="bosswagehigh" value="{{ $editsetup->crewboss_wage_high }}" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext11" class="form-label">Crew Boss Wage</label>
                          <span>if < <span id="minCrewLow" onclick="getPeopleData()"></span> people</span>
                          <input type="text" class="form-control" id="exampleInputtext11" name="bosswagelow" value="{{ $editsetup->crewboss_wage_low }}" >
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext12" class="form-label">Graft/Chainsaw</label>
                          <input type="text" class="form-control" id="exampleInputtext12" name="chainsaw" value="{{ $editsetup->graft_chainsaw }}" >
                        </div>
                      </div>

                    </div>

                    <div class="row">
                    <span style="font-size: 20px;margin-bottom: 20px;font-weight: 500;">Break Time</span>
                    <div class="col-lg-6">
                      <div class="mb-4">
                        <label for="exampleInputtext8" class="form-label">Lunch Break</label>
                        <select name="lunch" class="form-select mb-3" aria-label="Default select example">
                          <option>Lunch Break</option>
                          <option value="10" {{ $editsetup->lunch_break == 10 ? 'selected' : '' }}>10 Minutes</option>
                          <option value="20" {{ $editsetup->lunch_break == 20 ? 'selected' : '' }}>20 Minutes</option>
                          <option value="30" {{ $editsetup->lunch_break == 30 ? 'selected' : '' }}>30 Minutes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-4">
                        <label for="exampleInputtext9" class="form-label">Break 1</label>
                        <select name="break1" class="form-select mb-3" aria-label="Default select example">
                          <option>Break 1</option>
                          <option value="10" {{ $editsetup->break1 == 10 ? 'selected' : '' }}>10 Minutes</option>
                          <option value="20" {{ $editsetup->break1 == 20 ? 'selected' : '' }}>20 Minutes</option>
                          <option value="30" {{ $editsetup->break1 == 30 ? 'selected' : '' }}>30 Minutes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-4">
                        <label for="exampleInputtext10" class="form-label">Break 2</label>
                        <select name="break2" class="form-select mb-3" aria-label="Default select example">
                          <option>Break 2</option>
                          <option value="10"{{ $editsetup->break2 == 10 ? 'selected' : '' }}>10 Minutes</option>
                          <option value="20"{{ $editsetup->break2 == 20 ? 'selected' : '' }}>20 Minutes</option>
                          <option value="30"{{ $editsetup->break2 == 30 ? 'selected' : '' }}>30 Minutes</option>
                        </select>
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
              
            </form>
            </div>
          </div>
      </div>
</div>

<!-- update max people -->
<div class="modal fade" id="maxpeopleModal" tabindex="-1" aria-labelledby="maxpeopleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="maxpeopleModalLabel">Enter Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <div class="side-by-side clearfix">
              <label for="maxpeople" class="form-label">Add New People</label>
              <br>
              <input type="text" class="form-control" id="increpeople" name="increpeople">   
            </div>         
            <br>
            <input type="hidden" class="form-control" id="crewboss" name="crewboss">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="maxModalData">Save changes</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="peopleModal" tabindex="-1" aria-labelledby="peopleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="peopleModalLabel">Enter Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="maxpeople" class="form-label">Add New People</label>
              <br>
              <input type="text" class="form-control" id="descpeople" name="descpeople">   
            <br>
            <input type="hidden" class="form-control" id="crewboss" name="crewboss">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveModalData">Save changes</button>
        </div>
    </div>
  </div>
</div>


<script>
function getcrewpeople(Id) {
    var jobId = Id;
    if (jobId) {
        $.ajax({
            url: '/get/' + jobId + '/ofpeople',
            type: 'get',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#maxCrewHigh').text(response.max_crew);
                $('#minCrewLow').text(response.min_crew);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
}

$(document).ready(function() {
    var selectedCrew = '{{ $editsetup->crewboss_id }}';
    if (selectedCrew) {
        getcrewpeople(selectedCrew);
    }
});

document.getElementById('crewSelect').addEventListener('change', function() {
    var jobId = $(this).val();
    getcrewpeople(jobId);
});

function updatePeopleData() {
  var maxCrewLowValue = $('#maxCrewHigh').text();
  var jobId = $('#crewSelect').val();
  $('#crewboss').val(jobId);
  $('#increpeople').val(maxCrewLowValue);
  $('#maxpeopleModal').modal('show');

}

function getPeopleData() {
  var minCrewLow = $('#minCrewLow').text();
  var jobId = $('#crewSelect').val();
  $('#crewboss').val(jobId);
  $('#descpeople').val(minCrewLow);
  $('#peopleModal').modal('show');

}

$('#saveModalData').on('click', function() {
    var inputValue = $('#descpeople').val();
    var crewboss = $('#crewboss').val();
    $('#peopleModal').modal('hide');

    $.ajax({
        url: '/updatepeopledata',
        method: 'POST',
        data: { 
          _token: $('meta[name="csrf-token"]').attr('content'),
          crewboss: crewboss,
          mincrew: inputValue
         },
        dataType: 'json',
        success: function(response) {
              $('#minCrewLow').text(response.mincrew);
              toastr.success('People updated successfully!');

        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
});

$('#maxModalData').on('click', function() {
  var selectedCrew = $('#increpeople').val();
  var crewboss = $('#crewboss').val();
    $('#maxpeopleModal').modal('hide');

    $.ajax({
        url: '/newcrew',
        method: 'POST',
        data: { 
          _token: $('meta[name="csrf-token"]').attr('content'),
          crewboss: crewboss,
          selectcrew: selectedCrew
         },
        dataType: 'json',
        success: function(response) {
          $('#maxCrewHigh').text(response.crewboss_wage_high);
          toastr.success('People updated successfully!');

        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
});

</script>




@endsection