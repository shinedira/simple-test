<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instanceRoles       = collect();
        $instancePermissions = collect();

        $roles = $this->format(['senior-hrd', 'hrd']);
        foreach ($roles as $role) {
            $instanceRoles->push(Role::create($role));
        }


        $permissions       = ['view', 'read', 'edit', 'add'];
        $formatPermissions = $this->format($permissions);

        foreach ($formatPermissions as $permission) {
            $instancePermissions->push(Permission::create($permission));
        }

        $this->assignedPermissionToRole($instanceRoles, $instancePermissions, $permissions);
    }

    private function assignedPermissionToRole(Collection $instanceRoles, Collection $instancePermissions, array $permissions): void
    {
        $assignes = [
            'senior-hrd' => $permissions,
            'hrd'        => Arr::where($permissions, function($value) {
                return in_array($value, ['view', 'read']);
            })
        ];

        foreach ($assignes as $role => $permission) {
            $role_        = $instanceRoles->where('name', $role)->first();
            $permissions_ = $instancePermissions->filter(function($item) use ($permission) {
                return in_array($item->name, $permission);
            });

            $role_->givePermissionTo($permissions_);
        }
    }

    /**
     * Undocumented function
     *
     * @param array $data
     *
     * @return array
     */
    private function format(array $data) : array
    {
        return collect($data)->map(function($value) {
            return ['name' => $value];
        })->toArray();
    }
}
