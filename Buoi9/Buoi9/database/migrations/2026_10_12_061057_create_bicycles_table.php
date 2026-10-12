<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBicyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bicycles', function (Blueprint $table) {
            $table->id();
            $table->string('bike_code')->unique();
            $table->foreignId('station_id')->unllables()->contrained('stations')->nullOnDelete();
            $table->string('location_status');
            $table->string('condition_status');
            $table->decimal('rental_price_per_hour', 10, 2);
            $table->float('avg_rating')->default(0);
            $table->integer('total_reviews')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('bicycles');
    }
}
