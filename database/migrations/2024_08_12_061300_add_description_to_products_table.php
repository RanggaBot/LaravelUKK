<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->text('description')->after('name');
        });
    }

    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}