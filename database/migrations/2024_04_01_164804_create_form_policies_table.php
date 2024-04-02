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
        Schema::create('form_policies', function (Blueprint $table) {
            $table->id();
            $table->string('env_field')->nullable();
            $table->mediumText('search_field')->nullable();
            $table->string('tier_field')->nullable();
            $table->string('os_field')->nullable();
            $table->string('mandatory_field')->nullable();
            $table->string('optional_field')->nullable();
            $table->integer('tenant_id');
            $table->integer('status')->default('1');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_policies');
    }
};
