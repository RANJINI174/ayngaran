@extends('layouts.app')
@section('content')

    <!-- PAGE-HEADER -->
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Bookings</h3>
                    @php
                        $permission = new \App\Models\Permission();
                        $create_check = $permission->checkPermission('bookings.create');
                    @endphp
                    @if ($create_check == 1)
                    <a class="btn-primary add_master_btn" href="{{ url('/booking_create') }}"><span> <i
                                class="fe fe-plus"></i></span>Add New</a>
                   @endif
                </div>
<?php

$project_id = Request::input('project_id');
$plot_id=Request::input('plot_id');

?>
                <div class="card-body">
                     <form  method="get"  autocomplete="off" url ="{{ route('payment_list') }}">
                    <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Project  </label>
                                <div class="input-group">
                                    <input type="hidden" id="url" value="{{ route('store-payment') }}">
                                  <select name="project_id" id="payment_project_id" class="form-control SlectBox">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }} " @if($project_id == $pro->id) {{ "selected" }} @endif>{{ $pro->short_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Plots </label>
                                <div class="input-group">
                                   <select name="plot_id" id="payment_plot_id" class="form-control SlectBox">
                                       <option value="">Select Plot No</option>
                                        @if (isset($plots) && !empty($plots))
                                            @foreach ($plots as $plot)
                                                <option value="{{ $plot->id }} " @if($plot_id == $plot->id) {{ "selected" }} @endif>{{ $plot->plot_no }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                             
                            </div>
                             <div class="col-md-4 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                            </div>
                            </form>
                            <br><br>
                    <div class="table-responsive">
                        <table id="staff_detail_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0" style="width:31.9688px !important;">S.no</th>
                                    <th class="bg-transparent border-bottom-0" style="width:300.219px; !important">Project Name</th>
                                    <th class="bg-transparent border-bottom-0" style="width:256.984px !important;">short Name</th>
                                    <th class="bg-transparent border-bottom-0" style="width:134.234px !important;">Plot No</th>
                                    <th class="bg-transparent border-bottom-0" style="width:162.891px !important;">Status</th>
                                     <th class="bg-transparent border-bottom-0" style="width:95.7031px !important;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($booking as $books)
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <td>
                                            {{ $books->full_name }}
                                        </td>
                                        <td>
                                            {{ $books->short_name }}
                                        </td>
                                        <td>
                                            {{ $books->plot_no }}
                                        </td>
                                      
                                       <td class="text-success fs-12 fw-semibold">Booked</td>
                                      
                                        <td class="">
                                            @php
                                                $permission = new \App\Models\Permission();
                                                $edit_check = $permission->checkPermission('bookings.edit');
                                            @endphp
                                            @if($edit_check == 1)
                                            <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/booking/{{ $books->id }}/edit"
                                                style="padding: 4px; border-radius:5px;">
                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="12"
                                                        viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
                                            </a>
                                            
                                          @endif
                                            
                                            @php
                                                $permission = new \App\Models\Permission();
                                                $delete_check = $permission->checkPermission('bookings.delete');
                                            @endphp
                                            @if($delete_check == 1)
                                            
                                            <button onclick="deleteBooking('{{ $books->id }}')"
                                                class="btn-danger border-0" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete" style="border-radius: 5px;"><i><svg
                                                        class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                        height="12" viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                    </svg></i></button>
                                            @endif    
                                            
                                            @php
                                                 $permission = new \App\Models\Permission();
                                                $print_check = $permission->checkPermission('bookings.print');
                                            @endphp
                                            @if($print_check == 1 || Auth::user()->user_type == 'admin')         
                                              <a class="btn-info border-0 me-1 btnprn"
                                                    href="{{ url('/') }}/booking/{{ $books->id }}/print"
                                                    style="padding: 4px;width:30px ; border-radius:5px;">
                                                    <i  class="fa fa-print" data-bs-toggle="tooltip" title="Print"></i> 
                                                </a>
                                            @endif 
                                            
                                            <!-- <a class="btn-success border-0 me-1 " id="btnExport"-->
                                            <!--    href="{{ url('/') }}/booking/{{ $books->id }}/excel"-->
                                            <!--    style="padding: 4px;width:30px ; border-radius:5px;">-->
                                            <!--    <i  class="fa fa-file-excel-o" data-bs-toggle="tooltip" title="Export"></i> -->
                                            <!--</a>-->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div><!-- ROW-5 END -->
    
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#staff_detail_lists').DataTable();
            $('.btnprn').printPage();
            
               $("#btnExport").click(function() {
                   
    //     var contents = $("#print_book").html();
    // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(contents));
        
        // TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
        //   name: `export.xlsx`, // fileName you could use any name
        //   sheet: {
        //       name: 'Sheet 1' // sheetName
        //   }
        // });
    });
        });
        
        
    

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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/plot-booking';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: "{{ route('booking_delete', '') }}" + "/" + id,
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Booking Detail has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Booking Detail Delete Failed", "Please try again. :)", "error");
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
