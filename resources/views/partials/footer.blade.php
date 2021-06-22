
</div>
</div>

<div class="has-modal modal fade" id="showDetaildModal">
    <div class="modal-dialog modal-dialog-centered" id="modalSize">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="showDetaildModalTile">New Client Information</h4>
                <button type="button" class="close icons" data-dismiss="modal">
                    <i class="ti-close"></i>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="showDetaildModalBody">

            </div>

            <!-- Modal footer -->

        </div>
    </div>
</div>


<!--  Start Modal Area -->
<div class="modal fade invoice-details" id="showDetaildModalInvoice">
    <div class="modal-dialog large-modal modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Invoice</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body" id="showDetaildModalBodyInvoice">
            </div>

        </div>
    </div>
</div>


<!-- ================Footer Area ================= -->
<footer class="footer-area pt-10 pb-20">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 text-center">
        <p> {!! config('configs')->where('key', 'copyright_text')->first()->value !!} </p>
            </div>
        </div>
    </div>
</footer>
<!-- ================End Footer Area ================= -->


<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.4.1.min.js"></script>

<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-ui.js">
</script>

<script src="{{asset('public/backEnd/')}}/vendors/js/popper.js">
</script>

<script src="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.js"></script>

<script src="{{asset('public/frontend/')}}/vendors/text_editor/summernote-bs4.js"></script>


<script src="{{asset('public/backEnd/')}}/vendors/js/jquery.data-tables.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/dataTables.buttons.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.flash.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jszip.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.html5.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.print.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/dataTables.rowReorder.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/dataTables.responsive.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.colVis.min.js">
</script>

<script src="{{asset('public/backEnd/')}}/vendors/js/nice-select.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery.magnific-popup.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/fastselect.standalone.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/raphael-min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/morris.min.js">
</script>

<script type="text/javascript" src="{{asset('public/backEnd/')}}/vendors/js/toastr.min.js"></script>

<script type="text/javascript" src="{{asset('public/backEnd/')}}/vendors/js/moment.min.js"></script>

<!-- <script
</script> -->
<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap-datepicker.min.js">
</script>
<!-- tagsinput  -->
<script src="{{asset('public/frontend/')}}/vendors/tagsinput/tagsinput.js"></script>
<!-- summernote  -->
<!--  -->

<!-- nestable  -->
<script src="{{asset('public/frontend/')}}/vendors/nestable/jquery.nestable.js"></script>

<!-- chage  -->

<!-- metisMenu js  -->
<script src="{{asset('public/frontend/')}}/js/metisMenu.js"></script>


<!-- progressbar  -->
<script src="{{asset('public/frontend/')}}/vendors/progressbar/circle-progress.min.js"></script>
<!-- color picker  -->


<script type="text/javascript" src="{{asset('public/backEnd/')}}/js/jquery.validate.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/select2/select2.min.js"></script>


<script src="{{asset('public/backEnd/')}}/js/sweetalert.min.js"></script>
<script src="{{asset('public/backEnd/')}}/js/custom.js"></script>
<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<script src="{{asset('public/backEnd/')}}/js/developer.js"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
<script src="{{ asset('public/js/parsley.min.js') }}"></script>
{!! Toastr::message() !!}
@stack('admin.scripts')
@stack('js_before')
@stack('js_after')
@stack('scripts')
<script type="text/javascript">

    setTimeout(function() {
        $('.preloader').fadeOut('slow', function() {
            $(this).hide();
        });
    }, 0);


    // for select2 multiple dropdown in send email/Sms in Individual Tab
    $("#selectStaffss").select2();
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#selectStaffss > option").prop("selected", "selected");
            $("#selectStaffss").trigger("change");
        } else {
            $("#selectStaffss > option").removeAttr("selected");
            $("#selectStaffss").trigger("change");
        }
    });


    // for select2 multiple dropdown in send email/Sms in Class tab
    $("#selectSectionss").select2();
    $("#checkbox_section").click(function () {
        if ($("#checkbox_section").is(':checked')) {
            $("#selectSectionss > option").prop("selected", "selected");
            $("#selectSectionss").trigger("change");
        } else {
            $("#selectSectionss > option").removeAttr("selected");
            $("#selectSectionss").trigger("change");
        }
    });

</script>

 <script>


    $('.close_modal').on('click', function() {
        $('.custom_notification').removeClass('open_notification');
    });
    $('.notification_icon').on('click', function() {
        $('.custom_notification').addClass('open_notification');
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".custom_notification").length) {
            $("body").find(".custom_notification").removeClass("open_notification");
        }
    });



    $(document).ready(function () {
        $('#languageChange').on('change', function () {
        var str = $('#languageChange').val();
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        // get section for student
        $.ajax({
            type: "POST",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'language-change',
            success: function (data) {
                url= url + '/' + 'locale'+ '/' + data[0].language_universal;
                window.location.href = url;
            },
            error: function (data) {

            }
        });
    });
});
</script>
<script src="{{asset('public/backEnd/')}}/js/search.js"></script>
@yield('script')

</body>
</html>

