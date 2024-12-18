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
              <h4 class="fs-6 mb-0">Expense Sheet</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{route('user.dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Expense</li>
                </ol>
              </nav>
            </div>
            <!-- <div class="d-flex align-items-center justify-content-between gap-6">
              <button type="submit" class="btn btn-success d-flex align-items-center gap-1 fs-3 py-2 px-9" id="addLaborButton">
                <i class="ti ti-plus fs-4"></i>
                Add Labor
              </button>
            </div> -->
          </div>
          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom d-flex justify-content-between">
                <h4 class="card-title mb-0">Expense Sheet</h4>
                @if(!empty($clientName))
                    <h4 class="card-title mb-0 text-right clientname">Client Name: {{ $clientName }}</h4>
                @endif
            </div>
            <div class="card-body p-4">
              <div class="mb-4 border rounded-1">
                <div class="table-responsive">
                  <table id="alt_pagination_le" class="table table-bordered display text-nowrap text-center align-middle" aria-describedby="alt_pagination_info">
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
                                        <td class="acre-column">{{ $expense->acre_id }}</td>

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
                                                <td class="editable">{{ $expense[str_replace(' ', '_', strtolower('non_' .$nonLabor))] ?? Null }}</td>
                                                @php $totalExpenses += $expense[str_replace(' ', '_', strtolower('non_' .$nonLabor))] ?? Null; @endphp
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
        </div>
      </div>



<!-- Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:720px;">
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
                                </select> 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="labor_id"  name="labor_id">

                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="entrydate" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="crewboss" class="form-label">Crew Boss</label>
                                <select class="form-select" id="crewboss" name="crewboss" aria-label="Default select example">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="ofpeople" class="form-label"># Of People</label>
                                <select class="form-select" id="ofpeople" name="ofpeople" aria-label="Default select example">
                                    <option> --Select People-- </option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="ranch" class="form-label">Ranch</label>
                                <select class="form-select" id="ranch" name="ranch" aria-label="Default select example">
                                    <option> --Select Ranch-- </option>
                                    
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="block" class="form-label">Block</label>
                                <select class="form-select" id="block" name="blockid" aria-label="Default select example">
                                    <option> --Select Block-- </option>
                                    
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="job" class="form-label">Job Description</label>
                                <select class="form-select" id="job" name="jobid" aria-label="Default select example">
                                    <option> --Select Job-- </option>
                                    
                                </select>                    
                            </div>
                            <div id="amountFields" style="display: none;">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="starttime" class="form-label">Start Time</label>
                                <select class="form-select" id="starttime" name="starttime" aria-label="Default select example">
                                    <option> --Select Time-- </option>
                                    
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="endtime" class="form-label">End Time</label>
                                <select class="form-select" id="endtime" name="endtime" aria-label="Default select example">
                                    <option> --Select Time-- </option>
                                    
                                </select>                    
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="margin: 15px 0 18px 0;">
                            <span style="font-size: 22px;">Additional Info</span>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="binspicked" class="form-label">Bins Picked</label>
                                <select class="form-select" id="binspicked" name="binspicked" aria-label="Default select example">
                                    <option> --Select Value-- </option>
                                    
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="treescompleted" class="form-label">Trees Completed</label>
                                <select class="form-select" id="treescompleted" name="treescompleted" aria-label="Default select example">
                                    <option> --Select Value-- </option>
                                    
                                </select>                    
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="rowscompleted" class="form-label">Rows Completed</label>
                                <select class="form-select" id="rowscompleted" name="rowscompleted" aria-label="Default select example">
                                    <option> --Select Value-- </option>
                                    
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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
