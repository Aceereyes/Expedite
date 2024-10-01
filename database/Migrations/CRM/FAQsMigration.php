<?php
namespace Database\Migrations\CRM;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;

class FAQsMigration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public static $table = 'crm_faqs';
    public function up()
    {
        if(!Manager::schema()->hasTable(self::$table)) {
            Manager::schema()->create(self::$table, function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('content');
                $table->boolean('active')->default(1);
                
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