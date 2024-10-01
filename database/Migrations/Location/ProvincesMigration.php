<?php
namespace Database\Migrations\Location;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class ProvincesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('location_provinces')) {
            Manager::schema()->create('location_provinces', function (Blueprint $table) {
                $table->unsignedBigInteger('id');
                $table->unsignedBigInteger('region_id');
                $table->string('name');

                $table->primary('id');
                $table->foreign('region_id')->references('id')->on('location_regions')->onDelete('cascade');
                
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
        Manager::schema()->dropIfExists('location_provinces');
    }
};