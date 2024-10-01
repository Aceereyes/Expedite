<?php
namespace Database\Migrations\Location;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class MunicipalitiesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('location_municipalities')) {
            Manager::schema()->create('location_municipalities', function (Blueprint $table) {
                $table->unsignedBigInteger('id');
                $table->unsignedBigInteger('province_id');
                $table->string('name');

                $table->primary('id');
                $table->foreign('province_id')->references('id')->on('location_provinces')->onDelete('cascade');
                
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
        Manager::schema()->dropIfExists('location_municipalities');
    }
};