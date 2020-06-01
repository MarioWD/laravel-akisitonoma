<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoldOutColumnToItemMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_menu', function (Blueprint $table) {
            //
			$table->boolean('sold_out')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_menu', function (Blueprint $table) {
            //
			$table->dropColumn('sold_out');	
        });
    }
}
