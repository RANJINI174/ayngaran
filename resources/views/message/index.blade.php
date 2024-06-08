@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Message Template </div>
                </div>
                <div class="card-body">
                    <form id="Add_Message" class="p-3" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="row">
                             <input type="hidden" id="url" value="{{ route('send-message') }}">
                            
                            
                          <div class="col-md-6">
                                <label class="form-label">Meassage For<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="message_for" id="message_for" class="form-control SlectBox">
                                        <option value="">Select </option>
                                        <option value="1707170961591981365">Holiday Inform</option>
                                        <!--<option value="1707170961586169326">Wedding Anniversary</option>-->
                                        <!--<option value="1707170961581640455">Birthday Message</option>-->
                                        <option value="1707170961875176720">Festival Holiday</option>
                                        <option value="1707170910043447922">Wish</option>
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="message_for_validation">Meassage For Field is Required</span>
                            </div>
                            
                               <div class="col-md-6">
                                <label class="form-label">Meassage To<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="message_to[]" id="message_to" class="form-control SlectBox" multiple>
                                        <option value="">All</option>
                                        @if(isset($designations))
                                        @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="message_to_validation">Meassage To Field is Required</span>
                            </div>
                            
                         
                        </div>
                         <div class="row" >
                             
                             <div class="col-md-6" id="from_date"  style="display:none">
                                <label class="form-label">Holiday From Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="{{ date('Y-m-d') }}"
                                        type="date" name="message_date" id="message_date">
                                </div>
                                <span style="display:none" class="text-danger" id="message_date_validation">Message Date
                                    Field is Required</span>
                            </div>
                            
                            
                          <div class="col-md-6" id="to_date"  style="display:none">
                                 <label class="form-label">Holiday To Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="{{ date('Y-m-d') }}"
                                        type="date" name="message_date_2" id="message_date_2">
                                </div>
                                <span style="display:none" class="text-danger" id="message_date_2_validation">Message Date
                                    Field is Required</span>
                            </div>
                         
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                                <label class="form-label">Message Template<span class="text-red">*</span> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="message" id="message"
                                        placeholder="Message">
                                </div>
                              <span style="display:none;" class="text-danger"
                                    id="message_validation">Meassage Template Field is Required</span>
                            </div>
                            
                     
                       
                        </div>

                    
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2">Send</button>
                                 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
@endsection
@section('scripts')
    <script>
       // Staff Details
$("#Add_Message").submit(function (e) {
    e.preventDefault();
  var message = $("#message").val();
    if (message == "" || message == null) {
        $("#message")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#message_validation").css("display", "block");
    } else {
        $("#message")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#message_validation").css("display", "none");
    }
    
   
    var message_for = $("#message_for").val();
    if (message_for == "" || message_for == null) {
        $("#message_for")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#message_for_validation").css("display", "block");
    } else {
        $("#message_for")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#message_for_validation").css("display", "none");
    }
    
    
    
        if ($("#message_date").val() == "" || $("#message_date").val() == null) {
        $("#message_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#message_date_validation").css("display", "block");
    } else {
        $("#message_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#message_date_validation").css("display", "none");
    }
    
    var form = $("#Add_Message")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/message-template";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_Message")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
              swal("Failed!", data.message,"error"); 
            }
        },
        error: function (xhr) {
            $(".err").html("");
            $.each(xhr.responseJSON.errors, function (key, value) {
                $("." + key).append(
                    '<div class="err text-danger">' + value + "</div>"
                );
            });
        },
    });
});


 $('#message_for').on('change', function() {
          template_value = this.value;
         if(template_value == '1707170961591981365' || template_value == '1707170961875176720')
         {
             $('#from_date').css("display","block")
             $('#to_date').css("display","block")
         }else{
             $('#from_date').css("display","none")
             $('#to_date').css("display","none")
         }
           
          
        });

    </script>
@endsection
