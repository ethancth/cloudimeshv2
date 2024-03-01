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
        Schema::create('projects', function (Blueprint $table) {
          $table->id();
          $table->string('title', 100);
          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->integer('status')->default(1);
          $table->string('slug')->nullable();
          $table->integer('department_id')->unsigned()->default(0);
          $table->boolean('is_delete')->default(false);
          $table->string('total_cpu')->nullable()->default('0');
          $table->string('total_memory')->nullable()->default('0');
          $table->string('total_storage')->nullable()->default('0');
          $table->string('total_server')->nullable()->default('0');
          $table->string('total_server_on')->nullable()->default('0');
          $table->string('company_id')->nullable();
          $table->decimal('price','10',2)->default(0);
          $table->decimal('price_actual','10',5)->default(0);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
