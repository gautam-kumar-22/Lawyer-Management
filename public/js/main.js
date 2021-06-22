 "use strict";
/*
 * Form Checkbox Uniform
 */

var _componentUniform = function () {

    if (!$().uniform) {
        console.warn('Warning - uniform.min.js is not loaded.');
        return;
    }
    $('.form-input-styled').uniform();
};

/*
 * Tooltip Custom Color
 */

var _componentTooltipCustomColor = function () {

    $('[data-popup=tooltip-custom]').tooltip({
        template: '<div class="tooltip"><div class="arrow border-teal"></div><div class="tooltip-inner bg-teal"></div></div>'
    });
};

/*
 * Form Datepicker Uniform
 */

if ($().summernote && $('.summernote').length) {
$('.summernote').summernote({
    toolbar: [
        [ 'style', [ 'style' ] ],
        [ 'font', [ 'bold', 'italic', 'underline'] ],
        [ 'fontname', [ 'fontname' ] ],
        [ 'fontsize', [ 'fontsize' ] ],
        [ 'color', [ 'color' ] ],
        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
        [ 'table', [ 'table' ] ],
        [ 'insert', [ 'link'] ],
        [ 'view', [  'fullscreen', 'codeview' ] ],

    ],
    height : 200,
    tooltip : false

});
}


var _componentDatePicker = function (drops = 'down') {

    var locatDate = moment.utc().format('YYYY-MM-DD');
    var stillUtc = moment.utc(locatDate).toDate();
    var year = parseInt(moment(stillUtc).local().format('YYYY')) + 2;
    $('.date').attr('readonly', true);

    $('.date').daterangepicker({
        "applyClass": 'bg-slate-600',
        "cancelClass": 'btn-light',
        'setDate': null,
        "singleDatePicker": true,
        "locale": {
            "format": 'YYYY-MM-DD'
        },
        "drops": drops,
        "showDropdowns": true,
        "minYear": 1900,
        "maxYear": year,
        "timePicker": false,
        "alwaysShowCalendars": true,
    });
};

/*
 * Form Select 2 For Modal
 */

var _componentSelect2Modal = function () {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });
};

var _componentSelect2SelectModal = function () {
    "use strict";
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('#select_form .select').select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
    });
};

/*
 * Form Select2
 */
var _componentSelect2Normal = function () {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });

};

/*
 * For Switchery for Datatable Status
 */

