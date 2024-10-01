<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class JobApplicationsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('job_applications')) {
            Manager::schema()->create('job_applications', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('freelancer_id');
                $table->unsignedBigInteger('partner_id');
                $table->unsignedBigInteger('job_id');
                $table->string('status')->default('Pending');

                $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
                $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
                $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');

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
        Manager::schema()->dropIfExists('job_applications');
    }
};