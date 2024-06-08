$("#account_voucher_entry_add").submit(function (e) {
    e.preventDefault();
    
   
    
     if (
        $("#pay_mode").val() == "" ||
        $("#pay_mode").val() == null
    ) {
        $("#pay_mode")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#pay_mode_validation").css("display", "block");
    } else {
        $("#pay_mode")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#pay_mode_validation").css("display", "none");
    }
    
    //  if (
    //     $("#rs").val() == "" ||
    //     $("#rs").val() == null
    // ) {
    //     $("#rs")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#rs_validation").css("display", "block");
    // } else {
    //     $("#rs")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#rs_validation").css("display", "none");
    // }
    
    
    //  if (
    //     $("#tds").val() == "" ||
    //     $("#tds").val() == null
    // ) {
    //     $("#tds")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#tds_validation").css("display", "block");
    // } else {
    //     $("#tds")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#tds_validation").css("display", "none");
    // }
    
  
    
     if (
        $("#suspense_amount").val() == "" ||
        $("#suspense_amount").val() == null
    ) {
        $("#suspense_amount")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#amount_validation").css("display", "block");
    } else {
        $("#suspense_amount")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#amount_validation").css("display", "none");
    }
    
     if (
        $("#branch").val() == "" ||
        $("#branch").val() == null
    ) {
        $("#branch")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#branch_validation").css("display", "block");
    } else {
        $("#branch")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#branch_validation").css("display", "none");
    }
    
    
    // if (
    //     $("#sub_ledger").val() == "" ||
    //     $("#sub_ledger").val() == null
    // ) {
    //     $("#sub_ledger")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#sub_ledger_validation").css("display", "block");
    // } else {
    //     $("#sub_ledger")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#sub_ledger_validation").css("display", "none");
    // }
    
    // if (
    //     $("#main_ledger").val() == "" ||
    //     $("#main_ledger").val() == null
    // ) {
    //     $("#main_ledger")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#main_ledger_validation").css("display", "block");
    // } else {
    //     $("#main_ledger")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#main_ledger_validation").css("display", "none");
    // }
    // if (
    //     $("#account_for").val() == "" ||
    //     $("#account_for").val() == null
    // ) {
    //     $("#account_for")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#account_for_validation").css("display", "block");
    // } else {
    //     $("#account_for")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#account_for_validation").css("display", "none");
    // }
    
    if (
        $("#transaction_type").val() == "" ||
        $("#transaction_type").val() == null
    ) {
        $("#transaction_type")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#transaction_type_validation").css("display", "block");
    } else {
        $("#transaction_type")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#transaction_type_validation").css("display", "none");
    }
   
    
     if (
        $("#voucher_type").val() == "" ||
        $("#voucher_type").val() == null
    ) {
        $("#voucher_type")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#voucher_type_validation").css("display", "block");
    } else {
        $("#voucher_type")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#voucher_type_validation").css("display", "none");
    }
   
    
    
    if (
        $("#account_on").val() == "" ||
        $("#account_on").val() == null
    ) {
        $("#account_on")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#account_on_validation").css("display", "block");
    } else {
        $("#account_on")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#account_on_validation").css("display", "none");
    }
   
   if (
        $("#voucher_date").val() == "" ||
        $("#voucher_date").val() == null
    ) {
        $("#voucher_date")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#voucher_date_validation").css("display", "block");
    } else {
        $("#voucher_date")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#voucher_date_validation").css("display", "none");
    }
    var form = $("#account_voucher_entry_add")[0];
    var formData = new FormData(form);
    var url = $('meta[name="base_url"]').attr("content") + "/account-voucher-entry-store";
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/account-voucher-entry";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
               
                swal("Success!", "Account Voucher Added Successfully !", "success");
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


$("#account_voucher_entry_edit").submit(function (e) {
    e.preventDefault();
   
   
       
    
    //  if (
    //     $("#pay_mode").val() == "" ||
    //     $("#pay_mode").val() == null
    // ) {
    //     $("#pay_mode")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#pay_mode_validation").css("display", "block");
    // } else {
    //     $("#pay_mode")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#pay_mode_validation").css("display", "none");
    // }
    
    //  if (
    //     $("#rs").val() == "" ||
    //     $("#rs").val() == null
    // ) {
    //     $("#rs")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#rs_validation").css("display", "block");
    // } else {
    //     $("#rs")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#rs_validation").css("display", "none");
    // }
    
    
    //  if (
    //     $("#tds").val() == "" ||
    //     $("#tds").val() == null
    // ) {
    //     $("#tds")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#tds_validation").css("display", "block");
    // } else {
    //     $("#tds")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#tds_validation").css("display", "none");
    // }
    
    //  if (
    //     $("#suspense_amount").val() == "" ||
    //     $("#suspense_amount").val() == null
    // ) {
    //     $("#suspense_amount")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#amount_validation").css("display", "block");
    // } else {
    //     $("#suspense_amount")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#amount_validation").css("display", "none");
    // }
    
    //  if (
    //     $("#branch").val() == "" ||
    //     $("#branch").val() == null
    // ) {
    //     $("#branch")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#branch_validation").css("display", "block");
    // } else {
    //     $("#branch")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#branch_validation").css("display", "none");
    // }
    
    
    // if (
    //     $("#sub_ledger").val() == "" ||
    //     $("#sub_ledger").val() == null
    // ) {
    //     $("#sub_ledger")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#sub_ledger_validation").css("display", "block");
    // } else {
    //     $("#sub_ledger")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#sub_ledger_validation").css("display", "none");
    // }
    
    // if (
    //     $("#main_ledger").val() == "" ||
    //     $("#main_ledger").val() == null
    // ) {
    //     $("#main_ledger")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#main_ledger_validation").css("display", "block");
    // } else {
    //     $("#main_ledger")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#main_ledger_validation").css("display", "none");
    // }
    // if (
    //     $("#account_for").val() == "" ||
    //     $("#account_for").val() == null
    // ) {
    //     $("#account_for")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#account_for_validation").css("display", "block");
    // } else {
    //     $("#account_for")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#account_for_validation").css("display", "none");
    // }
    
    // if (
    //     $("#transaction_type").val() == "" ||
    //     $("#transaction_type").val() == null
    // ) {
    //     $("#transaction_type")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#transaction_type_validation").css("display", "block");
    // } else {
    //     $("#transaction_type")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#transaction_type_validation").css("display", "none");
    // }
   
    
    //  if (
    //     $("#voucher_type").val() == "" ||
    //     $("#voucher_type").val() == null
    // ) {
    //     $("#voucher_type")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#voucher_type_validation").css("display", "block");
    // } else {
    //     $("#voucher_type")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#voucher_type_validation").css("display", "none");
    // }
   
    
    
    // if (
    //     $("#account_on").val() == "" ||
    //     $("#account_on").val() == null
    // ) {
    //     $("#account_on")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#account_on_validation").css("display", "block");
    // } else {
    //     $("#account_on")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#account_on_validation").css("display", "none");
    // }
   
//   if (
//         $("#voucher_date").val() == "" ||
//         $("#voucher_date").val() == null
//     ) {
//         $("#voucher_date")
//             .removeClass("form-control")
//             .addClass("form-control mb-4 is-invalid state-invalid")
//             .focus();
//         $("#voucher_date_validation").css("display", "block");
//     } else {
//         $("#voucher_date")
//             .removeClass("form-control mb-4 is-invalid state-invalid")
//             .addClass("form-control");
//         $("#voucher_date_validation").css("display", "none");
//     }
    
    var form = $("#account_voucher_entry_edit")[0];
    var id = $("#account_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/account-voucher-entry-update/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/account-voucher-entry";
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


$('#voucher_type').on('change', function() {
    if(this.value == 2)
    {
        $('#purpose_div').css('display','block');
        $('#sub_ledger_div').css('display','none');
        $('#main_ledger_div').css('display','none');
        
    }else{
        $('#purpose_div').css('display','none');
        $('#sub_ledger_div').css('display','block');
        $('#main_ledger_div').css('display','block');
    }
              
        });

  
    // Getting Sub Ledger

 $('#main_ledger').on('change', function() {
    
          id = this.value;
          if(id != '')
          {
           $("#sub_ledger").html("<option value=''>Select Sub Ledger</option>"); 
            let url = $('meta[name="base_url"]').attr("content") +
            "/getsubledger/" + id;
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
                     
                   if (res.data.length > 0) {
                  for (var i = 0; i < res.data.length; i++) {
                      text += $("#sub_ledger").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["name"] +
                            "</option>"
                    );
                    
                     }
                     
                     
                   }else{
                     $("#sub_ledger").html("<option value=''>Select Sub Ledger</option>");  
                   }
                },
            });
           
           }else{
              $("#sub_ledger").html("<option value=''>Select Sub Ledger</option>");  
           }
          
              
        });

  $('#tds').on('keyup', function() {
     var amount = $('#suspense_amount').val();
     if(amount == '' || amount == 0)
     {
         $("#suspense_amount")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#amount_validation").css("display", "block");
          $('#tds').val('')
     }else{
         $("#suspense_amount")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#amount_validation").css("display", "none");
    var tds = this.value / 100;
     
     var rupees = amount * tds;
     
     $('#rs').val(rupees.toFixed(2));
     }
     
              
        });
