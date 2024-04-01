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
        Schema::create('cost_profiles', function (Blueprint $table) {
            $table->id();
            $table->string ('name');
            $table->string ('description');
            $table->integer('vcpu')->default('1');
            $table->decimal('vcpu_price', 10, 2)->default('1');
            $table->integer('form_vcpu_min')->default('1');
            $table->integer('form_vcpu_max')->default('16');
            $table->integer('vmen')->default('1');
            $table->decimal('vmen_price', 10, 2)->default('1');
            $table->integer('form_vmen_min')->default('1');
            $table->integer('form_vmen_max')->default('16');
            $table->integer('vstorage')->default('1');
            $table->string ('vstorage_unit')->comment("GB/TB")->default('GB');
            $table->decimal('vstorage_price', 10, 2)->default('0.5');
            $table->integer('form_vstorage_min')->default('100')->comment('size by GB');
            $table->integer('form_vstorage_max')->default('1000');
            $table->integer('created_by')->comment("create by")->nullable();
            $table->integer('tenant_id')->comment("tenant id");
            $table->integer('status')->default('1');

            $table->string ('environment_profile')->nullable();
            $table->string ('tier_profile')->nullable();
            $table->string ('department_profile')->nullable();
            $table->integer('is_master')->default('0')->comment('master cost profile by company');
            $table->integer('is_cpu_custom')->default('0');
            $table->integer('is_memory_custom')->default('0');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_profiles');
    }
};
