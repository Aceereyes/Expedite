<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class AdminsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('admins')) {
            Manager::schema()->create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('firstName');
                $table->string('lastName');
                $table->string('email');
                $table->text('password');
                $table->string('department');
                
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
        Manager::schema()->dropIfExists('admins');
    }
};