var _componentStatusSwitchery = function () {

    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-status-switchery'));

    if (elems.length > 0) {
        elems.forEach(function (html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * For Switchery input field
 */

var _componentInputSwitchery = function () {

    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var input_elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
    if (input_elems.length > 0) {
        input_elems.forEach(function (html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * Form Validation
 */

var _formValidation = function (form_id = '#content_form') {

    let form = $(form_id);
    if (form.length > 0) {
        form.parsley().on('field:validated', function () {
            const ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
        form.on('submit', function (e) {
            e.preventDefault();
            form.find('.submit').hide();
            form.find('.submitting').show();
            const submit = $('#submit');
            const submit_val = submit.val();
            const submit_url = form.attr('action');
            //Start Ajax
            const formData = new FormData(form[0]);
            formData.append('submit', submit_val);
            $.ajax({
                url: submit_url,
                type: 'POST',
                data: formData,
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: 'JSON',
                success: function (data) {

                    if(data.demo == true){
                        toastr.warning('This feature is disabled for demo.');
                    }else{
                        toastr.success(data.message, 'Succes');
                    }


                    form[0].reset();
                    if (data.goto) {
                        setTimeout(function () {
                            window.location.href = data.goto;
                        }, 1500);

                        if (data.window) {
                            window.open(data.window, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                            setTimeout(function () {
                                window.location.href = '';
                            }, 1000);
                        }
                    }
                    form.find('.submit').show();
                    form.find('.submitting').hide();
                },
                error: function (data) {
                    form.find('.submit').show();
                    form.find('.submitting').hide();
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors;
                    if (errors) {
                        var i = 0;
                        $.each(errors, function (key, value) {
                            const first_item = Object.keys(errors)[i];
                            $('.parsley-required').remove();
                            if($('#' + first_item).length){
                                $('#' + first_item).parsley().addError('required', {
                                    message: value,
                                    updateClass: true
                                });
                            }
                            toastr.error(value, 'Error');

                            i++;
                        });
                    } else {
                        toastr.error(jsonValue.message, 'Something Wrong!');

                    }
                }
            });
        });
    }
};


/*
 * Form Validation For Modal
 */

var _modalFormValidation = function () {

    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }
    $('#content_form').on('submit', function (e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'danger') {
                    new PNotify({
                        title: 'Error',
                        text: data.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });

                } else {
                    new PNotify({
                        title: 'Well Done!',
                        text: data.message,
                        type: 'success',
                        addclass: 'alert alert-styled-left',
                    });
                    $('#submit').show();
                    $('#submiting').hide();
                    $('#modal_remote').modal('toggle');
                    if (data.goto) {
                        setTimeout(function () {

                            window.location.href = data.goto;
                        }, 2500);
                    }
                    if (typeof (tariq) != "undefined" && tariq !== null) {
                        tariq.ajax.reload(null, false);
                    }
                }
            },
            error: function (data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function (key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }
                      new PNotify({
                            width: '30%',
                            title: jsUcfirst(first_item) + ' Error!!',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        width: '30%',
                        title: 'Something Wrong!',
                        text: jsonValue.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};


$(document).ready(function () {

    /*
     * For Delete Item
     */
    $(document).on('click', '#delete_item', function (e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        $('#action_menu_' + row).hide();
        $('#delete_loading_' + row).show();

        swal({
            title: "Are you sure?",
            text: "Once deleted, it will deleted all related Data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        method: 'Delete',
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        dataType: 'JSON',
                        success: function (data) {

                            if(data.demo == true){
                                toastr.warning('This feature is disabled for demo.');
                            }else{
                                toastr.success(data.message, 'Succes');
                            }

                            if (data.goto) {
                                setTimeout(function () {
                                    window.location.href = data.goto;
                                }, 1500);
                            }

                            if (data.load) {
                                setTimeout(function () {
                                    window.location.href = "";
                                }, 1500);
                            }
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        },
                        error: function (data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            var i = 0;
                            $.each(errors, function (key, value) {
                                toastr.error(value, 'Error');

                                i++;
                            });
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        }
                    });
                } else {
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                }
            });
    });

    $('.date').attr('readonly', true);
});


/*
 * For Uppercase Word first Letter
 */
function jsUcfirst(string) {
    "use strict";
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function p_notify(msg = 'Something Wrong', type = 'error', title = "Opps!!") {
    new PNotify({
        title: title,
        text: msg,
        type: type,
        addclass: 'alert alert-styled-left',
    });
}

function noty(msg = 'Something Wrong', type = 'error', title = "Opps!!", layout = 'topRight') {

    new Noty({
        theme: 'tekmarks',
        timeout: 2000,
        title: title,
        text: msg,
        type: type,
        modal: true,
        layout: 'center'
    }).show();
}

function show_submit_loading(button = $('#submit')) {

    button.attr('disabled', true);
    const card = button.closest('.card');
    if (card.length > 0) {
        cardBlock(card);
    }

}

function hide_submit_loading(button = $('#submit')) {

    $('#submit').attr('disabled', false);
    const card = button.closest('.card');
    if (card.length > 0) {
        cardUnblock(card);
    }
    $('.loader').remove();
}

$(document).ready(function () {

    /*
     * For Logout
     */
    $(document).on('click', '#logout', function (e) {
        e.preventDefault();
        $('.preloader').show('fade');
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            method: 'Post',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                toastr.success(data.message)
                setTimeout(function () {
                    window.location.href = data.goto;
                }, 2000);
            },
            error: function (data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors
                var i = 0;
                $.each(errors, function (key, value) {
                    toastr.error(value)
                    i++;
                });
            }
        });
    });

});

function cardBlock(card) {

    card.block({
        message: '<i class="icon-spinner3 icon-3x text-danger spinner"></i>',
        overlayCSS: {
            backgroundColor: '#1B2024',
            opacity: 0.85,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none',
            color: '#fff'
        }
    });
}

function cardUnblock(card) {

    card.unblock();
}


function _componentAjaxChildLoad(form_id = '#content_form', parent_id = '#country_id', child_id = '#state_id', module='state') {

    $(document).on('change', parent_id, function(e) {
        var content_id = form_id + ' ' + child_id;
        var value = $(this).val();
        $(content_id + '>option').remove();
        var child = $(form_id + ' select' + child_id);
        child.append(
            $('<option>', {
                value: '',
                text: 'Select '+ ucword(module)
            })
        );
        $.ajax({
                url: SET_DOMAIN + '/select/'+module,
                type: 'post',
                data: {
                    value: value
                },
                dataType: 'json'
            })
            .done(function(data) {
                $.each(data, function(i, v) {
                    child.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                child.trigger('change');
                child.niceSelect('update');
            })
            .fail(function(data) {
                toastr.error('Something Wrong!', 'Error')
            });
    });
};

function ucword(value){

    if(!value)
        return;

    return value.toLowerCase().replace(/\b[a-z]/g, function(value) {
        return value.toUpperCase();
    });
}



function _componentAjaxCourtLoad(form_id = '#content_form', select_id = '#court_category_id', district_id = '#court_id') {

    $(document).on('change', select_id, function(e) {
        var content_id = form_id + ' ' + district_id;
        var court_category_id = $(this).val();
        $(content_id + '>option').remove();
        var district = $(form_id + ' select' + district_id);
        district.append(
            $('<option>', {
                value: '',
                text: 'Select Court'
            })
        );
        // district.trigger('change');
        $.ajax({
                url: SET_DOMAIN + '/api/select/court',
                type: 'post',
                data: {
                    court_category_id: court_category_id
                },
                dataType: 'json'
            })
            .done(function(data) {

                $.each(data, function(i, v) {
                    district.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                district.trigger('change');
            })
            .fail(function(data) {
                new PNotify({
                    title: 'Something Wrong!',
                    text: 'Check Again And Try Again',
                    type: 'error',
                    addclass: 'alert alert-danger alert-styled-left',
                });
            });
    });
};


function _componentCourtCategorySelect2(id = '#content_form', select_id = '#court_category_id') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_court_category" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Court Category</button>'
                    );
                } else {
                    return 'No Court Category Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_court_category', function() {
    var form_id = $(this).data('form_id');
    $('#court_category_id').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/category/court',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#court_category_id').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentCaseCategorySelect2(id = '#content_form', select_id = '#case_category_id') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_case_category" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Case Category</button>'
                    );
                } else {
                    return 'No Case Category Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_case_category', function() {
    var form_id = $(this).data('form_id');
    $('#case_category_id').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/category/case',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#case_category_id').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentActSelect2(id = '#content_form', select_id = '#acts') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id).parent().find('.select2-search__field').val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_act" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Act</button>'
                    );
                } else {
                    return 'No Act Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_act', function() {

    var form_id = $(this).data('form_id');
    $('#acts').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/master/act',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#acts').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                );
                var pre_val = $('select#acts' )
                    .val();
                pre_val.push(data.model.id);
                    $('select#acts')
                    .val(pre_val)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentClientCategorySelect2(id = '#content_form', select_id = '#client_category_id') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_client_category" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Client Category</button>'
                    );
                } else {
                    return 'No Client Category Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_client_category', function() {
    var form_id = $(this).data('form_id');
    $('#client_category_id').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/category/client',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#client_category_id').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentLawyerSelect2(id = '#content_form', select_id = '#lawyer_id') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_lawyer" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Lawyer</button>'
                    );
                } else {
                    return 'No Lawyer Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_lawyer', function() {
    var form_id = $(this).data('form_id');
    $('#lawyer_id').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/lawyer',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#lawyer_id').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentCaseStageSelect2(id = '#content_form', select_id = '#stage_id') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_stage" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Case Stage</button>'
                    );
                } else {
                    return 'No Case Stage Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_stage', function() {
    var form_id = $(this).data('form_id');
    $('#stage_id').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/master/stage',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#stage_id').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentCourtSelect2(id = '#content_form', select_id = '#court_id') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_court" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Court</button>'
                    );
                } else {
                    return 'No Court Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_court', function() {

    var form_id = $(this).data('form_id');
    $('#court_id').select2('close');
    var name = $(this).data('name');
    var court_category_id = $('#court_category_id').val();
    if (court_category_id) {
        $.ajax({
                url: SET_DOMAIN + '/master/court',
                type: 'post',
                data: {
                    name: name,
                    court_category_id: court_category_id
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#court_id').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
        } else{
            p_notify('Select Court Category First');
        }
});

function _componentPlaintiffSelect2(id = '#content_form', select_id = '#plaintiff') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_plaintiff" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Client</button>'
                    );
                } else {
                    return 'No Client Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_plaintiff', function() {
    var form_id = $(this).data('form_id');
    $('#plaintiff').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/client',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#plaintiff').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentOppositeSelect2(id = '#content_form', select_id = '#opposite') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_opposite" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Client</button>'
                    );
                } else {
                    return 'No Client Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_opposite', function() {

    var form_id = $(this).data('form_id');
    $('#opposite').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/client',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#opposite').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});

function _componentContactCategorySelect2(id = '#content_form', select_id = '#contact_category_id') {

    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_contact_category" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Client</button>'
                    );
                } else {
                    return 'No Contact Category Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_contact_category', function() {
    var form_id = $(this).data('form_id');
    $('#contact_category_id').select2('close');
    var name = $(this).data('name');
        $.ajax({
                url: SET_DOMAIN + '/category/contact',
                type: 'post',
                data: {
                    name: name
                },
                dataType: 'json'
            })
            .done(function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('select#contact_category_id').append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                ).val(data.model.id)
                    .trigger('change');
            })
            .fail(function(data) {
                p_notify(data.message);
            });
});


