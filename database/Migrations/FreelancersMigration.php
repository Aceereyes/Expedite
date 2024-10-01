<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class FreelancersMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('freelancers')) {
            Manager::schema()->create('freelancers', function (Blueprint $table) {
                $table->id();
                $table->string('firstName');
                $table->string('lastName');
                $table->string('gender')->nullable();
                $table->date('dateOfBirth')->nullable();
                $table->string('email');
                $table->string('phone')->nullable();
                $table->text('password');
                $table->unsignedBigInteger('region_id')->nullable();
                $table->unsignedBigInteger('province_id')->nullable();
                $table->unsignedBigInteger('municipality_id')->nullable();
                $table->unsignedBigInteger('barangay_id')->nullable();
                $table->longText('about')->nullable();
                $table->text('avatar')->nullable();
                $table->boolean('initialSetup')->default(true);
                $table->text('skills');

                $table->foreign('region_id')->references('id')->on('location_regions')->onDelete('cascade');
                $table->foreign('province_id')->references('id')->on('location_provinces')->onDelete('cascade');
                $table->foreign('municipality_id')->references('id')->on('location_municipalities')->onDelete('cascade');
                $table->foreign('barangay_id')->references('id')->on('location_barangays')->onDelete('cascade');

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
        Manager::schema()->dropIfExists('freelancers');
    }
};