@extends('dashboard.user_dashboard')
@section('user')

<link rel="stylesheet" href="https://farmdatasolutions.co/assets/images/logos/favicone.png">
<link rel="stylesheet" href="https://farmdatasolutions.co/assets/css/styles.css">

<link rel="stylesheet" href="{{ asset('assets/css/plugins/chosen/docsupport/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/chosen/docsupport/prism.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/chosen/chosen.css') }}">


<div class="body-wrapper">
  <div class="container-fluid">
    <div class="d-md-flex align-items-center justify-content-between mb-7">
      <div class="mb-4 mb-md-0">
        <h4 class="fs-6 mb-0">User</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="../main/index.html">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Users</li>
          </ol>
        </nav>
      </div>
        <div class="d-flex align-items-center justify-content-between gap-6">
          <a class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" href="{{route('user.list')}}" id="get-url" aria-expanded="false">
          Users
          </a>
        </div>
      </div>
          <div class="col-12">
            <div class="card">
              <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Edit User</h4>
              </div>
              <div class="card-body p-4 border-bottom">
                <h5 class="fs-4 fw-semibold mb-4">Account Details</h5>
                <form action="{{route('user.register')}}" method="POST">
                  @csrf
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label for="exampleInputtext3" class="form-label">Name</label>
                          <input type="text" class="form-control" id="exampleInputtext3" name="name" value="{{ $user->name }}">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label class="form-label">Email</label>
                          <div class="input-group">
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label class="form-label">Role</label>
                          <select class="form-select" name="role" id="role-select" aria-label="Default select example">
                          <option selected>Select Role</option>
                            @foreach($userrole as $role)
                                <option value="{{ $role->id }}" {{ $user->role == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label class="form-label">Birthday</label>
                          <div class="input-group">
                            <input type="date"  name="birthday" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div id="conditional-checkbox" class="col-lg-12 d-none">
                        <div class="row">
                          <div class="col-lg-6 mb-4">
                            <input type="checkbox" id="extra-options-checkbox" name="boss">
                            <label for="extra-options-checkbox">Boss (optional)</label>
                          </div>
                          <div id="extra-dropdown" class="col-lg-6 d-none">
                              <div class=" mb-4">
                                <h3><a name="labels-work-too" class="anchor" href="#labels-work-too">Select Crew</a></h3>
                                <div class="side-by-side clearfix">
                                  <select name="selectcrew[]" data-placeholder="Select Crew" multiple class="chosen-select form-select" tabindex="18" id="multiple-label-example">
                                  <option>Select Crew</option>
                                    @foreach( $crewrole as $crewroles)
                                      <option value="{{ $crewroles->id }}">{{ $crewroles->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="mb-4">
                                <label class="form-label">Max Allow Crew</label>
                                <div class="input-group">
                                  <input type="number"  name="max_crew" class="form-control" placeholder="">
                                </div>
                              </div>
                              <div class="mb-4">
                                <label class="form-label">Min Allow Crew</label>
                                <div class="input-group">
                                  <input type="number"  name="min_crew" class="form-control" placeholder="">
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label class="form-label">Password</label>
                          <div class="input-group">
                            <input type="password" name="password" class="form-control" value="{{ $user->password }}">
                            <span class="input-group-text px-6" id="basic-addon1">
                              <i class="ti ti-eye fs-6"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-4">
                          <label class="form-label">Confirm Password</label>
                          <div class="input-group">
                            <input type="password" name="confirm-password" class="form-control" value="{{ $user->password }}">
                            <span class="input-group-text px-6" id="basic-addon1">
                              <i class="ti ti-eye fs-6"></i>
                            </span>
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
                  </div>
                </form>
            </div>
          </div>
      </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{ asset('assets/css/plugins/chosen/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/css/plugins/chosen/chosen.jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/css/plugins/chosen/docsupport/prism.js') }}" type="text/javascript" charset="utf-8"></script>
  <script src="{{ asset('assets/css/plugins/chosen/docsupport/init.js') }}" type="text/javascript" charset="utf-8"></script>


<script>
  $(document).ready(function () {

    const roleSelect = $('#role-select');
    const conditionalCheckbox = $('#conditional-checkbox');
    const extraDropdown = $('#extra-dropdown');
    const extraOptionsCheckbox = $('#extra-options-checkbox');

    roleSelect.on('change', function () {
      if (roleSelect.val() === '5') { // Replace 'SPECIFIC_ROLE_ID' with the actual role ID
        conditionalCheckbox.removeClass('d-none');
      } else {
        conditionalCheckbox.addClass('d-none');
        extraDropdown.addClass('d-none');
      }
    });

    extraOptionsCheckbox.on('change', function () {
      if (extraOptionsCheckbox.is(':checked')) {
        extraDropdown.removeClass('d-none');
      } else {
        extraDropdown.addClass('d-none');
      }
    });
  });
</script>




@endsection