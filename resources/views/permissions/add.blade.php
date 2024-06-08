@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Permission</div>
                </div>
                <div class="card-body">
                    <form id="Add_permission_Form" class="p-3">
                        @csrf
                        @method('POST')
                        <div class="row">
                          <div class="col-md-4">
                              <input type="hidden" id="url" value="{{ route('store_permission') }}">
                                <label class="form-label">Designation <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="user_role" class="form-control SelectBox">
                                        <option value="">Select Designation</option>
                                        @foreach ($user_type as $users)
                                            <option value="{{ $users->id }}">{{ $users->user_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger user_role"></small>
                            </div>
                         
                        </div>
                        @foreach($parent_pages as $parent)
                        <div class="row">
                          <div class="col-md-4">
                                <label class="form-label">{{ $parent->name }}</label>
                          </div>
                         
                        </div>
     
							<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card custom-card">
									<div class="card-body">
									<div class="table-responsive">
											<table class="table  border text-nowrap text-md-nowrap mg-b-0">
												<thead>
													<tr>
														<th>Page Name</th>
														<th>Read</th>
														<th>Create</th>
														<th>Edit</th>
														<th>Delete</th>
													</tr>
												</thead>
												<tbody>
												    <?php
												     $sub_pages = \App\Models\Pages::where('parent_id',$parent->id)->orderby('id','asc')->get();
												     if(isset($sub_pages))
												     {
												         foreach($sub_pages as $sub)
											           {
                                                      $sub_name = str_replace(" ", "", $sub->name);
                                                      $sub_page_name = strtolower($sub_name);
												    ?>
													<tr >
														<td> {{ $sub->name }} </td>
														<td style='display:none' >
													<input type="hidden" class="custom-control-input" name="page_id" value="{{$sub->id}}">
														</td>
														<td>
													<label class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$sub_page_name}}.read">
															<span class="custom-control-label">Read</span>
														</label>
														</td>
														<td><label class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$sub_page_name}}.create" >
															<span class="custom-control-label">create</span>
														</label></td>
														<td><label class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$sub_page_name}}.edit" >
															<span class="custom-control-label">Edit</span>
														</label></td>
														<td><label class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$sub_page_name}}.delete" >
															<span class="custom-control-label">Delete</span>
														</label></td>
													</tr>
													<?php
												         }
												     }
												     
												     ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
                               
                         
                        
                        @endforeach
                        <div class="row">
                            <div class="col-md-4 my-3">
                                <div class="input-group ">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
