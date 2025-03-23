<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); // Matches loadid
            $table->decimal('total_pts', 10, 2)->default(0); // Total points spent
            $table->decimal('total_lots', 10, 2)->default(0); // Total lots spent
            $table->string('redemption_type'); // 'points' or 'lots'
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('prod_id');
            $table->string('size')->nullable();
            $table->integer('quantity');
            $table->decimal('pts', 10, 2); // Points per unit
            $table->decimal('lots', 10, 2); // Lots per unit
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('prod_id')->references('prod_id')->on('product')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
}
