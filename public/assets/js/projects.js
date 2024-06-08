// Search Bar
$(document).ready(function() {
             $('.btnprn').printPage();
        });
  function search_bar() {
            $(document).ready(function() {
                $("#plot_no_search").select2();
                $("#res_direction_id").select2();
                $("#res_plot_no_search").select2();
                $("#res_seacrh_direction_id").select2();
                
                
                
            });
        }
     

// Getting Plot Details
$('#project_id').on('change', function() {
          id = this.value;
         if(id != '')
         {
           $("#plot_id").html("<option value=''>Select Plot No</option>")
            $("#payment_plot_id").html("<option value=''>Select Plot No</option>")
            $("#booking_plot_id").html("<option value=''>Select Plot No</option>")
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-plot-list/" + id;
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
                    
                    
                      text_1 += $("#payment_plot_id").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["plot_no"] +
                            "</option>"
                    );
                    
                    
                      text_2 += $("#booking_plot_id").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["plot_no"] +
                            "</option>"
                    );
                    
                     }
                     
                    }
                    $("#plan").val(res.booking.plan).trigger('change');
                     if(res.booking.company_scope != null || res.booking.company_scope != '')
                    {
                         $('#company_scope_days').val(res.booking.company_scope);
                    }
                    
                     if(res.booking.customer_scope != null || res.booking.customer_scope != '')
                    {
                         $('#customer_scope_days').val(res.booking.customer_scope);
                    }
                    
                    
                     if(res.booking.booking_open_days != null || res.booking.booking_open_days != '')
                    {
                         $('#booking_open_days').val(res.booking.booking_open_days);
                    }
                    
                    
                     if(res.booking.registration_due_days != null || res.booking.registration_due_days != '')
                    {
                         $('#registration_due_days').val(res.booking.registration_due_days);
                    }
                   
                    
                    
                },
            });
         }else{
                     $("#plot_id").html("<option value=''>Select Plot No</option>"); 
                     $("#payment_plot_id").html("<option value=''>Select Plot No</option>"); 
                     $("#booking_plot_id").html("<option value=''>Select Plot No</option>"); 
                   }
              
        });
        
        
        // Getting Plot Details
$('#payment_project_id').on('change', function() {
          id = this.value;
         if(id != '')
         {
             $("#payment_plot_id").html("<option value=''>Select Plot No</option>")
              let url = $('meta[name="base_url"]').attr("content") +
            "/get-plots/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                      var text_1 = "";
                     if (res.data.length > 0) {
                       
                  for (var i = 0; i < res.data.length; i++) {
               
                    
                      text_1 += $("#payment_plot_id").append(
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
                      $("#payment_plot_id").html("<option value=''>Select Plot No</option>"); 
                      
                   }
              
        });
        
        

        
        
        
        
        $('#plot_id').on('change', function() {
          project_id = $('#project_id').val();
          id = this.value;
         
        if(id != '')
         {
              let url = $('meta[name="base_url"]').attr("content") +
            "/get-booking-list/"+ project_id +"/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id,
                    project_id : project_id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                     var text = "";
                     $('#sqft_rate').val(res.data.sqft_rate).prop("readonly", true);
                     $('#plot_size_sqft').val(res.data.plot_size_sqft).prop("readonly", true);
                     $('#plot_size_cent').val(res.data.plot_size_cent).prop("readonly", true);
                     $('#total_value').val(res.data.total_value).prop("readonly", true);
                    //  $('#payable').val(res.data.payable).prop("readonly", true);
                     $('#description').val(res.data.description).prop("readonly", true);
                 
                },
            });
         }else{
                      $('#sqft_rate').val('');
                      $('#plot_size_sqft').val('');
                      $('#plot_size_cent').val('');
                      $('#total_value').val('');
                    //   $('#payable').val('');
                      $('#description').val('');
                      
         } 
              
        });
        
        
         $('#account_type').on('change', function() {
       
          var account_type = this.value;
          if(account_type == 2)
          {
              $('#payment_term_source').val(1).trigger('change');
          }
        });
        
        
        $('#amount_towards').on('change', function() {
       
        
            
            $('#amount').val('');
            $('#discount').val('');
            $("#amount").trigger('keyup');
            $("#discount").trigger('keyup');
        });
        
        
        
      // Amount Changing
      $('#amount').on('keyup', function() {
          
        
          
         var amount_towards = $('#amount_towards').val();
        
         if(amount_towards == 1)
         {
         $('#amount').prop("readonly",false);
         var paid = $('#paid').val();
         var total_value = $('#total_value_mv').val();
         var old_amount = $('#old_amount').val();
         var balance = total_value - paid;
         var discount = $('#discount').val();
         var amount = this.value;
        //  var new_amount = old_amount - amount;
        
        //  var diff =  Math.abs(old_amount - amount);
        
         var total_balance = balance - amount - discount;
         
         if((total_balance >= 0))
         {
         $('#balance').val(total_balance).prop("readonly", true);
         $('#mv_balance').val(total_balance).prop("readonly", true);
         }else{
         swal("Warning!", 'MV Balance Amount is Lesser than the Amount',"warning"); 
         
         }
         
         if(total_balance == 0)
         {
           $('#discount').prop("readonly", true);  
         }else{
           $('#discount').prop("readonly", false);    
         }
         
         }
         else{
         var total_value = $('#total_value_gl').val();
         var old_amount = $('#gl_amount').val();
         var amount = this.value;
         var balance = total_value - old_amount;
         
         if(balance != 0)
         {
         $('#amount').prop("readonly",false);
         var discount = $('#discount').val();
        //   var diff =  Math.abs(old_amount - amount);
         
          var total_balance = balance - amount - discount;
          
           if((total_balance >= 0))
         {
       
         $('#gl_balance').val(total_balance).prop("readonly", true); 
         if(total_balance == 0)
         {
           $('#discount').prop("readonly", true);  
         }else{
           $('#discount').prop("readonly", false);    
         }
         
         var paid = $('#paid').val();
         var total_value = $('#total_value_mv').val();
         var old_amount = $('#old_amount').val();
         var balance = total_value - paid;
         
         var amount = this.value;
         var total_balance = balance - amount - discount;
         
         $('#balance').val(total_balance).prop("readonly", true);
         $('#mv_balance').val(total_balance).prop("readonly", true);
         }else{
           swal("Warning!", 'GL Balance Amount is Lesser than the Amount',"warning");     
         }
         }else{
         swal("Warning!", 'GL Amount Already Paid',"warning"); 
         $('#amount').prop("readonly",true);
         }
       
        
         
         
         }
         
      });
      
      
      
      $('#discount').on('change', function() {
           
         var amount_towards = $('#amount_towards').val();
         if($('#fully_paid').prop('checked') == false)
          { 
         if(amount_towards == 1)
         {
         var paid = $('#paid').val();
         var total_value = $('#total_value_mv').val();
         var old_amount = $('#old_amount').val();
         var balance = total_value - paid;
         var paid_amt = $('#amount').val();
         var amount = this.value;
         
         var total_balance = balance - amount - paid_amt;
         
   
         $('#balance').val(total_balance).prop("readonly", true);
         $('#mv_balance').val(total_balance).prop("readonly", true);
         
         
        //  var total_value = $('#total_value_gl').val();
        //  var old_amount = $('#gl_amount').val();
        //  var amount = this.value;
        //  var balance = total_value - old_amount;
        
        //  if(balance > 0)
        // {
        //   var total_balance = balance - amount;
        //   $('#gl_balance').val(total_balance).prop("readonly", true);   
        // }
         
         }
         else{
         var total_value = $('#total_value_gl').val();
         var old_amount = $('#gl_amount').val();
         var amount = this.value;
         var balance = total_value - old_amount;
         var paid_amt = $('#amount').val();
        
        if(balance > 0)
        {
          var total_balance = balance - amount - paid_amt;
          
         $('#gl_balance').val(total_balance).prop("readonly", true);
           
        }
        
         var paid = $('#paid').val();
         var total_value = $('#total_value_mv').val();
         var old_amount = $('#old_amount').val();
         var balance = total_value - paid;
         var paid_amt = $('#amount').val();
         var amount = this.value;
        //  var new_amount = old_amount - amount;
        
        //  var diff =  Math.abs(old_amount - amount);
        
         var total_balance = balance - amount - paid_amt;
         
    
         $('#balance').val(total_balance).prop("readonly", true);
         $('#mv_balance').val(total_balance).prop("readonly", true);
         
         
         }
          }else{
         var paid = $('#paid').val();
         var total_value = $('#total_value_mv').val();
         var old_amount = $('#old_amount').val();
       
         var balance = total_value - paid;
         
         var amount = this.value;
         
          var last_amt = balance - amount;
         $('#amount').val(last_amt);
         
        //  var paid_amt = parseFloat($('#amount').val()) + parseFloat(amount);
        //  var total_balance = balance  - paid_amt;
          
        //  $('#balance').val(total_balance).prop("readonly", true);
        //  $('#mv_balance').val(total_balance).prop("readonly", true);
     
          }
         
      });
      
      
      $('#booking_amount').on('keyup', function() {
        //  var paid = $('#balance').val();
         var total_value = $('#total_value_mv').val();
         var old_amount = $('#old_amount').val();
         var amount = this.value;
         var balance = old_amount - amount;
        
        
          var diff =  Math.abs(old_amount - amount);
          var total_balance = total_value - amount;
       
         $('#balance').val(total_balance).prop("readonly", true);
         
      });
      
      
      $('#payment_term_source').on('change', function() {
          var account_type = $('#account_type').val();
          if(account_type == 2 && this.value != 1)
          {
            swal("Warning!",'Advance Payment Source Allows Own Fund ONly..!' ,"warning"); 
            $('#payment_term_source').val(1).trigger('change');
           
      }
      
      var id = $('#payment_term_source').val();
    
    if(id != '')
         {
             $("#pay_mode").html("<option value=''>Select Pay Mode</option>")
              let url = $('meta[name="base_url"]').attr("content") +
            "/get-paymode-list/"+ id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id,
                 
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    
                    var text = "";
                     
                    if (res.data.length > 0) {
                       
                  for (var i = 0; i < res.data.length; i++) {
                       text += $("#pay_mode").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["name"] +
                            "</option>"
                    );
                  }
                    }
             },
            });
         }else{
             $("#pay_mode").html("<option value=''>Select Pay Mode</option>")
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-paymode-list";
          $.ajax({
                url: url,
                method: "GET",
                 
                contentType: false,
                processData: false,
                success: function(res) {
                    
                    var text = "";
                     
                    if (res.data.length > 0) {
                       
                  for (var i = 0; i < res.data.length; i++) {
                       text += $("#pay_mode").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["name"] +
                            "</option>"
                    );
                  }
                    }
             },
            });
             
         } 
              
          
      });
       
        $('#payment_term').on('change', function() {
           if(this.value == 1)
           {
               $('#loan_company_div').css('display','none');
           }else{
               $('#loan_company_div').css('display','block');
           }
       });
       
       
      // Plot Details
      
      $('#plan').on('change', function() {
         $('#booking_plot_id').trigger("change");  
         
        
      });
      
      
      $('#booking_plot_id').on('change', function() {
          project_id = $('#project_id').val();
          plan = $('#plan').val();
          id = this.value;
         
        if(id != '')
         {
              let url = $('meta[name="base_url"]').attr("content") +
            "/get_plot_details/"+ project_id +"/" + id ;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id,
                    project_id : project_id,
                   
                },
                contentType: false,
                processData: false,
                success: function(res) {
                     var text = "";
                     if(res.status == true)
                     {
                        
                          
                         
                         if(plan == 1)
                         {
                             var market_value = res.project.market_value;
                         } 
                         
                         if(plan == 2)
                         {
                             var market_value = res.project.market_value_b;
                         } 
                      
                         if(plan == 3)
                         {
                             var market_value = res.project.market_value_c;
                         } 
                         
                     
                      
                     var market_value_total = market_value * res.data.plot_sq_ft;
                     var tot = parseFloat(res.data.total_value - res.paid);
                    //  $('#sqft_rate').val(res.data.sq_ft_rate).prop("readonly", true);
                     $('#plot_size_sqft').val(res.data.plot_sq_ft).prop("readonly", true);
                     
                    
                     $('#total_value_mv').val(Math.round(market_value_total)).prop("readonly", true);
                     
                     
                     $('#total_value_gl').val(Math.round(res.data.guide_line_plot_rate)).prop("readonly", true);
                     
                     var cent = res.data.plot_sq_ft / 435.56;
                     var cent_value = cent.toFixed(2);
                     $('#plot_size_cent').val(cent_value).prop("readonly", true);
                     $('#market_sqft_rate').val(market_value).prop("readonly", true);
                     $('#guide_line_sqft_rate').val(res.project.guide_line).prop("readonly", true);
                     
                    //  $('#payable').val(res.data.market_value_plot_rate).prop("readonly", true);
                     $('#description').val(res.data.description).prop("readonly", true);  
                     
                     if(plan == 1)
                     {
                         plan_name = "No Market Value Assigned for Plan A";
                     }else if(plan == 2)
                     {
                        plan_name = "No Market Value Assigned for Plan B"; 
                     }else{
                        plan_name = "No Market Value Assigned for Plan C";
                     }
                     
                     var market_val = $('#total_value_mv').val();
                    if(market_val == 0)
                    {
                        swal("Warning!",plan_name ,"warning");   
                    }
              if(market_val != 0)      
              {
                  
             var plan_id = $('#plan_id').val();
         
             if(plan_id != this.value)
             {
             var total_mv = $('#total_value_mv').val();
             
             
             var old_amount = $('#old_amount').val();
             
             var balance = total_mv - old_amount;
             
             $('#balance').val(Math.round(balance)).prop("readonly",true);
             
               }
         
              }
         
                     }
                     
                     else{
                      $('#sqft_rate').val('');
                      $('#plot_size_sqft').val('');
                      $('#plot_size_cent').val('');
                      $('#market_sqft_rate').val('');
                      $('#guide_line_sqft_rate').val('');
                      $('#total_value_gl').val('');
                      $('#total_value_mv').val('');
                    //   $('#payable').val('');
                      $('#description').val('');
                      
                     }
              
              
                },
            });
         }else{       
                      $('#sqft_rate').val('');
                      $('#plot_size_sqft').val('');
                      $('#plot_size_cent').val('');
                      $('#total_value_gl').val('');
                      $('#total_value_mv').val('');
                      $('#market_sqft_rate').val('');
                      $('#guide_line_sqft_rate').val('');
                    //   $('#payable').val('');
                      $('#description').val('');
                       
         } 
              
        });
        
   // Getting Booking Details
   