// new js

function ajax_error(data) {

    if (data.status === 404) {
        toastr.error("What you are looking is not found", 'Opps!');
        return;
    } else if (data.status === 500) {
        toastr.error('Something went wrong. If you are seeing this message multiple times, please contact Spondon IT authors.', 'Opps');
        return;
    } else if (data.status === 200) {
        toastr.error('Something is not right', 'Error');
        return;
    }
    let jsonValue = $.parseJSON(data.responseText);
    let errors = jsonValue.errors;
    if (errors) {
        let i = 0;
        $.each(errors, function(key, value) {
            let first_item = Object.keys(errors)[i];
            let error_el_id = $('#' + first_item);
            if (error_el_id.length > 0) {
                error_el_id.parsley().addError('ajax', {
                    message: value,
                    updateClass: true
                });
            }

            toastr.error(value, 'Validation Error');
            i++;
        });
    } else {
        toastr.error(jsonValue.message, 'Opps!');
    }
}

function jsUcfirst(string) {

    return string.charAt(0).toUpperCase() + string.slice(1);
}


function _formValidation2(form_id = 'content_form', modal = false, modal_id = 'content_modal', ajax_table = null) {

    const form = $('#' + form_id);

    if (!form.length) {
        return;
    }

    form.parsley().on('field:validated', function() {
        $('.parsley-ajax').remove();
        const ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    form.on('submit', function(e) {
        e.preventDefault();
        $('.parsley-ajax').remove();
        form.find('.submit').hide();
        form.find('.submitting').show();
        const submit_url = form.attr('action');
        const method = form.attr('method');
        //Start Ajax
        const formData = new FormData(form[0]);
        $.ajax({
            url: submit_url,
            type: method,
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                if(data.demo == true){
                    toastr.warning('This feature is disabled for demo.');
                }else{
                    toastr.success(data.message, 'Succes');
                }

                if (modal) {
                    $("." + modal_id).modal('hide');
                }
                if (ajax_table) {
                    ajax_table.ajax.reload();
                }

                if (data.goto) {
                    window.location.href = data.goto;
                }

                if (data.reload) {
                    window.location.href = '';
                }

                form.find('.submit').show();
                form.find('.submitting').hide();

            },
            error: function(data) {
                ajax_error(data);
                form.find('.submit').show();
                form.find('.submitting').hide();
            }
        });
    });
}


function change_status(button, ajax_table = null, change_status = false) {

    $(document).on('click', '#' + button, function(e) {
        e.preventDefault();
        var url = $(this).data('href');
        var status = $(this).data('status');
        var msg = '';
        if (status === 1) {
            msg = 'Change status from active to inactive';
        } else {
            msg = 'Change status from inactive to active';
        }

        if (!change_status) {
            msg = $(this).data('msg');
            if (!msg) {
                msg = 'Once deleted, it will delete all related data also';
            }
        } else {
            url = url + '?action=change_status';
        }

        swal({
                title: 'Are you sure?',
                text: msg,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#66cc99',
                cancelButtonColor: '#ff6666',
                confirmButtonText: 'Yes, Do it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'Delete',
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        dataType: 'JSON',
                        success: function(data) {
                            toastr.success(data.message, 'Success');
                            if (ajax_table) {
                                ajax_table.ajax.reload();
                            }
                        },
                        error: function(data) {
                            ajax_error(data);
                        }
                    });
                }
            });
    });
}


