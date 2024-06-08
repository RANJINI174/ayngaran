!(function (a) {
    "use strict";
    a("#wizard1").steps({
        headerTag: "h3",
        bodyTag: "section",
        autoFocus: !0,
        titleTemplate:
            '<span class="number">#index#</span> <span class="title">#title#</span>',
    }),
        a("#wizard2").steps({
            headerTag: "h3",
            bodyTag: "section",
            autoFocus: !0,
            titleTemplate:
                '<span class="number">#index#</span> <span class="title">#title#</span>',
            onStepChanging: function (t, e, s) {
                if (!(e < s)) return !0;

                if (0 === e) {
                    var short_name = $("#short_name").val();
                    if (short_name == "" || short_name == null) {
                        $("#short_name")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#short_name_validation").css("display", "block");
                        $("#short_name").validate();
                    } else {
                        $("#short_name")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#short_name_validation").css("display", "none");
                    }

                    if (
                        $("#full_name").val() == "" ||
                        $("#full_name").val() == null
                    ) {
                        $("#full_name")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#full_name_validation").css("display", "block");
                        $("#full_name").validate();
                    } else {
                        $("#full_name")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#full_name_validation").css("display", "none");
                    }

                    if (
                        $("#landmark").val() == "" ||
                        $("#landmark").val() == null
                    ) {
                        $("#landmark")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#landmark_validation").css("display", "block");
                        $("#landmark").validate();
                    } else {
                        $("#landmark")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#landmark_validation").css("display", "none");
                    }

                    if (
                        $("#project_start_date").val() == "" ||
                        $("#project_start_date").val() == null
                    ) {
                        $("#project_start_date")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#project_start_date_validation").css(
                            "display",
                            "block"
                        );
                        $("#project_start_date").validate();
                    } else {
                        $("#project_start_date")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#project_start_date_validation").css(
                            "display",
                            "none"
                        );
                    }

                    if (
                        $("#project_type").val() == "" ||
                        $("#project_type").val() == null
                    ) {
                        $("#project_type")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#project_type_validation").css("display", "block");
                        $("#project_type").validate();
                    } else {
                        $("#project_type")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#project_type_validation").css("display", "none");
                    }

                    if (
                        $("#marketing_type").val() == "" ||
                        $("#marketing_type").val() == null
                    ) {
                        $("#marketing_type")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#marketing_type_validation").css("display", "block");
                        $("#marketing_type").validate();
                    } else {
                        $("#marketing_type")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#marketing_type_validation").css("display", "none");
                    }

                    if (
                        $("#commission_type").val() == "" ||
                        $("#commission_type").val() == null
                    ) {
                        $("#commission_type")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#commission_type_validation").css(
                            "display",
                            "block"
                        );
                        $("#commission_type").validate();
                    } else {
                        $("#commission_type")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#commission_type_validation").css("display", "none");
                    }

                    if (
                        $("#branch_id").val() == "" ||
                        $("#branch_id").val() == null
                    ) {
                        $("#branch_id")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#branch_id_validation").css("display", "block");
                        $("#branch_id").validate();
                    } else {
                        $("#branch_id")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#branch_id_validation").css("display", "none");
                    }

                    if (
                        $("#project_incharge").val() == "" ||
                        $("#project_incharge").val() == null
                    ) {
                        $("#project_incharge")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#project_incharge_validation").css(
                            "display",
                            "block"
                        );
                        $("#project_incharge").validate();
                    } else {
                        $("#project_incharge")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#project_incharge_validation").css(
                            "display",
                            "none"
                        );
                    }

                    if (
                        $("#project_budget").val() == "" ||
                        $("#project_budget").val() == null
                    ) {
                        $("#project_budget")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#project_budget_validation").css("display", "block");
                        $("#project_budget").validate();
                    } else {
                        $("#project_budget")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#project_budget_validation").css("display", "none");
                    }

                    if (
                        $("#guide_line").val() == "" ||
                        $("#guide_line").val() == null
                    ) {
                        $("#guide_line")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#guide_line_validation").css("display", "block");
                        $("#guide_line").validate();
                    } else {
                        $("#guide_line")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#guide_line_validation").css("display", "none");
                    }

                   

                    if (
                        $("#project_budget").val() == "" ||
                        $("#project_budget").val() == null
                    ) {
                        $("#project_budget")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#project_budget_validation").css("display", "block");
                        $("#project_budget").validate();
                    } else {
                        $("#project_budget")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#project_budget_validation").css("display", "none");
                    }

                    if (
                        $("#project_budget").val() == "" ||
                        $("#project_budget").val() == null
                    ) {
                        $("#project_budget")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#project_budget_validation").css("display", "block");
                        $("#project_budget").validate();
                    } else {
                        $("#project_budget")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#project_budget_validation").css("display", "none");
                    }

                    // if ($("#plan").val() == "" || $("#plan").val() == null) {
                    //     $("#plan")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#plan_validation").css("display", "block");
                    //     $("#plan").validate();
                    // } else {
                    //     $("#plan")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#plan_validation").css("display", "none");
                       
                    // }
                    
                    
                    //  if (
                    //     $("#market_value").val() == "" ||
                    //     $("#market_value").val() == null
                    // ) {
                    //     $("#market_value")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#market_value_validation").css("display", "block");
                    //     $("#market_value").validate();
                    // } else {
                    //     $("#market_value")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#market_value_validation").css("display", "none");
                         
                    // }
                    
                    
                    if (
                        $("#template_id").val() == "" ||
                        $("#template_id").val() == null
                    ) {
                        $("#template_id")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#template_id_validation").css("display", "block");
                        $("#template_id").validate();
                    } else {
                        $("#template_id")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#template_id_validation").css("display", "none");
                         return !0;
                    }
                }
                if (1 === e) {
                    if (
                        $("#advance_amount").val() == "" ||
                        $("#advance_amount").val() == null
                    ) {
                        $("#advance_amount")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#advance_amount_validation").css("display", "block");
                        $("#advance_amount").validate();
                    } else {
                        $("#advance_amount")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#advance_amount_validation").css("display", "none");
                    }
                    
                    
                    //  if (
                    //     $("#registration_due_date").val() == "" ||
                    //     $("#registration_due_date").val() == null
                    // ) {
                    //     $("#registration_due_date")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#registration_due_date_validation").css("display", "block");
                    //     $("#registration_due_date").validate();
                    // } else {
                    //     $("#registration_due_date")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#registration_due_date_validation").css("display", "none");
                    // }
                    
                      if (
                        $("#registration_due_days").val() == "" ||
                        $("#registration_due_days").val() == null
                    ) {
                        $("#registration_due_days")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#registration_due_date_validation").css("display", "block");
                        $("#registration_due_days").validate();
                    } else {
                        $("#registration_due_days")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#registration_due_date_validation").css("display", "none");
                    }
                    
                    
                    
                     if (
                        $("#repay_deduction").val() == "" ||
                        $("#repay_deduction").val() == null
                    ) {
                        $("#repay_deduction")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#repay_deduction_validation").css("display", "block");
                        $("#repay_deduction").validate();
                    } else {
                        $("#repay_deduction")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#repay_deduction_validation").css("display", "none");
                    }
                    
                    
                    if (
                        $("#company_scope").val() == "" ||
                        $("#company_scope").val() == null
                    ) {
                        $("#company_scope")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#company_scope_validation").css("display", "block");
                        $("#company_scope").validate();
                    } else {
                        $("#company_scope")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#company_scope_validation").css("display", "none");
                    }
                    
                    
                    if (
                        $("#customer_scope").val() == "" ||
                        $("#customer_scope").val() == null
                    ) {
                        $("#customer_scope")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#customer_scope_validation").css("display", "block");
                        $("#customer_scope").validate();
                    } else {
                        $("#customer_scope")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#customer_scope_validation").css("display", "none");
                    }
                    
                    
                    
                    // if (
                    //     $("#booking_open").val() == "" ||
                    //     $("#booking_open").val() == null
                    // ) {
                    //     $("#booking_open")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#booking_open_validation").css("display", "block");
                    //     $("#booking_open").validate();
                    // } else {
                    //     $("#booking_open")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#booking_open_validation").css("display", "none");
                    // }
                    
                    
                     if (
                        $("#booking_open_days").val() == "" ||
                        $("#booking_open_days").val() == null
                    ) {
                        $("#booking_open_days")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#booking_open_validation").css("display", "block");
                        $("#booking_open_days").validate();
                    } else {
                        $("#booking_open_days")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#booking_open_validation").css("display", "none");
                    }

                    // if (
                    //     $("#advance_refund").val() == "" ||
                    //     $("#advance_refund").val() == null
                    // ) {
                    //     $("#advance_refund")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#advance_refund_validation").css("display", "block");
                    //     $("#advance_refund").validate();
                    // } else {
                    //     $("#advance_refund")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#advance_refund_validation").css("display", "none");
                    // }

                    if (
                        $("#refund_days").val() == "" ||
                        $("#refund_days").val() == null
                    ) {
                        $("#refund_days")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#refund_days_validation").css("display", "block");
                        $("#refund_days").validate();
                    } else {
                        $("#refund_days")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#refund_days_validation").css("display", "none");
                        return !0;
                    }

                    // if (
                    //     $("#valididty_days").val() == "" ||
                    //     $("#valididty_days").val() == null
                    // ) {
                    //     $("#valididty_days")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#valididty_days_validation").css("display", "block");
                    //     $("#valididty_days").validate();
                    // } else {
                    //     $("#valididty_days")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#valididty_days_validation").css("display", "none");
                    // }

                    // if (
                    //     $("#valididty_paid").val() == "" ||
                    //     $("#valididty_paid").val() == null
                    // ) {
                    //     $("#valididty_paid")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#valididty_paid_validation").css("display", "block");
                    //     $("#valididty_paid").validate();
                    // } else {
                    //     $("#valididty_paid")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#valididty_paid_validation").css("display", "none");
                    // }

                    // if (
                    //     $("#settlement").val() == "" ||
                    //     $("#settlement").val() == null
                    // ) {
                    //     $("#settlement")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#settlement_validation").css("display", "block");
                    //     $("#settlement").validate();
                    // } else {
                    //     $("#settlement")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#settlement_validation").css("display", "none");
                    // }

                    // if (
                    //     $("#broker_commission").val() == "" ||
                    //     $("#broker_commission").val() == null
                    // ) {
                    //     $("#broker_commission")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#broker_commission_validation").css(
                    //         "display",
                    //         "block"
                    //     );
                    //     $("#broker_commission").validate();
                    // } else {
                    //     $("#broker_commission")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#broker_commission_validation").css(
                    //         "display",
                    //         "none"
                    //     );
                    //     return !0;
                    // }
                }
                if (2 === e) {
                    // if (
                    //     $("#document_value").val() == "" ||
                    //     $("#document_value").val() == null
                    // ) {
                    //     $("#document_value")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#document_value_validation").css("display", "block");
                    //     $("#document_value").validate();
                    // } else {
                    //     $("#document_value")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#document_value_validation").css("display", "none");
                    // }

                    // if (
                    //     $("#document_commission").val() == "" ||
                    //     $("#document_commission").val() == null
                    // ) {
                    //     $("#document_commission")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#document_commission_validation").css(
                    //         "display",
                    //         "block"
                    //     );
                    //     $("#document_commission").validate();
                    // } else {
                    //     $("#document_commission")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#document_commission_validation").css(
                    //         "display",
                    //         "none"
                    //     );
                    // }
                    
                     if (
                        $("#stamp_duty").val() == "" ||
                        $("#stamp_duty").val() == null
                    ) {
                        $("#stamp_duty")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#stamp_duty_validation").css("display", "block");
                        $("#stamp_duty").validate();
                    } else {
                        $("#stamp_duty")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#stamp_duty_validation").css("display", "none");
                    }
                    
                    
                    //  if (
                    //     $("#registration_fees_dd").val() == "" ||
                    //     $("#registration_fees_dd").val() == null
                    // ) {
                    //     $("#registration_fees_dd")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#registration_fees_dd_validation").css("display", "block");
                    //     $("#registration_fees_dd").validate();
                    // } else {
                    //     $("#registration_fees_dd")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#registration_fees_dd_validation").css("display", "none");
                    // }
                    
                    
                       if (
                        $("#dd_charge").val() == "" ||
                        $("#dd_charge").val() == null
                    ) {
                        $("#dd_charge")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#dd_charge_validation").css("display", "block");
                        $("#dd_charge").validate();
                    } else {
                        $("#dd_charge")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#dd_charge_validation").css("display", "none");
                    }
                    
                    
                     if (
                        $("#extra_page_fees").val() == "" ||
                        $("#extra_page_fees").val() == null
                    ) {
                        $("#extra_page_fees")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#extra_page_fees_validation").css("display", "block");
                        $("#extra_page_fees").validate();
                    } else {
                        $("#extra_page_fees")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#extra_page_fees_validation").css("display", "none");
                    }


                         if (
                        $("#computer_fees").val() == "" ||
                        $("#computer_fees").val() == null
                    ) {
                        $("#computer_fees")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#computer_fees_validation").css("display", "block");
                        $("#computer_fees").validate();
                    } else {
                        $("#computer_fees")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#computer_fees_validation").css("display", "none");
                    }
                    
                    
                    
                      if ($("#cd").val() == "" || $("#cd").val() == null) {
                        $("#cd")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#cd_validation").css("display", "block");
                        $("#cd").validate();
                    } else {
                        $("#cd")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#cd_validation").css("display", "none");
                    }
                    
                    
                       if (
                        $("#sub_division_fees").val() == "" ||
                        $("#sub_division_fees").val() == null
                    ) {
                        $("#sub_division_fees")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#sub_division_fees_validation").css(
                            "display",
                            "block"
                        );
                        $("#sub_division_fees").validate();
                    } else {
                        $("#sub_division_fees")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#sub_division_fees_validation").css(
                            "display",
                            "none"
                        );
                    }
                    
                    
                     if (
                        $("#register_office").val() == "" ||
                        $("#register_office").val() == null
                    ) {
                        $("#register_office")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#register_office_validation").css(
                            "display",
                            "block"
                        );
                        $("#register_office").validate();
                    } else {
                        $("#register_office")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#register_office_validation").css(
                            "display",
                            "none"
                        );
                    }
                    
                    
                    

                    if (
                        $("#writer_fees").val() == "" ||
                        $("#writer_fees").val() == null
                    ) {
                        $("#writer_fees")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#writer_fees_validation").css("display", "block");
                        $("#writer_fees").validate();
                    } else {
                        $("#writer_fees")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#writer_fees_validation").css("display", "none");
                    }

                    // if (
                    //     $("#dd_commission").val() == "" ||
                    //     $("#dd_commission").val() == null
                    // ) {
                    //     $("#dd_commission")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#dd_commission_validation").css("display", "block");
                    //     $("#dd_commission").validate();
                    // } else {
                    //     $("#dd_commission")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#dd_commission_validation").css("display", "none");
                    // }

                   
                    // if (
                    //     $("#regitration_gift").val() == "" ||
                    //     $("#regitration_gift").val() == null
                    // ) {
                    //     $("#regitration_gift")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#regitration_gift_validation").css(
                    //         "display",
                    //         "block"
                    //     );
                    //     $("#regitration_gift").validate();
                    // } else {
                    //     $("#regitration_gift")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#regitration_gift_validation").css(
                    //         "display",
                    //         "none"
                    //     );
                    // }

                    
                    // if (
                    //     $("#customer_gift").val() == "" ||
                    //     $("#customer_gift").val() == null
                    // ) {
                    //     $("#customer_gift")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#customer_gift_validation").css("display", "block");
                    //     $("#customer_gift").validate();
                    // } else {
                    //     $("#customer_gift")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#customer_gift_validation").css("display", "none");
                    // }

                  

                    if ($("#ec").val() == "" || $("#ec").val() == null) {
                        $("#ec")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#ec_validation").css("display", "block");
                        $("#ec").validate();
                    } else {
                        $("#ec")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#ec_validation").css("display", "none");
                    }

                    if (
                        $("#reg_expense").val() == "" ||
                        $("#reg_expense").val() == null
                    ) {
                        $("#reg_expense")
                            .removeClass("form-control")
                            .addClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .focus();
                        $("#reg_expense_validation").css("display", "block");
                        $("#reg_expense").validate();
                    } else {
                        $("#reg_expense")
                            .removeClass(
                                "form-control mb-4 is-invalid state-invalid"
                            )
                            .addClass("form-control");
                        $("#reg_expense_validation").css("display", "none");
                        return !0;
                        
                    }

                    // if (
                    //     $("#other_expense").val() == "" ||
                    //     $("#other_expense").val() == null
                    // ) {
                    //     $("#other_expense")
                    //         .removeClass("form-control")
                    //         .addClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .focus();
                    //     $("#other_expense_validation").css("display", "block");
                    //     $("#other_expense").validate();
                    // } else {
                    //     $("#other_expense")
                    //         .removeClass(
                    //             "form-control mb-4 is-invalid state-invalid"
                    //         )
                    //         .addClass("form-control");
                    //     $("#other_expense_validation").css("display", "none");
                         
                        
                    // }
                }
            },
            onFinishing: function () {
                var type = a("#type").val();
                if (type == "insert") {
                    var url = a("#url").val();
                    var form = $("#Add_ProjectForm")[0];
                    var url = $("#url").val();
                    var formData = new FormData(form);
                    var redirect =
                        $('meta[name="base_url"]').attr("content") +
                        "/projects";
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                             
                            if (data.status == true) {
                                $("#Add_ProjectForm")[0].reset();
                                $(".err").html("");
                                swal("Created!", data.message, "success");
                                setTimeout(function () {
                                    window.location.href = redirect;
                                }, 2000);
                            } else{
                                swal("Warning!", data.message, "error");
                            }
                        },
                        error: function (xhr) {
                            $(".err").html("");
                            $.each(
                                xhr.responseJSON.errors,
                                function (key, value) {
                                    $("." + key).append(
                                        '<div class="err text-danger">' +
                                            value +
                                            "</div>"
                                    );
                                }
                            );
                        },
                    });
                } else {
                    var form = $("#Edit_ProjectForm")[0];
                    var id = $("#edit_project_detail_id").val();
                    var formData = new FormData(form);
                    var update =
                        $('meta[name="base_url"]').attr("content") +
                        "/project/" +
                        id;

                    var redirect =
                        $('meta[name="base_url"]').attr("content") +
                        "/projects";
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
                                swal("Warning!", data.message, "error");
                            }
                        },
                        error: function (xhr) {
                            $(".err").html("");
                            $.each(
                                xhr.responseJSON.errors,
                                function (key, value) {
                                    $("." + key).append(
                                        '<div class="err text-danger">' +
                                            value +
                                            "</div>"
                                    );
                                }
                            );
                        },
                    });
                }
            },
        }),
        a("#wizard3").steps({
            headerTag: "h3",
            bodyTag: "section",
            autoFocus: !0,
            titleTemplate:
                '<span class="number">#index#</span> <span class="title">#title#</span>',
            stepsOrientation: 1,
        });
    var t = {
        mode: "wizard",
        autoButtonsNextClass: "btn btn-primary float-end",
        autoButtonsPrevClass: "btn btn-light",
        stepNumberClass: "badge rounded-pill bg-primary me-1",
        onSubmit: function () {
            return alert("Form submitted!"), !0;
        },
    };
    a("#Add_ProjectForm").accWizard(t);
})(jQuery);