$('#payment_plot_id').on('change', function() {
          project_id = $('#payment_project_id').val();
          id = this.value;
         
        if(id != '')
         {
              let url = $('meta[name="base_url"]').attr("content") +
            "/get-booking-list/"+ project_id +"/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id,
                    project_id : project_id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                     var text = "";
                     if(res.status == true)
                     {
                     var tot = parseFloat(res.data.total_value_mv - res.paid);
                      
                     var total_gl = res.data.total_value_gl - res.paid;
                     $('#gl_balance').val(total_gl).prop("readonly", true);
                     $('#paid').val(res.paid).prop("readonly", true);
                     $('#balance').val(tot).prop("readonly", true);
                     $('#old_balance').val(tot).prop("readonly", true);
                     $('#gl_rate').val(res.guide_line).prop("readonly", true);
                     $('#customer_id').val(res.customer_id);
                    //  $('#sqft_rate').val(res.data.sqft_rate).prop("readonly", true);
                     $('#plot_size_sqft').val(res.data.plot_size_sqft).prop("readonly", true);
                     $('#plot_size_cent').val(res.data.plot_size_cent).prop("readonly", true);
                     $('#total_value_gl').val(res.data.total_value_gl).prop("readonly", true);
                     $('#total_value_mv').val(res.data.total_value_mv).prop("readonly", true);
                     $('#market_sqft_rate').val(res.data.market_value_sqft).prop("readonly", true);
                     $('#guide_line_sqft_rate').val(res.data.guide_line_sqft).prop("readonly", true);
                    //  $('#payable').val(res.data.total_value_mv).prop("readonly", true);
                     $('#description').val(res.data.description).prop("readonly", true);
                     $('#customer_name').val(res.customer_name).prop("readonly", true);
                     $('#mobile').val(res.mobile).prop("readonly", true);
                     $('#alternate_mobile').val(res.alternate_mobile).prop("readonly", true);
                     
                      $('#marketer_code').val(res.data.marketer_code);
                      $('#marketer_name').val(res.data.marketer_name).prop("readonly", true);
                      $('#designation').val(res.data.designation).prop("readonly", true);
                      $('#marketer_mobile').val(res.data.marketer_mobile).prop("readonly", true);
                     var text = "";
                  if (res.marketer.length > 0) {
                     
                      $("#marketer_table tbody").empty();
                      $("#marketer_table tbody").append(res.marketer);
             
                    }else{
                        $("#marketer_table tbody").empty();
                        $('#marketer_table tbody').append('<tr><td colspan=5 style="text-align : center">No Data Found</td></tr>');
                   
                   }  
                   
                   if (res.payment_history.length > 0) {
                     
                     $("#payment_table tbody").empty();
                      $("#payment_table tbody").append(res.payment_history);
             
                    }else{
                        $("#payment_table tbody").empty();
                        $('#payment_table tbody').append('<tr><td colspan=8 style="text-align : center">No Data Found</td></tr>');
                   
                   }         
                     }
                     
                     else{
                      $('#paid').val('');
                      $('#balance').val('');
                      $('#gl_rate').val('');
                      $('#customer_id').val('');
                      $('#old_balance').val('');
                      $('#sqft_rate').val('');
                      $('#plot_size_sqft').val('');
                      $('#plot_size_cent').val('');
                      $('#total_value_gl').val('');
                      $('#total_value_mv').val('');
                    //   $('#payable').val('');
                      $('#description').val('');
                      $('#customer_name').val('');
                      $('#mobile').val('');
                      $('#alternate_mobile').val('');
                      $('#marketer_code').val('');
                      $('#marketer_name').val('') ;
                      $('#designation').val('') ;
                      $('#marketer_mobile').val('') ;
                      $('#market_sqft_rate').val('');
                      $('#guide_line_sqft_rate').val('');
                      $("#marketer_table tbody").empty();
                      $('#marketer_table tbody').append('<tr><td colspan=5 style="text-align : center">No Data Found</td></tr>');
                      $("#payment_table tbody").empty();
                      $('#payment_table tbody').append('<tr><td colspan=8 style="text-align : center">No Data Found</td></tr>'); 
                     }
              
              
                },
            });
         }else{       
                      $('#paid').val('');
                      $('#balance').val('');
                      $('#gl_rate').val('');
                      $('#customer_id').val('');
                      $('#sqft_rate').val('');
                      $('#plot_size_sqft').val('');
                      $('#plot_size_cent').val('');
                      $('#total_value_gl').val('');
                      $('#total_value_mv').val('');
                    //   $('#payable').val('');
                      $('#old_balance').val('');
                      $('#description').val('');
                      $('#customer_name').val('');
                      $('#mobile').val('');
                      $('#alternate_mobile').val('');
                      $('#marketer_code').val('');
                      $('#marketer_name').val('') ;
                      $('#designation').val('') ;
                      $('#marketer_mobile').val('') ;
                      $('#market_sqft_rate').val('');
                      $('#guide_line_sqft_rate').val('');
                      $("#marketer_table tbody").empty();
                      $('#marketer_table tbody').append('<tr><td colspan=5 style="text-align : center">No Data Found</td></tr>');
                      $("#payment_table tbody").empty();
                      $('#payment_table tbody').append('<tr><td colspan=8 style="text-align : center">No Data Found</td></tr>');
         } 
              
        });
        
        
        $('#marketer_code').on('change',function(){
            
            $("#tbodyid").empty();

          id = this.value;
          let url = $('meta[name="base_url"]').attr("content") +
            "/get-marketer-details/" + id;
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
                      $('#marketer_id').val(res.marketer_id).prop("readonly", true);
                      $('#marketer_name').val(res.name).prop("readonly", true);
                      $('#designation').val(res.designation).prop("readonly", true);
                      $('#marketer_mobile').val(res.mobile).prop("readonly", true);
                     var text = "";
                  if (res.data.length > 0) {
                     
                      $("#marketer_table tbody").empty();
                      $("#marketer_table tbody").append(res.data);
             
                    }else{
                        $("#marketer_table tbody").empty();
                        $('#marketer_table tbody').append('<tr><td colspan=5>No Data Found</td></tr>');
                    
                   }  
                     }else{
                        swal("Warning!", 'Data is Not Valid',"warning");   
                        $('#marketer_code').val('')
                        $('#marketer_id').val('');
                        $('#marketer_name').val('');
                        $('#designation').val('');
                        $('#marketer_mobile').val('');
                        $("#marketer_table tbody").empty();
                        $('#marketer_table tbody').append('<tr><td colspan=5>No Data Found</td></tr>');
                     }
                    
                },
            });
              
         })

