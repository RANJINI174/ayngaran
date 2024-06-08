@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Marketing Supervisors</h3>
                    @php
                        $permission = new \App\Models\Permission();
                        $create_check = $permission->checkPermission('marketingsupervisors.create');
                    @endphp
                    @if ($create_check == 1)
                    <a class="btn-primary add_master_btn" href="{{ route('marketing_supervisor_create') }}"><span> <i
                                class="fe fe-plus"></i></span>Add New</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="marketing_supervisor_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5" style="width: 31.9688px;">S.no</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 185.922px;">Marketing Supervisor ID</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 205.141px;">Name</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 167.516px;">Mobile No</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 140.484px;">DOB</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 119.672px;">Status</th>
                                    <th class="bg-transparent border-bottom-0" style="width: 120.297px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($marketing_supervisors as $marketing_supervisor)
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <td>{{ $marketing_supervisor->reference_code }}</td>
                                        <td>
                                            {{ $marketing_supervisor->name }}
                                        </td>
                                        <td>
                                            {{ $marketing_supervisor->mobile_no }}
                                        </td>

                                        <td>
                                            {{ date('d-m-Y', strtotime($marketing_supervisor->dob)) }}
                                        </td>
                                        @if ($marketing_supervisor->status == 1)
                                            <td class="text-success fs-12 fw-semibold">Active</td>
                                        @else
                                            <td class="text-danger fs-12 fw-semibold">Inactive</td>
                                        @endif
                                        <td class="">
                                            @php
                                                $permission = new \App\Models\Permission();
                                                $edit_check = $permission->checkPermission('marketingsupervisors.edit');
                                            @endphp
                                            @if($edit_check == 1)
                                            <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/marketing-supervisor/{{ $marketing_supervisor->id }}/edit"
                                                style="padding: 4px; border-radius:5px;">
                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="12"
                                                        viewBox="0 0 19 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
                                            </a>
                                            @endif
                                            
                                            @php
                                                $permission = new \App\Models\Permission();
                                                $delete_check = $permission->checkPermission('marketingsupervisors.delete');
                                            @endphp
                                            @if($delete_check == 1)
                                            <button class="btn-danger border-0" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete" style="border-radius: 5px;"><i><svg
                                                        class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                        height="16" viewBox="0 0 24 24" width="12"
                                                        onclick="deleteOrder('{{ $marketing_supervisor->id }}')">
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
            var table = $('#marketing_supervisor_lists').DataTable();
        });


        function deleteOrder(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Marketing Supervisor?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/marketing-supervisor-lists';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: "{{ route('marketing_supervisor_destroy', '') }}" + "/" + id,
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Marketing Supervisor has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Marketing Supervisor Delete Failed", "Please try again. :)",
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
