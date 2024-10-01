<?php
namespace Database\Migrations\CRM;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class MessagesMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public static $table = 'crm_messages';
    public function up()
    {
        if(!Manager::schema()->hasTable(self::$table)) {
            Manager::schema()->create(self::$table, function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('subject');
                $table->longText('message');
                $table->boolean('done')->default(0);
                
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