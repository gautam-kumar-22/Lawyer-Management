<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryStateCityPermissionToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = [

            ['id'  => 501, 'module_id' => 12, 'parent_id' => 300, 'name' => 'Country', 'route' => 'setup.country.index', 'type' => 2 ],
            ['id'  => 502, 'module_id' => 12, 'parent_id' => 501, 'name' => 'Add', 'route' => 'setup.country.store', 'type' => 3 ],
            ['id'  => 503, 'module_id' => 12, 'parent_id' => 501, 'name' => 'Edit', 'route' => 'setup.country.edit', 'type' => 3 ],
            ['id'  => 504, 'module_id' => 12, 'parent_id' => 501, 'name' => 'Delete', 'route' => 'setup.country.destroy', 'type' => 3 ],

            ['id'  => 505, 'module_id' => 12, 'parent_id' => 300, 'name' => 'State', 'route' => 'setup.state.index', 'type' => 2 ],
            ['id'  => 506, 'module_id' => 12, 'parent_id' => 505, 'name' => 'Add', 'route' => 'setup.state.store', 'type' => 3 ],
            ['id'  => 507, 'module_id' => 12, 'parent_id' => 505, 'name' => 'Edit', 'route' => 'setup.state.edit', 'type' => 3 ],
            ['id'  => 508, 'module_id' => 12, 'parent_id' => 505, 'name' => 'Delete', 'route' => 'setup.state.destroy', 'type' => 3 ],

            ['id'  => 509, 'module_id' => 12, 'parent_id' => 300, 'name' => 'City', 'route' => 'setup.city.index', 'type' => 2 ],
            ['id'  => 510, 'module_id' => 12, 'parent_id' => 509, 'name' => 'Add', 'route' => 'setup.city.store', 'type' => 3 ],
            ['id'  => 511, 'module_id' => 12, 'parent_id' => 509, 'name' => 'Edit', 'route' => 'setup.city.edit', 'type' => 3 ],
            ['id'  => 512, 'module_id' => 12, 'parent_id' => 509, 'name' => 'Delete', 'route' => 'setup.city.destroy', 'type' => 3 ],

            ['id'  => 605, 'module_id' => 5, 'parent_id' => 66, 'name' => 'Utilities', 'route' => 'utilities', 'type' => 2 ],

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
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
}
