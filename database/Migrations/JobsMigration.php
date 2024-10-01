<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class JobsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('jobs')) {
            Manager::schema()->create('jobs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('partner_id');
                $table->string('title');
                $table->double('amount');
                $table->string('category');
                $table->date('closingDate');
                $table->dateTime('deadline');
                $table->string('experience');
                $table->longText('description');
                $table->longText('responsibilities');
                $table->longText('instructions');
                $table->boolean('active')->default(true);
                $table->text('skills');
                $table->integer('minAge');
                $table->integer('maxAge');
                $table->text('language');
                $table->string('sex');


                $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');

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
        Manager::schema()->dropIfExists('jobs');
    }
};