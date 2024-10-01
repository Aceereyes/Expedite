<?php
namespace Database\Migrations\HR;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class EmployeesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('hr_employees')) {
            Manager::schema()->create('hr_employees', function (Blueprint $table) {
                $table->id();
                $table->string('firstName');
                $table->string('lastName');
                $table->double('rate');
                $table->string('email');
                $table->text('password');
                $table->text('department');
                $table->text('position');
                $table->boolean('active');

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
        Manager::schema()->dropIfExists('hr_employees');
    }
};