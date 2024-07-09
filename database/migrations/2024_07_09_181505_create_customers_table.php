<?php

use App\Models\Category;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->foreignId('cat_id')->constrained('categories')->onDelete('cascade');
            $table->string('sub_cat_id')->nullable();
            $table->string('address')->nullable();
            $table->string('road')->nullable();
            $table->string('town')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('tel')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->foreignId('notes_id')->constrained('notes')->onDelete('cascade');
            $table->string('contact_them')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