function convertNumber(number) {

    var number = parseFloat(number);
    if (isNaN(number)) {
        return 0;
    }

    return number;
}

function imageChangeWithFile(input, srcId) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(srcId)
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

 var index = 0;
 $(document).on('click','#file_add',function(){
     index = $('.attach-item').length
     addNewFileAddItem(index)
 });

 $(document).on('click','.case-attach',function(){
     $(this).parent().remove();
 });

 $(document).on('change','.file-upload-multi',function(e){
     let fileName = e.target.files[0].name;
     $(this).parent().parent().find('#placeholderStaffsName').attr('placeholder',fileName);
 });

 function addNewFileAddItem(index){
     "use strict";

     var attachFile = '<div class="attach-file-section d-flex align-items-center">\n' +
         '        <div class="primary_input flex-grow-1">\n' +
         '            <div class="primary_file_uploader">\n' +
         '                <input class="primary-input" type="text" id="placeholderStaffsName" placeholder="Browse file" readonly>\n' +
         '                <button class="" type="button">\n' +
         '                    <label class="primary-btn small fix-gr-bg"\n' +
         '                           for="attach_file_'+index+'">Browse</label>\n' +
         '                    <input type="file" class="d-none file-upload-multi" name="file[]" id="attach_file_'+index+'">\n' +
         '                </button>\n' +
         '            </div>\n' +
         '        </div>\n' +
         '        <span style="cursor:pointer;" class="primary-btn small fix-gr-bg icon-only case-attach" type="button" > <i class="ti-trash"></i> </span>\n' +
         '    </div>';

     $('.attach-file-row').append(attachFile);
 }
