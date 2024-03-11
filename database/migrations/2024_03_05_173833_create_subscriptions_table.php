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
        Schema::create("subscriptions", function (Blueprint $table) {
            $table->enum("status", ["active", "inactive"])->nullable();
            $table->uuid("subscriber_id")->unique();
            $table->dateTime("start_date")->nullable();
            $table->dateTime("expire_date")->nullable();
            $table->string("phone_number", 15);
            $table->string("packageId");
            $table
                ->foreignId("user_id")
                ->constrained("users")
                ->onDelete("cascade");
            $table->timestamps();
            $table->softDeletes();
            $table->index(["status", "start_date", "expire_date"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("subscriptions");
    }
};
