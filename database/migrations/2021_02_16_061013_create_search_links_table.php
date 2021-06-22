<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSearchLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->timestamps();
        });



       $sql =  [


        ['id'  => 1, 'name' => 'Dashboard', 'route' => route('home')], //Main menu
      
        // settings
        ['id'  => 66, 'name' => 'Settings', 'route' => route('setting.index')],

        ['id'  => 171, 'name' => 'Leave Define', 'route' => route('leave_define.index')],

        ['id'  => 178, 'name' => 'Staffs', 'route' => route('staffs.index')],
        ['id'  => 179, 'name' => 'Add Staffs', 'route' => route('staffs.store')],

        ['id'  => 188, 'name' => 'Attendance Report', 'route' => route('attendance_report.index')],

        ['id'  => 189, 'name' => 'Attendance', 'route' => route('attendances.index')],

        ['id'  => 191, 'name' => 'Payroll', 'route' => route('payroll.index')],
        ['id'  => 192, 'name' => 'Payroll Report', 'route' => route('payroll_reports.index')],

        ['id'  => 195, 'name' => 'Role', 'route' => route('permission.roles.index')],

        ['id'  => 203, 'name' => 'Leave Type', 'route' => route('leave_types.index')],

        ['id'  => 301, 'name' => 'Stage', 'route' => route('master.stage.index')],
        ['id'  => 305, 'name' => 'Act', 'route' => route('master.act.index')],
        ['id'  => 309, 'name' => 'Court', 'route' => route('master.court.index')],
        ['id'  => 384, 'name' => 'Language', 'route' => route('languages.index')],

        ['id'  => 314, 'name' => 'Court Category', 'route' => route('category.court.index')],
        ['id'  => 318, 'name' => 'Case Category', 'route' => route('category.case.index')],
        ['id'  => 322, 'name' => 'Client Category', 'route' => route('category.client.index')],
        ['id'  => 326, 'name' => 'Contact Category', 'route' => route('category.contact.index')],

        ['id'  => 330, 'name' => 'Client', 'route' => route('client.index')],


        ['id'  => 335, 'name' => 'Case', 'route' => route('case.index')],
        ['id'  => 368, 'name' => 'Cause list', 'route' => route('causelist.index')],

        ['id'  => 340, 'name' => 'Lawyer', 'route' => route('lawyer.index')],

        ['id'  => 369, 'name' => 'Contact', 'route' => route('contact.index')],

        ['id'  => 374, 'name' => 'Appointment', 'route' => route('appointment.index')],

        ['id'  => 379, 'name' => 'Task', 'route' => route('task.index')],

        ['id'  => 500, 'name' => 'System Update', 'route' => route('setting.updatesystem')]
    
    ];
        

        
            DB::table('search_links')->insert($sql);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_links');
    }
}
