<?php
namespace Database\Migrations\Freelancers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class AcademicQualificationsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('freelancers_academic_qualifications')) {
            Manager::schema()->create('freelancers_academic_qualifications', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('freelancer_id');
                $table->string('institution');
                $table->string('course');
                $table->string('level');
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
        Manager::schema()->dropIfExists('freelancers_academic_qualifications');
    }
};