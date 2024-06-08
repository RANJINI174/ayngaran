$(function (e) {
  "use strict";
  $(".toggle").toggles({ on: !0, height: 26 }),
    $("#dateMask").mask("99/99/9999"),
    $("#phoneMask").mask("(999) 999-9999"),
    $("#ssnMask").mask("999-99-9999"),
    $("#tpBasic").timepicker(),
    $("#tp2").timepicker({ scrollDefault: "now" }),
    $("#tp3").timepicker(),
    $(document).on("click", "#setTimeButton", function () {
      $("#tp3").timepicker("setTime", new Date());
    }),
    $("#colorpicker").spectrum({ color: "#0061da" }),
    $("#showAlpha").spectrum({ color: "rgba(0, 97, 218, 0.5)", showAlpha: !0 }),
    $("#showPaletteOnly").spectrum({
      showPaletteOnly: !0,
      showPalette: !0,
      color: "#DC3545",
      palette: [
        ["#1D2939", "#fff", "#0866C6", "#23BF08", "#F49917"],
        ["#DC3545", "#17A2B8", "#6610F2", "#fa1e81", "#72e7a6"],
      ],
    }),
    $("#reservation").daterangepicker(),
    $(".fc-datepicker").datepicker({
      showOtherMonths: !0,
      selectOtherMonths: !0,
    }),
    $("#datepickerNoOfMonths").datepicker({
      showOtherMonths: !0,
      selectOtherMonths: !0,
      numberOfMonths: 2,
    }),
    // $("#datepicker-date").bootstrapdatepicker({
    //   format: "dd-mm-yyyy",
    //   viewMode: "date",
    //   multidate: !0,
    //   multidateSeparator: "-",
    // }),
    $("#datepicker-month").bootstrapdatepicker({
      format: "MM",
      viewMode: "months",
      minViewMode: "months",
      multidate: !0,
      multidateSeparator: "-",
    }),
    $("#datepicker-year").bootstrapdatepicker({
      format: "yyyy",
      viewMode: "year",
      minViewMode: "years",
      multidate: !0,
      multidateSeparator: "-",
    }),
    $(".select2").select2({ minimumResultsForSearch: 1 / 0, width: "100%" }),
    $(".select2-show-search").select2({
      minimumResultsForSearch: "",
      width: "100%",
    });
});
