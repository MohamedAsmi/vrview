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
            // Add new columns
            $table->foreignId('property_id')->nullable()->constrained('properties')->onDelete('cascade')->after('id');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('property_id');
            $table->text('description')->nullable()->after('title');
            $table->string('file_path')->nullable()->after('description');
            $table->string('file_name')->nullable()->after('file_path');
            
            // Rename existing path column to old_path (to maintain existing data)
            $table->renameColumn('path', 'old_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voice_records', function (Blueprint $table) {
            // Remove added columns
            $table->dropForeign(['property_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['property_id', 'user_id', 'description', 'file_path', 'file_name']);
            
            // Rename back
            $table->renameColumn('old_path', 'path');
        });
    }
};
