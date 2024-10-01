<?php
namespace Database\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class JobOrderAttachmentsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('job_orders_attachments')) {
            Manager::schema()->create('job_orders_attachments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('job_order_id');
                $table->longText('file_name')->nullable();
                
                $table->foreign('job_order_id')->references('id')->on('job_orders')->onDelete('cascade');
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
        Manager::schema()->dropIfExists('job_orders_attachments');
    }
};