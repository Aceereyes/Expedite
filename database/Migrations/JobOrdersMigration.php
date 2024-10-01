<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class JobOrdersMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('job_orders')) {
            Manager::schema()->create('job_orders', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('freelancer_id');
                $table->unsignedBigInteger('partner_id');
                $table->unsignedBigInteger('job_id');
                $table->longText('composed')->nullable();
                $table->string('status')->default(\App\Models\JobOrder::PENDING);
                $table->longText('reason')->nullable();
                $table->dateTime('submitted_at')->nullable();
                
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
        Manager::schema()->dropIfExists('job_orders');
    }
};