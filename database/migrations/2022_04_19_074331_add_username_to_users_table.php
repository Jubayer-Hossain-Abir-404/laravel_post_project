<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // adding that in the up migration
    // and dropping that in the down
    // migration
    public function up()
    {
        // this is used to add a username
        Schema::table('users', function (Blueprint $table) {
            $table->string('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // this is used to drop the column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
}
