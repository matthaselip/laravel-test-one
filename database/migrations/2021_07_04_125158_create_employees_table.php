<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employees_id');
            $table->string('first_name', 50)->nullable(false);
            $table->string('last_name',50)->nullable(false);
            $table->unsignedBigInteger('companies_id')->nullable(false);
            $table->foreign('companies_id')
                ->references('companies_id')
                ->on('companies')
                ->cascadeOnDelete();
            $table->string('email', 100)->nullable(true);
            $table->string('phone',20)->nullable(true);
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
        Schema::dropIfExists('employees');
    }
}
