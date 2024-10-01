<?php
namespace Database\Migrations\HR;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class CareersMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('hr_careers')) {
            Manager::schema()->create('hr_careers', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('description');

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
        Manager::schema()->dropIfExists('hr_careers');
    }
};