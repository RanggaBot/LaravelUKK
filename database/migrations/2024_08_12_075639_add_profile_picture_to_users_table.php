<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilePictureToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('User', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('User', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
        });
    }
}