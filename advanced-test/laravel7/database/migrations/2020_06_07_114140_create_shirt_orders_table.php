<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShirtOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shirt_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->default(0);
            $table->integer('fabric_id')->default(0);
            $table->decimal('collar_size', 10, 2)->default(0);
            $table->decimal('chest_size', 10, 2)->default(0);
            $table->decimal('waist_size', 10, 2)->default(0);
            $table->decimal('wrist_size', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shirt_orders');
    }
}
