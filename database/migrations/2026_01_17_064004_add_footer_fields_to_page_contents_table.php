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
        Schema::table('page_contents', function (Blueprint $table) {
            $table->text('footer_description')->nullable();
            
            // Social Links
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('instagram_url')->nullable();

            // Contact
            $table->string('footer_contact_email')->nullable();

            // Locations
            $table->text('uk_address')->nullable();
            $table->string('uk_email')->nullable();
            $table->text('hq_address')->nullable();
            $table->string('hq_email')->nullable();
            $table->text('nz_address')->nullable();
            $table->string('nz_email')->nullable();

            // Copyright
            $table->string('copyright_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_contents', function (Blueprint $table) {
            //
        });
    }
};
