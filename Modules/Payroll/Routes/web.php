<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::prefix('hr')->group(function() {
    Route::prefix('payroll')->group(function() {

        Route::get('/', 'PayrollController@index')->name('payroll.index')->middleware('permission');
        Route::get('/staff-list-for-payroll', 'PayrollController@search_for_payroll')->name('staff_search_for_payroll');
        Route::get('/pdf/{id}', 'PayrollController@getPdf')->name('payroll.pdf');
        Route::get('/generate-Payroll/{id}/{month}/{year}', 'PayrollController@generatePayroll')->name('genrate_payroll');
        Route::post('/save-payroll-data', 'PayrollController@savePayrollData')->name('save_payroll');
        Route::post('/payment/modal', 'PayrollController@paymentPayroll')->name('payroll_payment_modal');
        Route::post('/payment-slip/modal', 'PayrollController@viewPayslip')->name('payroll_view_slip_modal');
        Route::post('/savePayrollPaymentData', 'PayrollController@savePayrollPaymentData')->name('payroll_payment_store');


        // Payroll Report
        Route::get('/reports', 'PayrollController@report_index')->name('payroll_reports.index')->middleware('permission');
        Route::get('/reports/search', 'PayrollController@searchPayrollReport')->name('payroll_reports.search');
    });
});
