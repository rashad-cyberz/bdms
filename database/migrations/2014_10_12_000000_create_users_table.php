<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('dial_code')->default(91);
            $table->bigInteger('mobile');
            $table->bigInteger('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable()->comment('state / provinces ');
            $table->string('country')->nullable()->comment('state / provinces ');
            $table->integer('blood_type_id')->nullable();
            $table->dateTime('last_donated_at')->nullable();

            $table->string('referral_code')->nullable();
            $table->bigInteger('referred_by')->nullable();


            $table->tinyInteger('status')
                ->default(1)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['dial_code', 'mobile']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
