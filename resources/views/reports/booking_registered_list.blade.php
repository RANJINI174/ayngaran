@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    
     <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Plot Booking and Registered Details</h3>
                   
                </div>
<?php
 $team_id = Request::input('team');
$project_id = Request::input('project_id');
$plot_id=Request::input('plot_id');
$marketer_id = Request::input('marketer_id');
$from_date = Request::input('from_date');
$to_date=Request::input('to_date');
$status = Request::input('status');
if($from_date == '')
{
    $from_date = date('Y-m-d');
}
if($to_date == '')
{
    $to_date = date('Y-m-d');
}

?>
                <div class="card-body">
                    
                     <form  method="get"  autocomplete="off" url ="{{ route('cancel-plots-list') }}">
                    <div class="row">
                        <div class="col-md-2">
                                <label class="form-label">From Date  </label>
                                <div class="input-group">
                                <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"    value="{{ $from_date }}" 
                                        type="date" name="from_date" id="from_date">
                                </div>
                             
                            </div>
                            
                             <div class="col-md-2">
                                <label class="form-label">To Date </label>
                                <div class="input-group">
                                   <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"    value="{{ $to_date }}" 
                                        type="date" name="to_date" id="to_date">
                                </div>
                                </div>
                            <div class="col-md-2">
                                <label class="form-label">Team  </label>
                                <div class="input-group">
                            
                                  <select name="team[]" id="team"  class="form-control " style="height:40px !important" multiple>
                                        <option value="">All</option>
                                        @if(isset($team_name))
                                        @foreach($team_name as $team)
                                        <option value="{{ $team->team_name }} " @if(isset($team_id)) @if(in_array($team->team_name, $team_id)) {{ "Selected" }} @endif @endif>{{ $team->team_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                            
                             <div class="col-md-2">
                                <label class="form-label">Marketer </label>
                                <div class="input-group">
                                   <select name="marketer_id[]" id="marketer_id"  class="form-control " style="height:40px !important" multiple>
                                       <option value="">All</option>
                                        @if (isset($marketer) && !empty($marketer))
                                            @foreach ($marketer as $val)
                                                <option value="{{ $val->id }} " @if(isset($marketer_id)) @if(in_array($val->id,$marketer_id)) {{ "selected" }} @endif
                                                @endif> {{ $val->name }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                             
                            </div>
                             <div class="col-md-2">
                                <label class="form-label">Project </label>
                                <div class="input-group">
                                   <select name="project_id[]" id="project_id"   class="form-control " style="height:40px !important" multiple>
                                       <option value="">All</option>
                                        @if (isset($projects) && !empty($projects))
                                            @foreach ($projects as $val)
                                                <option value="{{ $val->id }} " @if(isset($project_id)) @if(in_array($val->id,$project_id)) {{ "selected" }} @endif @endif>{{ $val->short_name }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                             
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Status </label>
                                <div class="input-group">
                                 <select name="status" id="status"   class="form-control">
                                        <option value="">All</option>
                                        <option value="1" @if($status == 1) {{ "selected" }} @endif> Booked</option>
                                        <option value="2" @if($status == 2) {{ "selected" }} @endif> Fully Paid</option>
                                        <option value="3" @if($status == 3) {{ "selected" }} @endif>Registered</option>
                                        <option value="4" @if($status == 4) {{ "selected" }} @endif>Cancelled</option>
                                       
                                    </select>
                                </div>
                             
                            </div>
                             <div class="col-md-2 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                                <a class="btn btn-info me-2 btnprn"   href="{{ url('/') }}/plots-booking/{{ $from_date }}/{{ $to_date }}/print" title="Project History Print" style="padding: 4px;width:45px;border-radius:5px;">
                                                Print</a>
                            </div>
                            </div>
                            </form>
                            <br><br>
                       <div class="table-responsive export-table">
				 	 <table id="booked-reg-table" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0">S.no</th>
                                    <th class="bg-transparent border-bottom-0">From Date</th>
                                    <th class="bg-transparent border-bottom-0">To Date</th>
                                    <th class="bg-transparent border-bottom-0">Team</th>
                                    <th class="bg-transparent border-bottom-0">Marketer</th>
                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                    <th class="bg-transparent border-bottom-0">Plot No</th>
                                    <th class="bg-transparent border-bottom-0">Plot Sq.Ft</th>
                                    <th class="bg-transparent border-bottom-0">Status</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                 @php $i = 1; @endphp
                                 @if(isset($query))
                                 <?php
                                 $marketer_name = '';
                                 $fully_paid_status = '';
                                 $status = 'Booked';
                                 ?>
                                @foreach ($query as $books)
                                <?php
                                $get_marketer = \App\Models\User::where('id',$books->marketer_id)->first();
                                if(isset($get_marketer))
                                {
                                    $marketer_name = $get_marketer->name;
                                }
                                
                               
                                if($books->fully_paid_status == 1 && !isset($books->register_status)  && !isset($books->booking_status) )
                                {
                                    $status = "Fully Paid";
                                }
                                
                                 else if($books->register_status == 1 && !isset($books->booking_status))
                                {
                                    $status = "Registered";
                                }
                                  
                                 else if($books->booking_status == 1)
                                {
                                    $status = "Cancelled";
                                }else{
                                     $status = "Booked";
                                }
                                
                                 
                                 
                                 
                                
                                ?>
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center"> {{ $i++ }} </td>
                                        <td>
                                            {{ date('d-m-Y',strtotime($from_date)) }}
                                        </td>
                                         <td>
                                            {{ date('d-m-Y',strtotime($to_date)) }}
                                        </td>
                                         <td>
                                            {{ $books->team_name }}
                                        </td>
                                         <td>
                                            {{ $marketer_name }}
                                        </td>
                                        <td>
                                            {{ $books->short_name }}
                                        </td>
                                        
                                        <td>
                                            {{ $books->plot_no }}
                                        </td>
                                        <td>
                                            {{ $books->plot_sq_ft }}
                                        </td>
                                         <td>
                                            {{ $status }}
                                        </td>
                                      
                                        
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                          
                            <tfoot>
                                          <tr class="text-end">
                                                 <td >
                                                 </td><td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                  <td><h6 class="text-end fw-bold text-danger">Plots Booked </h6></td>
                                                 <td> <span class="text-success"> {{ $booking_count }} </span></td>
                                                  <td> <h6 class="text-end fw-bold text-danger">Sq.Ft Booked  </h6> </td>
                                                  <td> <span class="text-success"> {{ $booking_sqft }} </span></td>
                                                 
                                            </tr>
                                            <tr class="text-end">
                                                <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td><h6 class="text-end fw-bold text-danger">Plots Fully Paid  </h6></td>
                                                 <td> <span class="text-success"> {{ $fully_paid_count }} </span></td>
                                                  <td> <h6 class="text-end fw-bold text-danger">Sq.Ft Fully Paid  </h6> </td>
                                                  <td> <span class="text-success"> {{ $fully_paid_sqft }} </span></td>
                                            </tr>
                                            <tr class="text-end">
                                                <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td>    <h6 class="text-end fw-bold text-danger">Plots Registered  </h6></td>
                                                 <td> <span class="text-success"> {{ $registered_count }} </span></td>
                                                  <td> <h6 class="text-end fw-bold text-danger">Sq.Ft Registered  </h6>   </td>
                                                  <td> <span class="text-success"> {{ $registered_sqft }} </span></td>
                                            </tr>
                                            <tr class="text-end">
                                               <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td>    <h6 class="text-end fw-bold text-danger">Plots Cancelled  </h6></td>
                                                 <td> <span class="text-success"> {{ $cancelled_count }} </span></td>
                                                  <td> <h6 class="text-end fw-bold text-danger">Sq.Ft Cancelled  </h6>  </td>
                                                  <td> <span class="text-success">{{ $cancelled_sqft }} </span></td>
                                            </tr>
                                            <tr class="text-end">
                                               <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td >
                                                 </td>
                                                 <td><h6 class="text-end fw-bold text-danger">Total No.of Plots  </h6></td>
                                                 <td> <span class="text-success"> {{ $total_plots }} </span></td>
                                                  <td> <h6 class="text-end fw-bold text-danger">Total No.of Sq.Ft  </h6>  </td>
                                                  <td> <span class="text-success"> {{ $total_sqft }} </span></td>
                                            </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div><!-- ROW-5 END -->
@endsection
@section('scripts')
<script src="{{ asset('assets/js/table-data.js') }}"></script>
    <script>
    

        $(document).ready(function() {
            var print_check =  $("#print_check").val();
            var table = $('#booked-reg-table').DataTable({
               "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
           "iDisplayLength" : 100,
        buttons: [
      {
        extend: 'excelHtml5',
        footer: true,
        customize: (xlsx, config, dataTable) => {
          let sheet = xlsx.xl.worksheets['sheet1.xml'];
          let footerIndex = $('sheetData row', sheet).length;
          let $footerRows = $('tr', dataTable.footer());
          
           if ($footerRows.length > 1) {
            for (let i = 1; i < $footerRows.length; i++) {
              // Get the current footer row
              let $footerRow = $footerRows[i];

              // Get footer row columns
              let $footerRowCols = $('td', $footerRow);

              // Increment the last row index
              footerIndex++;

              // Create the new header row XML using footerIndex and append it at sheetData
              $('sheetData', sheet).append(`
                <row r="${footerIndex}">
                  ${$footerRowCols.map((index, el) => `
                    <c t="inlineStr" r="${String.fromCharCode(65 + index)}${footerIndex}" s="2">
                      <is>
                        <t xml:space="preserve">${$(el).text()}</t>
                      </is>
                    </c>
                  `).get().join('')}
                </row>
              `);
            }
          }
        }
      },
   
 
      
    ],
    
      });
            
table.buttons().container()
        .appendTo( '#booked-reg-table_wrapper .col-md-6:eq(0)' )

$('#project_id').select2({
    width: '100%', 
    // placeholder: "Select an Option", 
    allowClear: true 
    
});

$('#status').select2({
    width: '100%', 
    // placeholder: "Select an Option", 
    allowClear: true 
    
});


$('#marketer_id').select2({
    width: '100%', 
    // placeholder: "Select an Option", 
    allowClear: true 
    
});

$('#team').select2({
    width: '100%', 
    // placeholder: "Select an Option", 
    allowClear: true 
    
});


        });
        
         function submitForm(elem) {
        //   if (elem.value) {
              elem.form.submit();
        //   }
      }

            function EditPlot(project_id,plot_id) {
            var id = plot_id;
            $('#Edit_plotModal').modal('show');
            $.ajax({
                url: '{{ url('/') }}' + "/get-cancel-plots-list/" + project_id + "/"+ id,
                method: "GET",
                data: {
                    id: id,
                    project_id : project_id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                      var tot = parseFloat(res.plots.market_value_plot_rate - res.paid);
                      
                     $('#gender').text(res.gender);
                     $('#plot_no').text(res.plots.plot_no);
                     $('#plot_sqft').text(res.plots.plot_sq_ft);
                     $('#plot_rate').text(res.plots.market_value_plot_rate);
                     $('#sqft_rate').text(res.plots.market_value_sq_ft);
                     $('#paid').text(res.paid);
                     $('#balance').text(tot);
                     $('#gv_sqft').text(res.guide_line);
                     $('#gv_plot_rate').text(res.plots.guide_line_plot_rate);
                      
                     $('#customer_name').text(res.customer_name);
                     $('#mobile').text(res.mobile);
                     $('#alternate_mobile').text(res.alternate_mobile);
                     $('#address').text(res.address);
                     
                   if (res.marketer.length > 0) {
                     
                      $("#marketer_table tbody").empty();
                      $("#marketer_table tbody").append(res.marketer);
             
                    }else{
                        $("#marketer_table tbody").empty();
                        $('#marketer_table tbody').append('<tr><td colspan=5 style="text-align : center">No Data Found</td></tr>');
                   
                   } 
                   
                   if (res.payment_history.length > 0) {
                     
                     $("#payment_table tbody").empty();
                      $("#payment_table tbody").append(res.payment_history);
             
                    }else{
                        $("#payment_table tbody").empty();
                        $('#payment_table tbody').append('<tr><td colspan=10 style="text-align : center">No Data Found</td></tr>');
                   
                   }   
                   
                },
            });
        }
 
        function deleteBooking(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Booking?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var redirect = $('meta[name="base_url"]').attr('content') + '/part_payment_list';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: "{{ route('part_payment_delete', '') }}" + "/" + id,
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Payment Detail has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Payment Detail Delete Failed", "Please try again. :)", "error");
                                }
                            }
                        });

                    } else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }
    </script>
@endsection
