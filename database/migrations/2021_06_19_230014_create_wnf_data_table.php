<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWnfDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wnf_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('wnf_id');
            $table->string('wnf_uid');
            $table->string('cert_num')->nullable(true);
            $table->string('trade_name');
            $table->text('man_form');
            $table->string('manufacturer_name', 300);
            $table->string('manufacturer_country');
            $table->boolean('is_pharmacy_manufacturing');
            $table->string('series');
            $table->date('series_date')->nullable(true);
            $table->uuid('status_id')->nullable(true);
            $table->uuid('type_id');
            $table->string('scope');
            $table->jsonb('info_letter');
            $table->string('info_letter_fullname');
            $table->date('info_letter_date');
            $table->date('component_series_date')->nullable(true);
            $table->uuid('sku_id')->nullable(true);
            $table->boolean('is_verified')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wnf_data');
    }
}
