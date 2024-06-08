@extends('layouts.app')
@section('content')

    {{-- Add Branch --}}
    <div class="modal fade" id="Add_pageModel">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Page</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="Add_pageForm">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="hidden" name="url" id="url" value="{{ route('pages.store') }}">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Page Name">
                            <div class="text-start text-danger name"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="page_url" name="page_url"
                                placeholder="Page Url">
                            <div class="text-start text-danger page_url"></div>
                        </div>
                        <div class="form-group">
                            <select name="parent_id" id="parent_id" class="form-control form-select">
                                <option value="">Select Parent Page</option>
                                @if(isset($parent_pages))
                                @foreach($parent_pages as $parent)
                                <option value="{{ $parent->id}} ">{{$parent->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <div class="text-start text-danger parent_id"></div>
                        </div>
                        <div class="form-group">
                             <select name="is_parent" id="is_parent"  class="form-control form-select">
                                <option value=''>Select is Parent or Not</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div class="text-start text-danger is_parent"></div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary m-1">Add</button>
                            <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   <div class="modal fade" id="Edit_pageModel">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Page</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="Edit_pageForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="hidden" id="page_id">
                            <input type="text" class="form-control" id="edit_name" name="edit_name"
                                placeholder="Branch Name">
                            <div class="text-start text-danger edit_name"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_page_url" name="edit_page_url"
                                placeholder="Page Url">
                            <div class="text-start text-danger edit_page_url"></div>
                        </div>
                        <div class="form-group">
                            <select name="edit_parent_id" id="edit_parent_id" class="form-control form-select">
                                <option value="">Select Parent Page</option>
                                @if(isset($parent_pages))
                                @foreach($parent_pages as $parent)
                                <option value="{{ $parent->id}}">{{$parent->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <div class="text-start text-danger edit_parent_id"></div>
                        </div>
                        <div class="form-group">
                             <select name="edit_is_parent" id="edit_is_parent"  class="form-control form-select">
                                <option value="">Select is Parent or Not</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div class="text-start text-danger edit_is_parent"></div>
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
               <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Pages</h3>

                    @php
                        $permission = new \App\Models\Permission();
                        $create_check = $permission->checkPermission('pages.create');
                    @endphp
                    @if ($create_check == 1)
                    <button class="modal-effect add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                        href="#Add_pageModel"><span>
                            <i class="fe fe-plus"></i>
                        </span> Add New</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="page_table" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Page Name</th>
                                    <th class="bg-transparent border-bottom-0">Parent Page</th>
                                    <th class="bg-transparent border-bottom-0">Url</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($pages as $page)

                                <?php
                                if(isset($page->parent_id))
                                {
                                $parentpage = \App\Models\Pages::where('id',$page->parent_id)->first();
                                $parent = $parentpage->name;
                                }
                                else
                                {
                                 $parent = 'Parent Page';
                                }

                                ?>

                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <td>
                                            {{ $page->name }}
                                        </td>

                                       <td> {{$parent}} </td>
                                       <td> {{ $page->page_url }} </td>
                                       
                                        <td class="">
                                             @php
                                                $permission = new \App\Models\Permission();
                                                $edit_check = $permission->checkPermission('pages.edit');
                                            @endphp
                                            @if($edit_check == 1)
                                            <button class="bg-primary border-0  me-1" data-bs-effect="effect-fall"
                                                data-bs-toggle="modal" onclick="EditPage({{ $page->id }})"
                                                style="border-radius: 5px;">

                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"
                                                        height="16" viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
                                            </button>
                                            @endif

                                            @php
                                                $permission = new \App\Models\Permission();
                                                $delete_check = $permission->checkPermission('pages.delete');
                                            @endphp
                                            @if($delete_check == 1)
                                            <button class="bg-danger border-0" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete" style="border-radius: 5px;"><i><svg
                                                        class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                        height="16" viewBox="0 0 24 24" width="12"
                                                        onclick="deletePage('{{ $page->id }}')">
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
            var table = $('#page_table').DataTable();

             $("#parent_id").select2({
                width: "100%",
            });
            $("#is_parent").select2({
                width: "100%",
            });
             $("#edit_parent_id").select2({
                width: "100%",
            });
            $("#edit_is_parent").select2({
                width: "100%",
            });
        });

        // edit branch
        function EditPage(id) {

            $('#Edit_pageModel').modal('show');

            $.ajax({
                url: '{{ url('/') }}' + "/pages/" + id + "/edit",
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {

                // $('#edit_parent_id option').filter(function(){
                //   return this.value == res.data.parent_id;
                //     }).prop("selected", true);


                    $("#edit_parent_id").val(res.data.parent_id).trigger("change"); // Updated By Gowtham.s
                    $("#edit_name").val(res.data.name);
                    $("#edit_page_url").val(res.data.page_url);
                    $("#edit_is_parent").val(res.data.is_parent).trigger("change"); // Updated By Gowtham.s
                    $("#page_id").val(res.data.id);
                },
            });
        }

        function deletePage(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Page?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/pages';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: '{{ url('/') }}' + "/pages/" + id + "/delete",
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Page has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Page Delete Failed", "Please try again. :)", "error");
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
