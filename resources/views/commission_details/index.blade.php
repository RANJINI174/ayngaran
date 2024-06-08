@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Commission Updation</h3>
                               @php
                               $permission = new \App\Models\Permission();
                               $create_check = $permission->checkPermission('commissionupdation.create');
                               @endphp
                               @if($create_check == 1)
                    <a class="btn-primary add_master_btn" href="{{ route('commission_detail_create') }}">Add New</a>
                           @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="commission_detail_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 297.641px;">Project Name</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 279.922px;">Short Name</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 160.719px;">Plan</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 191.859px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @if (isset($commission_details))
                                    @foreach ($commission_details as $val)
                                        <tr class="border-bottom">
                                            <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                            <td>{{ $val->full_name }}</td>
                                            <td>{{ $val->short_name }}</td>
                                            @if ($val->plan == 1)
                                                <td>Plan A</td>
                                            @elseif($val->plan == 2)
                                                <td>Plan B</td>
                                            @else
                                                <td>Plan C</td>
                                            @endif
                                            <td class="">
                                @php
                               $permission = new \App\Models\Permission();
                               $edit_check = $permission->checkPermission('commissionupdation.edit');
                               $delete_check = $permission->checkPermission('commissionupdation.delete');
                               @endphp
                               
                                @if($edit_check == 1)
                                                <a class="btn-primary border-0 me-1"
                                                    href="{{ url('/') }}/commission-detail/{{ $val->project_id }}/{{ $val->plan }}/edit"
                                                    style="padding: 4px; border-radius:5px;">
                                                    <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"
                                                            height="12" viewBox="0 0 19 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                        </svg></i>
                                                </a>
                                    @endif
                                    @if($delete_check == 1)
                                    
                                                <button class="btn-danger border-0 plan_name_{{ $val->project_id }}"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete"
                                                    style="border-radius: 5px;"
                                                    onclick="deletecommissionDetail('{{ $val->project_id }}','{{ $val->plan }}')"><i><svg
                                                            class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                        </svg></i></button>
                                        @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var plot_table = $('#commission_detail_lists').DataTable();
        });

        function deletecommissionDetail(id, del_plan) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Commission Updation?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/commission-details';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        formData.append("del_plan", del_plan);
                        $.ajax({
                            url: "{{ route('commission_detail_destroy', '') }}" + "/" + id,
                            data: formData,
                            type: 'POST',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Commission Updation has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Commission Updation Delete Failed", "Please try again. :)",
                                        "error");
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
