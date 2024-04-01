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
        Schema::create('operating_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('display_description')->nullable();
            $table->boolean('status')->default(1);
            $table->string('display_icon')->nullable();
            $table->string('display_icon_colour')->nullable();
            $table->integer('tenant_id');
            $table->decimal('cost',10,2)->default('1');
            $table->string('os_type')->nullable();
            $table->integer('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operating_systems');
    }
};
