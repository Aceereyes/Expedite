<?php
namespace Database\Migrations\HR;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class PayrollsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('hr_payrolls')) {
            Manager::schema()->create('hr_payrolls', function (Blueprint $table) {
                $table->id();
                $table->date('dateStart');
                $table->date('dateEnd');
                $table->string('status');

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
        Manager::schema()->dropIfExists('hr_payrolls');
    }
};