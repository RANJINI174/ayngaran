@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Enquires</h3>
                    <a class="add_master_btn" href="{{ route('enquiry_create') }}"><span> <i class="fe fe-plus"></i></span>Add
                        New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="enquiry_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                    <th class="bg-transparent border-bottom-0">Email</th>
                                    <th class="bg-transparent border-bottom-0">Mobile No</th>
                                    {{-- <th class="bg-transparent border-bottom-0">Alternate Mobile</th> --}}
                                    <th class="bg-transparent border-bottom-0">Address</th>
                                    <th class="bg-transparent border-bottom-0">Pincode</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($enquires as $enquiry)
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <td>
                                            {{ $enquiry->customer_name }}
                                        </td>
                                        <td>
                                            {{ $enquiry->email }}
                                        </td>
                                        <td>
                                            {{ $enquiry->mobile }}
                                        </td>
                                        {{-- <td>
                                            {{ $enquiry->alternate_mobile }}
                                        </td> --}}
                                        <td>
                                            {{ $enquiry->address }}
                                        </td>
                                        {{-- <td>
                                            {{ $enquiry->state_id }}
                                        </td>
                                        <td>
                                            {{ $enquiry->country_id }}
                                        </td> --}}
                                        <td>
                                            {{ $enquiry->pincode }}
                                        </td>
                                        <td class="">
                                            <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/enquiry/{{ $enquiry->id }}/edit"
                                                style="border-radius: 5px; padding:4px;">
                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="12"
                                                        viewBox="0 0 19 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
                                            </a>
                                            <button class="btn-danger border-0" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete" style="border-radius: 5px;"><i><svg
                                                        class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                        height="16" viewBox="0 0 24 24" width="12"
                                                        onclick="deleteOrder('{{ $enquiry->id }}')">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                    </svg></i></button>
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
            var table = $('#enquiry_lists').DataTable();
        });


        function deleteOrder(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Enquiry?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/enquiry-lists';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: "{{ route('enquiry_destroy', '') }}" + "/" + id,
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Enquiry has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Enquiry Delete Failed", "Please try again. :)", "error");
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
