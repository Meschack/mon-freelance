<?php

use App\Models\Role;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->min(3);
            $table->string('lastname')->min(3);
            $table->string('email')->unique();
            $table->string('sexe')->nullable();
            $table->date("birthdate")->nullable();
            $table->string("bio")->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('two_factor_code')->nullable();
            $table->datetime('two_factor_expires_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignIdFor(Role::class)->constrained()->restrictOnDelete();
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
