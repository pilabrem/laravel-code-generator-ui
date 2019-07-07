<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneratorTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generator_tables', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 255)->nullable();
            $table->string('table_name')->nullable();
            $table->boolean('with_migration')->nullable();
            $table->boolean('with_form_request')->nullable();
            $table->boolean('with_soft_delete')->nullable();
            $table->integer('models_per_page')->nullable();
            $table->string('translation_for')->nullable();
            $table->string('primary_key')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('generator_tables');
    }
}
