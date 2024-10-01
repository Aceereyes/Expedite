<?php
namespace Database\Migrations\Location;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class RegionsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('location_regions')) {
            Manager::schema()->create('location_regions', function (Blueprint $table) {
                $table->unsignedBigInteger('id');
                $table->string('name');
                $table->string('description');
                
                $table->primary('id');
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
        Manager::schema()->dropIfExists('location_regions');
    }
};
?>