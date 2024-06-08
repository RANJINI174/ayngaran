@extends('layouts.app')
@section('content')
    <!-- Suspense Day book -->
    <div class="modal fade" id="SuspenseDayBookModel" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Suspense Day Book</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="suspense_day_book_form">
                        @csrf
                        @method('POST')
                        <div class="row mt- p-2" style="border-radius:5px;">
                            <input type="hidden" name="suspense_id" id="suspense_id" >
                            <input type="hidden" name="account_on" id="account_on" >
                            <input type="hidden" name="old_amount" id="old_amount" >
                            <input type="hidden" name="account_for" id="account_for" >
                            <input type="hidden" id="url" value="{{ route('account-suspense-day-book-store') }}">
                            <div class="col-md-4 mb-2">
                                <?php
                                 $transaction = \App\Models\Account::whereNull('closing_status')->whereNull('is_suspense')->orderBy('voucher_date', 'ASC')->first();  
                                         $current_date = '';
                                    if (isset($transaction)) {
                                        $current_date = $transaction->voucher_date;
                                    } else {
                                        $current_date = date('d-m-Y');
                                    }
                                ?>
                                <label for="" class="form-label mt-0">voucher_date  <span class="text-red">*</span></label>

                                <input type="date" class="form-control" name="voucher_date" id="voucher_date" min="{{$current_date}}" value="{{$current_date}}">
                                <input type="hidden" class="form-control" name="trans_type" id="trans_type"  >
                                <span id="voucher_date_validation" class="text-danger" style="display:none;">voucher_date
                                    Field is Required</span>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="" class="form-label mt-0">Transaction Type  <span class="text-red">*</span></label>
                                <select name="transaction_type" id="transaction_type"
                                    class="form-control SlectBox">
                                    <option value="">Select Transaction Type</option>
                                    <option value="1">Income</option>
                                    <option value="2">Expense</option>
                                </select>
                                <span id="transaction_type_validation" class="text-danger" style="display:none;">Transaction Type
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4 mb-2">
                                 
                                    <label for="" class="form-label mt-0">Main Ledger  <span class="text-red">*</span></label>
                                    <select name="main_ledger" id="main_ledger"
                                    class="form-control SlectBox">
                                    <option value="">Select Main Ledger</option>
                                    @if(isset($main_ledger))
                                    @foreach($main_ledger as $main)
                                    <option value="{{ $main->id }}">{{ $main->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                  <span id="main_ledger_validation" class="text-danger" style="display:none;">Transaction Type
                                    Field is Required</span>
                            </div>
                             <div class="col-md-4 mb-2">
                                 
                                    <label for="" class="form-label mt-0">Sub Ledger  <span class="text-red">*</span></label>
                                    <select name="sub_ledger" id="sub_ledger"
                                    class="form-control SlectBox">
                                    <option value="">Select Sub Ledger</option>
                                    
                                </select>
                                <span id="sub_ledger_validation" class="text-danger" style="display:none;">Sub Ledger
                                    Field is Required</span>
                            </div>
                            <!-- <div class="col-md-4 mb-2">-->
                            <!--      <label for="" class=" form-label mt-0">Purpose  </label>-->
                            <!--     <textarea name="purpose" id="purpose" cols="30" rows="2" class="form-control"></textarea>-->
                            <!--</div>-->
                            <div class="col-md-4 mb-2">
                                <label for="" class=" form-label mt-0">Amount  <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="amount" id="suspense_amount"  placeholder="0.00">
                                <span id="amount_validation" class="text-danger" style="display:none;">Amount
                                    Field is Required</span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="" class="form-label mt-0">TDS %</label>
                                <input type="Text" class="form-control" name="tds" id="tds" placeholder="0.00">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mt-0">RS</label>
                                <input type="text" class="form-control" name="rs" id="rs" placeholder="0.00">
                                <span id="rs_validation" class="text-danger" style="display:none;">RS
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="" class="form-label mt-0">PAN No  </label>
                                <input type="text" class="form-control" name="pan_no" id="pan_no">
                                 <span id="pan_no_validation" class="text-danger" style="display:none;">PAN No
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="" class="form-label">Pay Mode  <span class="text-red">*</span></label>
                                <select name="pay_mode" id="pay_mode"
                                    class="form-control SlectBox">
                                    <option value="">Select Pay Mode</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                    <option value="3">DD</option>
                                    <option value="4">Online Transfer</option>
                                    <option value="5">Cash Deposit</option>
                                </select>
                                <span id="pay_mode_validation" class="text-danger" style="display:none;">Pay Mode
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4" id="cheque_no_div" style="display: none;">
                                <label class="form-label">Cheque No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cheque_no" id="cheque_no" placeholder="Cheque No">
                                </div>
                            </div>
                            <div class="col-md-4" id="cheque_date_div" style="display: none;">
                                <label class="form-label">Cheque Date <span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date" name="cheque_date" id="cheque_date">
                                </div>
                            </div>
                            <div class="col-md-4" id="dd_no_div" style="display:none">
                                <label class="form-label">DD No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="dd_no" id="dd_no" placeholder="DD No">
                                </div>
                            </div>
                            <div class="col-md-4" id="dd_date_div" style="display:none">
                                <label class="form-label">DD Date <span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date" name="dd_date" id="dd_date">
                                </div>
                            </div>
                            <div class="col-md-4" id="online_trans_no_div" style="display:none">
                                <label class="form-label">Online Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="online_trans_no" id="online_trans_no" placeholder="Online Transfer No">
                                </div>
                            </div>
                            <div class="col-md-4" id="online_trans_date_div" style="display:none">
                                <label class="form-label">Online Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date" name="online_trans_date" id="online_trans_date">
                                </div>
                            </div>
                            <div class="col-md-4" id="transfer_no_div" style="display:none">
                                <label class="form-label">Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="transfer_no" id="transfer_no" placeholder="Transfer No">
                                </div>
                            </div>
                            <div class="col-md-4" id="transfer_date_div" style="display:none">
                                <label class="form-label">Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date" name="transfer_date" id="transfer_date">
                                </div>
                            </div>
                            <div class="col-md-4" id="bank_name_div" style="display:none">
                                <label class="form-label">Bank Name </label>
                                <div class="input-group">
                                    <select name="bank_name" id="bank_name" class="form-control SlectBox">
                                        <option value="">Select Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="bank_branch_div" style="display: none;">
                                <label class="form-label">Bank Branch </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch" placeholder="Bank Branch">
                                </div>
                            </div>
                            <div class="col-md-4" id="account_no_div" style="display:none">
                                <label class="form-label">Account No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="account_no" id="account_no" placeholder="Account No">
                                </div>
                            </div>
                            <div class="col-md-4" id="ifsc_code_div" style="display:none">
                                <label class="form-label">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label mt-0">Narration</label>
                                <textarea name="narration" id="narration" cols="30" rows="3" class="form-control"></textarea>
                                <span id="narration_validation" class="text-danger" style="display:none;">Narration
                                    Field is Required</span>
                            </div>
                            <div class="row">
                                <div class="row p-3">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary me-2">Clear</button>
                                </div>
                            </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Suspense Day Book List</h3>
                </div>
                <div class="card-body">
<?php
$from_date = Request::input('from_date');
$to_date=Request::input('to_date');
if($from_date == '')
{
  $transaction = \App\Models\Account::where('is_suspense',1)->whereNull('suspense_status')->orderBy('voucher_date', 'ASC')->first();  
    if (isset($transaction)) {
    $from_date = $transaction->voucher_date;
    } else {
    $from_date = date('d-m-Y');
    }
}
if($to_date == '')
{
    $to_date = date('Y-m-d');
}


?>
 
                                
                    <form  method="get"  autocomplete="off" url ="{{ route('cancel-plots-list') }}">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="form-label">From Date  </label>
                                <div class="input-group">
                                <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"    value="{{ $from_date }}" 
                                        type="date" name="from_date" id="from_date">
                                </div>
                             
                            </div>
                            
                             <div class="col-md-3">
                                <label class="form-label">To Date </label>
                                <div class="input-group">
                                   <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"    value="{{ $to_date }}" 
                                        type="date" name="to_date" id="to_date">
                                </div>
                                </div>
                          
                             <div class="col-md-2 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                            </div>
                            </form>
                            <br><br>
                       <div class="row mt-2 border border-light-subtle" style="border-radius:5px;">
                                <div class="table-responsive export-table">
                        <table id="suspense_table" class="table table-bordered text-nowrap mb-0">
                                <thead class="border text-center">
                                    <tr>
                                        <th class="bg-transparent border-bottom-0 w-5" >S.No</th>
                                        <th class="bg-transparent border-bottom-0">Voucher No</th>
                                        <th class="bg-transparent border-bottom-0">Voucher Date</th>
                                        <th class="bg-transparent border-bottom-0">Transaction Type</th>
                                        <th class="bg-transparent border-bottom-0">Purpose</th>
                                        <th class="bg-transparent border-bottom-0">Contact Name</th>
                                        <th class="bg-transparent border-bottom-0">Mobile</th>
                                        <!--<th class="bg-transparent ">Narration</th>-->
                                        <th class="bg-transparent border-bottom-0">Debit</th>
                                        <th class="bg-transparent border-bottom-0">Credit</th>
                                        <th class="bg-transparent border-bottom-0">Option</th>
                                        <th class="bg-transparent border-bottom-0">Print</th>
                                    </tr>
                                     </thead>
                                     <tbody class="border-bottom">
                                             @php
                                                $i = 1;
                                                $credit = 0;
                                                $debit = 0;
                                                $dedit_total = 0;
                                                $credit_total = 0;
                                                $name = "";
                                                $mobile = "";
                                                
                                            @endphp
                                    @if (isset($accounts))
                                    @foreach ($accounts as $account)
                                    <?php
                                    $get_contact_name = \App\Models\User::where('id',$account->account_for)->first();
                                    if(isset($get_contact_name))
                                    {
                                        $name = $get_contact_name->name;
                                        $mobile = $get_contact_name->mobile_no;
                                    }
                                
                                                        if ($account->transaction_type == 1) {
                                                            $debit = $account->amount;
                                                            $credit = 0;
                                                        } else {
                                                            $credit = $account->amount;
                                                            $debit = 0;
                                                        }
                                                        
                                                if ($account->transaction_type == 1) {
                                                    $trans_type = 'Income';
                                                } else {
                                                    $trans_type = 'Expense';
                                                }
                                       
                                                    
                                    ?>
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td> {{ $account->transaction_no}} </td>
                                        <td> {{ date('d-m-Y',strtotime($account->voucher_date))}} </td>
                                        <td> {{ $trans_type}} </td>
                                        <td> {{ $account->purpose}} </td>
                                        <td> {{ $name }} </td>
                                        <td> {{ $mobile}} </td>
                                        <td> {{ number_format($credit,2) }} </td>
                                        <!--<td>1.00</td>-->
                                        <td> {{ number_format($debit,2) }} </td>
                                        <td><button type="button" class="btn btn-sm btn-primary"
                                                onclick="suspense_clear_day(<?php echo $account->id; ?>,<?php echo $account->account_on; ?>,
                                                <?php echo $account->amount; ?>,<?php echo $account->transaction_type; ?>)">Clear</button></td>

                                        <td>
                                            @php
                                            $permission = new \App\Models\Permission();
                                                $print_check = $permission->checkPermission('suspensedaybooklist.print');
                                            @endphp
                                            @if($print_check == 1) 
                                            <a class="btn-info border-0 me-1 btnprn" href="{{ url('/') }}/account-suspense-day-book/{{ $account->id }}/{{ $from_date }}/{{ $to_date }}/print"
                                                style="padding: 4px;width:30px ; border-radius:5px;">
                                                <i class="fa fa-print" data-bs-toggle="tooltip" title=""
                                                    data-bs-original-title="Print" aria-label="Print"></i>
                                            </a>
                                            @endif
                                           
                                        </td>
                                    </tr>
                                    <?php
                                    $dedit_total = $dedit_total + $debit;
                                    $credit_total = $credit_total + $credit;
                                    ?>
                                    @endforeach
                                    @endif
                                    
                                    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td>  </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td> <h6 class="text-end fw-bold">Total :</h6>  </td>
                                        <td>  </td>
                                        <td> <h6 class="fw-bold">{{ number_format($credit_total,2) }}</h6> </td>
                                         
                                        <td> <h6 class="fw-bold">{{ number_format($dedit_total,2) }}</h6>  </td>
                                        <td> </td>

                                        <td>
                                             
                                           
                                        </td>
                                    </tr>
                                    </tfoot>
                            </table>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
     <!--<tr>-->
     <!--                                   <td colspan="7">-->
     <!--                                       <h6 class="text-end fw-bold">Total :</h6>-->
     <!--                                   </td>-->
     <!--                                   <td>-->
     <!--                                       <h6 class="fw-bold">{{ number_format($credit_total,2) }}</h6>-->
     <!--                                   </td>-->
     <!--                                   <td>-->
     <!--                                       <h6 class="fw-bold">{{ number_format($dedit_total,2) }}</h6>-->
     <!--                                   </td>-->
     <!--                                  <td colspan="2"></td>-->
     <!--                               </tr>-->
@endsection
@section('scripts')
    <script>
     $(document).ready(function() {
            var table = $('#suspense_table').DataTable({
    // buttons:[ "excel","pdf"],
    buttons: [
      {
        extend: 'excelHtml5',
        footer: true,
         exportOptions: {
            columns: 'th:not(:last-child)'
         }
       
      },
      {
        extend: 'pdfHtml5',
        footer: true,
        exportOptions: {
            columns: 'th:not(:last-child)'
         }
      },
     ]
    
}).buttons().container().appendTo("#suspense_table_wrapper .col-md-6:eq(0)");
          });
        function suspense_clear_day(suspense_id,account_on,amount,transaction_type) {
            $("#SuspenseDayBookModel").modal("show");
            $('#suspense_id').val(suspense_id)
            $('#account_on').val(account_on)
            // $('#account_for').val(account_for)
            $('#old_amount').val(amount)
            $('#trans_type').val(transaction_type)
            $('#transaction_type').val(transaction_type).trigger('change').prop('disabled',true);
        }
     
        
    $("#suspense_day_book_form").submit(function (e) {
     e.preventDefault();
    
    
    
     if (
        $("#pay_mode").val() == "" ||
        $("#pay_mode").val() == null
    ) {
        $("#pay_mode")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#pay_mode_validation").css("display", "block");
    } else {
        $("#pay_mode")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#pay_mode_validation").css("display", "none");
    }
    
    // if (
    //     $("#pan_no").val() == "" ||
    //     $("#pan_no").val() == null
    // ) {
    //     $("#pan_no")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#pan_no_validation").css("display", "block");
    // } else {
    //     $("#pan_no")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#pan_no_validation").css("display", "none");
    // }
    
    //  if (
    //     $("#rs").val() == "" ||
    //     $("#rs").val() == null
    // ) {
    //     $("#rs")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#rs_validation").css("display", "block");
    // } else {
    //     $("#rs")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#rs_validation").css("display", "none");
    // }
    
    
    //  if (
    //     $("#tds").val() == "" ||
    //     $("#tds").val() == null
    // ) {
    //     $("#tds")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#tds_validation").css("display", "block");
    // } else {
    //     $("#tds")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#tds_validation").css("display", "none");
    // }
    
     if (
        $("#suspense_amount").val() == "" ||
        $("#suspense_amount").val() == null
    ) {
        $("#suspense_amount")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#amount_validation").css("display", "block");
    } else {
        $("#suspense_amount")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#amount_validation").css("display", "none");
    }
    
     
    
    if (
        $("#sub_ledger").val() == "" ||
        $("#sub_ledger").val() == null
    ) {
        $("#sub_ledger")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#sub_ledger_validation").css("display", "block");
    } else {
        $("#sub_ledger")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#sub_ledger_validation").css("display", "none");
    }
    
    if (
        $("#main_ledger").val() == "" ||
        $("#main_ledger").val() == null
    ) {
        $("#main_ledger")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#main_ledger_validation").css("display", "block");
    } else {
        $("#main_ledger")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#main_ledger_validation").css("display", "none");
    }
    if (
        $("#transaction_type").val() == "" ||
        $("#transaction_type").val() == null
    ) {
        $("#transaction_type")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#transaction_type_validation").css("display", "block");
    } else {
        $("#transaction_type")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#transaction_type_validation").css("display", "none");
    }
   
   if (
        $("#voucher_date").val() == "" ||
        $("#voucher_date").val() == null
    ) {
        $("#voucher_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#voucher_date_validation").css("display", "block");
    } else {
        $("#voucher_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#voucher_date_validation").css("display", "none");
    }
    
    var form = $("#suspense_day_book_form")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/account-suspense-day-book";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#suspense_day_book_form")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                $("#SuspenseDayBookModel").modal("hide");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }
        },
        error: function (xhr) {
            $(".err").html("");
            $.each(xhr.responseJSON.errors, function (key, value) {
                $("." + key).append(
                    '<div class="err text-danger">' + value + "</div>"
                );
            });
        },
    });
    });
  
    </script>
@endsection
