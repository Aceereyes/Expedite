<?php
namespace Database\Migrations\HR;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class PayslipsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('hr_payslips')) {
            Manager::schema()->create('hr_payslips', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('payroll_id');
                $table->unsignedBigInteger('employee_id');
                $table->double('rate');
                $table->integer('noOfHours');
                $table->double('overtime');
                $table->double('gross');
                $table->double('deductions');
                $table->double('net');

                $table->foreign('employee_id')->references('id')->on('hr_employees')->onDelete('cascade');
                $table->foreign('payroll_id')->references('id')->on('hr_payrolls')->onDelete('cascade');
                
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
        Manager::schema()->dropIfExists('hr_payslips');
    }
};