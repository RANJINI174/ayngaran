@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    
     <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Site Visit Details</h3>
                   
                </div>
<?php
$team_id = Request::input('team');
$project_id = Request::input('project_id');
 
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
                                    </div><input class="form-control fc-datepicker"  value="{{ $from_date }}" 
                                        type="date" name="from_date" id="from_date">
                                </div>
                             
                            </div>
                            
                             <div class="col-md-2">
                                <label class="form-label">To Date </label>
                                <div class="input-group">
                                   <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="{{ $to_date }}" 
                                        type="date" name="to_date" id="to_date">
                                </div>
                                </div>
                                
                                <div class="col-md-3">
                                <label class="form-label">Team  </label>
                                <div class="input-group">
                                  <!--data-placeholder added by Gowtham.s-->
                                  <select name="team[]" id="team"   class="form-control" data-placeholder="Select Team" style="height:40px !important" multiple>
                                        <option value="">All</option>
                                        @if(isset($team_name))
                                        @foreach($team_name as $team)
                                        <option value="{{ $team->team_name }} " @if(isset($team_id)) @if(in_array($team->team_name, $team_id)) {{ "Selected" }} @endif @endif>{{ $team->team_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                            
                             <div class="col-md-3">
                                <label class="form-label">Project </label>
                                <div class="input-group">
                                    <!--data-placeholder added by Gowtham.s-->
                                   <select name="project_id[]" id="project_id"   class="form-control " data-placeholder="Select Project" style="height:40px !important" multiple>
                                       <option value="">All</option>
                                        @if (isset($projects) && !empty($projects))
                                            @foreach ($projects as $val)
                                                <option value="{{ $val->id }} " @if(isset($project_id)) @if(in_array($val->id,$project_id)) {{ "selected" }} @endif @endif>{{ $val->short_name }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                             
                            </div>
                            
                             <div class="col-md-2 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                            </div>
                            </form>
                            <br><br>
                       <div class="table-responsive export-table">
				 	 <table id="booked-reg-table" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Visit No</th>
                                    <th class="bg-transparent border-bottom-0">Visit Date</th>
                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                    <th class="bg-transparent border-bottom-0">No.of Person</th>
                                    <th class="bg-transparent border-bottom-0">Team</th>
                                    <th class="bg-transparent border-bottom-0">Marketer</th>
                                    <th class="bg-transparent border-bottom-0">Project</th>
                                    <th class="bg-transparent border-bottom-0">Vehicle</th>
                                    <th class="bg-transparent border-bottom-0">Trip Distance</th>
                                    <th class="bg-transparent border-bottom-0">Feedback</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                <?php
                                $i = 1;
                                $otherV = '';
                                $vehicle_name = '';
                               ?>
                                @if(isset($query))
                                @foreach($query as $project)
                               
                               
                                  <tr >
                                        <td > {{ $i++ }} </td>
                                        <td>
                                            {{ $project->visit_number }}
                                        </td>
                                        
                                            
                                        <td>{{ date('d-m-Y',strtotime($project->visit_date)) }}</td>
                                         <td>
                                           {{ $project->customer_name }}
                                        </td>
                                        <td>
                                            {{ $project->no_of_person }}
                                        </td>
                                        <td>
                                            {{ $project->team_name }}
                                        </td>
                                        <td>
                                            {{ $project->name }}
                                        </td>
                                        <td>
                                           {{ $project->company_name }}
                                        </td>
                                        
                                        <?php
                                        //   Vehicle name updated by Gowtham.S
                                        
                                        if (!empty($project->vehicle) && $project->vehicle != null) {
                                            $vehicle = \App\Models\Vehicle::where('id', $project->vehicle)->where('status', 1)->first();
                                            if (!empty($vehicle) && $vehicle != null) {
                                                $vehicle_name = $vehicle->vehicle_name;
                                            } else {
                                                $vehicle_name = '';
                                            }
                                        } else {
                                            $vehicle_name = '';
                                        }

                                        ?>
                                        <td>
                                           {{ $vehicle_name }}
                                        </td>
                                        <td>
                                             {{ $project->distance }}
                                        </td>
                                        <td>
                                             {{ $project->feedback }}
                                        </td>
                                         
                                    
                                    </tr>
                                    <?php
                                    $project_names = [];
                                    ?>
                                    @endforeach
                                @endif
                                  
                            </tbody>
                          
                            <tfoot>
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
                                                 <td>
                                                   </td>
                                                 <td>   
                                                 </td>
                                                 <td> <h6 class="text-end fw-bold text-danger" style="visibility:hidden">PROJECT VISITS </h6></td>
                                                 <td></td>
                                                  <td> </td>
                                                  <td> </td>
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
                                                 <td>
                                                   </td>
                                                 <td>   
                                                 </td>
                                                 <td> </td>
                                                 <td> <h6 class="text-end fw-bold text-danger">PROJECT VISITS </h6></td>
                                                  <td> </td>
                                                  <td> </td>
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
                                                 <td>
                                                    </td>
                                                  <td>  
                                                  </td>
                                                  <td><h6  class="text-left fw-bold text-danger">PERIOD :</h6></td>
                                                  <td><span class="text-primary" style="font-size:13px !important;"> {{ date('d-m-Y',strtotime($from_date)) }} </span> </td>
                                                  <td><span class="text-primary" style="font-size:13px !important;"> {{ date('d-m-Y',strtotime($to_date)) }} </span> </td>
                                                  <td></td>
                                            </tr>
                                            <?php
                                            $total_site_visit = 0;
                                            ?>
                                            @if(isset($team_name))
                                        @foreach($team_name as $team)
                                          <?php
                                          $site_visit_get = \App\Models\ProjectVisit::where('team_name',$team->team_name)
                                                             ->whereBetween('visit_date',[$from_date,$to_date]);
                                           if(isset($project_id))
        
                                             {
                                       foreach($project_id as $word){
                                          $site_visit_get->whereRaw('FIND_IN_SET(?, project_id)', [$word]);
                                          }

                                         }
        
                                          if(isset($team_id))
                                          {
                                              $site_visit_get = $site_visit_get->whereIn('team_name',$team_id);
                                          }
                                          
                                          $site_visit = $site_visit_get->get()->count();
                                          $total_site_visit = $total_site_visit + $site_visit;
                                          ?>
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
                                                 <td>
                                                    </td>
                                                 <td>  
                                                 </td>
                                                 <td>    <h6 class="text-end fw-bold text-danger"> {{ $team->team_name }} </h6></td>
                                                 <td> <span class="text-success"> {{ $site_visit }} </span></td>
                                                  <td> </td>
                                                  <td> </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
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
                                                 <td>
                                                    </td>
                                                 <td>  
                                                 </td>
                                                 <td>    <h6 class="text-end fw-bold text-danger">TOTAL PROJECT VISIT </h6></td>
                                                 <td> <span class="text-success"> {{ $total_site_visit }} </span></td>
                                                  <td> </td>
                                                  <td> </td>
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
