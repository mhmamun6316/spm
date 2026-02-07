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
        Schema::rename('text_contents', 'home_contents');

        // Update Permissions
        $permissions = [
            'text_contents.view' => 'home_contents.view',
            'text_contents.create' => 'home_contents.create',
            'text_contents.edit' => 'home_contents.edit',
            'text_contents.delete' => 'home_contents.delete',
        ];

        foreach ($permissions as $old => $new) {
            \Spatie\Permission\Models\Permission::where('name', $old)->update(['name' => $new]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('home_contents', 'text_contents');

        // Revert Permissions
        $permissions = [
            'home_contents.view' => 'text_contents.view',
            'home_contents.create' => 'text_contents.create',
            'home_contents.edit' => 'text_contents.edit',
            'home_contents.delete' => 'text_contents.delete',
        ];

        foreach ($permissions as $old => $new) {
            \Spatie\Permission\Models\Permission::where('name', $old)->update(['name' => $new]);
        }
    }
};