// Getting Project Incharge

 $('#pay_mode').on('change', function() {
          pay_mode = this.value;
          if(pay_mode == 2)
          {
              $('#cheque_no_div').css('display','block');
              $('#cheque_date_div').css('display','block');
              $('#bank_name_div').css('display','block');
              $('#bank_branch_div').css('display','block');
              $('#account_no_div').css('display','none');
              $('#ifsc_code_div').css('display','none');
              $('#dd_no_div').val('').css('display','none');
              $('#dd_date_div').val('').css('display','none'); 
              $('#transfer_no_div').val('').css('display','none');
              $('#transfer_date_div').val('').css('display','none'); 
              $('#online_trans_no_div').val('').css('display','none'); 
              $('#online_trans_date_div').val('').css('display','none');
          }
          else if(pay_mode == 4)
          {
              $('#online_trans_no_div').css('display','block'); 
              $('#online_trans_date_div').css('display','block');
              $('#transfer_no_div').val('').css('display','none'); 
              $('#transfer_date_div').val('').css('display','none'); 
              $('#bank_name_div').css('display','block');
              $('#bank_branch_div').css('display','block');
              $('#account_no_div').css('display','block');
              $('#ifsc_code_div').css('display','block');
              $('#cheque_no_div').val('').css('display','none');
              $('#cheque_date_div').val('').css('display','none');
              $('#dd_no_div').val('').css('display','none');
              $('#dd_date_div').val('').css('display','none'); 
          }
          else if(pay_mode == 3 )
          {
              $('#dd_no_div').css('display','block');
              $('#dd_date_div').css('display','block'); 
              $('#bank_name_div').css('display','block');
              $('#bank_branch_div').css('display','block');
              $('#account_no_div').css('display','block');
              $('#ifsc_code_div').css('display','block');
              $('#cheque_no_div').val('').css('display','none');
              $('#cheque_date_div').val('').css('display','none');
              $('#transfer_no_div').val('').css('display','none');
              $('#transfer_date_div').val('').css('display','none');
              $('#online_trans_no_div').val('').css('display','none'); 
              $('#online_trans_date_div').val('').css('display','none');
          } 
          else if(pay_mode == 5 )
          {
              $('#bank_name_div').css('display','block');
              $('#bank_branch_div').css('display','block');
              $('#online_trans_no_div').val('').css('display','none'); 
              $('#online_trans_date_div').val('').css('display','none');
              $('#account_no_div').css('display','block');
              $('#ifsc_code_div').css('display','block');
              $('#cheque_no_div').val('').css('display','none');
              $('#cheque_date_div').val('').css('display','none');
              $('#transfer_no_div').css('display','block');
              $('#transfer_date_div').css('display','block');
              $('#dd_no_div').val('').css('display','none');
              $('#dd_date_div').val('').css('display','none'); 
          }
          else{
              $('#bank_name_div').val('').css('display','none');
              $('#bank_branch_div').val('').css('display','none');
              $('#account_no_div').val('').css('display','none');
              $('#ifsc_code_div').val('').css('display','none');
              $('#cheque_no_div').val('').css('display','none');
              $('#cheque_date_div').val('').css('display','none');
              $('#transfer_no_div').val('').css('display','none'); 
              $('#transfer_date_div').val('').css('display','none');
              $('#dd_no_div').val('').css('display','none');
              $('#dd_date_div').val('').css('display','none'); 
              $('#online_trans_no_div').val('').css('display','none'); 
              $('#online_trans_date_div').val('').css('display','none');
          }
              
    });
    
    
    $('#customer_id').on('change', function() {
          id = this.value;
          if(id != '')
          {
           let url = $('meta[name="base_url"]').attr("content") +
            "/get-customers/" + id;
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
                       $("#existing_cusotmer").val(res.data.customer_name);  
                       $('#title').val(res.data.title).trigger("change");
                       $('#select').val(res.data.title).trigger("change");
                       $('#relation_name').val(res.data.relation_name).prop("readonly", true);
                       $('#dob').val(res.data.dob).trigger("change");
                       $('#gender').val(res.data.gender).trigger("change");
                       $('#email').val(res.data.email).prop("readonly", true);
                       $('#customer_name').val(res.data.customer_name).prop("readonly", true);
                       $('#mobile').val(res.data.mobile).prop("readonly", true);
                       $('#alternate_mobile').val(res.data.alternate_mobile).prop("readonly", true);
                       $('#street').val(res.data.street).prop("readonly", true);
                       $('#pincode').val(res.data.pincode).prop("readonly", true);
                       var text = "";
                       var text_2 = "";
                    if (res.areas.length > 0) {
                     for (var i = 0; i < res.areas.length; i++) {
                       text += $("#area").append(
                        '<option value="' +
                            res.areas[i]["id"] +
                            '">' +
                            res.areas[i]["area"] +
                            "</option>"
                    );
                    
                  }
                    }
                      if (res.state.length > 0) {
                       
                  for (var i = 0; i < res.state.length; i++) {
                       text += $("#state_id").append(
                        '<option value="' +
                            res.state[i]["id"] +
                            '">' +
                            res.state[i]["state"] +
                            "</option>"
                    );
                    
                  }
                    }
                    
                    if (res.city.length > 0) {
                       
                  for (var i = 0; i < res.city.length; i++) {
                       text += $("#city_id").append(
                        '<option value="' +
                            res.city[i]["id"] +
                            '">' +
                            res.city[i]["city"] +
                            "</option>"
                    );
                    
                  }
                    }
                    
                    
                       $('#area').val(res.data.area).trigger("change");
                       $('#city_id').val(res.data.city).trigger("change");
                       $('#state_id').val(res.data.state).trigger("change");
                       $('#country_id').val(res.data.country).trigger("change");
                       
                    }else{
                        // $("#existing_cusotmer").val('');
                         swal("Failed!", 'No Data Found',"error"); 
                        //   $('#customer_details_div').css('display','block');
                    }
                    
                       
                   
                },
            });   
          }else{
                       $("#existing_cusotmer").val('').prop("readonly", false);    
                       $('#title').val('').trigger("change"); 
                       $('#select').val('').trigger("change"); 
                       $('#relation_name').val('').prop("readonly", false);    
                       $('#dob').val('').prop("readonly", false);   
                       $('#gender').val('').trigger("change");  
                       $('#email').val('').prop("readonly", false);   
                       $('#customer_name').val('').prop("readonly", false);   
                       $('#mobile').val('').prop("readonly", false);  
                       $('#alternate_mobile').val('').prop("readonly", false);   
                       $('#street').val('').prop("readonly", false);    
                       $('#pincode').val('').prop("readonly", false);    
                       $('#area').val('').trigger("change");;  
                       $('#city_id').val('').trigger("change");;  
                       $('#state_id').val('').trigger("change");;  
                       $('#country_id').val('').trigger("change");;  
               $('#customer_details_div').css('display','block');
          }
           
              
    });
   
    $('#fully_paid').on('click', function() {
          id = this.value;
           $('#discount').prop("readonly", false);
          if($('#fully_paid').prop('checked') == true)
          {
          var balance_mv = $('#balance').val();
          $('#amount').val(balance_mv);
          $('#amount').prop("readonly", true);
          $('#balance').val(0).prop("readonly", true);
          $('#mv_balance').val(0).prop("readonly", true)  
          $('#gl_balance').val(0).prop("readonly", true)  
          }else{
           $('#amount').val(0);
           
           var total_value_gl = $('#total_value_gl').val();
           var gl_amount = $('#gl_amount').val();
           
           var total_gl_balance = total_value_gl - gl_amount;
           
           var total_value_mv = $('#total_value_mv').val();
           var mv_amount = $('#mv_amount').val();
           
           var total_mv_balance = total_value_mv - mv_amount;
           $('#amount').prop("readonly", false);
          $('#balance').val(total_mv_balance).prop("readonly", true);
          $('#discount').val('');
          $('#mv_balance').val(total_mv_balance).prop("readonly", true)  
          $('#gl_balance').val(total_gl_balance).prop("readonly", true)  
          }
        
          
        //   $('#discount').prop("readonly", true);
    });
    
    // $('#existing').on('click', function() {
    //       id = this.value;
          
    //       if($('#existing').prop('checked') == true)
    //       {
    //           $('#customer_details_div').css('display','none');
    //       }else{
    //           $('#customer_details_div').css('display','block');
    //           $('#customer_id').val('');
    //           $('#existing_cusotmer').val();
    //       }
        
              
    // });
        
