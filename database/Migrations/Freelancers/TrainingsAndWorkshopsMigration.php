<?php
namespace Database\Migrations\Freelancers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class TrainingsAndWorkshopsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('freelancers_trainings_workshops')) {
            Manager::schema()->create('freelancers_trainings_workshops', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('freelancer_id');
                $table->string('training');
                $table->string('institution');
                $table->string('timeframe');

                $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');

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
        Manager::schema()->dropIfExists('freelancers_trainings_workshops');
    }
};