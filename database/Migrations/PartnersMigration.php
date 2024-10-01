<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class PartnersMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('partners')) {
            Manager::schema()->create('partners', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->text('password');
                $table->string('type');
                $table->date('established')->nullable();
                $table->string('employeeCount')->nullable();
                $table->string('website')->nullable();
                $table->string('region_id')->nullable();
                $table->string('province_id')->nullable();
                $table->string('municipality_id')->nullable();
                $table->string('barangay_id')->nullable();
                $table->text('logo')->nullable();
                $table->longText('background')->nullable();
                $table->longText('services')->nullable();
                $table->longText('expertise')->nullable();
                $table->boolean('initialSetup')->default(1);
                
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
        Manager::schema()->dropIfExists('partners');
    }
};