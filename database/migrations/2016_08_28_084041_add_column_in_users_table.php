<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('description')->after('id');
            $table->string('username')->after('id');
            $table->string('super_user', 10)->after('email');
            $table->string('phone', 10)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('description');
            $table->dropColumn('username');
            $table->dropColumn('super_user');
            $table->dropColumn('phone');
        });
    }
}
