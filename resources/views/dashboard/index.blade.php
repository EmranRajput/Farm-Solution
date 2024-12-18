@extends('dashboard.user_dashboard')
<style>
    #map { height: 350px; }
    .table-responsivess {
    max-height: 400px; /* Set a desired max height */
    overflow-y: auto !important;
}

.crewshowing{
  min-height: 400px;
}
</style>
@section('user')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<div class="body-wrapper">
        <div class="container-fluid">
          <div class="d-md-flex align-items-center justify-content-between mb-7">
            <div class="mb-4 mb-md-0">
              <h4 class="fs-6 mb-0">Dashboard</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
                
              </nav>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-6">
              
              <!-- <button class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9">
                <i class="ti ti-plus fs-4"></i>
                Create
              </button> -->
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="card crewshowing">
                <div class="card-body text-center">
                  <h4 class="text-center">Crew</h4>
                  <!-- <div id="unique-visit"></div> -->
                  <div class="table-responsive border rounded-1 table-responsivess">
                    <table class="table table-bordered display">
                      <!-- <thead class="text-dark fs-4">
                        <tr>
                          <th>
                            <h6 class="fs-4 fw-semibold mb-0">User</h6>
                          </th>
                        </tr>
                      </thead> -->
                      <tbody id="clientusername">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <div class="p-2 text-center border-top">
                  <h4 class="fw-medium mb-0">
                    <i class="ti ti-chevron-up text-success"></i> 
                    <span id="totalUserCount">{{ $dashdata['totalUserCount'] }}</span>
                  </h4>
                </div> -->
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="card crewshowing">
                <div class="card-body text-center">
                  <h4 class="text-center">Jobs</h4>
                  <!-- <div id="total_visit"></div> -->
                  <div class="table-responsive border rounded-1 table-responsivess">
                    <table class="table table-bordered display">
                    
                      <tbody id="clientuserjob">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <div class="p-2 text-center border-top">
                  <h4 class="fw-medium mb-0">
                    <i class="ti ti-chevron-down text-danger"></i> 
                    <span id="totalJobsCount">{{ $dashdata['totalJobsCount'] }}</span>
                  </h4>
                </div> -->
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="card crewshowing">
                <div class="card-body text-center">
                  <h4 class="text-center">Location</h4>
                  <!-- <div id="bounce-rate"></div> -->
                  <div class="table-responsive border rounded-1 table-responsivess">
                    <table class="table table-bordered display">
                    
                      <tbody id="clientuserloc">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <div class="p-2 text-center border-top">
                  <h4 class="fw-medium mb-0">
                    <i class="ti ti-chevron-up text-success"></i> 12456
                  </h4>
                </div> -->
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="card crewshowing">
                <div class="card-body text-center">
                  <h4 class="text-center">Cost</h4>
                  <!-- <div id="page_views"></div> -->
                  <div class="table-responsive border rounded-1 table-responsivess">
                    <table class="table table-bordered display">
                    
                      <tbody id="clientuserexp">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <div class="p-2 text-center border-top">
                  <h4 class="fw-medium mb-0">
                    <i class="ti ti-chevron-down text-danger"></i> 
                    <span id="currentMonthcost">{{ $dashdata['cost'] }}</span>
                  </h4>
                </div> -->
              </div>
            </div>

            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <h4 class="card-title">Total Revenue</h4>
                  </div>
                  <div class="table-responsive">
                  <table class="table table-bordered display text-nowrap text-center align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th rowspan="2" colspan="4">
                          <h6 class="fs-4 fw-semibold mb-0" >No</h6>
                        </th>
                        <th colspan="59">
                          <h6 class="fs-4 fw-semibold mb-0" >Labor</h6>
                        </th>
                        <th colspan="34">
                          <h6 class="fs-4 fw-semibold mb-0">Non Labor</h6>
                        </th>
                      </tr>
                        <tr>
                            @foreach($columnGroups['Labor'] as $category => $jobs)
                                <th colspan="{{ count($jobs) }}"><h6 class="fs-4 fw-semibold mb-0">{{ $category }}</h6></th>
                            @endforeach

                            @foreach($columnGroups['Non Labor'] as $category => $expenses)
                                <th colspan="{{ count($expenses) }}"><h6 class="fs-4 fw-semibold mb-0">{{ $category }}</h6></th>
                            @endforeach
                            <th rowspan="2">
                                <h6 class="fs-4 fw-semibold mb-0">Total $ amount</h6>
                            </th>
                            <th rowspan="2">
                                <h6 class="fs-4 fw-semibold mb-0">$/Acre</h6>
                            </th>
                        </tr>

                        <tr>
                            <th>Ranch</th>
                            <th>Block</th>
                            <th>Variety</th>
                            <th>#Acre</th>
                            @foreach($columnGroups['Labor'] as $category => $jobs)
                                @foreach($jobs as $job)
                                    <th><h6 class="fw-semibold mb-0">{{ $job }}</h6></th>
                                @endforeach
                            @endforeach
                            @foreach($columnGroups['Non Labor'] as $category => $eexpenses)
                                @foreach($eexpenses as $eexpense)
                                    <th><h6 class="fw-semibold mb-0">{{ $eexpense }}</h6></th>
                                @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expense->groupBy('ranch_id') as $ranchId => $expenseGroup)
                            @php
                                $firstExpense = $expenseGroup->first();
                                $ranchRowspan = $expenseGroup->count();
                            @endphp

                            @foreach($expenseGroup->groupBy('block_id') as $blockId => $blockGroup)
                                @php
                                    $blockRowspan = $blockGroup->count();
                                    $firstBlockExpense = $blockGroup->first();
                                @endphp

                                @foreach($blockGroup as $index => $expense)
                                    <tr class="data-row">
                                        @if($loop->parent->first && $index === 0)
                                            <td rowspan="{{ $ranchRowspan }}">{{ $firstExpense->ranch->title }}</td>
                                        @endif

                                        @if($index === 0)
                                            <td rowspan="{{ $blockRowspan }}">{{ $firstBlockExpense->block->title }}</td>
                                        @endif
                                        <td></td>
                                        <td class="acre-column editable">{{ $expense->acre_id }}</td>

                                        @php
                                            $totalLabor = 0;
                                            $totalExpenses = 0;
                                        @endphp

                                        @foreach($columnGroups['Labor'] as $category => $jobs)
                                            @foreach($jobs as $job)
                                                <td class="editable">{{ $expense[str_replace(' ', '_', strtolower($job))] ?? Null }}</td>
                                                @php $totalLabor += $expense[str_replace(' ', '_', strtolower($job))] ?? Null; @endphp
                                            @endforeach
                                        @endforeach

                                        @foreach($columnGroups['Non Labor'] as $category => $nonLaborExpenses)
                                            @foreach($nonLaborExpenses as $nonLabor)
                                                <td class="editable">{{ $expense[str_replace(' ', '_', strtolower($nonLabor))] ?? Null }}</td>
                                                @php $totalExpenses += $expense[str_replace(' ', '_', strtolower($nonLabor))] ?? Null; @endphp
                                            @endforeach
                                        @endforeach

                                        <td class="row-total editable">{{ $totalLabor + $totalExpenses }}</td>
                                        <td class="per-acre-total editable">
                                            {{ $expense->acre_id > 0 ? number_format(($totalLabor + $totalExpenses) / $expense->acre_id, 2) : 0 }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td class="column-total" id="totalAmountDisplay"></td>

                            @php
                                // Initialize an array to store column totals
                                $columnTotals = [];
                            @endphp

                            @foreach($columnGroups['Labor'] as $category => $jobs)
                                @foreach($jobs as $job)
                                    @php
                                        // Calculate the total for each column dynamically
                                        $columnTotal = array_sum(array_map(fn($expense) => $expense['labor'][$job] ?? 0, $expenses));
                                        $columnTotals[] = $columnTotal;
                                    @endphp
                                    <td class="column-total">${{ number_format($columnTotal, 2) }}</td>
                                @endforeach
                            @endforeach
                            @foreach($columnGroups['Non Labor'] as $category => $expenseItems)
                                @foreach($expenseItems as $expenseKey)
                                    @php
                                        $columnTotal = array_sum(array_map(fn($item) => $item['expenses'][$expenseKey] ?? 0, $expenses));
                                        $columnTotals[] = $columnTotal;
                                    @endphp
                                    <td class="column-total">${{ number_format($columnTotal, 2) }}</td>
                                @endforeach
                            @endforeach
                            <td class="column-total"><strong>${{ number_format(array_sum($columnTotals), 2) }}</strong></td>
                            <td class="column-total">$/Acre (calculation)</td>
                        </tr>
                    </tfoot>
                  </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-lg-4">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-6 col-lg-6 col-xl-7">
                          <h4 class="card-title mb-5">Total expire</h4>
                          <div>
                            <h2 class="fs-9 fw-light" id="totalExpiredCount">{{ $dashdata['totalExpiredCount'] }}</h2>
                          </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-5">
                          <div id="sales-prediction"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-6 col-lg-6 col-xl-7">
                          <h4 class="card-title mb-5">Expenses</h4>
                          <div>
                            <h2 class="fs-9 fw-light">{{ $dashdata['Expense'] }}</h2>
                          </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-5">
                          <div id="sales-difference"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Stats</h4>
                  <div id="map"></div>
                </div>
              </div>
            </div> -->
            <!-- <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Browser Stats</h4>
                  <ul class="list-unstyled mb-0">
                    <li class="hstack justify-content-between mb-7">
                      <div class="hstack gap-6">
                        <img src="../assets/images/browser/chrome-logo.png" class="img-fluid rounded-circle flex-shrink-0" alt="" width="30" height="30">
                        <h5 class="mb-0 fw-medium">Google Chrome</h5>
                      </div>
                      <span class="badge bg-primary-subtle text-primary rounded-pill">23%</span>
                    </li>
                    <li class="hstack justify-content-between mb-7">
                      <div class="hstack gap-6">
                        <img src="../assets/images/browser/firefox-logo.png" class="img-fluid rounded-circle flex-shrink-0" alt="" width="30" height="30">
                        <h5 class="mb-0 fw-medium">Mozila Firefox</h5>
                      </div>
                      <span class="badge bg-success-subtle text-success rounded-pill">15%</span>
                    </li>
                    <li class="hstack justify-content-between mb-7">
                      <div class="hstack gap-6">
                        <img src="../assets/images/browser/safari-logo.png" class="img-fluid rounded-circle flex-shrink-0" alt="" width="30" height="30">
                        <h5 class="mb-0 fw-medium">Apple Safari</h5>
                      </div>
                      <span class="badge bg-secondary-subtle text-secondary rounded-pill">07%</span>
                    </li>
                    <li class="hstack justify-content-between mb-7">
                      <div class="hstack gap-6">
                        <img src="../assets/images/browser/internet-logo.png" class="img-fluid rounded-circle flex-shrink-0" alt="" width="30" height="30">
                        <h5 class="mb-0 fw-medium">Internet Explorer</h5>
                      </div>
                      <span class="badge bg-warning-subtle text-warning rounded-pill">09%</span>
                    </li>
                    <li class="hstack justify-content-between mb-7">
                      <div class="hstack gap-6">
                        <img src="../assets/images/browser/opera-logo.png" class="img-fluid rounded-circle flex-shrink-0" alt="" width="30" height="30">
                        <h5 class="mb-0 fw-medium">Opera mini</h5>
                      </div>
                      <span class="badge bg-danger-subtle text-danger rounded-pill">23%</span>
                    </li>
                    <li class="hstack justify-content-between">
                      <div class="hstack gap-6">
                        <img src="../assets/images/browser/internet-logo.png" class="img-fluid rounded-circle flex-shrink-0" alt="" width="30" height="30">
                        <h5 class="mb-0 fw-medium">Microsoft edge </h5>
                      </div>
                      <span class="badge bg-primary-subtle text-primary rounded-pill">09%</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div> -->

            <!-- <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="h-600" data-simplebar>
                    <div class="p-4 calender-sidebar app-calendar">
                      <div id="calendar"></div>
                    </div>
                  </div>
                  <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="eventModalLabel">
                            Add / Edit Event
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div>
                                <label class="form-label">Event Title</label>
                                <input id="event-title" type="text" class="form-control" />
                              </div>
                            </div>
                            <div class="col-md-12 mt-4">
                              <div>
                                <label class="form-label">Event Color</label>
                              </div>
                              <div class="d-flex">
                                <div class="n-chk">
                                  <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input" type="radio" name="event-level" value="Danger" id="modalDanger" />
                                    <label class="form-check-label" for="modalDanger">Danger</label>
                                  </div>
                                </div>
                                <div class="n-chk">
                                  <div class="form-check form-check-warning form-check-inline">
                                    <input class="form-check-input" type="radio" name="event-level" value="Success" id="modalSuccess" />
                                    <label class="form-check-label" for="modalSuccess">Success</label>
                                  </div>
                                </div>
                                <div class="n-chk">
                                  <div class="form-check form-check-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="event-level" value="Primary" id="modalPrimary" />
                                    <label class="form-check-label" for="modalPrimary">Primary</label>
                                  </div>
                                </div>
                                <div class="n-chk">
                                  <div class="form-check form-check-danger form-check-inline">
                                    <input class="form-check-input" type="radio" name="event-level" value="Warning" id="modalWarning" />
                                    <label class="form-check-label" for="modalWarning">Warning</label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 d-none">
                              <div>
                                <label class="form-label">Enter Start Date</label>
                                <input id="event-start-date" type="text" class="form-control" />
                              </div>
                            </div>

                            <div class="col-md-12 d-none">
                              <div>
                                <label class="form-label">Enter End Date</label>
                                <input id="event-end-date" type="text" class="form-control" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn" data-bs-dismiss="modal">
                            Close
                          </button>
                          <button type="button" class="btn btn-success btn-update-event" data-fc-event-public-id="">
                            Update changes
                          </button>
                          <button type="button" class="btn btn-primary btn-add-event">
                            Add Event
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- <div class="col-lg-6">
              <div class="card">
                <div class="card-body border-bottom">
                  <h4 class="card-title">Customer Support</h4>
                  <p class="card-subtitle fw-normal mb-0">24 new support ticket request generate</p>
                </div>
                <div class="card-body">
                  <div class="chat-box w-100 h-390" data-simplebar>
                    <ul class="chat-list m-0 p-0">
                      <li class="pb-9 border-bottom">
                        <div class="chat-img d-inline-block align-top">
                          <img src="../assets/images/profile/user-5.jpg" alt="user" class="rounded-circle" />
                        </div>
                        <div class="chat-content ps-6 d-inline-block">
                          <h6 class="text-muted text-nowrap fw-medium">James Anderson</h6>
                          <div class="box d-inline-block message fs-3 bg-secondary-subtle">
                            <h6 class="mb-2 fw-medium">It’s Great opportunity to work. I would loveto join the team. 🎉
                            </h6>
                            <h6 class="chat-time text-end mb-0 fw-medium d-block w-100">
                              10:56 am
                            </h6>
                          </div>
                        </div>
                      </li>
                      <li class="py-9 border-bottom">
                        <div class="chat-img d-inline-block align-top">
                          <img src="../assets/images/profile/user-7.jpg" alt="user" class="rounded-circle" />
                        </div>
                        <div class="chat-content ps-6 d-inline-block">
                          <h6 class="text-muted text-nowrap fw-medium">Hritik Roshan</h6>
                          <div class="box d-inline-block message fs-3 bg-warning-subtle">
                            <h6 class="mb-2 fw-medium">Sed sed eros quis libero 😆Well we have good budget for the
                              project</h6>
                            <h6 class="chat-time text-end mb-0 fw-medium d-block w-100">
                              10:56 am
                            </h6>
                          </div>
                        </div>
                      </li>
                      <li class="py-9 border-bottom text-end">
                        <div class="chat-content ps-6 d-inline-block">
                          <div class="box d-inline-block message fs-3 bg-info-subtle">
                            <h6 class="mb-2 fw-medium">Whats budget of the new project. Looking forward to hear back
                            </h6>
                            <h6 class="chat-time text-end mb-0 fw-medium d-block w-100">
                              10:58 am
                            </h6>
                          </div>
                        </div>
                      </li>
                      <li class="pt-9">
                        <div class="chat-img d-inline-block align-top">
                          <img src="../assets/images/profile/user-7.jpg" alt="user" class="rounded-circle" />
                        </div>
                        <div class="chat-content ps-6 d-inline-block">
                          <h6 class="text-muted text-nowrap fw-medium">Sonu Nigam</h6>
                          <div class="box d-inline-block message fs-3 bg-success-subtle">
                            <h6 class="mb-2 fw-medium">Sed sed eros quis libero Well we have good budget for the project
                            </h6>
                            <h6 class="chat-time text-end m-0 fw-medium d-block w-100">
                              11:00 am
                            </h6>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="card-body border-top">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-6 w-85">
                      <a class="position-relative" href="javascript:void(0)">
                        <i class="ti ti-paperclip fs-6"></i>
                      </a>
                      <input type="text" class="bg-transparent form-control fw-medium text-muted border-0 p-0 shadow-none" placeholder="Write a message">
                    </div>
                    <ul class="list-unstyled mb-0 d-flex align-items-center gap-6">
                      <li>
                        <a class="fs-6" href="javascript:void(0)">
                          <i class="ti ti-mood-smile"></i>
                        </a>
                      </li>
                      <li>
                        <a class="fs-6" href="javascript:void(0)">
                          <i class="ti ti-microphone"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div> -->
            <!-- <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-0">Recent Messages</h4>
                </div>
                <div class="message-box h-545" data-simplebar>
                  <div class="message-widget message-scroll">
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-10.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Mathew Anderson</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">Just see the my new admin!</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-2.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Bianca Anderson</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">Just a reminder that you have
                          event</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-3.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Andrew Johnson</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">You can customize this template as you
                          want</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-4.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Mark Strokes</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">Just see the my new admin!</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-5.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Mark, Stoinus & Rishvi..</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">Just a reminder that you have
                          event</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-6.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Daniel Kristeen</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">Just see the my new admin!</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-7.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Emma Smith</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">Just a reminder that you have
                          event</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-8.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Olivia Johnson</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">You can customize this template as you
                          want</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center border-bottom gap-3 p-3">
                      <span class="round-48 user-img position-relative d-block flex-shrink-0">
                        <img src="../assets/images/profile/user-9.jpg" alt="user" class="rounded-circle w-100" />
                        <span class="profile-status bg-success position-absolute rounded-circle"></span>
                      </span>
                      <div class="w-100 d-inline-block v-middle">
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="mb-1 lh-base">Isabella Williams</h6>
                          <span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
                        </div>
                        <span class="fs-2 d-block text-truncate text-body-color">Just see the my new admin!</span>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div> -->

          </div>
        </div>
      </div>


<!-- Modal -->
<div class="modal fade" id="selectPopup" tabindex="-1" aria-labelledby="selectPopupLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectPopupLabel">Select Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="clientSelect" class="form-select">
          <!-- Options will be populated here dynamically -->
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveClientButton">Save</button>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
var ranches = @json($ranches);
    var initialLat, initialLng;

    if (ranches.length > 0 && ranches[0].lat && ranches[0].lng) {
        initialLat = ranches[0].lat; 
        initialLng = ranches[0].lng; 
    } else {
        initialLat = 37.7749; 
        initialLng = -122.4194; 
    }
    
    var map = L.map('map').setView([initialLat, initialLng], 13);

    // Satellite and street layers
    var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Farm Data Solutions'
    }).addTo(map); // Set satellite as the default by adding it here

    var streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://farmdatasolutions.co/">Farm Data Solutions</a> contributors'
    });

    // Layer control to switch between map and satellite views
    L.control.layers({
        "Streets": streets,
        "Satellite": satellite
    }).addTo(map);

    // Iterate through ranches
    ranches.forEach(function(ranch) {
        if (ranch && ranch.lat && ranch.lng) {
            // Add a marker for each ranch
            var ranchMarker = L.marker([ranch.lat, ranch.lng]).addTo(map)
                .bindPopup(`<b>${ranch.title}</b>`);

            // Iterate through blocks within each ranch
            ranch.blocks.forEach(function(block) {
                if (block.lat && block.lng) {
                    // Add a marker for each block within the ranch
                    var blockMarker = L.marker([block.lat, block.lng]).addTo(map)
                        .bindPopup(`<b>Block: ${block.title}<br>Acre Size: ${block.size}</b>`);

                    // Iterate through acres within each block
                    block.acres.forEach(function(acre) {
                        if (acre.lat && acre.lng) {
                            // Add a marker for each acre within the block
                            L.marker([acre.lat, acre.lng]).addTo(map)
                                .bindPopup(`<b>Acre Location</b>`);
                        }
                    });
                }
            });
        }
    });

   
