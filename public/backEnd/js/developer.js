"use strict";

// for date picker icon click
$('#apply_date_icon').on('click', function () {
    $('#apply_date').focus();
});
// for datepicker icon click
$('#to-date-icon').on('click', function () {
    $('#leave_to').focus();
});
// for datepicker icon click
$('#homework_date_icon').on('click', function () {
    $('#homework_date').focus();
});
// for datepicker icon click
$('#submission_date_icon').on('click', function () {
    $('#submission_date').focus();
});
$('#notice_date_icon').on('click', function () {
    $('#notice_date').focus();
});
$('#publish_on_icon').on('click', function () {
    $('#publish_on').focus();
});
$('#event_start_date').on('click', function () {
    $('#event_from_date').focus();
});
$('#event_end_date').on('click', function () {
    $('#event_to_date').focus();
});
$('#book_return_date_icon').on('click', function () {
    $('#due_date').focus();
});
$('#receive_date_icon').on('click', function () {
    $('#receive_date').focus();
});
// for upload attach file when apply leave
var fileInput = document.getElementById('attach_file');
if (fileInput) {
    //alert("staffs photo");
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderAttachFile').placeholder = fileName;
    }
}
// for global modal 
// $('body').on('click', '.nom_epi', function() { alert("hello"); })
$(document).ready(function () {
    $('body').on("click", ".modalLink", function (e) {

        e.preventDefault();
        $('.modal-backdrop').show();
        $("#showDetaildModal").show();
        $("div.modal-dialog").removeClass('modal-md');
        $("div.modal-dialog").removeClass('modal-lg');
        $("div.modal-dialog").removeClass('modal-bg');
        var modal_size = $(this).attr('data-modal-size');
        if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
            $("#modalSize").addClass(modal_size);
        } else {
            $("#modalSize").addClass('modal-md');
        }
        var title = $(this).attr('title');
        $("#showDetaildModalTile").text(title);
        var data_title = $(this).attr('data-original-title');
        $("#showDetaildModalTile").text(data_title);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').show();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (data) {
                $("#showDetaildModalBody").html(data);
                $("#showDetaildModal").modal('show');
            }
        });
    });
});
// for global Delete
$(document).ready(function () {
    $('body').on("click", ".deleteUrl", function (e) {
        e.preventDefault();
        $('.modal-backdrop').show();
        $("#showDetaildModal").show();
        $("div.modal-dialog").removeClass('modal-md');
        $("div.modal-dialog").removeClass('modal-lg');
        $("div.modal-dialog").removeClass('modal-bg');
        var modal_size = $(this).attr('data-modal-size');
        if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
            $("#modalSize").addClass(modal_size);
        } else {
            $("#modalSize").addClass('modal-md');
        }
        var title = $(this).attr('title');
        $("#showDetaildModalTile").text(title);
        var data_title = $(this).attr('data-original-title');
        $("#showDetaildModalTile").text(data_title);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').show();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (data) {
                $("#showDetaildModalBody").html(data);
                $("#showDetaildModal").modal('show');
            }
        });
    });
});
// select staff name from selecting role name
$(document).ready(function () {
    $("#staffNameByRole").on("change", function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'staffNameByRole',
            success: function (data) {
                var a = '';
                $.each(data, function (i, item) {
                    if (item.length) {
                        $('#selectStaffs').find('option').not(':first').remove();
                        $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        $.each(item, function (i, staffs) {
                            $('#selectStaffs').append($('<option>', {
                                value: staffs.id,
                                text: staffs.full_name
                            }));
                            $("#selectStaffsDiv ul").append("<li data-value='" + staffs.id + "' class='option'>" + staffs.full_name + "</li>");
                        });
                    } else {
                        $('#selectStaffsDiv .current').html('SELECT *');
                        $('#selectStaffs').find('option').not(':first').remove();
                        $('#selectStaffsDiv ul').find('li').not(':first').remove();
                    }
                });
            },
            error: function (data) {

            }
        });
    });
});




