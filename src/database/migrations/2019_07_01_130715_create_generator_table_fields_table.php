<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneratorTableFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generator_table_fields', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 255)->nullable();
            $table->string('labels', 255)->nullable();
            $table->string('validation')->nullable();
            $table->string('html_type')->nullable();
            $table->string('html_value')->nullable();
            $table->string('css_class')->nullable();
            $table->string('options')->nullable();
            $table->string('data_type')->nullable();
            $table->string('data_type_params')->nullable();
            $table->string('data_value')->nullable();
            $table->string('date_format')->nullable();
            $table->string('placeholder')->nullable();
            $table->boolean('is_inline_options')->nullable();
            $table->boolean('is_on_index')->nullable();
            $table->boolean('is_on_form')->nullable();
            $table->boolean('is_on_show')->nullable();
            $table->boolean('is_on_views')->nullable();
            $table->boolean('is_header')->nullable();
            $table->boolean('is_auto_increment')->nullable();
            $table->boolean('is_primary')->nullable();
            $table->boolean('is_index')->nullable();
            $table->boolean('is_unique')->nullable();
            $table->boolean('is_nullable')->nullable();
            $table->boolean('is_unsigned')->nullable();
            $table->integer('generator_table_id')->unsigned()->nullable()->index();
            $table->foreign('generator_table_id')
                ->references('id')->on('generator_tables')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('generator_table_fields');
    }
}