</script>



<script>

  var allCrewData = @json($dashdata['allcrew']);
  var percentageArray = @json($dashdata['percentageArray']);
  //var monthlyCosts = @json($dashdata['monthlyCosts']);

  var user_role = {{ session('user_role') }};
  var modal_shown = {{ session('modal_shown') }};
  
  
  $(document).ready(function() {

    

    renderChart(@json($dashdata['monthlyCosts']));
    
    $('#selectMonth, #selectYear, #selectWeek').on('change', function() {
        var selectedMonth = $('#selectMonth').val();
        var selectedYear = $('#selectYear').val();
        selectedMonth = selectedMonth || 0; // If month is not selected, set to 0
        selectedYear = selectedYear || 0;   // If year is not selected, set to 0

        getDataByMonthAndYear(selectedMonth, selectedYear);
    });



    $('#saveClientButton').on('click', function() {
      var selectedClientId = $('#clientSelect').val(); 
      $.ajax({
        url: "/saveClient",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          client_id: selectedClientId
        },
        success: function(response) {
          $('#selectPopup').modal('hide'); 

        },
        error: function(xhr) {
          console.error("Error saving client:", xhr);
        }
      });
    });



  });

  function getDataByMonthAndYear(month, year) {
    $.ajax({
        url: '{{ route("get_mothlydata") }}', 
        type: 'GET',
        data: {
            month: month,
            year: year,
        },
        success: function(response) {
          $('#totalUserCount').text(response.totalUserCount);
          $('#totalJobsCount').text(response.totalJobsCount);
          $('#currentMonthcost').text(response.cost);
        },
        error: function(error) {
            console.error(error);
        }
    });
}

