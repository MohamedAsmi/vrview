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
        Schema::table('voice_records', function (Blueprint $table) {
            // Add new columns for text-to-speech functionality
            $table->string('record_method')->default('microphone')->after('property_images_id'); // microphone or text
            $table->text('text_content')->nullable()->after('record_method'); // for text-to-speech content
            
            // Remove columns that are no longer needed
            if (Schema::hasColumn('voice_records', 'property_id')) {
                $table->dropForeign(['property_id']);
                $table->dropColumn('property_id');
            }
            
            if (Schema::hasColumn('voice_records', 'description')) {
                $table->dropColumn('description');
            }
            
            // Rename title to old_title (remove later if not needed)
            if (Schema::hasColumn('voice_records', 'title')) {
                $table->renameColumn('title', 'old_title');
            }
            
            if (Schema::hasColumn('voice_records', 'old_path')) {
                $table->dropColumn('old_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voice_records', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['record_method', 'text_content']);
            
            // Restore old columns
            $table->foreignId('property_id')->nullable()->constrained('properties')->onDelete('cascade');
            $table->text('description')->nullable();
            
            if (Schema::hasColumn('voice_records', 'old_title')) {
                $table->renameColumn('old_title', 'title');
            }
        });
    }
};
