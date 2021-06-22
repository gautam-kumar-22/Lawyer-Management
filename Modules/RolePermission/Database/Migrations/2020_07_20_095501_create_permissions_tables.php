<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('module_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('name')->nullable();
            $table->string('route')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->default(1)->unsigned();
            $table->integer('updated_by')->default(1)->unsigned();
            $table->integer('type')->nullable()->comment('1 for main menu, 2 for sub menu , 3 action');
            $table->timestamps();
        });

    $sql = [

        // Dashboard
        ['id'  => 1, 'module_id' => 1, 'parent_id' => null, 'name' => 'Dashboard', 'route' => 'home', 'type' => 1 ], //Main menu

        ['id'  => 700, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Quick Summery', 'route' => 'dashboard_quick_summery.index', 'type' => 2 ],
        ['id'  => 701, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Calender', 'route' => 'dashboad_calender.index', 'type' => 2 ],
        ['id'  => 702, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Todo', 'route' => 'dashboard_todo.index', 'type' => 2 ],
        ['id'  => 703, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Appointment', 'route' => 'dashboard_appointment.index', 'type' => 2 ],
        ['id'  => 704, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Upcoming Date', 'route' => 'dashboard_upcoming_date.index', 'type' => 2 ],
      
        // settings
        ['id'  => 66, 'module_id' => 5, 'parent_id' => null, 'name' => 'Settings', 'route' => 'setting.index', 'type' => 1 ],
         ['id'  => 600, 'module_id' => 5, 'parent_id' => 66, 'name' => 'General Settings', 'route' => 'general_setting.index', 'type' => 2 ],
         ['id'  => 601, 'module_id' => 5, 'parent_id' => 66, 'name' => 'Smtp Settings', 'route' => 'smtp_setting.index', 'type' => 2 ],
         ['id'  => 602, 'module_id' => 5, 'parent_id' => 66, 'name' => 'Cron Settings', 'route' => 'cron.index', 'type' => 2 ],
         ['id'  => 603, 'module_id' => 5, 'parent_id' => 66, 'name' => 'Login Background Image Settings', 'route' => 'login_bg_image.index', 'type' => 2 ],
         ['id'  => 604, 'module_id' => 5, 'parent_id' => 66, 'name' => 'Email Template Settings', 'route' => 'email_template_settings.index', 'type' => 2 ],
     
        // Leave

        ['id'  => 170, 'module_id' => 10, 'parent_id' => null, 'name' => 'Leave', 'route' => 'leave', 'type' => 1 ],

        ['id'  => 171, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Leave Define', 'route' => 'leave_define.index', 'type' => 2 ],
        ['id'  => 172, 'module_id' => 10, 'parent_id' => 171, 'name' => 'Add', 'route' => 'leave_define.store', 'type' => 3 ],
        ['id'  => 173, 'module_id' => 10, 'parent_id' => 171, 'name' => 'Edit', 'route' => 'leave_define.edit', 'type' => 3 ],
        ['id'  => 174, 'module_id' => 10, 'parent_id' => 171, 'name' => 'Delete', 'route' => 'leave_define.delete', 'type' => 3 ],
        ['id'  => 175, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Approve', 'route' => 'approved_index', 'type' => 2 ],
        ['id'  => 176, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Set Approval', 'route' => 'set_approval_leave', 'type' => 2 ],
        ['id'  => 224, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Pending Leave', 'route' => 'pending_index', 'type' => 2 ],
        ['id'  => 225, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Apply Leave', 'route' => 'apply_leave.index', 'type' => 2 ],
        ['id'  => 226, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Carry Forward', 'route' => 'carry.forward', 'type' => 2 ], 
        ['id'  => 227, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Holiday', 'route' => 'holidays.index', 'type' => 2 ],
        ['id'  => 228, 'module_id' => 10, 'parent_id' => 227, 'name' => 'View', 'route' => 'view.year.data', 'type' => 3 ],
         ['id'  => 229, 'module_id' => 10, 'parent_id' => 227, 'name' => 'Edit', 'route' => 'year.data', 'type' => 3 ],
        ['id'  => 230, 'module_id' => 10, 'parent_id' => 227, 'name' => 'Delete', 'route' => 'holiday.delete', 'type' => 3 ],

        // Human Resource
        ['id'  => 177, 'module_id' => 11, 'parent_id' => null, 'name' => 'Human Resource', 'route' => 'human_resource', 'type' => 1 ],

        ['id'  => 178, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Staffs', 'route' => 'staffs.index', 'type' => 2 ],
        ['id'  => 179, 'module_id' => 11, 'parent_id' => 178, 'name' => 'Add Staffs', 'route' => 'staffs.store', 'type' => 3 ],
        ['id'  => 180, 'module_id' => 11, 'parent_id' => 178, 'name' => 'Edit', 'route' => 'staffs.edit', 'type' => 3 ],
        ['id'  => 181, 'module_id' => 11, 'parent_id' => 178, 'name' => 'Delete', 'route' => 'staffs.destroy', 'type' => 3 ],
        ['id'  => 182, 'module_id' => 11, 'parent_id' => 178, 'name' => 'Update Status', 'route' => 'staffs.update_active_status', 'type' => 3 ],
        ['id'  => 183, 'module_id' => 11, 'parent_id' => 178, 'name' => 'View', 'route' => 'staffs.view', 'type' => 3 ],


        ['id'  => 188, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Attendance Report', 'route' => 'attendance_report.index', 'type' => 2 ],

        ['id'  => 189, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Attendance', 'route' => 'attendances.index', 'type' => 2 ],
        ['id'  => 190, 'module_id' => 11, 'parent_id' => 189, 'name' => 'Add', 'route' => 'attendances.store', 'type' => 3 ],

        ['id'  => 191, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Payroll', 'route' => 'payroll.index', 'type' => 2 ],
        ['id'  => 192, 'module_id' => 11, 'parent_id' => 191, 'name' => 'Payroll Report', 'route' => 'payroll_reports.index', 'type' => 2 ],


        ['id'  => 195, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Role', 'route' => 'permission.roles.index', 'type' => 2 ],
        ['id'  => 196, 'module_id' => 11, 'parent_id' => 195, 'name' => 'Add', 'route' => 'permission.roles.store', 'type' => 3 ],
        ['id'  => 197, 'module_id' => 11, 'parent_id' => 195, 'name' => 'Edit', 'route' => 'permission.roles.edit', 'type' => 3 ],
        ['id'  => 198, 'module_id' => 11, 'parent_id' => 195, 'name' => 'Delete', 'route' => 'permission.roles.destroy', 'type' => 3 ],


        ['id'  => 199, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Permission', 'route' => 'permission.permissions.index', 'type' => 2 ],
        ['id'  => 200, 'module_id' => 11, 'parent_id' => 199, 'name' => 'Add', 'route' => 'permission.permissions.create', 'type' => 3 ],
        ['id'  => 201, 'module_id' => 11, 'parent_id' => 199, 'name' => 'Edit', 'route' => 'permission.permissions.edit', 'type' => 3 ],
        ['id'  => 202, 'module_id' => 11, 'parent_id' => 199, 'name' => 'Delete', 'route' => 'permission.permissions.destroy', 'type' => 3 ],

        // Leave ---- Leave Type

        ['id'  => 203, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Leave Type', 'route' => 'leave_types.index', 'type' => 2 ],
        ['id'  => 204, 'module_id' => 10, 'parent_id' => 203, 'name' => 'Add', 'route' => 'leave_types.store', 'type' => 3 ],
        ['id'  => 205, 'module_id' => 10, 'parent_id' => 203, 'name' => 'Edit', 'route' => 'leave_types.edit', 'type' => 3 ],
        ['id'  => 206, 'module_id' => 10, 'parent_id' => 203, 'name' => 'Delete', 'route' => 'leave_types.delete', 'type' => 3 ],


        // srtup

        ['id'  => 300, 'module_id' => 12, 'parent_id' => null, 'name' => 'Setup', 'route' => 'setup', 'type' => 1 ],

        ['id'  => 301, 'module_id' => 12, 'parent_id' => 300, 'name' => 'Stage', 'route' => 'master.stage.index', 'type' => 2 ],
        ['id'  => 302, 'module_id' => 12, 'parent_id' => 301, 'name' => 'Add', 'route' => 'master.stage.store', 'type' => 3 ],
        ['id'  => 303, 'module_id' => 12, 'parent_id' => 301, 'name' => 'Edit', 'route' => 'master.stage.edit', 'type' => 3 ],
        ['id'  => 304, 'module_id' => 12, 'parent_id' => 301, 'name' => 'Delete', 'route' => 'master.stage.destroy', 'type' => 3 ],

        ['id'  => 305, 'module_id' => 12, 'parent_id' => 300, 'name' => 'Act', 'route' => 'master.act.index', 'type' => 2 ],
        ['id'  => 306, 'module_id' => 12, 'parent_id' => 305, 'name' => 'Add', 'route' => 'master.act.store', 'type' => 3 ],
        ['id'  => 307, 'module_id' => 12, 'parent_id' => 305, 'name' => 'Edit', 'route' => 'master.act.edit', 'type' => 3 ],
        ['id'  => 308, 'module_id' => 12, 'parent_id' => 305, 'name' => 'Delete', 'route' => 'master.act.destroy', 'type' => 3 ],

        ['id'  => 309, 'module_id' => 12, 'parent_id' => 300, 'name' => 'Court', 'route' => 'master.court.index', 'type' => 2 ],
        ['id'  => 310, 'module_id' => 12, 'parent_id' => 309, 'name' => 'Add', 'route' => 'master.court.store', 'type' => 3 ],
        ['id'  => 311, 'module_id' => 12, 'parent_id' => 309, 'name' => 'Edit', 'route' => 'master.court.edit', 'type' => 3 ],
        ['id'  => 312, 'module_id' => 12, 'parent_id' => 309, 'name' => 'Delete', 'route' => 'master.court.destroy', 'type' => 3 ],

        ['id'  => 384, 'module_id' => 12, 'parent_id' => 300, 'name' => 'Language', 'route' => 'languages.index', 'type' => 2 ],
        ['id'  => 385, 'module_id' => 12, 'parent_id' => 384, 'name' => 'Add', 'route' => 'languages.store', 'type' => 3 ],
        ['id'  => 386, 'module_id' => 12, 'parent_id' => 384, 'name' => 'Edit', 'route' => 'languages.edit', 'type' => 3 ],
        ['id'  => 387, 'module_id' => 12, 'parent_id' => 384, 'name' => 'Delete', 'route' => 'languages.destroy', 'type' => 3 ],
        ['id'  => 388, 'module_id' => 12, 'parent_id' => 384, 'name' => 'Show', 'route' => 'language.translate_view', 'type' => 3 ],
        ['id'  => 389, 'module_id' => 12, 'parent_id' => 384, 'name' => 'Chnage Status', 'route' => 'languages.update_active_status', 'type' => 3 ],
        ['id'  => 390, 'module_id' => 12, 'parent_id' => 384, 'name' => 'Chnage', 'route' => 'language.change', 'type' => 3 ],

        ['id'  => 500, 'module_id' => 23, 'parent_id' => 300, 'name' => 'System Update', 'route' => 'setting.updatesystem', 'type' => 2 ],



        // Category
        ['id'  => 313, 'module_id' => 13, 'parent_id' => null, 'name' => 'Category', 'route' => 'setup', 'type' => 1 ],

        ['id'  => 314, 'module_id' => 13, 'parent_id' => 313, 'name' => 'Court', 'route' => 'category.court.index', 'type' => 2 ],
        ['id'  => 315, 'module_id' => 13, 'parent_id' => 314, 'name' => 'Add', 'route' => 'category.court.store', 'type' => 3 ],
        ['id'  => 316, 'module_id' => 13, 'parent_id' => 314, 'name' => 'Edit', 'route' => 'category.court.edit', 'type' => 3 ],
        ['id'  => 317, 'module_id' => 13, 'parent_id' => 314, 'name' => 'Delete', 'route' => 'category.court.destroy', 'type' => 3 ],

        ['id'  => 318, 'module_id' => 13, 'parent_id' => 313, 'name' => 'Case', 'route' => 'category.case.index', 'type' => 2 ],
        ['id'  => 319, 'module_id' => 13, 'parent_id' => 318, 'name' => 'Add', 'route' => 'category.case.store', 'type' => 3 ],
        ['id'  => 320, 'module_id' => 13, 'parent_id' => 318, 'name' => 'Edit', 'route' => 'category.case.edit', 'type' => 3 ],
        ['id'  => 321, 'module_id' => 13, 'parent_id' => 318, 'name' => 'Delete', 'route' => 'category.case.destroy', 'type' => 3 ],

        ['id'  => 322, 'module_id' => 13, 'parent_id' => 313, 'name' => 'Client', 'route' => 'category.client.index', 'type' => 2 ],
        ['id'  => 323, 'module_id' => 13, 'parent_id' => 322, 'name' => 'Add', 'route' => 'category.client.store', 'type' => 3 ],
        ['id'  => 324, 'module_id' => 13, 'parent_id' => 322, 'name' => 'Edit', 'route' => 'category.client.edit', 'type' => 3 ],
        ['id'  => 325, 'module_id' => 13, 'parent_id' => 322, 'name' => 'Delete', 'route' => 'category.client.destroy', 'type' => 3 ],

        ['id'  => 326, 'module_id' => 13, 'parent_id' => 313, 'name' => 'Contact', 'route' => 'category.contact.index', 'type' => 2 ],
        ['id'  => 327, 'module_id' => 13, 'parent_id' => 326, 'name' => 'Add', 'route' => 'category.contact.store', 'type' => 3 ],
        ['id'  => 328, 'module_id' => 13, 'parent_id' => 326, 'name' => 'Edit', 'route' => 'category.contact.edit', 'type' => 3 ],
        ['id'  => 329, 'module_id' => 13, 'parent_id' => 326, 'name' => 'Delete', 'route' => 'category.contact.destroy', 'type' => 3 ],


        // Client
        ['id'  => 330, 'module_id' => 14, 'parent_id' => null, 'name' => 'Client', 'route' => 'client.index', 'type' => 1 ],

        ['id'  => 332, 'module_id' => 14, 'parent_id' => 330, 'name' => 'Add', 'route' => 'client.store', 'type' => 2 ],
        ['id'  => 333, 'module_id' => 14, 'parent_id' => 330, 'name' => 'Edit', 'route' => 'client.edit', 'type' => 2 ],
        ['id'  => 334, 'module_id' => 14, 'parent_id' => 330, 'name' => 'Delete', 'route' => 'client.destroy', 'type' => 2 ],


        // Case
        ['id'  => 335, 'module_id' => 15, 'parent_id' => null, 'name' => 'Case', 'route' => 'case.index', 'type' => 1 ],

        ['id'  => 337, 'module_id' => 15, 'parent_id' => 335, 'name' => 'Add', 'route' => 'case.store', 'type' => 2 ],
        ['id'  => 338, 'module_id' => 15, 'parent_id' => 335, 'name' => 'Edit', 'route' => 'case.edit', 'type' => 2 ],
        ['id'  => 339, 'module_id' => 15, 'parent_id' => 335, 'name' => 'Delete', 'route' => 'case.destroy', 'type' => 2 ],
        
        ['id'  => 368, 'module_id' => 15, 'parent_id' => 335, 'name' => 'Cause list', 'route' => 'causelist.index', 'type' => 2 ],
        

        //Lawyer
        ['id'  => 340, 'module_id' => 16, 'parent_id' => null, 'name' => 'Lawyer', 'route' => 'lawyer.index', 'type' => 1 ],

        ['id'  => 342, 'module_id' => 16, 'parent_id' => 340, 'name' => 'Add', 'route' => 'lawyer.store', 'type' => 2 ],
        ['id'  => 343, 'module_id' => 16, 'parent_id' => 340, 'name' => 'Edit', 'route' => 'lawyer.edit', 'type' => 2 ],
        ['id'  => 344, 'module_id' => 16, 'parent_id' => 340, 'name' => 'Delete', 'route' => 'lawyer.destroy', 'type' => 2 ],

        //Hearing date
        ['id'  => 345, 'module_id' => 17, 'parent_id' => null, 'name' => 'Hearing Date', 'route' => 'date.index', 'type' => 1 ],

        ['id'  => 347, 'module_id' => 17, 'parent_id' => 345, 'name' => 'Add', 'route' => 'date.store', 'type' => 2 ],
        ['id'  => 348, 'module_id' => 17, 'parent_id' => 345, 'name' => 'Edit', 'route' => 'date.edit', 'type' => 2 ],
        ['id'  => 349, 'module_id' => 17, 'parent_id' => 345, 'name' => 'Delete', 'route' => 'date.destroy', 'type' => 2 ],


        //PUT UP date
        ['id'  => 350, 'module_id' => 18, 'parent_id' => null, 'name' => 'Put Up Date', 'route' => 'putlist.index', 'type' => 1 ],

        ['id'  => 352, 'module_id' => 18, 'parent_id' => 350, 'name' => 'Add', 'route' => 'putlist.store', 'type' => 2 ],
        ['id'  => 353, 'module_id' => 18, 'parent_id' => 350, 'name' => 'Edit', 'route' => 'putlist.edit', 'type' => 2 ],
        ['id'  => 354, 'module_id' => 18, 'parent_id' => 350, 'name' => 'Delete', 'route' => 'putlist.destroy', 'type' => 2 ],

        //lobbying date
        ['id'  => 355, 'module_id' => 19, 'parent_id' => null, 'name' => 'Lobbying Date', 'route' => 'lobbying.index', 'type' => 1 ],

        ['id'  => 357, 'module_id' => 19, 'parent_id' => 355, 'name' => 'Add', 'route' => 'lobbying.store', 'type' => 2 ],
        ['id'  => 358, 'module_id' => 19, 'parent_id' => 355, 'name' => 'Edit', 'route' => 'lobbying.edit', 'type' => 2 ],
        ['id'  => 359, 'module_id' => 19, 'parent_id' => 355, 'name' => 'Delete', 'route' => 'lobbying.destroy', 'type' => 2 ],


         //judgement date
         ['id'  => 360, 'module_id' => 20, 'parent_id' => null, 'name' => 'Judgement Date', 'route' => 'judgement.index', 'type' => 1 ],

         ['id'  => 362, 'module_id' => 20, 'parent_id' => 360, 'name' => 'Add', 'route' => 'judgement.store', 'type' => 2 ],
         ['id'  => 363, 'module_id' => 20, 'parent_id' => 360, 'name' => 'Edit', 'route' => 'judgement.edit', 'type' => 2 ],
         ['id'  => 364, 'module_id' => 20, 'parent_id' => 360, 'name' => 'Delete', 'route' => 'judgement.destroy', 'type' => 2 ],

         ['id'  => 365, 'module_id' => 20, 'parent_id' => 360, 'name' => 'Close', 'route' => 'judgement.close', 'type' => 2 ],
         ['id'  => 366, 'module_id' => 20, 'parent_id' => 360, 'name' => 'Re-open', 'route' => 'judgement.reopen', 'type' => 2 ],

         ['id'  => 367, 'module_id' => 20, 'parent_id' => 360, 'name' => 'Closed Case', 'route' => 'judgement.closed', 'type' => 2 ],

         //contact
        ['id'  => 369, 'module_id' => 21, 'parent_id' => null, 'name' => 'Contact', 'route' => 'contact.index', 'type' => 1 ],

        ['id'  => 371, 'module_id' => 21, 'parent_id' => 369, 'name' => 'Add', 'route' => 'contact.store', 'type' => 2 ],
        ['id'  => 372, 'module_id' => 21, 'parent_id' => 369, 'name' => 'Edit', 'route' => 'contact.edit', 'type' => 2 ],
        ['id'  => 373, 'module_id' => 21, 'parent_id' => 369, 'name' => 'Delete', 'route' => 'contact.destroy', 'type' => 2 ],



        //Appointment 
        ['id'  => 374, 'module_id' => 22, 'parent_id' => null, 'name' => 'Appointment', 'route' => 'appointment.index', 'type' => 1 ],

        ['id'  => 376, 'module_id' => 22, 'parent_id' => 374, 'name' => 'Add', 'route' => 'appointment.store', 'type' => 2 ],
        ['id'  => 377, 'module_id' => 22, 'parent_id' => 374, 'name' => 'Edit', 'route' => 'appointment.edit', 'type' => 2 ],
        ['id'  => 378, 'module_id' => 22, 'parent_id' => 374, 'name' => 'Delete', 'route' => 'appointment.destroy', 'type' => 2 ],


        //Task 
        ['id'  => 379, 'module_id' => 23, 'parent_id' => null, 'name' => 'Task', 'route' => 'task.index', 'type' => 1 ],

        ['id'  => 381, 'module_id' => 23, 'parent_id' => 379, 'name' => 'Add', 'route' => 'task.store', 'type' => 2 ],
        ['id'  => 382, 'module_id' => 23, 'parent_id' => 379, 'name' => 'Edit', 'route' => 'task.edit', 'type' => 2 ],
        ['id'  => 383, 'module_id' => 23, 'parent_id' => 379, 'name' => 'Delete', 'route' => 'task.destroy', 'type' => 2 ],

        // language

        

        
      
    ];

        DB::table('permissions')->insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
