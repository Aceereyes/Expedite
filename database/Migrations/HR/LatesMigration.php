<?php
namespace Database\Migrations\HR;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class LatesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('hr_lates')) {
            Manager::schema()->create('hr_lates', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('employee_id');
                $table->date('date');
                $table->time('time');
                $table->integer('equivalent_time');

                $table->foreign('employee_id')->references('id')->on('hr_employees');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Manager::schema()->dropIfExists('hr_lates');
    }
};