<?php
namespace Database\Migrations\Freelancers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class OtherAttachmentsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Manager::schema()->hasTable('freelancers_other_attachments')) {
            Manager::schema()->create('freelancers_other_attachments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('freelancer_id');
                $table->string('type');
                $table->string('issuer');
                $table->string('name');

                $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');

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
        Manager::schema()->dropIfExists('freelancers_other_attachments');
    }
};