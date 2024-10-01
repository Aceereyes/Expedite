<?php
namespace Database\Migrations\Freelancers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class ReceivablesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public static $table = 'freelancers_receivables';
    public function up()
    {
        if(!Manager::schema()->hasTable(self::$table)) {
            Manager::schema()->create(self::$table, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('partner_id');
                $table->unsignedBigInteger('freelancer_id');
                $table->unsignedBigInteger('job_order_id');
                $table->double('amount');
                $table->longText('description');
                
                $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
                $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
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
        Manager::schema()->dropIfExists(self::$table);
    }
};