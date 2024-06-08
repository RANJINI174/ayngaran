@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Site Visits</h3>
                                 @php
                               $permission = new \App\Models\Permission();
                               $create_check = $permission->checkPermission('sitevisits.create');
                               @endphp
                               
                               @if($create_check == 1)
                    <a class="btn-primary add_master_btn" href="{{ url('/project_visit_create') }}"><span> <i
                                class="fe fe-plus"></i></span>Add New</a>
                                @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="staff_detail_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Visit No</th>
                                    <th class="bg-transparent border-bottom-0">Visit Date</th>
                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                    <th class="bg-transparent border-bottom-0">Team Name</th>
                                    <th class="bg-transparent border-bottom-0">Marketer Name</th>
                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $i = 1;
                                $project_name = '';
                                @endphp
                                @foreach ($projects as $project)
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <td>
                                            {{ $project->visit_number }}
                                        </td>
                                        
                                            
                                        <td>{{ date('d-m-Y',strtotime($project->visit_date)) }}</td>
                                        <td>
                                            {{ $project->customer_name }}
                                        </td>
                                        <td>
                                            {{ $project->team_name }}
                                        </td>
                                        <td>
                                            {{ $project->name }}
                                        </td>
                                        
                                      
                                        <td>
                                        <?php
                                        $sites = explode(',', $project->project_id);
                                        ?>
                                        
                                        @if(isset($sites))
                                            @php
                                                $totalSites = count($sites);
                                                $count = 0;
                                            @endphp
                                            @foreach($sites as $siteId)
                                                @php
                                                    $project_name = \App\Models\ProjectDetail::where('id', $siteId)->first();
                                                @endphp
                                        
                                                @if(isset($project_name))
                                                    {{ $project_name->short_name }}
                                                    @if(++$count < $totalSites)
                                                        ,
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif


                                        </td>
                                 @php
                                $permission = new \App\Models\Permission();
                               $edit_check = $permission->checkPermission('sitevisits.edit');
                               $print_check = $permission->checkPermission('sitevisits.delete');
                                 @endphp
                                   
                                    <td class="">
                                         @if($edit_check == 1)
                                            <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/project_visit/{{ $project->id }}/edit"
                                                style="padding: 4px; border-radius:5px;">
                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="12"
                                                        viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
                                            </a>
                                            
                                            @endif
                                             @if($print_check == 1)
                                            <button onclick="deleteBooking('{{ $project->id }}')"
                                                class="btn-danger border-0" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete" style="border-radius: 5px;"><i><svg
                                                        class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                        height="12" viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                    </svg></i></button>
                                           @endif
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
                    text: "Confirm to delete this Project Visit?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/project_visit_list';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: "{{ route('project_visit_delete', '') }}" + "/" + id,
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Project Visit has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Project Visit Delete Failed", "Please try again. :)", "error");
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
