@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Directors</h3>
                   @php
                        $permission = new \App\Models\Permission();
                        $create_check = $permission->checkPermission('directors.create');
                    @endphp
                    @if ($create_check == 1)
                    <a class="add_master_btn" href="{{ url('/director-create') }}"><span> <i class="fe fe-plus"></i></span>Add
                        New</a>
                        @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="director_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Director ID</th>
                                    <th class="bg-transparent border-bottom-0">Name</th>
                                    <!--<th class="bg-transparent border-bottom-0">Email</th>-->
                                    <th class="bg-transparent border-bottom-0">Mobile No</th>
                                    <!--<th class="bg-transparent border-bottom-0">Alternate Mobile</th>-->
                                    <!--<th class="bg-transparent border-bottom-0">Address</th>-->
                                    <th class="bg-transparent border-bottom-0">DOB</th>
                                    <th class="bg-transparent border-bottom-0">Status</th>
                                    <!--<th class="bg-transparent border-bottom-0">State</th>-->
                                    <!--<th class="bg-transparent border-bottom-0">Country</th> -->
                                    <!--<th class="bg-transparent border-bottom-0">Pincode</th>-->
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($directors as $director)
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <td>{{ $director->reference_code }}</td>
                                        <td>
                                            {{ $director->name }}
                                        </td>
                                        <!--<td>-->
                                        <!--    {{ $director->email }}-->
                                        <!--</td>-->
                                        <td>
                                            {{ $director->mobile_no }}
                                        </td>
                                        <!--<td>-->
                                        <!--    {{ $director->alternate_mobile }}-->
                                        <!--</td>-->
                                        <!--<td>-->
                                        <!--    {{ $director->address }}-->
                                        <!--</td>-->
                                        <td>
                                            {{ date('d-m-Y', strtotime($director->dob)) }}
                                        </td>
                                         @if ($director->status == 1)
                                            <td class="text-success fs-12 fw-semibold">Active</td>
                                        @else
                                            <td class="text-danger fs-12 fw-semibold">Inactive</td>
                                        @endif
                                       <!--<td>-->
                                       <!--     {{ $director->state_id }}-->
                                       <!-- </td>-->
                                       <!-- <td>-->
                                       <!--     {{ $director->country_id }}-->
                                       <!-- </td> -->
                                       <!-- <td>-->
                                       <!--     {{ $director->pincode }}-->
                                       <!-- </td>-->
                                        <td class="">
                                          @php
                                                $permission = new \App\Models\Permission();
                                                $edit_check = $permission->checkPermission('directors.edit');
                                            @endphp
                                            @if($edit_check == 1)
                                            <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/director/{{ $director->id }}/edit"
                                                style="border-radius: 5px; padding:4px;">
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
                                                $delete_check = $permission->checkPermission('directors.delete');
                                            @endphp
                                            @if($delete_check == 1)
                                            <button class="btn-danger border-0" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete" style="border-radius: 5px;"><i><svg
                                                        class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                        height="16" viewBox="0 0 24 24" width="12"
                                                        onclick="deleteDirector('{{ $director->id }}')">
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
            var table = $('#director_lists').DataTable();
        });


        function deleteDirector(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Director?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/director-lists';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: "{{ route('director_destroy', '') }}" + "/" + id,
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Director has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Director Delete Failed", "Please try again. :)", "error");
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
