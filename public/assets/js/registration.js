// Registration management

$("#Add_fullypaid_Form").submit(function (e) {
    e.preventDefault();
   

    var form = $("#Add_fullypaid_Form")[0];
    var formData = new FormData(form);
    var url = $('meta[name="base_url"]').attr("content") + "/update_register";
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/fullypaid_list";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
               
                swal("Success!", "Registration Status Changed !", "success");
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

 
$("#Add_ReceiveRegistrationDocument_Form").submit(function (e) {
    e.preventDefault();
   
   if ($("#doc_collected_mobile").val() == "" || $("#doc_collected_mobile").val() == null) {
        $("#doc_collected_mobile")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#doc_collected_mobile_validation").css("display", "block");
    } else {
        $("#doc_collected_mobile")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#doc_collected_mobile_validation").css("display", "none");
    }
    
    
    if ($("#doc_collected_by").val() == "" || $("#doc_collected_by").val() == null) {
        $("#doc_collected_by")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#doc_collected_by_validation").css("display", "block");
    } else {
        $("#doc_collected_by")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#doc_collected_by_validation").css("display", "none");
    }
    if ($("#doc_collected_date").val() == "" || $("#doc_collected_date").val() == null) {
        $("#doc_collected_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#doc_collected_date_validation").css("display", "block");
    } else {
        $("#doc_collected_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#doc_collected_date_validation").css("display", "none");
    }

    var form = $("#Add_ReceiveRegistrationDocument_Form")[0];
    var formData = new FormData(form);
    var url = $('meta[name="base_url"]').attr("content") + "/update-document-receive";
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/receive-registration-document";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
               
                swal("Success!", "Document Received Status Updated!", "success");
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


// Add Legal Book Issue Form

$("#Add_LegalBookIssue_Form").submit(function (e) {
    e.preventDefault();
   
 if ($("#legal_plot_id").val() == "" || $("#legal_plot_id").val() == null) {
        $("#legal_plot_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#legal_plot_id_validation").css("display", "block");
    } else {
        $("#legal_plot_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#legal_plot_id_validation").css("display", "none");
    }
    if ($("#legal_project_id").val() == "" || $("#legal_project_id").val() == null) {
        $("#legal_project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#legal_project_id_validation").css("display", "block");
    } else {
        $("#legal_project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control") ;
        $("#legal_project_id_validation").css("display", "none");
    }
    var form = $("#Add_LegalBookIssue_Form")[0];
    var formData = new FormData(form);
    var url = $('meta[name="base_url"]').attr("content") + "/update-legal-book";
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/legal-book-issue";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
               
                swal("Success!", data.msg , "success");
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

// Get user Details

 $('#doc_collected_by').on('change', function() {
          id = this.value;
          if(id != '')
          {
          let url = $('meta[name="base_url"]').attr("content") +
            "/get-mobile/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    if(res.status == true)
                    {
                      $('#doc_collected_mobile').val(res.data.mobile_no).prop("readonly",true);
                       
                    }else{
                         
                         swal("Failed!", 'No Data Found',"error"); 
                       
                    }
                    
                       
                   
                },
            });   
          }  
    });
    $('#register_project_id').on('change', function() {
          id = this.value;
       
         if(id != '')
         {
             $("#plot_id").html("<option value=''>Select Plot No</option>")
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-register-plot-list/" + id;
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
                     var text_1 = "";
                     var text_2 = "";
                    if (res.data.length > 0) {
                       
                  for (var i = 0; i < res.data.length; i++) {
                       text += $("#plot_id").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["plot_no"] +
                            "</option>"
                    );
                    
                }
                     
                    }
                      
                },
            });
         }else{
              $("#plot_id").html("<option value=''>Select Plot No</option>"); 
           }
              
        });
    
    // Getting Plot Details
$('#legal_project_id').on('change', function() {
          id = this.value;
       
         if(id != '')
         {
             $("#legal_plot_id").html("<option value=''>Select Plot No</option>")
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-legal-plots/" + id;
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
                     var text_1 = "";
                     var text_2 = "";
                    if (res.data.length > 0) {
                       
                  for (var i = 0; i < res.data.length; i++) {
                       text += $("#legal_plot_id").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["plot_no"] +
                            "</option>"
                    );
                    
                }
                     
                    }
                      
                },
            });
         }else{
              $("#legal_plot_id").html("<option value=''>Select Plot No</option>"); 
           }
              
        });
        
$('#legal_plot_id').on('change', function() {
          id = this.value;
             project_id = $('#legal_project_id').val();
         if(id != '')
         {
          
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-legal-details/"+ project_id +"/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#plot_sqft_value').text(res.data.plot_size_sqft);
                    $('#customer_name').text(res.customer_name);
                    $('#customer_mobile').text(res.mobile);
                    $('#reg_no').text(res.data.reg_no);
                    $('#register_date').text(res.register_date);
                    $('#collected_by').text(res.collected_by);
                    $('#collected_date').text(res.collected_date);
                    $('#expense_by').text(res.expense_by);
                    $('#issue_to_name').val(res.customer_name);
                    $('#issue_to_mobile_no').val(res.mobile);
                },
            });
         }else{
              $("#legal_plot_id").html("<option value=''>Select Plot No</option>"); 
           }
              
        });


//Main ledger
$("#Add_mainLedgerForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_mainLedgerForm")[0];
    var formData = new FormData(form);
    var url = $('meta[name="base_url"]').attr("content") + "/main-ledger-store";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_mainLedgerForm")[0].reset();
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

$("#edit_mainLedgerForm").submit(function (e) {
    e.preventDefault();
    var form = $("#edit_mainLedgerForm")[0];
    var id = $("#edit_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/main/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/main-ledger";
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

//Sub ledger
$("#Add_subLedgerForm").submit(function (e) {
    e.preventDefault();
    var form = $("#Add_subLedgerForm")[0];
    var formData = new FormData(form);
    var url = $('meta[name="base_url"]').attr("content") + "/sub-ledger-store";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_subLedgerForm")[0].reset();
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

$("#edit_subLedgerForm").submit(function (e) {
    e.preventDefault();
    var form = $("#edit_subLedgerForm")[0];
    var id = $("#edit_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/sub/" + id;
    var redirect = $('meta[name="base_url"]').attr("content") + "/sub-ledger";
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