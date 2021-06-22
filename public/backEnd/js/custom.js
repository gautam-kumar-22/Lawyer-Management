"use strict";

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function () {
    $('.isDisabled').click(function (e) {
        e.preventDefault();
    });


    var review = $('.active-testimonial');
    if (review.length) {
        review.owlCarousel({
            items: 1,
            loop: false,
            margin: 10,
            loop: true,
            autoplay: true,
            smartSpeed: 500,
            navText: [`Prev <img src='public/backEnd/img/prev.png'>`, `Next<img src='public/backEnd/img/next.png'>`]
        });
    }


});




$(document).ready(function () {

    if (($('input#total-attendance').length > 0)) {
        var total_attendance = $('input#total-attendance').val();

        var attendanceArray = total_attendance.split('-');

        $('#total_present').html(attendanceArray[0]);
        $('#total_absent').html(attendanceArray[1]);
        $('#total_late').html(attendanceArray[2]);
        $('#total_halfday').html(attendanceArray[3]);
        $('#total_holiday').html(attendanceArray[4]);
    }
});



// image or file browse

var fileInput = document.getElementById('photo');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderPhoto').placeholder = fileName;
    }
}



var fileInput = document.getElementById('document_file_1');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileOneName').placeholder = fileName;
    }
}


var fileInput = document.getElementById('signature_photo');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('signature_photo_placeholder').placeholder = fileName;
    }
}


var fileInput = document.getElementById('document_file_2');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileTwoName').placeholder = fileName;
    }
}

var fileInput = document.getElementById('document_file_3');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
      "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileThreeName').placeholder = fileName;
    }
}

var fileInput = document.getElementById('document_file_4');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileFourName').placeholder = fileName;
    }
}



// staff photo upload js

var fileInput = document.getElementById('staff_photo');
if (fileInput) {

    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderStaffsFName').placeholder = fileName;
    }
}

// Fees Assign
$('#checkAll').click(function () {
    $('input:checkbox').prop('checked', this.checked);
});

$('input:checkbox').click(function () {
    if (!$(this).is(':checked')) {
        $('#checkAll').prop('checked', false);
    }
    var numberOfChecked = $('input:checkbox:checked').length;
    var totalCheckboxes = $('input:checkbox').length;
    var totalCheckboxes = totalCheckboxes - 1;

    if (numberOfChecked == totalCheckboxes) {
        $('#checkAll').prop('checked', true);
    }
});




function find_duplicate_in_array(arra1) {
    "use strict";
    const object = {};
    var result = 0;

    arra1.forEach(item => {
        if (!object[item])
            object[item] = 0;
        object[item] += 1;
    })

    for (const prop in object) {
        if (object[prop] >= 2) {
            result = 1;
        }
    }
    return result;
}






// to do list

$(".complete_task").on("click", function () {
    var url = $('#url').val();
    var id = $(this).val();
    var formData = {
        id: $(this).val()
    };

    // get section for student
    $.ajax({
        type: "GET",
        data: formData,
        dataType: 'json',
        url: url + '/' + 'remove-to-do',
        success: function (data) {

            setTimeout(function () {
                toastr.success('Operation Success!', 'Success Alert', {
                    "iconClass": 'customer-info'
                }, {
                    timeOut: 2000
                });
            }, 500);

            $("#to_do_list_div" + id + "").remove();


            $('#toDoListsCompleted').children('div').remove();



        },
        error: function (data) {

        }
    });
});

$(document).ready(function () {
    $('.toDoListsCompleted').hide();
});

$(document).ready(function () {
    $('#toDoList').on("click", function (e) {
        e.preventDefault();


        if ($(this).hasClass('tr-bg')) {
            $(this).removeClass('tr-bg');
            $(this).addClass('fix-gr-bg');
        }


        if ($('#toDoListsCompleted').hasClass('fix-gr-bg')) {
            $('#toDoListsCompleted').removeClass('fix-gr-bg');
            $('#toDoListsCompleted').addClass('tr-bg');
        }

        $('.toDoList').show();
        $('.toDoListsCompleted').hide();
    });
});

$(document).ready(function () {
    $('#toDoListsCompleted').on("click", function (e) {
        e.preventDefault();

        if ($(this).hasClass('tr-bg')) {
            $(this).removeClass('tr-bg');
            $(this).addClass('fix-gr-bg');
        }

        if ($('#toDoList').hasClass('fix-gr-bg')) {
            $('#toDoList').removeClass('fix-gr-bg');
            $('#toDoList').addClass('tr-bg');
        }


        $('.toDoList').hide();
        $('.toDoListsCompleted').show();


        var formData = {
            id: 0
        };

        var url = $('#url').val();

        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'get-to-do-list',
            success: function (data) {

                $(".toDoListsCompleted").empty();

                $.each(data, function (i, value) {

                    var appendRow = "";

                    appendRow += "<div class='single-to-do d-flex justify-content-between'>";
                    appendRow += "<div>";
                    appendRow += "<h5 class='d-inline'>" + value.title + "</h5>";
                    appendRow += "<p>" + value.date + "</p>";
                    appendRow += "</div>";
                    appendRow += "</div>";


                    $('.toDoListsCompleted').append(appendRow);
                });
                // });


            },
            error: function (data) {

            }
        });


    });
});



function startDatatable(){
    "use strict";

    $('.Crm_table_active3').DataTable({
        bLengthChange: false,
        "bDestroy": true,
        language: {
            search: "<i class='ti-search'></i>",
            searchPlaceholder: 'Quick Search',
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                text: '<i class="fa fa-files-o"></i>',
                title : $("#logo_title").val(),
                titleAttr: 'Copy',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                title : $("#logo_title").val(),
                margin: [10 ,10 ,10, 0],
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                },

            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i>',
                title : $("#logo_title").val(),
                titleAttr: 'PDF',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                },
                orientation: 'landscape',
                pageSize: 'A4',
                margin: [ 0, 0, 0, 12 ],
                alignment: 'center',
                header: true,
                customize: function ( doc ) {
                doc.content.splice( 1, 0, {
                  margin: [ 0, 0, 0, 12 ],
                  alignment: 'center',
                  image: 'data:image/png;base64,'+$("#logo_img").val()
                } );
                  }

            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                title : $("#logo_title").val(),
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i>',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [{
            visible: false
        }],
        responsive: true,
    });
}

$(document).on('click', '.btn-modal', function(e) {
    e.preventDefault();
    let container = '.' + $(this).data('container');
    $.ajax({
        url: $(this).data('href'),
        dataType: 'html',
        success: function(result) {
            $(container)
                .html(result)
                .modal('show');

            $(container).on('shown.bs.modal', function() {
                $('input:text:visible:first', this).focus();
            })
        },
        error: function(data) {
            toastr.error('Something is not right!', 'Opps!');
        }
    });
});
