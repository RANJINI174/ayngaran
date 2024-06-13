@extends('layouts.app')
@section('content')
    <div class="modal fade" id="Add_SupplierModel">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Supplier</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                  </div>
                <div class="modal-body">
                    {{-- <form id="Add_supplierForm" autocomplete="off"> --}}
                        <form id="Add_supplierForm" action="{{ route('suppliers.store') }}" method="POST">
                        @csrf
                        {{-- @method('POST') --}}
                        <div class="form-group">
                            {{-- <input type="hidden" id="url" value="{{ route('suppliers.store') }}"> --}}
                            <input type="text" class="form-control" id="suppliername" name="suppliername"
                                placeholder="Supplier Name">
                            <div class="text-start text-danger suppliername"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="supplier_contact_name" name="supplier_contact_name"
                                placeholder="Supplier Contact Name">
                            <div class="text-start text-danger supplier_contact_name"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="address_line_1" name="address_line_1"
                                placeholder="Address Line 1">
                            <div class="text-start text-danger address_line_1"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="address_line_2" name="address_line_2"
                                placeholder="Address Line 2">
                            <div class="text-start text-danger address_line_2"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="address_line_3" name="address_line_3"
                                placeholder="Address line 3">
                            <div class="text-start text-danger address_line_3"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="city" name="city"
                                placeholder="City">
                            <div class="text-start text-danger city"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="state" name="state"
                                placeholder="State">
                            <div class="text-start text-danger state"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="pincode" name="pincode"
                                placeholder="Pincode">
                            <div class="text-start text-danger pincode"></div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="country" name="country"
                                placeholder="Country">
                            <div class="text-start text-danger country"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="gstin" name="gstin"
                                placeholder="GSTIN">
                            <div class="text-start text-danger gstin"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="website" name="website"
                                placeholder="Website">
                            <div class="text-start text-danger website"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Email">
                            <div class="text-start text-danger email"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="mobileno" name="mobileno"
                                placeholder="Mobile No">
                            <div class="text-start text-danger mobileno"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phoneno" name="phoneno"
                                placeholder="Phone No">
                            <div class="text-start text-danger phoneno"></div>
                        </div>

                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div class="text-start text-danger status"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary m-1">Add</button>
                            <!-- <a class="btn btn-light" data-bs-dismiss="modal">Close</a> -->
                            <a class="btn btn-light" onclick="Cancel_Supplier()">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Supplier --}}

    <div class="modal fade" id="Edit_Supplier_Model">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Supplier</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                     <form id="Edit_supplier_Form" autocomplete="off">
                        {{-- <form id="Edit_Supplier_form" action="{{ url('suppliers/update') }}" method="POST"> --}}
                         @csrf
                         @method('PUT')
                        <div class="form-group">
                            <input type="hidden" id="supplier_id">
                            <input type="text" class="form-control" id="edit_suppliername"  name="edit_suppliername"
                                placeholder="SupplierName">
                            <div class="text-start text-danger edit_suppliername"></div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="edit_supplier_contact_name"  name="edit_supplier_contact_name" placeholder="Supplier Contact Name">
                            <div class="text-start text-danger edit_supplier_contact_name"></div>
                        </div>

                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_address_line_1" name="edit_address_line_1"
                                placeholder="Address Line 1">
                            <div class="text-start text-danger edit_address_line_1"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_address_line_2" name="edit_address_line_2"
                                placeholder="Address Line 2">
                            <div class="text-start text-danger edit_address_line_2"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_address_line_3" name="edit_address_line_3"
                                placeholder="Address Line 3">
                            <div class="text-start text-danger edit_address_line_3"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_city" name="edit_city"
                                placeholder="City">
                            <div class="text-start text-danger edit_city"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_state" name="edit_state"
                                placeholder="State">
                            <div class="text-start text-danger edit_state"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_pincode" name="edit_pincode"
                                placeholder="Pincode">
                            <div class="text-start text-danger edit_pincode"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_country" name="edit_country"
                                placeholder="Country">
                            <div class="text-start text-danger edit_country"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_gstin" name="edit_gstin"
                                placeholder="GSTIN">
                            <div class="text-start text-danger edit_gstin"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_website" name="edit_website"
                                placeholder="Website">
                            <div class="text-start text-danger edit_website"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_email" name="edit_email"
                                placeholder="Email">
                            <div class="text-start text-danger edit_email"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_mobileno" name="edit_mobileno"
                                placeholder="MobileNo">
                            <div class="text-start text-danger edit_mobileno"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_phoneno" name="edit_phoneno"
                                placeholder="PhoneNo">
                            <div class="text-start text-danger edit_phoneno"></div>
                        </div>
                        <div class="form-group">
                            <select name="edit_status" id="edit_status" class="form-control form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div class="text-start text-danger edit_status"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary m-1">Update</button>
                            <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-5 -->
    <div class="row row-sm mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header  d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Suppliers</h3>
                    <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                    href="#Add_SupplierModel"><span><i class="fe fe-plus"></i></span> Add New</button>
                    {{-- @php
                        $permission = new \App\Models\Permission();
                        $create_check = $permission->checkPermission('vehicles.create');
                    @endphp
                    @if ($create_check == 1)
                    <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                        href="#Add_SupplierModel"><span>
                            <i class="fe fe-plus"></i>
                        </span> Add New</button>
                    @endif --}}

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="suppliers_table_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">SupplierName</th>
                                    <th class="bg-transparent border-bottom-0">Supplier Contact Name</th>
                                    <th class="bg-transparent border-bottom-0">Address Line 1</th>
                                    <th class="bg-transparent border-bottom-0">Address Line 2</th>
                                    <th class="bg-transparent border-bottom-0">Address Line 3</th>
                                    <th class="bg-transparent border-bottom-0">City</th>
                                    <th class="bg-transparent border-bottom-0">State</th>
                                    <th class="bg-transparent border-bottom-0">Pincode</th>
                                    <th class="bg-transparent border-bottom-0">Country</th>
                                    <th class="bg-transparent border-bottom-0">GSTIN</th>
                                    <th class="bg-transparent border-bottom-0">Website</th>
                                    <th class="bg-transparent border-bottom-0">Email</th>
                                    <th class="bg-transparent border-bottom-0">MobileNo</th>
                                    <th class="bg-transparent border-bottom-0">PhoneNo</th>
                                    <th class="bg-transparent border-bottom-0">Status</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($suppliers))
                                    @php $i = 1; @endphp
                                    @foreach ($suppliers as $supplier)
                                        <tr class="border-bottom">
                                            <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}
                                            </td>
                                            <td>{{ $supplier->suppliername }}</td>
                                            <td> {{$supplier->supplier_contact_name}} </td>
                                            <td> {{ $supplier->address_line_1 }} </td>
                                            <td> {{ $supplier->address_line_2 }} </td>
                                            <td> {{ $supplier->address_line_3 }} </td>
                                            <td> {{ $supplier->city }} </td>
                                            <td> {{ $supplier->state }} </td>
                                            <td> {{ $supplier->pincode }} </td>
                                            <td> {{ $supplier->country }} </td>
                                            <td> {{ $supplier->gstin }} </td>
                                            <td> {{ $supplier->website }} </td>
                                            <td> {{ $supplier->email }} </td>
                                            <td> {{ $supplier->mobileno }} </td>
                                            <td> {{ $supplier->phoneno }} </td>
                                            @if ($supplier->status == 1)
                                                <td class="text-success fs-12 fw-semibold">Active</td>
                                            @else
                                                <td class="text-danger fs-12 fw-semibold">Inactive</td>
                                            @endif
                                            <td class="">
                                             {{-- @php
                                                $permission = new \App\Models\Permission();
                                                $edit_check = $permission->checkPermission('suppliers.edit');
                                            @endphp
                                            @if($edit_check == 1) --}}
                                                <button class="bg-primary border-0 me-1" data-bs-effect="effect-fall"
                                                    data-bs-toggle="modal"
                                                    onclick="return EditSupplierModel({{ $supplier->id }})"
                                                    style="border-radius: 5px;">

                                                    <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                        </svg></i>
                                                </button>
                                            {{-- @endif --}}

                                            {{-- @php
                                                $permission = new \App\Models\Permission();
                                                $delete_check = $permission->checkPermission('suppliers.delete');
                                            @endphp
                                            @if($delete_check == 1) --}}
                                                <button class="bg-danger border-0" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete" style="border-radius: 5px;"
                                                    onclick="deleteOrder('{{ $supplier->id }}')"><i><svg
                                                            class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                        </svg></i></button>
                                            {{-- @endif --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
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
            var table = $('#suppliers_table_lists').DataTable();
            $("#status").select2({
                width: "100%",
            });
            $("#edit_status").select2({
                width: "100%",
            });
        });
        $('#Add_supplierForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status) {
                            alert('Supplier added successfully!');
                            // Optionally, reload the table or page to show the new data
                            table.ajax.reload(); // Reload the DataTable
                        } else {
                            alert('Failed to add supplier!');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
                    }
                });
            });

        // edit Supplier

        function EditSupplierModel(id) {

            $('#Edit_Supplier_Model').modal('show');

            $.ajax({
                url: '{{ url('/') }}' + "/suppliers/" + id + "/edit",
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {

                    $("#edit_suppliername").val(res.data.suppliername);
                    $("#edit_supplier_contact_name").val(res.data.supplier_contact_name);
                    $("#edit_address_line_1").val(res.data.address_line_1);
                    $("#edit_address_line_2").val(res.data.address_line_2);
                    $("#edit_address_line_3").val(res.data.address_line_3);
                    $("#edit_city").val(res.data.city);
                    $("#edit_state").val(res.data.state);
                    $("#edit_pincode").val(res.data.pincode);
                    $("#edit_country").val(res.data.country);
                    $("#edit_gstin").val(res.data.gstin);
                    $("#edit_website").val(res.data.website);
                    $("#edit_email").val(res.data.email);
                    $("#edit_mobileno").val(res.data.mobileno);
                    $("#edit_phoneno").val(res.data.phoneno);
                    $("#edit_status").val(res.data.status).trigger("change");
                    $("#supplier_id").val(res.data.id);
                },
            });
        }

 // update supplier

$('#Edit_supplier_Form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '{{ url('suppliers') }}/' + $("#supplier_id").val(),
        method: 'PUT',
        data: $(this).serialize(),
        success: function(response) {
            if (response.status) {
                alert('Supplier updated successfully!');
                $('#Edit_Supplier_Model').modal('hide');
                // Optionally, reload the table or update UI as needed
                table.ajax.reload(); // Reload the DataTable
            } else {
                alert('Failed to update supplier!');
            }
        },
        error: function(xhr) {
            alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
        }
    });
});
        function deleteOrder(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Supplier?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/suppliers';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: '{{ url('/') }}' + "/suppliers/" + id + "/delete",
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Supplier has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Supplier Delete Failed", "Please try again. :)",
                                        "error");
                                }
                            }
                        });

                    } else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }

        function Cancel_Supplier() {
            $("#Add_SupplierModel").modal("hide");
            $("#Add_supplierForm")[0].reset();
            $(".err").html("");
        }

        function Cancel_edit_ledger() {
            $("#Edit_Supplier_Model").modal("hide");
            $(".err").html("");
        }
    </script>
@endsection
