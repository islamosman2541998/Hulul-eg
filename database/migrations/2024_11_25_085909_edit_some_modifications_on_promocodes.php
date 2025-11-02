<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promo_codes', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->boolean('type')->default(1)->comment("1 = ratio(%)   , 0 = value to be discounted");

        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('promo_codes' , ['title' , 'code' , 'type']);

    }
};
