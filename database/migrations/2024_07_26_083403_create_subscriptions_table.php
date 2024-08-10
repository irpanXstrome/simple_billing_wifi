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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('amount'); // max 50
            $table->timestamp('expired')->default(\Illuminate\Support\Carbon::parse(now())->addMonth()); // max 50
            $table->enum('type',['mbps','device']);
            $table->timestamps();
        });
        Schema::table('customers',function (Blueprint $table){
            $table->foreignId('subscription_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers',function (Blueprint $table){
            $table->dropForeign('subs_id');
        });
        Schema::dropIfExists('subscriptions');
    }
};
