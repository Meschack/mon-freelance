<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("price");
            $table->enum("status", ["pending", "done", "cancelled"]);
            $table->enum('review_type', ["positive", "negative"])->nullable();
            $table->longText("review_content")->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Service::class)->constrained()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
