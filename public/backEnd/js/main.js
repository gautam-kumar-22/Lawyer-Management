	'use strict';

	// metisMenu 
	var metismenu = $("#sidebar_menu");
	if(metismenu.length){
		metismenu.metisMenu();
	}
	
	$(".open_miniSide").on("click", function () {
		$(".sidebar").toggleClass("mini_sidebar");
		$("#main-content").toggleClass("mini_main_content");
	  });
	  

	  $(document).on("click", function(event){
        if (!$(event.target).closest(".sidebar,.sidebar_icon  ").length) {
            $("body").find(".sidebar").removeClass("active");
        }
    });

	function slideToggle(clickBtn, toggleDiv) {
		clickBtn.on('click', function () {
			toggleDiv.stop().slideToggle('slow');
		});
	}
	$(document).ready(function(){
		$(".Earning_add_btn").on("click", function(){
			$(".single_earning_value").append(`<div class="row">
			<div class="col-lg-7">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Type</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
			<div class="col-lg-5">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Value</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
		</div>`);
		});
	});
	$(document).ready(function(){
		$(".deductions_add_btn").on("click", function(){
			$(".single_deductions_value").append(`<div class="row">
			<div class="col-lg-7">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Type</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
			<div class="col-lg-5">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Value</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
		</div>`);
		});
	});
	function removeDiv(clickBtn, toggleDiv) {
		"use strict";
		clickBtn.on('click', function () {
			toggleDiv.hide('slow', function () {
				toggleDiv.remove();
			});
		});
	}

	slideToggle($('#barChartBtn'), $('#barChartDiv'));
	removeDiv($('#barChartBtnRemovetn'), $('#incomeExpenseDiv'));
	slideToggle($('#areaChartBtn'), $('#areaChartDiv'));
	removeDiv($('#areaChartBtnRemovetn'), $('#incomeExpenseSessionDiv'));

	/*-------------------------------------------------------------------------------
         Start Primary Button Ripple Effect
	   -------------------------------------------------------------------------------*/
	$('.primary-btn').on('click', function (e) {
		// Remove any old one
		$('.ripple').remove();

		// Setup
		var primaryBtnPosX = $(this).offset().left,
			primaryBtnPosY = $(this).offset().top,
			primaryBtnWidth = $(this).width(),
			primaryBtnHeight = $(this).height();

		// Add the element
		$(this).prepend("<span class='ripple'></span>");

		// Make it round!
		if (primaryBtnWidth >= primaryBtnHeight) {
			primaryBtnHeight = primaryBtnWidth;
		} else {
			primaryBtnWidth = primaryBtnHeight;
		}

		// Get the center of the element
		var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
		var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

		// Add the ripples CSS and start the animation
		$('.ripple')
			.css({
				width: primaryBtnWidth,
				height: primaryBtnHeight,
				top: y + 'px',
				left: x + 'px'
			})
			.addClass('rippleEffect');
	});

	// for form popup 
    $('.pop_up_form_hader').click( function(){
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
        } else {
            $('.pop_up_form_hader.active').removeClass('active');
            $(this).addClass('active');    
        }
	});
	$(document).click(function(event){
        if (!$(event.target).closest(".company_form_popup").length) {
            $("body").find(".pop_up_form_hader").removeClass("active");
        }
    });
	jQuery(document).ready(function($) {
		$('.small_circle_1').circleProgress({
			value: 0.75,
			size: 60,
			lineCap: 'round',
			emptyFill: '#F5F7FB',
			thickness:'5',
			fill: {
			  gradient: [["#7C32FF", .47], ["#C738D8", .3]]
			}
		  });
		});
	jQuery(document).ready(function($) {
		$('.large_circle').circleProgress({
			value: 0.75,
			size: 228,
			lineCap: 'round',
			emptyFill: '#F5F7FB',
			thickness:'5',
			fill: {
			  gradient: [["#7C32FF", .47], ["#C738D8", .3]]
			}
		  });
		});
		
	jQuery(document).ready(function($) {
        $(".entry-content").hide('slow');
        $(".entry-title").click(function() {
            $(".entry-content").hide();
        $(this).parent().children(".entry-content").slideToggle(600); });
        });


		

	/*-------------------------------------------------------------------------------
         Start Add Deductions
	   -------------------------------------------------------------------------------*/
	$('#addDeductions').on('click', function () {
		$('#addDeductionsTableBody').append(
			'<tr>' +
			'<td width="80%" class="pr-30 pt-20">' +
			'<div class="input-effect mt-10">' +
			'<input class="primary-input form-control" type="text" id="searchByFileName">' +
			'<label for="searchByFileName">Type</label>' +
			'<span class="focus-border"></span>' +
			'</div>' +
			'</td>' +
			'<td width="20%" class="pt-20">' +
			'<div class="input-effect mt-10">' +
			'<input class="primary-input form-control" type="text" id="searchByFileName">' +
			'<label for="searchByFileName">Value</label>' +
			'<span class="focus-border"></span>' +
			'</div>' +
			'</td>' +
			'<td width="10%" class="pt-30">' +
			'<button class="primary-btn icon-only fix-gr-bg close-deductions">' +
			'<span class="ti-close"></span>' +
			'</button>' +
			'</td>' +
			'</tr>'
		);
	});

	$('#addDeductionsTableBody').on('click', '.close-deductions', function () {
		$(this).closest('tr').fadeOut(500, function () {
			$(this).closest('tr').remove();
		});
	});

	
	/*-------------------------------------------------------------------------------
         End Add Earnings
	   -------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------
         Start Upload file and chane placeholder name
	   -------------------------------------------------------------------------------*/
	var fileInput = document.getElementById('browseFile');
	if (fileInput) {
		fileInput.addEventListener('change', showFileName);
		function showFileName(event) {
			"use strict";
			var fileInput = event.srcElement;
			var fileName = fileInput.files[0].name;
			document.getElementById('placeholderInput').placeholder = fileName;
		}
	}

	if ($('.multipleSelect').length) {
		$('.multipleSelect').fastselect();
	}

	/*-------------------------------------------------------------------------------
         End Upload file and chane placeholder name
	   -------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------
         Start Check Input is empty
	   -------------------------------------------------------------------------------*/
	$('.input-effect input').each(function () {
		if ($(this).val().length > 0) {
			$(this).addClass('read-only-input');
		} else {
			$(this).removeClass('read-only-input');
		}

		$(this).on('keyup', function () {
			if ($(this).val().length > 0) {
				$(this).siblings('.invalid-feedback').fadeOut('slow');
			} else {
				$(this).siblings('.invalid-feedback').fadeIn('slow');
			}
		});
	});

	$('.input-effect textarea').each(function () {
		if ($(this).val().length > 0) {
			$(this).addClass('read-only-input');
		} else {
			$(this).removeClass('read-only-input');
		}
	});

	/*-------------------------------------------------------------------------------
         End Check Input is empty
	   -------------------------------------------------------------------------------*/
	$(window).on('load', function () {
		$('.input-effect input, .input-effect textarea').focusout(function () {
			if ($(this).val() != '') {
				$(this).addClass('has-content');
			} else {
				$(this).removeClass('has-content');
			}
		});
	});

	/*-------------------------------------------------------------------------------
         End Input Field Effect
	   -------------------------------------------------------------------------------*/
	// Search icon
	$('#search-icon').on('click', function () {
		$('#search').focus();
	});

	$('#start-date-icon').on('click', function () {
		$('#startDate').focus();
		
	});

	$('#end-date-icon').on('click', function () {
		$('#endDate').focus();
	});
	$('.primary-input.date').datepicker({
		todayHighlight : true,
		autoclose : true,
		format : 'yyyy-mm-dd',
		setDate: new Date()
		// setDate: new Date()
	});
	


	$('#startDate').datepicker({
		Default: {
			leftArrow: '<i class="fa fa-long-arrow-left"></i>',
			rightArrow: '<i class="fa fa-long-arrow-right"></i>'
		}
	});
	/*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
       -------------------------------------------------------------------------------*/
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
	});
	$('#close_sidebar').on('click', function () {
        $('#sidebar').removeClass('active');
    })

	// setNavigation();
	/*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
	   -------------------------------------------------------------------------------*/
	$(window).on('load', function () {

		$('.dataTables_wrapper .dataTables_filter input').on('focus', function () {
			$('.dataTables_filter > label').addClass('jquery-search-label');
		});

		$('.dataTables_wrapper .dataTables_filter input').on('blur', function () {
			$('.dataTables_filter > label').removeClass('jquery-search-label');
		});
	});

	// Student Details
	

	$('.single-cms-box .btn').on('click', function () {
		$(this).fadeOut(500, function () {
			$(this).closest('.col-lg-2.mb-30').hide();
		});
	});

	/*----------------------------------------------------*/
	/*  Magnific Pop up js (Image Gallery)
    /*----------------------------------------------------*/
	$('.pop-up-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	/*-------------------------------------------------------------------------------
         Jquery Table
	   -------------------------------------------------------------------------------*/
	
	/*-------------------------------------------------------------------------------
         Nice Select 
	   -------------------------------------------------------------------------------*/
	if ($('.niceSelect').length) {
		$('.niceSelect').niceSelect();
	}
    //niceselect select jquery
    $('.nice_Select').niceSelect();
    //niceselect select jquery
    $('.nice_Select2').niceSelect();
    $('.primary_select').niceSelect();
	/*-------------------------------------------------------------------------------
       Full Calendar Js 
	-------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------
       Moris Chart Js 
	-------------------------------------------------------------------------------*/
	$(document).ready(function () {
		if ($('#commonAreaChart').length) {
			barChart();
		}
		if ($('#commonAreaChart').length) {
			areaChart();
		}
		if ($('#donutChart').length) {

			donutChart();
		}
	});

	

	function donutChart() {
		var total_collection = document.getElementById("total_collection").value;
		var total_assign = document.getElementById("total_assign").value;

		var due = total_assign - total_collection;


		window.donutChart = Morris.Donut({
			element: 'donutChart',
			data: [{ label: 'Total Collection', value: total_collection }, { label: 'Due', value: due }],
			colors: ['#7c32ff', '#c738d8'],
			resize: true,
			redraw: true
		});
	}


	// for MENU notification
	$('.bell_notification_clicker').on('click', function () {
		$('.Menu_NOtification_Wrap').toggleClass('active');
	});

	$(document).on("click", function(event){
        if (!$(event.target).closest(".bell_notification_clicker ,.Menu_NOtification_Wrap").length) {
            $("body").find(".Menu_NOtification_Wrap").removeClass("active");
        }
	});

	// OPEN CUSTOMERS POPUP
	$('.pop_up_form_hader').on('click', function () {
		$('.company_form_popup').toggleClass('Company_Info_active');
		$('.pop_up_form_hader').toggleClass('Company_Info_opened');
	});

	$(document).on("click", function(event){
        if (!$(event.target).closest(".pop_up_form_hader ,.company_form_popup").length) {
            $("body").find(".company_form_popup").removeClass("Company_Info_active");
            $("body").find(".pop_up_form_hader").removeClass("Company_Info_opened");
        }
	});


	// CHAT_MENU_OPEN 
    $('.CHATBOX_open').on('click', function() {
        $('.CHAT_MESSAGE_POPUPBOX').toggleClass('active');
    });
    $('.MSEESAGE_CHATBOX_CLOSE').on('click', function() {
        $('.CHAT_MESSAGE_POPUPBOX').removeClass('active');
    });
    $(document).on("click", function(event) {
        if (!$(event.target).closest(".CHAT_MESSAGE_POPUPBOX, .CHATBOX_open").length) {
            $("body").find(".CHAT_MESSAGE_POPUPBOX").removeClass("active");
        }
    });


	// add_action 
    $('.add_action').on('click', function() {
        $('.quick_add_wrapper').toggleClass('active');
    });
    $(document).on("click", function(event) {
        if (!$(event.target).closest(".quick_add_wrapper, .add_action").length) {
            $("body").find(".quick_add_wrapper").removeClass("active");
        }
    });


	// filter_text 
    $('.filter_text span').on('click', function() {
        $('.filterActivaty_wrapper').toggleClass('active');
    });
    $(document).on("click", function(event) {
        if (!$(event.target).closest(".filterActivaty_wrapper , .filter_text span").length) {
            $("body").find(".filterActivaty_wrapper").removeClass("active");
        }
    });


 //active courses option
 $(".leads_option_open").on("click", function() {
    $(this).parent(".dots_lines").toggleClass("leads_option_active");
  });
	$(document).on("click", function(event) {
		if (!$(event.target).closest(".dots_lines").length) {
		  $("body")
			.find(".dots_lines")
			.removeClass("leads_option_active");
		}
	  });
// ######  inbox style icon ######
$('.favourite_icon i').on('click', function(e) {
    $(this).toggleClass("selected_favourite"); //you can list several class names 
    e.preventDefault();
  });


// ######  copyTask style #######
$(".CopyTask_clicker").on("click", function() {
    $(this).parent("li.copy_task").toggleClass("task_expand_wrapper_open");
  });
	$(document).on("click", function(event) {
		if (!$(event.target).closest("li.copy_task").length) {
		  $("body")
			.find("li.copy_task")
			.removeClass("task_expand_wrapper_open");
		}
	});

// ######  copyTask style #######
$(".Reminder_clicker").on("click", function() {
    $(this).parent("li.Set_Reminder").toggleClass("task_expand_wrapper_open");
  });
	$(document).on("click", function(event) {
		if (!$(event.target).closest("li.Set_Reminder").length) {
		  $("body")
			.find("li.Set_Reminder")
			.removeClass("task_expand_wrapper_open");
		}
	  });

// Crm_table_active 
if ($('.Crm_table_active').length) {
    $('.Crm_table_active').DataTable({
        bLengthChange: false,
        "bDestroy": true,
        language: {
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        columnDefs: [{
            visible: false
        }],
        responsive: true,
        searching: false,
    });
}

// Crm_table_active 2
  if ($('.Crm_table_active2').length) {
    $('.Crm_table_active2').DataTable({
        bLengthChange: false,
        "bDestroy": false,
        language: {
            search: "<i class='ti-close'></i>",
            searchPlaceholder: 'SEARCH HERE',
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        columnDefs: [{
            visible: false
        }],
        responsive: true,
        searching: false,
        paging: false,
        info: false
    });
}


// CRM TABLE 3 
if ($('.Crm_table_active3').length) {
	startDatatable();
}


// TABS DATA TABLE ISSU 
    // data table responsive problem tab 
    $(document).ready(function () {   
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
               .columns.adjust()
               .responsive.recalc();
        });    
	});
	

    $(document).ready(function () {   
		$(document).ready(function(){
			$(".Add_note").click(function(){
				$(".note_add_form").slideToggle(900);
			});
		});
    });


$(document).on('click', '.remove', function () {
    $(this).parents('.row_lists').fadeOut();
});
$(document).ready(function(){
	$('.add_single_row').click(function() {
		$('.row_lists').parent("tbody").prepend('<tr class="row_lists"> <td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"> <textarea class="placeholder_invoice_textarea" placeholder="-" ></textarea> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0 pr-0 remove" style="border:0"> <div class="items_min_icon "><i class="fas fa-minus-circle"></i></div></td></tr>');
	});
})
// nestable for drah and drop 
$(document).ready(function(){
    $('#nestable').nestable({
        group: 1
    })

});

// METU SET UP 
$(".edit_icon").on("click", function(e){
    var target = $(this).parent().find('.menu_edit_field');
    $(this).toggleClass("expanded");
    target.slideToggle();
    $('.menu_edit_field').not( target ).slideUp();
});

// SCROLL NAVIGATION 
$(document).ready(function(){
	// scroll /
	$('.scroll-left-button').click(function() {
	  event.preventDefault();
	  $('.scrollable_tablist').animate({
		scrollLeft: "+=300px"
	  }, "slow");
	});
	
	 $('.scroll-right-button ').click(function() {
	  event.preventDefault();
	  $('.scrollable_tablist').animate({
		scrollLeft: "-=300px"
	  }, "slow");
	});
});

// FOR CUSTOM TAB 
$(function() {
    $('#theme_nav li label').on('click', function() {
		$('#'+$(this).data('id')).show().siblings('div.Settings_option').hide();
    });
    $('#sms_setting li label').on('click', function() {
		$('#'+$(this).data('id')).show().siblings('div.sms_ption').hide();
    });
});



function deleteId() {
	"use strict";
    var id = $('.deleteStudentModal').data("id")
   $('#student_delete_i').val(id);
    
}


$(document).ready(function(e) {
	$('.hide_row').click(function() {
		$(this).parent().parent().hide();
		return false;
	});
});

$(document).ready(function(e) {
	$('.minus_single_role').click(function() {
		$(this).parent(".single__role_member").hide(400);
		return false;
	});
});



