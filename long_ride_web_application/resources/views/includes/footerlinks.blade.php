<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

<!-- Jquery js-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!--Internal  Chart.bundle js -->
<script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<!-- Ionicons js-->
<script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>

<!-- Moment js -->
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

<!--Internal  jquery.maskedinput js -->
<script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>

<!--Internal  spectrum-colorpicker js -->
<script src="{{ asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>

<!-- Internal Select2.min js -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Ionicons js -->
<script src="{{ asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>


<!-- P-scroll js -->
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>

<!-- Rating js-->
<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>
<script src="{{ asset('assets/plugins/rating/jquery.barrating.js') }}"></script>

<!-- Sidebar js -->
<script src="{{ asset('assets/plugins/side-menu/sidemenu.js') }}"></script>

<!-- Right-sidebar js -->
<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>
<script src="{{ asset('assets/plugins/sidebar/sidebar-custom.js') }}"></script>

<!-- Sticky js-->
<script src="{{ asset('assets/js/sticky.js') }}"></script>

<!-- eva-icons js -->
<script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>

<!-- Auto generate password -->
<script src="{{ asset('assets/js/password.js') }}"></script>

<!-- Internal Data tables -->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

{{-- <!--Internal Chartjs js -->
<script src="{{ asset('assets/js/chart.chartjs.js') }}"></script> --}}

 <!--Internal Fileuploads js-->
 <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
 <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

<!--Internal  Sweet-Alert js-->
<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>

{{-- <script src="{{ asset('assets/js/form-wizard.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>


<!-- custom js -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Internal form-elements js -->
<script src="{{ asset('assets/js/form-elements.js') }}"></script>

<!-- jquery signature -->
<script src="{{ asset('assets/plugins/jquery-ui-slider/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/signature/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('assets/js/signature/jquery.signature.js') }}"></script>
{{-- <script src="{{ asset('assets/js/signature/jquery.signature.min.js') }}"></script> --}}




<script>
        $.blockUI.defaults.message='<h5 class="mt-2"><i class="fas fa-circle-notch fa-spin mr-2 text-info"></i>Please wait...</h5>';
        $.blockUI.defaults.baseZ= 9999;
        $.blockUI.defaults.css.border='2px solid #17a2b8 ';
        $(document).ajaxStart(function(){ $.blockUI(); });
        $(document).ajaxStop(function(){ $.unblockUI(); });
        $(document).on('submit', function(e) { $.blockUI(); });

        function showToast(icon,title,text){
            Swal.mixin({toast: true, position: 'top',showConfirmButton: false,timer: 3000}).fire( title,text,icon );
        }

    $(document).ready(function () {
        $('.select2').select2();
        $('.select2-container').css('width','100%');
        // $('.fc-datepicker').datepicker();
        $(".fc-datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        defaultDate: moment().toDate(),
        onSelect: function () {
            selectedDate = $.datepicker.formatDate("dd/mm/yy", $(this).datepicker('getDate'));
        }
    });
    });

    $(document).on('click','.pending',function (e) {
    e.preventDefault();

    Swal.fire(
  'Process on work',
  '',
  'info'
)



    })
    function equal_cols(el)
{
    var h = 0;
    $(el).each(function(){
        $(this).css({'height':'auto'});

        if($(this).outerHeight() > h)
        {
            h = $(this).outerHeight();
        }
    });
    $(el).each(function(){
        $(this).css({'height':h});
    });
}

// env('APP_NAME', 'Laravel')
</script>

@if (env('APP_DEBUG', false))



<script>

var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement,60*1000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
	console.log(idleTime);
    idleTime = idleTime + 1;
    if (idleTime > 10) { // 20 minutes
        // window.location.reload();
		$('#logout-form').submit();
    }
}
</script>
@endif
