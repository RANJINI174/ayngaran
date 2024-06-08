  <!-- BACK-TO-TOP -->
  <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- JQUERY JS -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

  <!-- BOOTSTRAP JS -->
  <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

  <!-- INPUT MASK JS-->
  <script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

  <!-- SIDE-MENU JS -->
  <script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

  <!-- SIDEBAR JS -->
  <script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>
  <!-- Data table -->
  <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js   ') }}"></script>
  <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
  
  <script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js')}}"></script>
		<script src="{{ asset('assets/plugins/charts-c3/c3-chart.js')}}"></script>

  <!-- Perfect SCROLLBAR JS-->
  <script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>
  <script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js') }}"></script>

  <!-- SWEET-ALERT JS -->
  <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  <!-- Select 2 -->
  <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
  <!-- INTERNAL Bootstrap-Datepicker js-->
  <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- BOOTSTRAP-DATERANGEPICKER JS -->
  <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- DATEPICKER JS -->
  <script src="{{ asset('assets/plugins/date-picker/date-picker.js') }}"></script>
  <script src="{{ asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>
  <script src="{{ asset('assets/plugins/input-mask/jquery.maskedinput.js') }}"></script>
  <!-- MULTI SELECT JS-->
		<script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
		<script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>
   <!-- FORM WIZARD JS-->
        <script src="{{ asset('assets/plugins/formwizard/jquery.smartWizard.js') }}"></script>
		<script src="{{ asset('assets/plugins/formwizard/fromwizard.js') }}"></script>

		<!-- INTERNAl Jquery.steps js -->
		<script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>

		<!-- INTERNAL Accordion-Wizard-Form js-->
		<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
		<script src="{{ asset('assets/js/form-wizard.js') }}"></script>
		<script src="{{ asset('assets/js/printpage.js') }}"></script>
  <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  </script>
  <!-- Form CUSTOM JS-->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/projects.js') }}"></script>
  <script src="{{ asset('assets/js/registration.js') }}"></script>
  <script src="{{ asset('assets/js/accounts.js') }}"></script>
  
  
  
      <!-- FILE UPLOADES JS -->
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('') }}assets/plugins/fileuploads/js/file-upload.js"></script>



    <!-- INTERNAL File-Uploads Js-->   <!--Updated by Gowtham.s-->
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

  <!-- INTERNAL Sumoselect js-->
    <script src="{{ asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    
  <!-- INTERNAL jquery transfer js-->
<script src="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>

  <!-- INTERNAL multi js-->
    <script src="{{ asset('assets/plugins/multi/multi.min.js') }}"></script>

 
  @yield('scripts')

  <!-- CUSTOM JS-->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
