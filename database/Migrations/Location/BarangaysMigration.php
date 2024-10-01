<?php
namespace Database\Migrations\Location;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class BarangaysMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('location_barangays')) {
            Manager::schema()->create('location_barangays', function (Blueprint $table) {
                $table->unsignedBigInteger('id');
                $table->unsignedBigInteger('municipality_id');
                $table->string('name');

                $table->primary('id');
                $table->foreign('municipality_id')->references('id')->on('location_municipalities')->onDelete('cascade');
                
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
        Manager::schema()->dropIfExists('location_barangays');
    }
};