<?php
namespace Database\Migrations\Freelancers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class WorkExperiencesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('freelancers_work_experiences')) {
            Manager::schema()->create('freelancers_work_experiences', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('freelancer_id');
                $table->string('institution');
                $table->string('job_title');
                $table->string('timeframe');
                $table->string('dutiesAndResponsibilities');

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