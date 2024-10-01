<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class InterviewSchedulesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('interview_schedules')) {
            Manager::schema()->create('interview_schedules', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('partner_id');
                $table->unsignedBigInteger('freelancer_id');
                $table->unsignedBigInteger('job_id');
                $table->unsignedBigInteger('job_application_id');
                $table->dateTime('start');
                $table->dateTime('end');
                $table->longText('note');

                $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
                $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
                $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
                $table->foreign('job_application_id')->references('id')->on('job_applications')->onDelete('cascade');

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
        Manager::schema()->dropIfExists('interview_schedules');
    }
};