// for add staff earnings in payroll
function addMoreEarnings() {
    "use strict";
    var table = document.getElementById("tableID");
    var table_len = (table.rows.length);
    var id = parseInt(table_len);
    var row = table.insertRow(table_len).outerHTML = "<tr id='row" + id + "'><td width='70%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='text' id='earningsType" + id + "' name='earningsType[]'><label for='earningsType" + id + "'>Type</label><span class='focus-border'></span></div></td><td width='20%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='number' id='earningsValue" + id + "' name='earningsValue[]'><label for='earningsValue" + id + "'>Value</label><span class='focus-border'></span></div></td><td width='10%' class='pt-30'><button class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_earings(" + id + ")'><span class='ti-close'></span></button></td></tr>";
}

function delete_earings(id) {
    "use strict";
    var table = document.getElementById("tableID");
    var rowCount = table.rows.length;
    $("#row" + id).html("");
}

// for minus staff deductions in payroll
function addDeductions() {
    "use strict";
    var table = document.getElementById("tableDeduction");
    var table_len = (table.rows.length);
    var id = parseInt(table_len);
    var row = table.insertRow(table_len).outerHTML = "<tr id='DeductionRow" + id + "'><td width='70%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='text' id='deductionstype" + id + "' name='deductionstype[]'><label for='deductionstype" + id + "'>Type</label><span class='focus-border'></span></div></td><td width='20%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='number' id='deductionsValue" + id + "' name='deductionsValue[]'><label for='deductionsValue" + id + "'>Value</label><span class='focus-border'></span></div></td><td width='10%' class='pt-30'><button class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_deduction(" + id + ")'><span class='ti-close'></span></button></td></tr>";
}

function delete_deduction(id) {
    "use strict";
    var tables = document.getElementById("tableDeduction");
    var rowCount = tables.rows.length;
    $("#DeductionRow" + id).html("");
}

// payroll calculate for staff
function calculateSalary() {
    "use strict";
    var basicSalary = $("#basicSalary").val();
    if (basicSalary == 0) {
        alert('Please Add Employees Basic Salary from Staff Update Form First');
    } else {
        var earningsType = document.getElementsByName('earningsValue[]');
        var earningsValue = document.getElementsByName('earningsValue[]');
        var tax = $("#tax").val();
        var total_earnings = 0;
        var total_deduction = 0;
        var deductionstype = document.getElementsByName('deductionstype[]');
        var deductionsValue = document.getElementsByName('deductionsValue[]');
        for (var i = 0; i < earningsValue.length; i++) {
            var inp = earningsValue[i];
            if (inp.value == '') {
                var inpvalue = 0;
            } else {
                var inpvalue = inp.value;
            }
            total_earnings += parseInt(inpvalue);
        }
        for (var j = 0; j < deductionsValue.length; j++) {
            var inpd = deductionsValue[j];
            if (inpd.value == '') {
                var inpdvalue = 0;
            } else {
                var inpdvalue = inpd.value;
            }
            total_deduction += parseInt(inpdvalue);
        }
        var gross_salary = parseInt(basicSalary) + parseInt(total_earnings) - parseInt(total_deduction);
        var net_salary = parseInt(basicSalary) + parseInt(total_earnings) - parseInt(total_deduction) - parseInt(tax);

        $("#total_earnings").val(total_earnings);
        $("#total_deduction").val(total_deduction);
        $("#gross_salary").val(gross_salary);
        $("#final_gross_salary").val(gross_salary);
        $("#net_salary").val(net_salary);

        if ($('#total_earnings').val() != '') {
            $('#total_earnings').focus();
        }

        if ($('#total_deduction').val() != '') {
            $('#total_deduction').focus();
        }

        if ($('#net_salary').val() != '') {
            $('#net_salary').focus();
        }
    }
}

function validateForm() {
    "use strict";
    var x = $("#payment_mode").val();
    if (x === "") {
        $('.modal_input_validation').show();
        $(".modal_input_validation").html("<font style='color:red;'>Must be Fill Up</font>");
        $("span.modal_input_validation").addClass("red_alert");
        return false;
    }
    return true;
    preventDefault();
}

