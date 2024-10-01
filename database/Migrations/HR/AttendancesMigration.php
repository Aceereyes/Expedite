<?php
namespace Database\Migrations\HR;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class AttendancesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('hr_attendances')) {
            Manager::schema()->create('hr_attendances', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('employee_id');
                $table->string('type');
                $table->date('attendance_date');
                $table->time('timeIn')->nullable();
                $table->time('timeOut')->nullable();
                $table->integer('noOfHours');
                $table->string('remarks')->nullable();

                $table->foreign('employee_id')->references('id')->on('hr_employees')->onDelete('cascade');
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
        Manager::schema()->dropIfExists('hr_attendances');
    }
};