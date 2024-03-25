<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('display_description')->nullable();
            $table->boolean('enable_status')->default(1);
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->on('teams')->references('id');
            $table->decimal('cost',10,5);
            $table->integer('is_one_time_payment')->default('0');
            $table->integer('is_cost_per_core')->default('0');
            $table->integer('cpu_amount')->default('0');
            $table->boolean('is_default')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_applications');
    }
};