function validateToDoForm() {
    "use strict";
    var todo_title = $("#todo_title").val();
    if (todo_title === "") {
        $('.modal_input_validation').show();
        $(".modal_input_validation").html("<font style='color:red;'>Must be Fill Up</font>");
        $("span.modal_input_validation").addClass("red_alert");
        return false;
    }
    return true;
    preventDefault();
}

$("select.niceSelect").on("change", function () {
    $('.modal_input_validation').hide();
});



// for upload content in teacher module
var fileInput = document.getElementById('upload_content_file');
if (fileInput) {

    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderUploadContent').placeholder = fileName;
    }
}

// for upload Event File  in communication module
var fileInput = document.getElementById('upload_event_image');
if (fileInput) {

    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderEventFile').placeholder = fileName;
    }
}
// for upload Holiday File  in communication module
var fileInput = document.getElementById('upload_holiday_image');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;

        document.getElementById('placeholderHolidayFile').placeholder = fileName;
    }
}
// for add member  in Library module
$(document).ready(function () {
    $('body').on("change", "#member_type", function (e) {
        e.preventDefault();
        role_id = $(this).val();
        if (role_id == '2') {
            $(".forStudentWrapper").slideDown(1000);
            $("#selectStaffsDiv").slideUp(1000);
            $('#selectStaffs').find('option').not(':first').remove();
            $('#selectStaffsDiv ul').find('li').not(':first').remove();
        } else {
            $(".forStudentWrapper").slideUp(1000);
            $("#selectStaffsDiv").slideDown(1000);

            $('#select_student').find('option').not(':first').remove();
            $('#select_student_div ul').find('li').not(':first').remove();


            var url = $('#url').val();
            var formData = {
                id: $(this).val()
            };


            // get section for student
            $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'staffNameByRole',
                success: function (data) {

                    var a = '';
                    $.each(data, function (i, item) {
                        if (item.length) {
                            $('#selectStaffs').find('option').not(':first').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();
                            $.each(item, function (i, staffs) {
                                if (role_id == "3") {
                                    $('#selectStaffs').append($('<option>', {
                                        value: staffs.user_id,
                                        text: staffs.fathers_name
                                    }));
                                    $("#selectStaffsDiv ul").append("<li data-value='" + staffs.user_id + "' class='option'>" + staffs.fathers_name + "</li>");
                                } else {
                                    $('#selectStaffs').append($('<option>', {
                                        value: staffs.user_id,
                                        text: staffs.full_name
                                    }));
                                    $("#selectStaffsDiv ul").append("<li data-value='" + staffs.user_id + "' class='option'>" + staffs.full_name + "</li>");
                                }
                            });
                        } else {
                            $('#selectStaffsDiv .current').html('SELECT *');
                            $('#selectStaffs').find('option').not(':first').remove();
                            $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        }
                    });

                },
                error: function (data) {

                }
            });
        }
    });
});



function printDiv(divID) {
    "use strict";
    //Get the HTML of div
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";
    //Print Page
    window.print();
    //Restore orignal HTML
    document.body.innerHTML = oldPage;
}


// in communication send To tab selected
$(".nav-link").on("click", function () {
    var selectTab = $(this).attr('selectTab');
    $("#selectTab").val(selectTab);
    $("#initialselectTab").val();
});




// for upload main School logo in General Settings
//var upload_logo = document.getElementById('upload_logo');
var upload_logo = document.getElementById('logo_wrapper');
if (upload_logo) {

    upload_logo.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var upload_logo = event.srcElement;
        var fileName = upload_logo.files[0].name;

    }
}

// for document upload in profile View
var staff_upload_document = document.getElementById('staff_upload_document');
if (staff_upload_document) {

    staff_upload_document.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var staff_upload_document = event.srcElement;
        var fileName = staff_upload_document.files[0].name;

    }
}

$("#email_engine_type").on("change", function () {
    email_engine_type = $("#email_engine_type").val();
    if (email_engine_type == 'email') {
        $(".smtp_inner_wrapper").slideUp();
    } else {
        $(".smtp_wrapper").slideDown();
        $(".smtp_wrapper_block").slideDown();
        $(".smtp_inner_wrapper").slideDown();
    }
});


function readURL(input) {
    "use strict";
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function () {
    readURL(this);
});
