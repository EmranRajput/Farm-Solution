@extends('dashboard.user_dashboard')

  <link rel="stylesheet" href="https://farmdatasolutions.co/assets/css/styles.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  @section('user')

  <div class="body-wrapper">
  <div class="container-fluid">
    <div class="invoice-inner-part h-100" id="printableArea">
      <div class="invoiceing-box">
        <div class="invoice-header d-flex align-items-center border-bottom p-3">
          <div class="col-md-6 d-flex align-items-center">
            <img src="https://farmdatasolutions.co/assets/images/logos/farm_logo-removebg.png"  style="max-width: 250px;">
          </div>
          <div class="col-md-6 text-end">
            <h4 class="text-uppercase mb-0">Invoice # {{$laboratoryDetail->id }}</h4>
          </div>
        </div>
        <div class="p-3" id="custom-invoice">
          <div class="invoice-123" >
            <div class="row pt-3">
            <div class="col-md-12">
                <div>
                  <address>
                    <h6>&nbsp;From,</h6>
                    <h6 class="fw-bold">&nbsp;Steve Jobs</h6>
                    <p class="ms-1">
                      1108, Clair Street,
                      <br />Massachusetts,
                      <br />Woods Hole - 02543
                    </p>
                  </address>
                </div>
                <div class="text-end">
                  <address>
                    <h6>To,</h6>
                    <h6 class="fw-bold invoice-customer">
                      James Anderson,
                    </h6>
                    <p class="ms-4">
                      455, Shobe Lane,
                      <br />Colorado,
                      <br />Fort
                      Collins - 80524
                    </p>
                    <p class="mt-4 mb-1">
                      <span>Invoice Date :</span>
                      <i class="ti ti-calendar"></i>
                      {{$laboratoryDetail->date }}
                    </p>
                    <p>
                      <span>Due Date :</span>
                      <i class="ti ti-calendar"></i>
                      {{$laboratoryDetail->date }}
                    </p>
                  </address>
                </div>
              </div>
              <div class="col-md-12">
                <div class="table-responsive mt-5">
                  <table class="table table-hover">
                    <thead>
                      <!-- start row -->
                      <tr>
                        <th>Name</th>
                        <th class="text-end">Price</th>
                      </tr>
                      <!-- end row -->
                    </thead>
                    <tbody>
                      <!-- start row -->
                      <tr>
                        <td>Boss Name</td>
                        <td class="text-end">{{$laboratoryDetail->crewuser ? $laboratoryDetail->crewuser->name : ''}}</td>
                      </tr>

                      <tr>
                        <td>Full Time</td>
                        <td class="text-end">{{ $laboratoryDetail->full_time }}</td>
                      </tr>
                    <tr>
                      <td>Boss Amount</td>
                      <td class="text-end">{{ $laboratoryDetail->crewboss_amount }}</td>
                    </tr>
                    @foreach($crewDetail as $crew)
                    <tr>
                      <td>{{ $crew->name }}<span>Crew<span></td>
                      <td class="text-end">{{ $crew->crew_price }}</td>
                    </tr>
                    @endforeach
 
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-12">
                <div class="pull-right mt-4 text-end">
                  <p>Sub - Total amount: $</p>
                  <p>Comission : ${{ $laboratoryDetail->comission }}</p>
                  <hr />
                  <h3>
                    <b>Total :</b> ${{ $laboratoryDetail->total_amount }}
                  </h3>
                </div>
                <div class="clearfix"></div>
                <hr />
                <div class="text-end">
                  <button class="btn bg-danger-subtle text-danger" type="submit">
                    Proceed to payment
                  </button>
                  <button class="btn btn-primary btn-default print-page ms-6" type="button">
                    <span>
                      <i class="ti ti-printer fs-5"></i>
                      Print
                    </span>
                  </button>
                </div>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>

  <script src="https://farmdatasolutions.co/assets/js/apps/invoice.js"></script>
  <script src="https://farmdatasolutions.co/assets/js/apps/jquery.PrintArea.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    $('.print-page').on('click', function () {
      var element = document.getElementById('printableArea');
      var buttonsToHide = $('.text-end button');
      buttonsToHide.hide();

      $('#printableArea').addClass('print-layout-adjustment');
      var options = {
        margin: [0.5, 0.5, 0.5, 0.5], 
        filename: 'invoice.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      };

      html2pdf().from(element).set(options).save().then(function () {
        $('#printableArea').removeClass('print-layout-adjustment');
        buttonsToHide.show();
      });
    });
  });
</script>





@endsection