// for Select2
$('.SlectBox').select2({
    width: '100%', 
    // placeholder: "Select an Option", 
    allowClear: true 
    
});

// toggle password
$(".toggle-password").click(function () {
    var passwordInput = $("#password");
    var passwordIcon = $(".toggle-password i");

    if (passwordInput.attr("type") === "password") {
        passwordInput.attr("type", "text");
        passwordIcon.removeClass("fe-eye-off").addClass("fe-eye");
    } else {
        passwordInput.attr("type", "password");
        passwordIcon.removeClass("fe-eye").addClass("fe-eye-off");
    }
});

// print template content

$("#Add_printTemplateForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_printTemplateForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/print-template";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_printTemplateForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                $("#Add_PrintTemplateModel").modal("hide");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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
$("#Edit_printTemplateForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_printTemplateForm")[0];
    var id = $("#print_template_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/print-template/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/print-template";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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

// vehicles

$("#Add_VehicleForm").submit(function (e) {
    e.preventDefault();

    var form = $("#Add_VehicleForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/vehicle";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_VehicleForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                $("#Add_VehicleModel").modal("hide");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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

$("#Edit_Vehicle_Form").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_Vehicle_Form")[0];
    var id = $("#vehicle_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/vehicle/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/vehicle";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                $("#Edit_Vehicle_Model").modal("hide");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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


//User Type
$("#Add_UserTypeForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_UserTypeForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/user-type";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_UserTypeForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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
$("#Edit_UserTypeForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_UserTypeForm")[0];
    var id = $("#user_type_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/user-type/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/user-type";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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
//Directors
$("#Add_directorForm").submit(function (e) {
    e.preventDefault();
    
    
     if($('#dob').val() == '' || $('#dob').val() == null)
    {
      $("#dob").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#dob_validation').css('display','block');  
    }else{
     $("#dob").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#dob_validation').css('display','none'); 
    }
    
    
      if($('#mobile_no').val() == '' || $('#mobile_no').val() == null)
    {
      $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#mobile_no_validation').css('display','block');  
    }else{
     $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#mobile_no_validation').css('display','none'); 
    }
    
     if($('#address').val() == '' || $('#address').val() == null)
    {
      $("#address").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#address_validation').css('display','block');  
    }else{
     $("#address").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#address_validation').css('display','none'); 
    }
    
     if($('#designation_id').val() == '' || $('#designation_id').val() == null)
    {
      $("#designation_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#designation_id_validation').css('display','block');  
    }else{
     $("#designation_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#designation_id_validation').css('display','none'); 
    }
    
     if($('#nominee_mobile').val() == '' || $('#nominee_mobile').val() == null)
    {
      $("#nominee_mobile").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_mobile_validation').css('display','block');  
    }else{
     $("#nominee_mobile").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#nominee_mobile_validation').css('display','none'); 
    }
    
     if($('#relationship').val() == '' || $('#relationship').val() == null)
    {
      $("#relationship").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#relationship_validation').css('display','block');  
    }else{
     $("#relationship").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#relationship_validation').css('display','none'); 
    }
    
     if($('#nominee_name').val() == '' || $('#nominee_name').val() == null)
    {
      $("#nominee_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_name_validation').css('display','block');  
    }else{
     $("#nominee_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#nominee_name_validation').css('display','none'); 
    }
     
     if($('#marrital_status').val() == '' || $('#marrital_status').val() == null)
    {
      $("#marrital_status").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#marrital_status_validation').css('display','block');  
    }else{
     $("#marrital_status").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#marrital_status_validation').css('display','none'); 
    }
    
    if($('#join_date').val() == '' || $('#join_date').val() == null)
    {
      $("#join_date").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#join_date_validation').css('display','block');  
    }else{
     $("#join_date").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#join_date_validation').css('display','none'); 
    }
    
     if($('#branch_id').val() == '' || $('#branch_id').val() == null)
    {
      $("#branch_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#branch_validation').css('display','block');  
    }else{
     $("#branch_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#branch_validation').css('display','none'); 
    }
    
     
     if($('#father_husband_name').val() == '' || $('#father_husband_name').val() == null)
    {
      $("#father_husband_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#father_husband_name_validation').css('display','block');  
    }else{
     $("#father_husband_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#father_husband_name_validation').css('display','none'); 
    }
    if ($("#password").val() == "" || $("#password").val() == null) {
        $("#password")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#password_validation").css("display", "block").addClass("mt-4");
    } else {
        $("#password")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#password_validation").css("display", "none").removeClass("mt-4");
    }

    if ($("#email").val() == "" || $("#email").val() == null) {
        $("#email")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#email_name_validation").css("display", "block");
    } else {
        $("#email")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#email_name_validation").css("display", "none");
    }
     // Team Name
    
    if($('#team_name').val() == '' || $('#team_name').val() == null)
    {
      $("#team_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#team_name_validation').css('display','block');  
    }else{
     $("#team_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#team_name_validation').css('display','none'); 
    }
    
     var name = $('#name').val();
    if(name == '' || name == null)
    {
      $("#name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#name_validation').css('display','block');  
    }else{
     $("#name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#name_validation').css('display','none'); 
    }
 
    
    var form = $("#Add_directorForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/director-lists";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_directorForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
               if(data.message == 'Email Already Exist!')
                {
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
$("#Edit_directorForm").submit(function (e) {
    e.preventDefault();
    
     if($('#dob').val() == '' || $('#dob').val() == null)
    {
      $("#dob").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#dob_validation').css('display','block');  
    }else{
     $("#dob").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#dob_validation').css('display','none'); 
    }
    
    
      if($('#mobile_no').val() == '' || $('#mobile_no').val() == null)
    {
      $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#mobile_no_validation').css('display','block');  
    }else{
     $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#mobile_no_validation').css('display','none'); 
    }
    
     if($('#address').val() == '' || $('#address').val() == null)
    {
      $("#address").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#address_validation').css('display','block');  
    }else{
     $("#address").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#address_validation').css('display','none'); 
    }
    
     if($('#designation_id').val() == '' || $('#designation_id').val() == null)
    {
      $("#designation_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#designation_id_validation').css('display','block');  
    }else{
     $("#designation_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#designation_id_validation').css('display','none'); 
    }
    
     if($('#nominee_mobile').val() == '' || $('#nominee_mobile').val() == null)
    {
      $("#nominee_mobile").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_mobile_validation').css('display','block');  
    }else{
     $("#nominee_mobile").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#nominee_mobile_validation').css('display','none'); 
    }
    
     if($('#relationship').val() == '' || $('#relationship').val() == null)
    {
      $("#relationship").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#relationship_validation').css('display','block');  
    }else{
     $("#relationship").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#relationship_validation').css('display','none'); 
    }
    
     if($('#nominee_name').val() == '' || $('#nominee_name').val() == null)
    {
      $("#nominee_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_name_validation').css('display','block');  
    }else{
     $("#nominee_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#nominee_name_validation').css('display','none'); 
    }
     
     if($('#marrital_status').val() == '' || $('#marrital_status').val() == null)
    {
      $("#marrital_status").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#marrital_status_validation').css('display','block');  
    }else{
     $("#marrital_status").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#marrital_status_validation').css('display','none'); 
    }
    
    if($('#join_date').val() == '' || $('#join_date').val() == null)
    {
      $("#join_date").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#join_date_validation').css('display','block');  
    }else{
     $("#join_date").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#join_date_validation').css('display','none'); 
    }
    
     if($('#branch_id').val() == '' || $('#branch_id').val() == null)
    {
      $("#branch_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#branch_validation').css('display','block');  
    }else{
     $("#branch_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#branch_validation').css('display','none'); 
    }
    
     
     if($('#father_husband_name').val() == '' || $('#father_husband_name').val() == null)
    {
      $("#father_husband_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#father_husband_name_validation').css('display','block');  
    }else{
     $("#father_husband_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#father_husband_name_validation').css('display','none'); 
    }
     if($('#password').val() == '' || $('#password').val() == null)
    {
      $("#password").removeClass("form-control").addClass("form-control is-invalid state-invalid").focus();
      $('#password_validation').css('display','block').addClass("mt-4");  
    }else{
     $("#password").removeClass("form-control is-invalid state-invalid").addClass("form-control").focus();
      $('#password_validation').css('display','none').removeClass("mt-4"); 
    }
    
    
     if($('#email').val() == '' || $('#email').val() == null)
    {
      $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#email_name_validation').css('display','block');  
    }else{
     $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#email_name_validation').css('display','none'); 
    }
     // Team Name
    
    if($('#team_name').val() == '' || $('#team_name').val() == null)
    {
      $("#team_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#team_name_validation').css('display','block');  
    }else{
     $("#team_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#team_name_validation').css('display','none'); 
    }
    
     var name = $('#name').val();
    if(name == '' || name == null)
    {
      $("#name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#name_validation').css('display','block');  
    }else{
     $("#name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#name_validation').css('display','none'); 
    }
    var form = $("#Edit_directorForm")[0];
    var id = $("#director_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/director/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/director-lists";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
               swal("Warning!", data.message, "warning");
               if(data.message == 'Email Already Exist!')
                {
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
//Marketing Manager
$("#Add_marketingmanagerForm").submit(function (e) {
    e.preventDefault();
     if ($("#dob").val() == "" || $("#dob").val() == null) {
        $("#dob")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#dob_validation").css("display", "block");
    } else {
        $("#dob")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#dob_validation").css("display", "none");
    }
    if ($("#mobile_no").val() == "" || $("#mobile_no").val() == null) {
        $("#mobile_no")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#mobile_no_validation").css("display", "block");
    } else {
        $("#mobile_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#mobile_no_validation").css("display", "none");
    }
    if ($("#address").val() == "" || $("#address").val() == null) {
        $("#address")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#address_validation").css("display", "block");
    } else {
        $("#address")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#address_validation").css("display", "none");
    }
    if (
        $("#designation_id").val() == "" ||
        $("#designation_id").val() == null
    ) {
        $("#designation_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#designation_validation").css("display", "block");
    } else {
        $("#designation_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#designation_validation").css("display", "none");
    }
    if (
        $("#nominee_mobile").val() == "" ||
        $("#nominee_mobile").val() == null
    ) {
        $("#nominee_mobile")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_mobile_validation").css("display", "block");
    } else {
        $("#nominee_mobile")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_mobile_validation").css("display", "none");
    }

    if ($("#relationship").val() == "" || $("#relationship").val() == null) {
        $("#relationship")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#relationship_validation").css("display", "block");
    } else {
        $("#relationship")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#relationship_validation").css("display", "none");
    }

    if ($("#nominee_name").val() == "" || $("#nominee_name").val() == null) {
        $("#nominee_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_name_validation").css("display", "block");
    } else {
        $("#nominee_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_name_validation").css("display", "none");
    }
    if (
        $("#marrital_status").val() == "" ||
        $("#marrital_status").val() == null
    ) {
        $("#marrital_status")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#marrital_status_validation").css("display", "block");
    } else {
        $("#marrital_status")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#marrital_status_validation").css("display", "none");
    }
    if ($("#join_date").val() == "" || $("#join_date").val() == null) {
        $("#join_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#join_date_validation").css("display", "block");
    } else {
        $("#join_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#join_date_validation").css("display", "none");
    }
    if ($("#branch_id").val() == "" || $("#branch_id").val() == null) {
        $("#branch_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#branch_validation").css("display", "block");
    } else {
        $("#branch_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#branch_validation").css("display", "none");
    }
    if (
        $("#father_husband_name").val() == "" ||
        $("#father_husband_name").val() == null
    ) {
        $("#father_husband_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#father_husband_name_validation").css("display", "block");
    } else {
        $("#father_husband_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#father_husband_name_validation").css("display", "none");
    }
    if ($("#password").val() == "" || $("#password").val() == null) {
        $("#password")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#password_validation").css("display", "block").addClass("mt-4");
    } else {
        $("#password")
            .removeClass("form-control is-invalid state-invalid")
            .addClass("form-control");
        $("#password_validation").css("display", "none").removeClass("mt-4");
    }
    if ($("#email").val() == "" || $("#email").val() == null) {
        $("#email")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#email_name_validation").css("display", "block");
    } else {
        $("#email")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#email_name_validation").css("display", "none");
    }

    // if ($("#director_id").val() == "" || $("#director_id").val() == null) {
    //     $("#director_id")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#director_validation").css("display", "block");
    // } else {
    //     $("#director_id")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#director_validation").css("display", "none");
    // }
    var name = $("#name").val();
    if (name == "" || name == null) {
        $("#name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#name_validation").css("display", "block");
    } else {
        $("#name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#name_validation").css("display", "none");
    }
    var form = $("#Add_marketingmanagerForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/marketing-manager-lists";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_marketingmanagerForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
                if(data.message == 'Email Already Exist!')
                {
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
$("#Edit_marketingmanagerForm").submit(function (e) {
    e.preventDefault();
     if ($("#dob").val() == "" || $("#dob").val() == null) {
        $("#dob")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#dob_validation").css("display", "block");
    } else {
        $("#dob")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#dob_validation").css("display", "none");
    }
    if ($("#mobile_no").val() == "" || $("#mobile_no").val() == null) {
        $("#mobile_no")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#mobile_no_validation").css("display", "block");
    } else {
        $("#mobile_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#mobile_no_validation").css("display", "none");
    }
    if ($("#address").val() == "" || $("#address").val() == null) {
        $("#address")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#address_validation").css("display", "block");
    } else {
        $("#address")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#address_validation").css("display", "none");
    }
    if (
        $("#designation_id").val() == "" ||
        $("#designation_id").val() == null
    ) {
        $("#designation_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#designation_validation").css("display", "block");
    } else {
        $("#designation_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#designation_validation").css("display", "none");
    }
    if (
        $("#nominee_mobile").val() == "" ||
        $("#nominee_mobile").val() == null
    ) {
        $("#nominee_mobile")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_mobile_validation").css("display", "block");
    } else {
        $("#nominee_mobile")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_mobile_validation").css("display", "none");
    }

    if ($("#relationship").val() == "" || $("#relationship").val() == null) {
        $("#relationship")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#relationship_validation").css("display", "block");
    } else {
        $("#relationship")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#relationship_validation").css("display", "none");
    }

    if ($("#nominee_name").val() == "" || $("#nominee_name").val() == null) {
        $("#nominee_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_name_validation").css("display", "block");
    } else {
        $("#nominee_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_name_validation").css("display", "none");
    }
    if (
        $("#marrital_status").val() == "" ||
        $("#marrital_status").val() == null
    ) {
        $("#marrital_status")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#marrital_status_validation").css("display", "block");
    } else {
        $("#marrital_status")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#marrital_status_validation").css("display", "none");
    }
    if ($("#join_date").val() == "" || $("#join_date").val() == null) {
        $("#join_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#join_date_validation").css("display", "block");
    } else {
        $("#join_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#join_date_validation").css("display", "none");
    }
    if ($("#branch_id").val() == "" || $("#branch_id").val() == null) {
        $("#branch_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#branch_validation").css("display", "block");
    } else {
        $("#branch_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#branch_validation").css("display", "none");
    }
    if (
        $("#father_husband_name").val() == "" ||
        $("#father_husband_name").val() == null
    ) {
        $("#father_husband_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#father_husband_name_validation").css("display", "block");
    } else {
        $("#father_husband_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#father_husband_name_validation").css("display", "none");
    }
    if ($("#password").val() == "" || $("#password").val() == null) {
        $("#password")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#password_validation").css("display", "block").addClass("mt-4");
    } else {
        $("#password")
            .removeClass("form-control is-invalid state-invalid")
            .addClass("form-control");
        $("#password_validation").css("display", "none").removeClass("mt-4");
    }
    
    if ($("#email").val() == "" || $("#email").val() == null) {
        $("#email")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#email_name_validation").css("display", "block");
    } else {
        $("#email")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#email_name_validation").css("display", "none");
    }

    // if ($("#director_id").val() == "" || $("#director_id").val() == null) {
    //     $("#director_id")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#director_validation").css("display", "block");
    // } else {
    //     $("#director_id")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#director_validation").css("display", "none");
    // }
    var name = $("#name").val();
    if (name == "" || name == null) {
        $("#name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#name_validation").css("display", "block");
    } else {
        $("#name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#name_validation").css("display", "none");
    }
    var form = $("#Edit_marketingmanagerForm")[0];
    var id = $("#marketing_manager_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/marketing-manager/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/marketing-manager-lists";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
                swal("Warning!", data.message, "warning");
                if(data.message == 'Email Already Exist!')
                {
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
//Marketing supervisor
$("#Add_marketingSupervisorForm").submit(function (e) {
    e.preventDefault();
     if ($("#dob").val() == "" || $("#dob").val() == null) {
        $("#dob")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#dob_validation").css("display", "block");
    } else {
        $("#dob")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#dob_validation").css("display", "none");
    }
    if ($("#mobile_no").val() == "" || $("#mobile_no").val() == null) {
        $("#mobile_no")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#mobile_no_validation").css("display", "block");
    } else {
        $("#mobile_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#mobile_no_validation").css("display", "none");
    }
    if ($("#address").val() == "" || $("#address").val() == null) {
        $("#address")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#address_validation").css("display", "block");
    } else {
        $("#address")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#address_validation").css("display", "none");
    }
    if (
        $("#designation_id").val() == "" ||
        $("#designation_id").val() == null
    ) {
        $("#designation_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#designation_validation").css("display", "block");
    } else {
        $("#designation_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#designation_validation").css("display", "none");
    }
    if (
        $("#nominee_mobile").val() == "" ||
        $("#nominee_mobile").val() == null
    ) {
        $("#nominee_mobile")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_mobile_validation").css("display", "block");
    } else {
        $("#nominee_mobile")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_mobile_validation").css("display", "none");
    }

    if ($("#relationship").val() == "" || $("#relationship").val() == null) {
        $("#relationship")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#relationship_validation").css("display", "block");
    } else {
        $("#relationship")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#relationship_validation").css("display", "none");
    }

    if ($("#nominee_name").val() == "" || $("#nominee_name").val() == null) {
        $("#nominee_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_name_validation").css("display", "block");
    } else {
        $("#nominee_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_name_validation").css("display", "none");
    }
    if (
        $("#marrital_status").val() == "" ||
        $("#marrital_status").val() == null
    ) {
        $("#marrital_status")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#marrital_status_validation").css("display", "block");
    } else {
        $("#marrital_status")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#marrital_status_validation").css("display", "none");
    }
    if ($("#join_date").val() == "" || $("#join_date").val() == null) {
        $("#join_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#join_date_validation").css("display", "block");
    } else {
        $("#join_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#join_date_validation").css("display", "none");
    }
    if ($("#branch_id").val() == "" || $("#branch_id").val() == null) {
        $("#branch_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#branch_validation").css("display", "block");
    } else {
        $("#branch_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#branch_validation").css("display", "none");
    }
    if (
        $("#father_husband_name").val() == "" ||
        $("#father_husband_name").val() == null
    ) {
        $("#father_husband_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#father_husband_name_validation").css("display", "block");
    } else {
        $("#father_husband_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#father_husband_name_validation").css("display", "none");
    }
    if ($("#password").val() == "" || $("#password").val() == null) {
        $("#password")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#password_validation").css("display", "block").addClass("mt-4");
    } else {
        $("#password")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#password_validation").css("display", "none").removeClass("mt-4");
    }
    if ($("#email").val() == "" || $("#email").val() == null) {
        $("#email")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#email_name_validation").css("display", "block");
    } else {
        $("#email")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#email_name_validation").css("display", "none");
    }

    // if ($("#director_id").val() == "" || $("#director_id").val() == null) {
    //     $("#director_id")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#director_validation").css("display", "block");
    // } else {
    //     $("#director_id")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#director_validation").css("display", "none");
    // }
    var name = $("#name").val();
    if (name == "" || name == null) {
        $("#name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#name_validation").css("display", "block");
    } else {
        $("#name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#name_validation").css("display", "none");
    }
    var form = $("#Add_marketingSupervisorForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") +
        "/marketing-supervisor-lists";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_marketingSupervisorForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
                if(data.message == 'Email Already Exist!')
                {
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
$("#Edit_marketingSupervisorForm").submit(function (e) {
    e.preventDefault();
     if ($("#dob").val() == "" || $("#dob").val() == null) {
        $("#dob")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#dob_validation").css("display", "block");
    } else {
        $("#dob")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#dob_validation").css("display", "none");
    }
    if ($("#mobile_no").val() == "" || $("#mobile_no").val() == null) {
        $("#mobile_no")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#mobile_no_validation").css("display", "block");
    } else {
        $("#mobile_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#mobile_no_validation").css("display", "none");
    }
    if ($("#address").val() == "" || $("#address").val() == null) {
        $("#address")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#address_validation").css("display", "block");
    } else {
        $("#address")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#address_validation").css("display", "none");
    }
    if (
        $("#designation_id").val() == "" ||
        $("#designation_id").val() == null
    ) {
        $("#designation_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#designation_validation").css("display", "block");
    } else {
        $("#designation_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#designation_validation").css("display", "none");
    }
    if (
        $("#nominee_mobile").val() == "" ||
        $("#nominee_mobile").val() == null
    ) {
        $("#nominee_mobile")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_mobile_validation").css("display", "block");
    } else {
        $("#nominee_mobile")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_mobile_validation").css("display", "none");
    }

    if ($("#relationship").val() == "" || $("#relationship").val() == null) {
        $("#relationship")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#relationship_validation").css("display", "block");
    } else {
        $("#relationship")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#relationship_validation").css("display", "none");
    }

    if ($("#nominee_name").val() == "" || $("#nominee_name").val() == null) {
        $("#nominee_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_name_validation").css("display", "block");
    } else {
        $("#nominee_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_name_validation").css("display", "none");
    }
    if (
        $("#marrital_status").val() == "" ||
        $("#marrital_status").val() == null
    ) {
        $("#marrital_status")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#marrital_status_validation").css("display", "block");
    } else {
        $("#marrital_status")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#marrital_status_validation").css("display", "none");
    }
    if ($("#join_date").val() == "" || $("#join_date").val() == null) {
        $("#join_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#join_date_validation").css("display", "block");
    } else {
        $("#join_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#join_date_validation").css("display", "none");
    }
    if ($("#branch_id").val() == "" || $("#branch_id").val() == null) {
        $("#branch_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#branch_validation").css("display", "block");
    } else {
        $("#branch_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#branch_validation").css("display", "none");
    }
    if (
        $("#father_husband_name").val() == "" ||
        $("#father_husband_name").val() == null
    ) {
        $("#father_husband_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#father_husband_name_validation").css("display", "block");
    } else {
        $("#father_husband_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#father_husband_name_validation").css("display", "none");
    }
    if ($("#password").val() == "" || $("#password").val() == null) {
        $("#password")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#password_validation").css("display", "block").addClass("mt-4");
    } else {
        $("#password")
            .removeClass("form-control is-invalid state-invalid")
            .addClass("form-control");
        $("#password_validation").css("display", "none").removeClass("mt-4");
    }
    if ($("#email").val() == "" || $("#email").val() == null) {
        $("#email")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#email_name_validation").css("display", "block");
    } else {
        $("#email")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#email_name_validation").css("display", "none");
    }

    // if ($("#director_id").val() == "" || $("#director_id").val() == null) {
    //     $("#director_id")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#director_validation").css("display", "block");
    // } else {
    //     $("#director_id")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#director_validation").css("display", "none");
    // }
    var name = $("#name").val();
    if (name == "" || name == null) {
        $("#name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#name_validation").css("display", "block");
    } else {
        $("#name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#name_validation").css("display", "none");
    }
    var form = $("#Edit_marketingSupervisorForm")[0];
    var id = $("#marketing_supervisor_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") +
        "/marketing-supervisor/" +
        id;
    var redirect =
        $('meta[name="base_url"]').attr("content") +
        "/marketing-supervisor-lists";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
                swal("Warning!", data.message, "warning");
                if(data.message == 'Email Already Exist!')
                {
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
//Marketing executive
$("#Add_marketingExecutiveForm").submit(function (e) {
    e.preventDefault();
    
     if($('#dob').val() == '' || $('#dob').val() == null)
    {
      $("#dob").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#dob_validation').css('display','block');  
    }else{
     $("#dob").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#dob_validation').css('display','none'); 
    }
    
    
      if($('#mobile_no').val() == '' || $('#mobile_no').val() == null)
    {
      $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#mobile_no_validation').css('display','block');  
    }else{
     $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#mobile_no_validation').css('display','none'); 
    }
    
     if($('#address').val() == '' || $('#address').val() == null)
    {
      $("#address").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#address_validation').css('display','block');  
    }else{
     $("#address").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#address_validation').css('display','none'); 
    }
    
     if($('#designation_id').val() == '' || $('#designation_id').val() == null)
    {
      $("#designation_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#designation_id_validation').css('display','block');  
    }else{
     $("#designation_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#designation_id_validation').css('display','none'); 
    }
    
     if($('#nominee_mobile').val() == '' || $('#nominee_mobile').val() == null)
    {
      $("#nominee_mobile").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_mobile_validation').css('display','block');  
    }else{
     $("#nominee_mobile").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#nominee_mobile_validation').css('display','none'); 
    }
    
     if($('#relationship').val() == '' || $('#relationship').val() == null)
    {
      $("#relationship").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#relationship_validation').css('display','block');  
    }else{
     $("#relationship").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#relationship_validation').css('display','none'); 
    }
    
     if($('#nominee_name').val() == '' || $('#nominee_name').val() == null)
    {
      $("#nominee_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_name_validation').css('display','block');  
    }else{
     $("#nominee_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#nominee_name_validation').css('display','none'); 
    }
     
     if($('#marrital_status').val() == '' || $('#marrital_status').val() == null)
    {
      $("#marrital_status").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#marrital_status_validation').css('display','block');  
    }else{
     $("#marrital_status").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#marrital_status_validation').css('display','none'); 
    }
    
    if($('#join_date').val() == '' || $('#join_date').val() == null)
    {
      $("#join_date").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#join_date_validation').css('display','block');  
    }else{
     $("#join_date").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#join_date_validation').css('display','none'); 
    }
    
     if($('#branch_id').val() == '' || $('#branch_id').val() == null)
    {
      $("#branch_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#branch_validation').css('display','block');  
    }else{
     $("#branch_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#branch_validation').css('display','none'); 
    }
    
     
     if($('#father_husband_name').val() == '' || $('#father_husband_name').val() == null)
    {
      $("#father_husband_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#father_husband_name_validation').css('display','block');  
    }else{
     $("#father_husband_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#father_husband_name_validation').css('display','none'); 
    }
     if($('#password').val() == '' || $('#password').val() == null)
    {
      $("#password").removeClass("form-control").addClass("form-control is-invalid state-invalid").focus();
      $('#password_validation').css('display','block').addClass("mt-4");  
    }else{
     $("#password").removeClass("form-control is-invalid state-invalid").addClass("form-control");
      $('#password_validation').css('display','none').removeClass("mt-4"); 
    }
    
    
     if($('#email').val() == '' || $('#email').val() == null)
    {
      $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#email_name_validation').css('display','block');  
    }else{
     $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#email_name_validation').css('display','none'); 
    }
     // Team Name
    
    if($('#team_name').val() == '' || $('#team_name').val() == null)
    {
      $("#team_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#team_name_validation').css('display','block');  
    }else{
     $("#team_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#team_name_validation').css('display','none'); 
    }
    
     var name = $('#name').val();
    if(name == '' || name == null)
    {
      $("#name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#name_validation').css('display','block');  
    }else{
     $("#name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#name_validation').css('display','none'); 
    }
    var form = $("#Add_marketingExecutiveForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") +
        "/marketing-executive-lists";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_marketingExecutiveForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }
            else{
               if(data.message == 'Email Already Exist!')
                {
                    
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
$("#Edit_marketingExecutiveForm").submit(function (e) {
    e.preventDefault();
     if($('#dob').val() == '' || $('#dob').val() == null)
    {
      $("#dob").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#dob_validation').css('display','block');  
    }else{
     $("#dob").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#dob_validation').css('display','none'); 
    }
    
    
      if($('#mobile_no').val() == '' || $('#mobile_no').val() == null)
    {
      $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#mobile_no_validation').css('display','block');  
    }else{
     $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#mobile_no_validation').css('display','none'); 
    }
    
     if($('#address').val() == '' || $('#address').val() == null)
    {
      $("#address").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#address_validation').css('display','block');  
    }else{
     $("#address").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#address_validation').css('display','none'); 
    }
    
     if($('#designation_id').val() == '' || $('#designation_id').val() == null)
    {
      $("#designation_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#designation_id_validation').css('display','block');  
    }else{
     $("#designation_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#designation_id_validation').css('display','none'); 
    }
    
     if($('#nominee_mobile').val() == '' || $('#nominee_mobile').val() == null)
    {
      $("#nominee_mobile").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_mobile_validation').css('display','block');  
    }else{
     $("#nominee_mobile").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#nominee_mobile_validation').css('display','none'); 
    }
    
     if($('#relationship').val() == '' || $('#relationship').val() == null)
    {
      $("#relationship").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#relationship_validation').css('display','block');  
    }else{
     $("#relationship").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#relationship_validation').css('display','none'); 
    }
    
     if($('#nominee_name').val() == '' || $('#nominee_name').val() == null)
    {
      $("#nominee_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#nominee_name_validation').css('display','block');  
    }else{
     $("#nominee_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#nominee_name_validation').css('display','none'); 
    }
     
     if($('#marrital_status').val() == '' || $('#marrital_status').val() == null)
    {
      $("#marrital_status").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#marrital_status_validation').css('display','block');  
    }else{
     $("#marrital_status").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
     $('#marrital_status_validation').css('display','none'); 
    }
    
    if($('#join_date').val() == '' || $('#join_date').val() == null)
    {
      $("#join_date").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#join_date_validation').css('display','block');  
    }else{
     $("#join_date").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#join_date_validation').css('display','none'); 
    }
    
     if($('#branch_id').val() == '' || $('#branch_id').val() == null)
    {
       $("#branch_id").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#branch_validation').css('display','block');  
    }else{
     $("#branch_id").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#branch_validation').css('display','none'); 
    }
    
     
     if($('#father_husband_name').val() == '' || $('#father_husband_name').val() == null)
    {
      $("#father_husband_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#father_husband_name_validation').css('display','block');  
    }else{
     $("#father_husband_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#father_husband_name_validation').css('display','none'); 
    }
     if($('#password').val() == '' || $('#password').val() == null)
    {
      $("#password").removeClass("form-control").addClass("form-control is-invalid state-invalid").focus();
      $('#password_validation').css('display','block').addClass("mt-4");  
    }else{
     $("#password").removeClass("form-control is-invalid state-invalid").addClass("form-control").focus();
      $('#password_validation').css('display','none').removeClass("mt-4"); 
    }
    
    
     if($('#email').val() == '' || $('#email').val() == null)
    {
      $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#email_name_validation').css('display','block');  
    }else{
     $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#email_name_validation').css('display','none'); 
    }
     // Team Name
    
    if($('#team_name').val() == '' || $('#team_name').val() == null)
    {
      $("#team_name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#team_name_validation').css('display','block');  
    }else{
     $("#team_name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#team_name_validation').css('display','none'); 
    }
    
     var name = $('#name').val();
    if(name == '' || name == null)
    {
      $("#name").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
      $('#name_validation').css('display','block');  
    }else{
     $("#name").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
      $('#name_validation').css('display','none'); 
    }
    var form = $("#Edit_marketingExecutiveForm")[0];
    var id = $("#marketing_executive_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") +
        "/marketing-executive/" +
        id;
    var redirect =
        $('meta[name="base_url"]').attr("content") +
        "/marketing-executive-lists";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
           if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }
            else{
                swal("Warning!", data.message, "warning");
                if(data.message == 'Email Already Exist!')
                {
                    $("#email").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#email_validation').css('display','block');
                }else{
                    $("#email").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#email_validation').css('display','none');
                }
                if(data.message == 'Mobile No Already Exist!')
                {
                    $("#mobile_no").removeClass("form-control").addClass("form-control mb-4 is-invalid state-invalid").focus();
                    $('#mobile_validation').css('display','block');
                }else{
                    $("#mobile_no").removeClass("form-control mb-4 is-invalid state-invalid").addClass("form-control");
                    $('#mobile_validation').css('display','none');
                }
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
// Staff Details
$("#Add_staff_detailsForm").submit(function (e) {
    e.preventDefault();
     if ($("#dob").val() == "" || $("#dob").val() == null) {
        $("#dob")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#dob_validation").css("display", "block");
    } else {
        $("#dob")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#dob_validation").css("display", "none");
    }
    if ($("#mobile_no").val() == "" || $("#mobile_no").val() == null) {
        $("#mobile_no")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#mobile_no_validation").css("display", "block");
    } else {
        $("#mobile_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#mobile_no_validation").css("display", "none");
    }
    if ($("#address").val() == "" || $("#address").val() == null) {
        $("#address")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#address_validation").css("display", "block");
    } else {
        $("#address")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#address_validation").css("display", "none");
    }
    if (
        $("#designation_id").val() == "" ||
        $("#designation_id").val() == null
    ) {
        $("#designation_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#designation_validation").css("display", "block");
    } else {
        $("#designation_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#designation_validation").css("display", "none");
    }
    if (
        $("#nominee_mobile").val() == "" ||
        $("#nominee_mobile").val() == null
    ) {
        $("#nominee_mobile")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_mobile_validation").css("display", "block");
    } else {
        $("#nominee_mobile")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_mobile_validation").css("display", "none");
    }

    if ($("#relationship").val() == "" || $("#relationship").val() == null) {
        $("#relationship")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#relationship_validation").css("display", "block");
    } else {
        $("#relationship")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#relationship_validation").css("display", "none");
    }

    if ($("#nominee_name").val() == "" || $("#nominee_name").val() == null) {
        $("#nominee_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_name_validation").css("display", "block");
    } else {
        $("#nominee_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_name_validation").css("display", "none");
    }
    if (
        $("#marrital_status").val() == "" ||
        $("#marrital_status").val() == null
    ) {
        $("#marrital_status")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#marrital_status_validation").css("display", "block");
    } else {
        $("#marrital_status")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#marrital_status_validation").css("display", "none");
    }
    if ($("#join_date").val() == "" || $("#join_date").val() == null) {
        $("#join_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#join_date_validation").css("display", "block");
    } else {
        $("#join_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#join_date_validation").css("display", "none");
    }
    if ($("#branch_id").val() == "" || $("#branch_id").val() == null) {
        $("#branch_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#branch_validation").css("display", "block");
    } else {
        $("#branch_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#branch_validation").css("display", "none");
    }
    if (
        $("#father_husband_name").val() == "" ||
        $("#father_husband_name").val() == null
    ) {
        $("#father_husband_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#father_husband_name_validation").css("display", "block");
    } else {
        $("#father_husband_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#father_husband_name_validation").css("display", "none");
    }
    // if ($("#password").val() == "" || $("#password").val() == null) {
    //     $("#password")
    //         .removeClass("form-control")
    //         .addClass("form-control is-invalid state-invalid")
    //         .focus();
    //     $("#password_validation").css("display", "block").addClass("mt-4");
    // } else {
    //     $("#password")
    //         .removeClass("form-control is-invalid state-invalid")
    //         .addClass("form-control")
    //         ;
    //     $("#password_validation").css("display", "none").removeClass("mt-4");
    // }
    // if ($("#email").val() == "" || $("#email").val() == null) {
    //     $("#email")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#email_name_validation").css("display", "block");
    // } else {
    //     $("#email")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control")
    //         .focus();
    //     $("#email_name_validation").css("display", "none");
    // }
    var name = $("#name").val();
    if (name == "" || name == null) {
        $("#name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#name_validation").css("display", "block");
    } else {
        $("#name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#name_validation").css("display", "none");
    }
    var form = $("#Add_staff_detailsForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/staff-details";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_staff_detailsForm")[0].reset();
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
$("#Edit_staff_detailsForm").submit(function (e) {
    e.preventDefault();
    
     if ($("#dob").val() == "" || $("#dob").val() == null) {
        $("#dob")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#dob_validation").css("display", "block");
    } else {
        $("#dob")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#dob_validation").css("display", "none");
    }
    if ($("#mobile_no").val() == "" || $("#mobile_no").val() == null) {
        $("#mobile_no")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#mobile_no_validation").css("display", "block");
    } else {
        $("#mobile_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#mobile_no_validation").css("display", "none");
    }
    if ($("#address").val() == "" || $("#address").val() == null) {
        $("#address")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#address_validation").css("display", "block");
    } else {
        $("#address")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#address_validation").css("display", "none");
    }
    if (
        $("#designation_id").val() == "" ||
        $("#designation_id").val() == null
    ) {
        $("#designation_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#designation_validation").css("display", "block");
    } else {
        $("#designation_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#designation_validation").css("display", "none");
    }
    if (
        $("#nominee_mobile").val() == "" ||
        $("#nominee_mobile").val() == null
    ) {
        $("#nominee_mobile")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_mobile_validation").css("display", "block");
    } else {
        $("#nominee_mobile")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_mobile_validation").css("display", "none");
    }

    if ($("#relationship").val() == "" || $("#relationship").val() == null) {
        $("#relationship")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#relationship_validation").css("display", "block");
    } else {
        $("#relationship")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#relationship_validation").css("display", "none");
    }

    if ($("#nominee_name").val() == "" || $("#nominee_name").val() == null) {
        $("#nominee_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#nominee_name_validation").css("display", "block");
    } else {
        $("#nominee_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#nominee_name_validation").css("display", "none");
    }
    if (
        $("#marrital_status").val() == "" ||
        $("#marrital_status").val() == null
    ) {
        $("#marrital_status")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#marrital_status_validation").css("display", "block");
    } else {
        $("#marrital_status")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#marrital_status_validation").css("display", "none");
    }
    if ($("#join_date").val() == "" || $("#join_date").val() == null) {
        $("#join_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#join_date_validation").css("display", "block");
    } else {
        $("#join_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#join_date_validation").css("display", "none");
    }
    if ($("#branch_id").val() == "" || $("#branch_id").val() == null) {
        $("#branch_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#branch_validation").css("display", "block");
    } else {
        $("#branch_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#branch_validation").css("display", "none");
    }
    if (
        $("#father_husband_name").val() == "" ||
        $("#father_husband_name").val() == null
    ) {
        $("#father_husband_name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#father_husband_name_validation").css("display", "block");
    } else {
        $("#father_husband_name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#father_husband_name_validation").css("display", "none");
    }
    // if ($("#password").val() == "" || $("#password").val() == null) {
    //     $("#password")
    //         .removeClass("form-control")
    //         .addClass("form-control is-invalid state-invalid")
    //         .focus();
    //     $("#password_validation").css("display", "block").addClass("mt-4");
    // } else {
    //     $("#password")
    //         .removeClass("form-control is-invalid state-invalid")
    //         .addClass("form-control")
    //         ;
    //     $("#password_validation").css("display", "none").removeClass("mt-4");
    // }
    // if ($("#email").val() == "" || $("#email").val() == null) {
    //     $("#email")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#email_name_validation").css("display", "block");
    // } else {
    //     $("#email")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control")
    //         .focus();
    //     $("#email_name_validation").css("display", "none");
    // }
    var name = $("#name").val();
    if (name == "" || name == null) {
        $("#name")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#name_validation").css("display", "block");
    } else {
        $("#name")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#name_validation").css("display", "none");
    }
    var form = $("#Edit_staff_detailsForm")[0];
    var id = $("#staff_detail_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/staff-detail/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/staff-details";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
              swal("Warning!", data.message,"warning"); 
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
//Project Type
$("#add_projectform").submit(function (e) {
    e.preventDefault();
    var form = $("#add_projectform")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/project-type";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                console.log(data.message);

                $("#add_projectform")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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

$("#edit_projectform").submit(function (e) {
    e.preventDefault();
    var form = $("#edit_projectform")[0];
    var id = $("#project_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/project-type/" + id;

    var redirect = $('meta[name="base_url"]').attr("content") + "/project-type";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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
//Branch
$("#Add_branchForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_branchForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/branch";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_branchForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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
$("#Edit_branchForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_branchForm")[0];
    var id = $("#branch_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/branch/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/branch";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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


//Banks
$("#Add_bankForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_bankForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/bank";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_bankForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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
$("#Edit_bankForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_bankForm")[0];
    var id = $("#bank_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/bank/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/bank";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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



//Relationship Type
$("#add_relationshipform").submit(function (e) {
    e.preventDefault();
    var form = $("#add_relationshipform")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#add_relationshipform")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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

$("#edit_relationshipform").submit(function (e) {
    e.preventDefault();
    var form = $("#edit_relationshipform")[0];
    var id = $("#relation_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/relationship/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/relationship";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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

//Designation
$("#add_designationForm").submit(function (e) {
    e.preventDefault();
    var form = $("#add_designationForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/designation";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#add_designationForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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

$("#Edit_designationForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_designationForm")[0];
    var id = $("#designation_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/designation/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/designation";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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

//Direction
$("#Add_directionForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_directionForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/direction";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_directionForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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
$("#Edit_directionForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_directionForm")[0];
    var id = $("#direction_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/direction/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/direction";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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
// Marketing Type
$("#Add_MarketingTypeForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_MarketingTypeForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/marketing";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_MarketingTypeForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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
$("#Edit_MarketingTypeForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_MarketingTypeForm")[0];
    var id = $("#marketing_type_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/marketing/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/marketing";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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


// Page

$("#Add_pageForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_pageForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/pages";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_pageForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
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

$("#Edit_pageForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_pageForm")[0];
    var id = $("#page_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/pages/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/pages";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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



//pincode generate
$(document).on("keyup", "#pincode", function () {
    let pincode_val = $(this).val();
    var pincode = pincode_val.trim();

    $("#area").html("<option value=''>Select Area</option>");
    $("#city_id").html("<option value=''>Select City</option>");
    $("#state_id").html("<option value=''>Select State</option>");
    $("#district_id").html("<option value=''>Select District</option>");
    let url =
        $('meta[name="base_url"]').attr("content") +
        "/pincode-generate/" +
        pincode;
    if (pincode.length == 6) {
        $.ajax({
            url: url,
            method: "GET",
            data: {
                pincode: pincode,
            },
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == true) {
                    if (res.data.length > 0) {
                        $("#area").html(
                            "<option value=''>Select Area</option>"
                        );
                        $("#city_id").html(
                            "<option value=''>Select City</option>"
                        );
                        $("#state_id").html(
                            "<option value=''>Select State</option>"
                        );
                        $("#district_id").html(
                            "<option value=''>Select District</option>"
                        );
                        var text = "";
                        for (var i = 0; i < res.data.length; i++) {
                            text += $("#area").append(
                                '<option value="' +
                                    res.data[i]["id"] +
                                    '">' +
                                    res.data[i]["area"] +
                                    "</option>"
                            );
                        }
                        $("#city_id").append(
                            '<option value="' +
                                res.city["id"] +
                                '">' +
                                res.city["city"] +
                                "</option>"
                        );
                        $("#district_id").append(
                            '<option value="' +
                                res.city["id"] +
                                '">' +
                                res.city["city"] +
                                "</option>"
                        );
                        $("#state_id").append(
                            '<option value="' +
                                res.state["id"] +
                                '">' +
                                res.state["state"] +
                                "</option>"
                        );
                    } else {
                        swal("Failed!", "Invalid Pincode", "error");
                        $("#area").html(
                            "<option value=''>Select Area</option>"
                        );
                        $("#city_id").html(
                            "<option value=''>Select City</option>"
                        );
                        $("#state_id").html(
                            "<option value=''>Select State</option>"
                        );
                        $("#district_id").html(
                            "<option value=''>Select District</option>"
                        );
                    }
                } else {
                     swal("Failed!", "Invalid Pincode", "error");
                    $("#area").html(
                            "<option value=''>Select Area</option>"
                        );
                        $("#city_id").html(
                            "<option value=''>Select City</option>"
                        );
                        $("#state_id").html(
                            "<option value=''>Select State</option>"
                        );
                        $("#district_id").html(
                            "<option value=''>Select District</option>"
                        );
                }
            },
        });
    } else {
        if(pincode.length > 6){
            swal("Failed!", "Invalid Pincode", "error");
        }
    }
});

// Permissions

// Permission Details
$("#Add_permission_Form").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_permission_Form")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/permissions";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_permission_Form")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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
$("#Edit_permission_Form").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_permission_Form")[0];
    var id = $("#user_role_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/permissions/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/designation";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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


// enquiry
$("#Add_enquiryForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_enquiryForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/enquiry-lists";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_enquiryForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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
$("#Edit_enquiryForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Edit_enquiryForm")[0];
    var id = $("#enquiry_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/enquiry/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/enquiry-lists";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
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


// Getting Project Incharge

 $('#project_incharge').on('change', function() {
          id = this.value;
          if(id == '')
          {
          $("#select_incharge").css("display", "none")
           }
           $("#incharge_id").html("<option value=''>Select Incharge</option>");
       
             let url = $('meta[name="base_url"]').attr("content") +
            "/getintroducer/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                     var text = "";
                     $("#select_incharge").css("display", "block")
                   if (res.data.length > 0) {
                  for (var i = 0; i < res.data.length; i++) {
                      text += $("#incharge_id").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["name"] +
                            "</option>"
                    );
                    
                     }
                     
                     
                   }else{
                     $("#incharge_id").html("<option value=''>Select Incharge</option>");  
                   }
                },
            });
              
        });
        

// Getting Introducer Details

 $('#introduced_by').on('change', function() {
          id = this.value;
          if(id == '')
          {
          $("#select_introducer_id").css("display", "none")
          $("#introducer").html("<option value=''>Select Introducer</option>");
          }
          $("#select_introducer_id").css("display", "none")
          $("#introducer").html("<option value=''>Select Introducer</option>");
           if(this.value != 'thired_party')
          {
             let url = $('meta[name="base_url"]').attr("content") +
            "/getintroducer/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                     var text = "";
                     $("#select_introducer").css("display", "block")
                   if (res.data.length > 0) {
                  for (var i = 0; i < res.data.length; i++) {
                      text += $("#introducer").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["name"] +
                            "</option>"
                    );
                    
                     }
                     
                     
                   }else{
                     $("#introducer").html("<option value=''>Select Introducer</option>");  
                   }
                },
            });
              $("#thired_part_1").css("display", "none")
              $("#thired_part_2").css("display", "none")
          }
          else{
              $("#select_introducer").css("display", "none")
              $("#thired_part_1").css("display", "block")
              $("#thired_part_2").css("display", "block")
              
          }
        });

// Getting Introducer Code Details

 $('#introducer').on('change', function() {
          id = this.value;
         
             let url = $('meta[name="base_url"]').attr("content") +
            "/getintroducer_id/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                  $("#select_introducer_id").css("display", "block")
                  $('#introducer_id').val(res.data["reference_code"]);
                  $("#introducer_id").prop("readonly", true);
                },
            });
          
        });