// Plot management
$("#Add_PlotForm").submit(function (e) {
    e.preventDefault();
    if ($("#direction_id").val() == "" || $("#direction_id").val() == null) {
        $("#direction_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#direction_validation").css("display", "block");
    } else {
        $("#direction_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#direction_validation").css("display", "none");
    }
    if ($("#plot_rate").val() == "" || $("#plot_rate").val() == null) {
        $("#plot_rate")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#plot_rate_validation").css("display", "block");
    } else {
        $("#plot_rate")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#plot_rate_validation").css("display", "none");
    }
    if ($("#plot_sq_ft").val() == "" || $("#plot_sq_ft").val() == null) {
        $("#plot_sq_ft")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#plot_sqft_validation").css("display", "block");
    } else {
        $("#plot_sq_ft")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#plot_sqft_validation").css("display", "none");
    }
    if ($("#plot_no").val() == "" || $("#plot_no").val() == null) {
        $("#plot_no")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#plot_no_validation").css("display", "block");
    } else {
        $("#plot_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#plot_no_validation").css("display", "none");
    }
    if ($("#sq_ft_rate").val() == "" || $("#sq_ft_rate").val() == null) {
        $("#sq_ft_rate")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#sqft_rate_validation").css("display", "block");
    } else {
        $("#sq_ft_rate")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#sqft_rate_validation").css("display", "none");
    }
    if ($("#type_id").val() == "" || $("#type_id").val() == null) {
        $("#type_id")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#type_validation").css("display", "block");
    } else {
        $("#type_id")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#type_validation").css("display", "none");
    }
    if ($("#project_id").val() == "" || $("#project_id").val() == null) {
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#project_name_validation").css("display", "block");
    } else {
        $("#project_id")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#project_name_validation").css("display", "none");
    }

    var form = $("#Add_PlotForm")[0];
    var formData = new FormData(form);
    var url = $('meta[name="base_url"]').attr("content") + "/plot-store";
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/plot-management";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $(".err").html("");
                $("#plot_no").val("");
                $("#plot_sq_ft").val("");
                $("#guide_line_plot_rate").val("");
                $("#market_value_plot_rate").val("");
                $("#direction_id").val("").trigger("change");
                $("#exist_plot_no_validation").css("display", "none");
                search_bar(); // call back function
                $("#table_body").html(data.html);
                swal("Success!", "Plot Created Successfully!", "success");
            } else {
                if (data.message == "Plot No Already Exist!") {
                    $("#plot_no")
                        .removeClass("form-control")
                        .addClass("form-control mb-4 is-invalid state-invalid")
                        .focus();
                    $("#exist_plot_no_validation").css("display", "block");
                } else {
                    $("#plot_no")
                        .removeClass(
                            "form-control mb-4 is-invalid state-invalid"
                        )
                        .addClass("form-control");
                    $("#exist_plot_no_validation").css("display", "none");
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

$("#Edit_PlotForm").submit(function (e) {
    e.preventDefault();
    if (
        $("#edit_direction_id").val() == "" ||
        $("#edit_direction_id").val() == null
    ) {
        $("#edit_direction_id")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#edit_direction_validation").css("display", "block");
    } else {
        $("#edit_direction_id")
            .removeClass("form-control is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#edit_direction_validation").css("display", "none");
    }
    if (
        $("#edit_plot_rate").val() == "" ||
        $("#edit_plot_rate").val() == null
    ) {
        $("#edit_plot_rate")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#edit_plot_rate_validation").css("display", "block");
    } else {
        $("#edit_plot_rate")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#edit_plot_rate_validation").css("display", "none");
    }
    if (
        $("#edit_plot_sq_ft").val() == "" ||
        $("#edit_plot_sq_ft").val() == null
    ) {
        $("#edit_plot_sq_ft")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#edit_plot_sq_ft_validation").css("display", "block");
    } else {
        $("#edit_plot_sq_ft")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#edit_plot_sq_ft_validation").css("display", "none");
    }
    if ($("#edit_plot_no").val() == "" || $("#edit_plot_no").val() == null) {
        $("#edit_plot_no")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#edit_plot_no_validation").css("display", "block");
    } else {
        $("#edit_plot_no")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#edit_plot_no_validation").css("display", "none");
    }
    if (
        $("#edit_sq_ft_rate").val() == "" ||
        $("#edit_sq_ft_rate").val() == null
    ) {
        $("#edit_sq_ft_rate")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#edit_sqft_rate_validation").css("display", "block");
    } else {
        $("#edit_sq_ft_rate")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#edit_sqft_rate_validation").css("display", "none");
    }
    if ($("#edit_type_id").val() == "" || $("#edit_type_id").val() == null) {
        $("#edit_type_id")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#edit_type_validation").css("display", "block");
    } else {
        $("#edit_type_id")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#edit_type_validation").css("display", "none");
    }
    if (
        $("#edit_project_id").val() == "" ||
        $("#edit_project_id").val() == null
    ) {
        $("#edit_project_id")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#edit_project_name_validation").css("display", "block");
    } else {
        $("#edit_project_id")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control")
            .focus();
        $("#edit_project_name_validation").css("display", "none");
    }
    var form = $("#Edit_PlotForm")[0];
    var id = $("#edit_plot_id").val();
    var formData = new FormData(form);
    var update = $('meta[name="base_url"]').attr("content") + "/plot/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/plot-management";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                $(".err").html("");
                $("#plot_no").val("");
                $("#plot_sq_ft").val("");
                $("#guide_line_plot_rate").val("");
                $("#market_value_plot_rate").val("");
                $("#direction_id").val("").trigger("change");
                $("#Edit_plotModal").modal("hide");
                $("#edit_exist_plot_no_validation").css("display", "none");
                search_bar(); // call back function
                $("#table_body").html(data.html);
            } else {
                if (data.message == "Plot No Already Exist!") {
                    $("#edit_plot_no")
                        .removeClass("form-control")
                        .addClass("form-control mb-4 is-invalid state-invalid")
                        .focus();
                    $("#edit_exist_plot_no_validation").css("display", "block");
                } else {
                    $("#edit_plot_no")
                        .removeClass(
                            "form-control mb-4 is-invalid state-invalid"
                        )
                        .addClass("form-control");
                    $("#edit_exist_plot_no_validation").css("display", "none");
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

//plot square fit edit
$("#Plot_sqft_edit_Form").submit(function (e) {
    e.preventDefault();
    if ($("#valid_reason").val() == "" || $("#valid_reason").val() == null) {
        $("#valid_reason")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#valid_reason_validation").css("display", "block");
    } else {
        $("#valid_reason")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#valid_reason_validation").css("display", "none");
    }
    if (
        $("#edit_new_plot_sq_ft").val() == "" ||
        $("#edit_new_plot_sq_ft").val() == null
    ) {
        $("#edit_new_plot_sq_ft")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#new_plot_sq_ft_validation").css("display", "block");
    } else {
        $("#edit_new_plot_sq_ft")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#new_plot_sq_ft_validation").css("display", "none");
    }
    if (
        $("#edit_new_plot_no").val() == "" ||
        $("#edit_new_plot_no").val() == null
    ) {
        $("#edit_new_plot_no")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#new_plot_no_validation").css("display", "block");
    } else {
        $("#edit_new_plot_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#new_plot_no_validation").css("display", "none");
    }
    // if (
    //     $("#edit_ini_plot_sq_ft").val() == "" ||
    //     $("#edit_ini_plot_sq_ft").val() == null
    // ) {
    //     $("#edit_ini_plot_sq_ft")
    //         .removeClass("form-control")
    //         .addClass("form-control mb-4 is-invalid state-invalid")
    //         .focus();
    //     $("#ini_plot_sq_ft_validation").css("display", "block");
    // } else {
    //     $("#edit_ini_plot_sq_ft")
    //         .removeClass("form-control mb-4 is-invalid state-invalid")
    //         .addClass("form-control");
    //     $("#ini_plot_sq_ft_validation").css("display", "none");
    // }
    if (
        $("#edit_ini_plot_no").val() == "" ||
        $("#edit_ini_plot_no").val() == null
    ) {
        $("#edit_ini_plot_no")
            .removeClass("form-control")
            .addClass("form-control is-invalid state-invalid")
            .focus();
        $("#ini_plot_no_validation").css("display", "block");
    } else {
        $("#edit_ini_plot_no")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#ini_plot_no_validation").css("display", "none");
    }
    if (
        $("#edit_project_id").val() == "" ||
        $("#edit_project_id").val() == null
    ) {
        $("#edit_project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#project_name_validation").css("display", "block");
    } else {
        $("#edit_project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#project_name_validation").css("display", "none");
    }
    var form = $("#Plot_sqft_edit_Form")[0];
    var id = $("#plot_sqft_edit_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") +
        "/plot-sqft/" +
        id +
        "/update";

    var redirect =
        $('meta[name="base_url"]').attr("content") + "/plot-management";
    if (id != "") {
        $.ajax({
            url: update,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == true) {
                    $("#Plot_sqft_edit_Form")[0].reset();
                    swal("Updated!", data.message, "success");
                    $("#old_edit_ini_plot_sq_ft").val("");
                    $("#exist_plot_no_validation").css("display", "none");
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                    // $("#Table_body").html(data.html);
                } else {
                    if (data.message == "Plot No Already Exist!") {
                        $("#edit_new_plot_no")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#exist_plot_no_validation").css("display", "block");
                    } else {
                        $("#edit_new_plot_no")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#exist_plot_no_validation").css("display", "none");
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
    }
});


//commission updation
$("#Add_CommissionForm").submit(function (e) {
    e.preventDefault();
    
    var commission_type = $("#commission_type").val();
    if (commission_type == 1) {
        if (
            $(".percentage_validation").val() == "" ||
            $(".percentage_validation").val() == null
        ) {
            $(".percentage_validation")
                .removeClass("form-control")
                .addClass("form-control  is-invalid state-invalid")
                .focus();
            var Plan_value = $("#plan_id").val();
            if (Plan_value != "") {
                if ($("#mv_sq_ft").val() == "" || $("#mv_sq_ft") == null) {
                    $("#mv_sq_ft")
                        .removeClass("form-control")
                        .addClass("form-control is-invalid state-invalid");
                    $("#mv_sq_ft_validation").css("display", "block");
                } else {
                    $("#mv_sq_ft")
                        .removeClass("form-control is-invalid state-invalid")
                        .addClass("form-control");
                    $("#mv_sq_ft_validation").css("display", "none");
                }
            }
            if ($("#plan_id").val() == "" || $("#plan_id").val() == null) {
                $("#plan_id")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#plan_validation").css("display", "block");
                $("#exist_plan_validation").css("display", "none");
            } else {
                $("#plan_id")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#plan_validation").css("display", "none");
                $("#exist_plan_validation").css("display", "none");
            }
            if (
                $("#commission_type").val() == "" ||
                $("#commission_type").val() == null
            ) {
                $("#commission_type")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#commission_type_validation").css("display", "block");
            } else {
                $("#commission_type")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#commission_type_validation").css("display", "none");
            }
            if (
                $("#project_id").val() == "" ||
                $("#project_id").val() == null
            ) {
                $("#project_id")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#project_name_validation").css("display", "block");
            } else {
                $("#project_id")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#project_name_validation").css("display", "none");
            }
            return;
        } else {
            $(".percentage_validation")
                .removeClass("form-control  is-invalid state-invalid")
                .addClass("form-control");
            $("#mv_sq_ft_validation").css("display", "none");
        }
    }

    if (commission_type == 2) {
        if (
            $(".cash_validation").val() == "" ||
            $(".cash_validation").val() == null
        ) {
            $(".cash_validation")
                .removeClass("form-control")
                .addClass("form-control  is-invalid state-invalid")
                .focus();
            var Plan_value = $("#plan_id").val();
            if (Plan_value != "") {
                if ($("#mv_sq_ft").val() == "" || $("#mv_sq_ft") == null) {
                    $("#mv_sq_ft")
                        .removeClass("form-control")
                        .addClass("form-control is-invalid state-invalid");
                    $("#mv_sq_ft_validation").css("display", "block");
                } else {
                    $("#mv_sq_ft")
                        .removeClass("form-control is-invalid state-invalid")
                        .addClass("form-control");
                    $("#mv_sq_ft_validation").css("display", "none");
                }
            }
            if ($("#plan_id").val() == "" || $("#plan_id").val() == null) {
                $("#plan_id")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#plan_validation").css("display", "block");
                $("#exist_plan_validation").css("display", "none");
            } else {
                $("#plan_id")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#plan_validation").css("display", "none");
                $("#exist_plan_validation").css("display", "none");
            }
            if (
                $("#commission_type").val() == "" ||
                $("#commission_type").val() == null
            ) {
                $("#commission_type")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#commission_type_validation").css("display", "block");
            } else {
                $("#commission_type")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#commission_type_validation").css("display", "none");
            }
            if (
                $("#project_id").val() == "" ||
                $("#project_id").val() == null
            ) {
                $("#project_id")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#project_name_validation").css("display", "block");
            } else {
                $("#project_id")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#project_name_validation").css("display", "none");
            }
            return;
        } else {
            $(".cash_validation")
                .removeClass("form-control  is-invalid state-invalid")
                .addClass("form-control");
            $("#mv_sq_ft_validation").css("display", "none");
        }
    }
    var Plan_value = $("#plan_id").val();
    if (Plan_value != "") {
        if ($("#mv_sq_ft").val() == "" || $("#mv_sq_ft") == null) {
            $("#mv_sq_ft")
                .removeClass("form-control")
                .addClass("form-control is-invalid state-invalid");
            $("#mv_sq_ft_validation").css("display", "block");
        } else {
            $("#mv_sq_ft")
                .removeClass("form-control is-invalid state-invalid")
                .addClass("form-control");
            $("#mv_sq_ft_validation").css("display", "none");
        }
    }
    if ($("#plan_id").val() == "" || $("#plan_id").val() == null) {
        $("#plan_id")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#plan_validation").css("display", "block");
        $("#exist_plan_validation").css("display", "none");
    } else {
        $("#plan_id")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#plan_validation").css("display", "none");
        $("#exist_plan_validation").css("display", "none");
    }
    if (
        $("#commission_type").val() == "" ||
        $("#commission_type").val() == null
    ) {
        $("#commission_type")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#commission_type_validation").css("display", "block");
    } else {
        $("#commission_type")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#commission_type_validation").css("display", "none");
    }
    if ($("#project_id").val() == "" || $("#project_id").val() == null) {
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#project_name_validation").css("display", "block");
    } else {
        $("#project_id")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#project_name_validation").css("display", "none");
    }
    var form = $("#Add_CommissionForm")[0];
    var url = $("#url").val();
    var total_cash_amt = $("#total_cash_amt").val();
    var total_percentage_amt = $("#total_percentage_amt").val();
    var formData = new FormData(form);
    formData.append("total_cash_amt", total_cash_amt);
    formData.append("total_percentage_amt", total_percentage_amt);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/commission-details";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_CommissionForm")[0].reset();
                $(".err").html("");
                $("#exist_plan_validation").css("display", "none");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            } else {
                if (data.message == "Project Plan Already Exist!") {
                    $("#plan")
                        .removeClass("form-control")
                        .addClass("form-control is-invalid state-invalid")
                        .focus();
                    $("#exist_plan_validation").css("display", "block");
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
$("#Edit_CommissionForm").submit(function (e) {
    e.preventDefault();
    var commission_type = $("#commission_type").val();
    if (commission_type == 1) {
        if (
            $(".percentage_validation").val() == "" ||
            $(".percentage_validation").val() == null
        ) {
            $(".percentage_validation")
                .removeClass("form-control")
                .addClass("form-control  is-invalid state-invalid")
                .focus();
            var Plan_value = $("#plan").val();
            if (Plan_value != "") {
                if ($("#mv_sq_ft").val() == "" || $("#mv_sq_ft") == null) {
                    $("#mv_sq_ft")
                        .removeClass("form-control")
                        .addClass("form-control is-invalid state-invalid");
                    $("#mv_sq_ft_validation").css("display", "block");
                } else {
                    $("#mv_sq_ft")
                        .removeClass("form-control is-invalid state-invalid")
                        .addClass("form-control");
                    $("#mv_sq_ft_validation").css("display", "none");
                }
            }
            if ($("#plan").val() == "" || $("#plan").val() == null) {
                $("#plan")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#plan_validation").css("display", "block");
                $("#exist_plan_validation").css("display", "none");
            } else {
                $("#plan")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#plan_validation").css("display", "none");
                $("#exist_plan_validation").css("display", "none");
            }
            if (
                $("#commission_type").val() == "" ||
                $("#commission_type").val() == null
            ) {
                $("#commission_type")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#commission_type_validation").css("display", "block");
            } else {
                $("#commission_type")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#commission_type_validation").css("display", "none");
            }
            if (
                $("#project_id").val() == "" ||
                $("#project_id").val() == null
            ) {
                $("#project_id")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#project_name_validation").css("display", "block");
            } else {
                $("#project_id")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#project_name_validation").css("display", "none");
            }
            return;
        } else {
            $(".percentage_validation")
                .removeClass("form-control  is-invalid state-invalid")
                .addClass("form-control");
            $("#mv_sq_ft_validation").css("display", "none");
        }
    }

    if (commission_type == 2) {
        if (
            $(".cash_validation").val() == "" ||
            $(".cash_validation").val() == null
        ) {
            $(".cash_validation")
                .removeClass("form-control")
                .addClass("form-control  is-invalid state-invalid")
                .focus();
            var Plan_value = $("#plan").val();
            if (Plan_value != "") {
                if ($("#mv_sq_ft").val() == "" || $("#mv_sq_ft") == null) {
                    $("#mv_sq_ft")
                        .removeClass("form-control")
                        .addClass("form-control is-invalid state-invalid");
                    $("#mv_sq_ft_validation").css("display", "block");
                } else {
                    $("#mv_sq_ft")
                        .removeClass("form-control is-invalid state-invalid")
                        .addClass("form-control");
                    $("#mv_sq_ft_validation").css("display", "none");
                }
            }
            if ($("#plan").val() == "" || $("#plan").val() == null) {
                $("#plan")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#plan_validation").css("display", "block");
                $("#exist_plan_validation").css("display", "none");
            } else {
                $("#plan")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#plan_validation").css("display", "none");
                $("#exist_plan_validation").css("display", "none");
            }
            if (
                $("#commission_type").val() == "" ||
                $("#commission_type").val() == null
            ) {
                $("#commission_type")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#commission_type_validation").css("display", "block");
            } else {
                $("#commission_type")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#commission_type_validation").css("display", "none");
            }
            if (
                $("#project_id").val() == "" ||
                $("#project_id").val() == null
            ) {
                $("#project_id")
                    .removeClass("form-control")
                    .addClass("form-control  is-invalid state-invalid")
                    .focus();
                $("#project_name_validation").css("display", "block");
            } else {
                $("#project_id")
                    .removeClass("form-control  is-invalid state-invalid")
                    .addClass("form-control");
                $("#project_name_validation").css("display", "none");
            }
            return;
        } else {
            $(".cash_validation")
                .removeClass("form-control  is-invalid state-invalid")
                .addClass("form-control");
            $("#mv_sq_ft_validation").css("display", "none");
        }
    }
    var Plan_value = $("#plan").val();
    if (Plan_value != "") {
        if ($("#mv_sq_ft").val() == "" || $("#mv_sq_ft") == null) {
            $("#mv_sq_ft")
                .removeClass("form-control")
                .addClass("form-control is-invalid state-invalid");
            $("#mv_sq_ft_validation").css("display", "block");
        } else {
            $("#mv_sq_ft")
                .removeClass("form-control is-invalid state-invalid")
                .addClass("form-control");
            $("#mv_sq_ft_validation").css("display", "none");
        }
    }
    if ($("#plan").val() == "" || $("#plan").val() == null) {
        $("#plan")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#plan_validation").css("display", "block");
        $("#exist_plan_validation").css("display", "none");
    } else {
        $("#plan")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#plan_validation").css("display", "none");
        $("#exist_plan_validation").css("display", "none");
    }
    if (
        $("#commission_type").val() == "" ||
        $("#commission_type").val() == null
    ) {
        $("#commission_type")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#commission_type_validation").css("display", "block");
    } else {
        $("#commission_type")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#commission_type_validation").css("display", "none");
    }
    if ($("#project_id").val() == "" || $("#project_id").val() == null) {
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control  is-invalid state-invalid")
            .focus();
        $("#project_name_validation").css("display", "block");
    } else {
        $("#project_id")
            .removeClass("form-control  is-invalid state-invalid")
            .addClass("form-control");
        $("#project_name_validation").css("display", "none");
    }
    var form = $("#Edit_CommissionForm")[0];
    var id = $("#com_update_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/commission-detail/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/commission-details";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                swal("Updated!", data.message, "success");
                $("#exist_plan_validation").css("display", "none");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            } else {
                if (data.message == "Project Plan Already Exist!") {
                    $("#plan")
                        .removeClass("form-control")
                        .addClass("form-control is-invalid state-invalid")
                        .focus();
                    $("#exist_plan_validation").css("display", "block");
                    return;
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

// Booking Details
$("#Add_plotbookinForm").submit(function (e) {
    e.preventDefault();
    
   

if ($("#loan_company").val() == "" || $("#loan_company").val() == null) {
    $("#loan_company")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#loan_company_validation").css("display", "block");
} else {
    $("#loan_company")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#loan_company_validation").css("display", "none");
}


if ($("#payment_term").val() == "" || $("#payment_term").val() == null) {
    $("#payment_term")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#payment_term_validation").css("display", "block");
} else {
    $("#payment_term")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#payment_term_validation").css("display", "none");
}

// if (
//     $("#mobile").val() == "" ||
//     $("#mobile").val() == null
// ) {
//     $("#mobile")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#mobile_validation").css("display", "block");
// } else {
//     $("#mobile")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#mobile_validation").css("display", "none");
// }

// if ($("#customer_name").val() == "" || $("#customer_name").val() == null) {
//     $("#customer_name")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#customer_name_validation").css("display", "block");
// } else {
//     $("#customer_name")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#customer_name_validation").css("display", "none");
// }
if ($("#marketer_code").val() == "" || $("#marketer_code").val() == null) {
    $("#marketer_code")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#marketer_id_validation").css("display", "block");
} else {
    $("#marketer_code")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#marketer_id_validation").css("display", "none");
}

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

if ( $("#booking_amount").val() == "" ||  $("#booking_amount").val() == null) {
    $("#booking_amount")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#amount_validation").css("display", "block");
} else {
    $("#booking_amount")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#amount_validation").css("display", "none");
}

if ($("#customer_scope").val() == "" || $("#customer_scope").val() == null) {
    $("#customer_scope")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#customer_scope_validation").css("display", "block");
} else {
    $("#customer_scope")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#customer_scope_validation").css("display", "none");
}


if ($("#company_scope").val() == "" || $("#company_scope").val() == null) {
    $("#company_scope")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#company_scope_validation").css("display", "block");
} else {
    $("#company_scope")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#company_scope_validation").css("display", "none");
}


if ($("#booking_open_date").val() == "" || $("#booking_open_date").val() == null) {
    $("#booking_open_date")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#booking_open_date_validation").css("display", "block");
} else {
    $("#booking_open_date")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#booking_open_date_validation").css("display", "none");
}


if ($("#registration_due_date").val() == "" || $("#registration_due_date").val() == null) {
    $("#registration_due_date")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#registration_due_date_validation").css("display", "block");
} else {
    $("#registration_due_date")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#registration_due_date_validation").css("display", "none");
}

if ($("#receipt_date").val() == "" || $("#receipt_date").val() == null) {
    $("#receipt_date")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#receipt_date_validation").css("display", "block");
} else {
    $("#receipt_date")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#receipt_date_validation").css("display", "none");
}

// if ($("#payable").val() == "" || $("#payable").val() == null) {
//     $("#payable")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#payable_validation").css("display", "block");
  
// } else {
//     $("#payable")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#payable_validation").css("display", "none");
// }


if ($("#total_value").val() == "" || $("#total_value").val() == null) {
    $("#total_value")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#total_value_validation").css("display", "block");
    
} else {
    $("#total_value")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#total_value_validation").css("display", "none");
}


if ($("#plot_size_sqft").val() == "" ||$("#plot_size_cent").val() == null ) {
    $("#plot_size_cent")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#plot_size_sqft")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#plot_size_validation").css("display", "block");
   
} else {
    $("#plot_size_cent")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#plot_size_sqft")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#plot_size_validation").css("display", "none");
}


 if ($("#sqft_rate").val() == "" || $("#sqft_rate").val() == null) {
        $("#sqft_rate")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#sqft_rate_validation").css("display", "block");
       
    } else {
        $("#sqft_rate")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#sqft_rate_validation").css("display", "none");
    }


 if ($("#booking_plot_id").val() == "" || $("#booking_plot_id").val() == null) {
        $("#booking_plot_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#plot_validation").css("display", "block");

    } else {
        $("#booking_plot_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control");
        $("#plot_validation").css("display", "none");
    }
    


var project_id = $("#project_id").val();
    if (project_id == "" || project_id == null) {
        
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#project_validation").css("display", "block");
       
    } else {
        
        $("#project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#project_validation").css("display", "none");
    } 
    
    
    var form = $("#Add_plotbookinForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/plot-booking";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $('#add_booking').prop("disabled",true);
                $("#Add_plotbookinForm")[0].reset();
                $(".err").html("");
                swal("Created!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
              swal("Failed!", "Please Check the Given Data..!","error"); 
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
$("#Edit_plotbookinForm").submit(function (e) {
    e.preventDefault();
   

if ($("#loan_company").val() == "" || $("#loan_company").val() == null) {
    $("#loan_company")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#loan_company_validation").css("display", "block");
} else {
    $("#loan_company")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#loan_company_validation").css("display", "none");
}


if ($("#payment_term").val() == "" || $("#payment_term").val() == null) {
    $("#payment_term")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#payment_term_validation").css("display", "block");
} else {
    $("#payment_term")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#payment_term_validation").css("display", "none");
}

// if (
//     $("#mobile").val() == "" ||
//     $("#mobile").val() == null
// ) {
//     $("#mobile")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#mobile_validation").css("display", "block");
// } else {
//     $("#mobile")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#mobile_validation").css("display", "none");
// }

// if ($("#customer_name").val() == "" || $("#customer_name").val() == null) {
//     $("#customer_name")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#customer_name_validation").css("display", "block");
// } else {
//     $("#customer_name")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#customer_name_validation").css("display", "none");
// }
if ($("#marketer_code").val() == "" || $("#marketer_code").val() == null) {
    $("#marketer_code")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#marketer_id_validation").css("display", "block");
} else {
    $("#marketer_code")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#marketer_id_validation").css("display", "none");
}

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

if ( $("#booking_amount").val() == "" ||  $("#booking_amount").val() == null) {
    $("#booking_amount")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#amount_validation").css("display", "block");
} else {
    $("#booking_amount")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#amount_validation").css("display", "none");
}

if ($("#receipt_date").val() == "" || $("#receipt_date").val() == null) {
    $("#receipt_date")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#receipt_date_validation").css("display", "block");
} else {
    $("#receipt_date")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#receipt_date_validation").css("display", "none");
}

// if ($("#payable").val() == "" || $("#payable").val() == null) {
//     $("#payable")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#payable_validation").css("display", "block");
  
// } else {
//     $("#payable")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#payable_validation").css("display", "none");
// }


if ($("#total_value").val() == "" || $("#total_value").val() == null) {
    $("#total_value")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#total_value_validation").css("display", "block");
    
} else {
    $("#total_value")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#total_value_validation").css("display", "none");
}


if ($("#plot_size_sqft").val() == "" ||$("#plot_size_cent").val() == null ) {
    $("#plot_size_cent")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#plot_size_sqft")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#plot_size_validation").css("display", "block");
   
} else {
    $("#plot_size_cent")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#plot_size_sqft")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#plot_size_validation").css("display", "none");
}


 if ($("#sqft_rate").val() == "" || $("#sqft_rate").val() == null) {
        $("#sqft_rate")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#sqft_rate_validation").css("display", "block");
       
    } else {
        $("#sqft_rate")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#sqft_rate_validation").css("display", "none");
    }


 if ($("#booking_plot_id").val() == "" || $("#booking_plot_id").val() == null) {
        $("#booking_plot_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#plot_validation").css("display", "block");

    } else {
        $("#booking_plot_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
             ;
        $("#plot_validation").css("display", "none");
    }

var project_id = $("#project_id").val();
    if (project_id == "" || project_id == null) {
        
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#project_validation").css("display", "block");
       
    } else {
        
        $("#project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#project_validation").css("display", "none");
    }
    
    

  
    var form = $("#Edit_plotbookinForm")[0];
    var id = $("#booking_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/booking/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/plot-booking";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $('#edit_booking').prop("disabled",true);
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                    window.location.href = redirect;
                }, 2000);
            }else{
              $('#add_booking').prop("disabled",true);
              swal("Failed!", "Please Check the Given Data..!","error"); 
               
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



// Booking Details
$("#Add_partpaymentForm").submit(function (e) {
    e.preventDefault();
 
   
if (
    $("#account_type").val() == "" ||
    $("#account_type").val() == null
) {
    $("#account_type")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#account_type_validation").css("display", "block");
} else {
    $("#account_type")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#account_type_validation").css("display", "none");
}


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

if ( $("#amount").val() == "" ||  $("#amount").val() == null) {
    $("#amount")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#amount_validation").css("display", "block");
} else {
    $("#amount")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#amount_validation").css("display", "none");
}

if ($("#receipt_date").val() == "" || $("#receipt_date").val() == null) {
    $("#receipt_date")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#receipt_date_validation").css("display", "block");
} else {
    $("#receipt_date")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#receipt_date_validation").css("display", "none");
}


// if ($("#paid").val() == "" || $("#paid").val() == null) {
//     $("#paid")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#paid_validation").css("display", "block");
    
// } else {
//     $("#paid")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#paid_validation").css("display", "none");
// }


// if ($("#gl_balance").val() == "" || $("#gl_balance").val() == null) {
//     $("#gl_balance")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#gl_balance_validation").css("display", "block");
    
// } else {
//     $("#gl_balance")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#gl_balance_validation").css("display", "none");
// }


if ($("#gl_rate").val() == "" || $("#gl_rate").val() == null) {
    $("#gl_rate")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#gl_rate_validation").css("display", "block");
    
} else {
    $("#gl_rate")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#gl_rate_validation").css("display", "none");
}



 if ($("#payment_plot_id").val() == "" || $("#payment_plot_id").val() == null) {
        $("#payment_plot_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#plot_validation").css("display", "block");

    } else {
        $("#payment_plot_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#plot_validation").css("display", "none");
    }

var project_id = $("#payment_project_id").val();
    if (project_id == "" || project_id == null) {
        
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#project_validation").css("display", "block");
       
    } else {
        
        $("#project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#project_validation").css("display", "none");
    } 
    var form = $("#Add_partpaymentForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/part_payment_list";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $("#Add_partpaymentForm")[0].reset();
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
// Edit Part Payment
$("#Edit_partpaymentForm").submit(function (e) {
    e.preventDefault();
    
    if($("#amount").val() != "")
    {
   
if (
    $("#account_type").val() == "" ||
    $("#account_type").val() == null
) {
    $("#account_type")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#account_type_validation").css("display", "block");
} else {
    $("#account_type")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#account_type_validation").css("display", "none");
}
  
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

if (
    $("#payment_term_source").val() == "" ||
    $("#payment_term_source").val() == null
) {
    $("#payment_term_source")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#payment_term_validation").css("display", "block");
} else {
    $("#payment_term_source")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#payment_term_validation").css("display", "none");
}

}

// if ( $("#amount").val() == "" ||  $("#amount").val() == null ||  $("#amount").val() == 0) {
//     $("#amount")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#amount_validation").css("display", "block");
// } else {
//     $("#amount")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#amount_validation").css("display", "none");
// }

// if ($("#receipt_date").val() == "" || $("#receipt_date").val() == null) {
//     $("#receipt_date")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#receipt_date_validation").css("display", "block");
// } else {
//     $("#receipt_date")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#receipt_date_validation").css("display", "none");
// }


// if ($("#paid").val() == "" || $("#paid").val() == null) {
//     $("#paid")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#paid_validation").css("display", "block");
    
// } else {
//     $("#paid")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#paid_validation").css("display", "none");
// }


// if ($("#gl_balance").val() == "" || $("#gl_balance").val() == null) {
//     $("#gl_balance")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#gl_balance_validation").css("display", "block");
    
// } else {
//     $("#gl_balance")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#gl_balance_validation").css("display", "none");
// }


if ($("#gl_rate").val() == "" || $("#gl_rate").val() == null) {
    $("#gl_rate")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#gl_rate_validation").css("display", "block");
    
} else {
    $("#gl_rate")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#gl_rate_validation").css("display", "none");
}



 if ($("#payment_plot_id").val() == "" || $("#payment_plot_id").val() == null) {
        $("#payment_plot_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#plot_validation").css("display", "block");

    } else {
        $("#payment_plot_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
           ;
        $("#plot_validation").css("display", "none");
    }

var project_id = $("#payment_project_id").val();
    if (project_id == "" || project_id == null) {
        
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#project_validation").css("display", "block");
       
    } else {
        
        $("#project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#project_validation").css("display", "none");
    }
    var form = $("#Edit_partpaymentForm")[0];
    var id = $("#payment_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/part_payment/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/part_payment_list";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $('#edit_payment').prop("disabled",true);
                swal("Updated!", data.message, "success");
                setTimeout(function () {
                   location.reload()
                }, 2000);
            }else{
              swal("Failed!","Please Check the Given Data","error"); 
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





// Edit Part Payment
$("#Cancel_plotBookingForm").submit(function (e) {
    e.preventDefault();
     var cancel_reason = $("#cancel_reason").val();
    
     if($("#cancel_reason").val().trim().length < 1) {
      
        $("#cancel_reason")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#cancel_reason_validation").css("display", "block");
        
       
    } else {
       
        $("#cancel_reason")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#cancel_reason_validation").css("display", "none");
    }
    
    if($("#cancel_reason").val().trim().length > 1) {
    swal({
                    title: "Are you sure?",
                    text: "Confirm to Cancel this Booking?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
      
    var form = $("#Cancel_plotBookingForm")[0];
    var project_id = $("#cancel_project_id").val();
    var plot_id = $("#cancel_plot_id").val();
    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/plots_update/" + project_id +"/" + plot_id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/part_payment_list";
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
                   location.reload()
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
    
                    } else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
                
    }
});



// Project Visit
 
$("#Add_projectvisitForm").submit(function (e) {
    e.preventDefault();
  
// if (
//     $("#trip_distance").val() == "" ||
//     $("#trip_distance").val() == null
// ) {
//     $("#trip_distance")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#trip_distance_validation").css("display", "block");
// } else {
//     $("#trip_distance")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#trip_distance_validation").css("display", "none");
// }

if (
    $("#vehicle").val() == "" ||
    $("#vehicle").val() == null
) {
    $("#vehicle")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#vehicle_validation").css("display", "block");
} else {
    $("#vehicle")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#vehicle_validation").css("display", "none");
}


var project_id = $("#project_id").val();
    if (project_id == "" || project_id == null) {
        
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#project_validation").css("display", "block");
       
    } else {
        
        $("#project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#project_validation").css("display", "none");
    } 
    
    if (
    $("#marketer_id").val() == "" ||
    $("#marketer_id").val() == null
) {
    $("#marketer_id")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#marketer_id_validation").css("display", "block");
} else {
    $("#marketer_id")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#marketer_id_validation").css("display", "none");
}

if ($("#team").val() == "" || $("#team").val() == null) {
    $("#team")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#team_validation").css("display", "block");
} else {
    $("#team")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#team_validation").css("display", "none");
}



if ($("#no_of_person").val() == "" || $("#no_of_person").val() == null) {
    $("#no_of_person")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#no_of_person_validation").css("display", "block");
} else {
    $("#no_of_person")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#no_of_person_validation").css("display", "none");
}


  
   

if ($("#customer_name").val() == "" || $("#customer_name").val() == null) {
    $("#customer_name")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#customer_name_validation").css("display", "block");
} else {
    $("#customer_name")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#customer_name_validation").css("display", "none");
}

if ($("#visit_date").val() == "" || $("#visit_date").val() == null) {
    $("#visit_date")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#visit_date_validation").css("display", "block");
} else {
    $("#visit_date")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#visit_date_validation").css("display", "none");
}

 
    var form = $("#Add_projectvisitForm")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/project_visit_list";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                $('#add_booking').prop("disabled",true);
                $("#Add_projectvisitForm")[0].reset();
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



$("#Edit_projectvisitForm").submit(function (e) {
    e.preventDefault();
  
// if (
//     $("#trip_distance").val() == "" ||
//     $("#trip_distance").val() == null
// ) {
//     $("#trip_distance")
//         .removeClass("form-control")
//         .addClass("form-control mb-4 is-invalid state-invalid")
//         .focus();
//     $("#trip_distance_validation").css("display", "block");
// } else {
//     $("#trip_distance")
//         .removeClass("form-control mb-4 is-invalid state-invalid")
//         .addClass("form-control");
//     $("#trip_distance_validation").css("display", "none");
// }

if (
    $("#vehicle").val() == "" ||
    $("#vehicle").val() == null
) {
    $("#vehicle")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#vehicle_validation").css("display", "block");
} else {
    $("#vehicle")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#vehicle_validation").css("display", "none");
}


var project_id = $("#project_id").val();

    if (project_id == "" || project_id == null) {
        
        $("#project_id")
            .removeClass("form-control")
            .addClass("form-control mb-4 is-invalid state-invalid")
            .focus();
        $("#project_validation").css("display", "block");
       
    } else {
        
        $("#project_id")
            .removeClass("form-control mb-4 is-invalid state-invalid")
            .addClass("form-control")
            ;
        $("#project_validation").css("display", "none");
    } 
    
    if (
    $("#marketer_id").val() == "" ||
    $("#marketer_id").val() == null
) {
    $("#marketer_id")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#marketer_id_validation").css("display", "block");
} else {
    $("#marketer_id")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#marketer_id_validation").css("display", "none");
}

if ($("#team").val() == "" || $("#team").val() == null) {
    $("#team")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#team_validation").css("display", "block");
} else {
    $("#team")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#team_validation").css("display", "none");
}



if ($("#no_of_person").val() == "" || $("#no_of_person").val() == null) {
    $("#no_of_person")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#no_of_person_validation").css("display", "block");
} else {
    $("#no_of_person")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#no_of_person_validation").css("display", "none");
}


  
   

if ($("#customer_name").val() == "" || $("#customer_name").val() == null) {
    $("#customer_name")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#customer_name_validation").css("display", "block");
} else {
    $("#customer_name")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#customer_name_validation").css("display", "none");
}

if ($("#visit_date").val() == "" || $("#visit_date").val() == null) {
    $("#visit_date")
        .removeClass("form-control")
        .addClass("form-control mb-4 is-invalid state-invalid")
        .focus();
    $("#visit_date_validation").css("display", "block");
} else {
    $("#visit_date")
        .removeClass("form-control mb-4 is-invalid state-invalid")
        .addClass("form-control");
    $("#visit_date_validation").css("display", "none");
}

 
    var form = $("#Edit_projectvisitForm")[0];
    var id = $("#project_visit_id").val();

    var formData = new FormData(form);
    var update =
        $('meta[name="base_url"]').attr("content") + "/project_visit/" + id;
    var redirect =
        $('meta[name="base_url"]').attr("content") + "/project_visit_list";
    $.ajax({
        url: update,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
               
                $(".err").html("");
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