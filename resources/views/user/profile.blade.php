@extends('dashboard.user_dashboard')
@section('user')

      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">User Profile</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="../main/index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="card overflow-hidden">
            <div class="card-body p-0">
              <img src="../assets/images/backgrounds/profilebg.jpg" alt="monster-img" class="img-fluid">
              <div class="row align-items-center">
                <div class="col-lg-4 order-lg-1 order-2">
                  <div class="d-flex align-items-center justify-content-around m-4">
                    <div class="text-center">
                      <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                      <h4 class="mb-0 fw-semibold lh-1">938</h4>
                      <p class="mb-0 ">Posts</p>
                    </div>
                    <div class="text-center">
                      <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                      <h4 class="mb-0 fw-semibold lh-1">3,586</h4>
                      <p class="mb-0 ">Followers</p>
                    </div>
                    <div class="text-center">
                      <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                      <h4 class="mb-0 fw-semibold lh-1">2,659</h4>
                      <p class="mb-0 ">Following</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                  <div class="mt-n5">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                      <div class="d-flex align-items-center justify-content-center round-110">
                        <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                          <img src="../assets/images/profile/user-1.jpg" alt="monster-img" class="w-100 h-100">
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <h5 class="mb-0">{{$user->name}}</h5>
                      <p class="mb-0">{{ $user->role_name }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 order-last">
                  <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-4 gap-3">
                    <li>
                      <a class="d-flex align-items-center justify-content-center btn btn-primary p-2 fs-4 rounded-circle" href="javascript:void(0)" width="30" height="30">
                        <i class="ti ti-brand-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a class="btn btn-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="javascript:void(0)">
                        <i class="ti ti-brand-dribbble"></i>
                      </a>
                    </li>
                    <li>
                      <a class="btn btn-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="javascript:void(0)">
                        <i class="ti ti-brand-youtube"></i>
                      </a>
                    </li>
                    <!-- <li>
                      <button class="btn btn-primary text-nowrap">Add To Story</button>
                    </li> -->
                  </ul>
                </div>
              </div>
              <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active hstack gap-2 rounded-0 fs-12 py-6" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                    <i class="ti ti-user-circle fs-5"></i>
                    <span class="d-none d-md-block">Profile</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false">
                    <i class="ti ti-heart fs-5"></i>
                    <span class="d-none d-md-block">Security</span>
                  </button>
                </li>
              </ul>
            </div>
          </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card shadow-none border">
                    <div class="card-body">
                      <h4 class="mb-3">Introduction</h4>
                      <p class="card-subtitle">Hello, I am {{$user->name}}. I love making websites and graphics. Lorem
                        ipsum dolor sit amet,
                        consectetur adipiscing elit.</p>
                      <div class="vstack gap-3 mt-4">
                        <div class="hstack gap-6">
                          <i class="ti ti-briefcase text-dark fs-6"></i>
                          <h6 class=" mb-0">Sir, P P Institute Of Science</h6>
                        </div>
                        <div class="hstack gap-6">
                          <i class="ti ti-mail text-dark fs-6"></i>
                          <h6 class=" mb-0">{{$user->email}}</h6>
                        </div>
                        <div class="hstack gap-6">
                          <i class="ti ti-device-desktop text-dark fs-6"></i>
                          <h6 class=" mb-0">www.xyz.com</h6>
                        </div>
                        <div class="hstack gap-6">
                          <i class="ti ti-map-pin text-dark fs-6"></i>
                          <h6 class=" mb-0">Newyork, USA - 100001</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <h4 class="card-title mb-3">Edit profile</h4>
                  <form method="POST" action="{{route('update.user')}}">
                  @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                        <input type="hidden" class="form-control" name="user_id" id="tb-id" value="{{$user->id}}"/>
                          <input type="text" class="form-control" name="name" id="tb-name" value="{{$user->name}}"/>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" name="email" id="tb-email" value="{{$user->email}}" />
                        </div>
                      </div>
                      <!-- <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input type="date" class="form-control" name="birthday" id="tb-dob" value="" />
                        </div>
                      </div> -->
                      <div class="col-12">
                        <div class="d-md-flex align-items-center">
                          <div class="ms-auto mt-3 mt-md-0">
                            <button type="submit" class="btn btn-primary hstack gap-6">
                              <i class="ti ti-send fs-4"></i>
                              Submit
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
              <div class="row">
                <div class=" col-md-6 col-xl-4">
                </div>
                <div class=" col-md-6 col-xl-4">
                  <div class="card">
                    <div class="card-body p-4 d-flex align-items-center gap-6 flex-wrap">
                      <img src="../assets/images/profile/2fagoogle.png" alt="monster-img" class="rounded-circle" width="40" height="40">
                      <div>
                        <h5 class="fw-semibold mb-0">2FA Authentication</h5>
                        <span class="fs-2 d-flex align-items-center">
                          <i class="ti ti-auth-2fa text-dark fs-3 me-1"></i>2fa authentication with google app for your scurity purposes
                        </span>
                      </div>
                      @if($user->two_factor_enabled == 1)
                          <button id="disableButton" class="btn btn-outline-danger py-1 px-2 ms-auto">Disable</button>
                      @else
                          <button id="enableButton" class="btn btn-outline-primary py-1 px-2 ms-auto" data-bs-toggle="collapse" data-bs-target="#collapseExample2">Enable</button>
                      @endif
                      
                    </div>
                  </div>
                </div>
                <div class=" col-md-6 col-xl-4">
                </div>
                <div class=" col-md-6 col-xl-4">
                </div>
                <div class=" col-md-6 col-xl-4">
                  <div class="collapse" id="collapseExample2">
                      <div class="card">
                        <div class="card-body p-4 d-flex align-items-center gap-6 flex-wrap">
                            <h3 class="align-items-center">Scan this QR code with your Google Authenticator app:</h3>
                            <img src="" id="qrCodeImage" alt="QR Code" class="img-fluid">
                            <form action="{{ route('2fa-enable') }}" method="post">
                            @csrf
                              <lable>Enter the Code below and Save</lable>
                              <input name="otpcode" type="number" placeholder="Code on App here....">
                              <button class="btn btn-success" type="submit">Save</button>
                            </form>
                        </div>
                      </div>
                  </div>
                </div>
                <div class=" col-md-6 col-xl-4">
                </div>
                <div class=" col-md-6 col-xl-4">
                </div>
                <div class=" col-md-6 col-xl-4">
                  <div class="card">
                    <div class="card-body p-4 d-flex align-items-center gap-6 flex-wrap">
                      <img src="../assets/images/profile/mobileotp.png" alt="monster-img" class="rounded-circle" width="40" height="40">
                      <div>
                        <h5 class="fw-semibold mb-0">OTP Varification</h5>
                        <span class="fs-2 d-flex align-items-center">
                          <i class="ti ti-phone text-dark fs-3 me-1"></i>Mobile OTP Varification for Secured Login
                        </span>
                      </div>
                      <button class="btn btn-primary py-1 px-2 ms-auto" data-bs-toggle="collapse" data-bs-target="#collapseExample2">Enable</button>
                    </div>
                  </div>
                </div>
                <div class=" col-md-6 col-xl-4">
                </div>
              </div>
            </div>
    
          </div>
        </div>
      </div>
     
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script>
          $(document).ready(function() {
              $('#enableButton').click(function() {
                alert
                  $.ajax({
                      url: '/2fa-setup', // URL to your TwoFactorController@showSetupForm route
                      type: 'GET',
                      success: function(response) {
                          // Replace the QR code image with the newly generated QR code
                          // alert(response.qrCodeUrl);
                          $('#qrCodeImage').attr('src', response.qrCodeUrl);
                          
                          // Hide the enable button and show the QR code section
                          $('#enableButton').hide();
                          $('#qrCodeSection').collapse('show');
                      },
                      error: function() {
                          alert('Failed to enable 2FA. Please try again.');
                      }
                  });
              });
            });


      </script>


@endsection