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
        $permissions = [
            'hero_sliders.view',
            'hero_sliders.create',
            'hero_sliders.edit',
            'hero_sliders.delete',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $role = \Spatie\Permission\Models\Role::where('name', 'Super Admin')->first();
        if ($role) {
            $role->givePermissionTo($permissions);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $permissions = [
            'hero_sliders.view',
            'hero_sliders.create',
            'hero_sliders.edit',
            'hero_sliders.delete',
        ];

        foreach ($permissions as $permission) {
            $p = \Spatie\Permission\Models\Permission::where('name', $permission)->first();
            if ($p) $p->delete();
        }
    }
};