$(document).ready(function() {
    function calculateColumnTotals() {
        let columnTotals = [];

        $('tr.data-row').each(function() {
            $(this).find('.editable').each(function(index) {
                let textValue = $(this).text().replace(/[^0-9.]/g, '');
                let value = parseFloat(textValue) || 0;
                columnTotals[index] = (columnTotals[index] || 0) + value;
            });
        });
        console.log(columnTotals);
        $('.column-total').each(function(index) {
            let total = columnTotals[index] || 0;
            $(this).text(total === 0 ? '$ -' : `$ ${total.toFixed(2)}`);
        });
    }

    function calculateRowTotals() {
        $('tr.data-row').each(function() {
            let rowTotal = 0;
            let acreValue = parseFloat($(this).find('.acre-column').text()) || 0;

            $(this).find('.editable').each(function() {
                let value = parseFloat($(this).text()) || 0;
                rowTotal += value;
            });
            $(this).find('.row-total').text(rowTotal === 0 ? '$ -' : `$ ${rowTotal.toFixed(2)}`);

            let perAcreValue = acreValue > 0 ? rowTotal / acreValue : 0;
           
            $(this).find('.per-acre-total').text(perAcreValue === 0 ? '$ -' : `$ ${perAcreValue.toFixed(2)}`);

        });
    }

    function calculateTotals() {
        calculateRowTotals();
        calculateColumnTotals();
    }

    calculateTotals();

    $(document).on('input', '.editable', function() {
        let rowId = $(this).data('row-id');
        let columnName = $(this).data('column-name');
        let newValue = parseFloat($(this).text()) || 0;

        $.ajax({
            url: '/update-cell',
            method: 'POST',
            data: {
                row_id: rowId,
                column_name: columnName,
                value: newValue
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Database updated successfully');
            },
            error: function(error) {
                console.log('Error updating database:', error);
            }
        });

        calculateTotals();
    });
});

$(document).ready(function() {
    function calculateTotalAmount() {
        let total = 0;
        $(".acre-column").each(function() {
            let amountText = $(this).text().replace(/[^0-9.-]/g, '').trim(); 
            let amount = parseFloat(amountText);

            if (!isNaN(amount)) { 
                total += amount;
            }
        });

        $("#totalAmountDisplay").text(total);
    }

    calculateTotalAmount();
});
</script>



@endsection