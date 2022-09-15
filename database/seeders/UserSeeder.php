<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
			// $beranda = Permission::create(['name' => 'akses beranda']);

			// $laporan_penjualan = Permission::create(['name' => 'akses laporan penjualan']);

			$superadmin_role = Role::create(['name' => 'Super Admin']);
			$admin_role = Role::create(['name' => 'Admin']);
			$treasurer_role = Role::create(['name' => 'Bendahara']);
			$leader_role = Role::create(['name' => 'Pimpinan']);

			// $admin_role->syncPermissions([$bank, $pelanggan, $pembayaran, $penjualan, $penjualan_aksi, $dashboard, $daerah, $laporan_penjualan]);


			$superadmin = User::create([
				'name' => 'Super Admin',
				'email' => 'superadmin@gmail.com',
				'password' => Hash::make('password')
			]);

			$admin = User::create([
				'name' => 'Admin',
				'email' => 'admin@gmail.com',
				'password' => Hash::make('password')
			]);

			$leader = User::create([
				'name' => 'Pimpinan',
				'email' => 'pimpinan@gmail.com',
				'password' => Hash::make('password')
			]);

			$treasurer = User::create([
				'name' => 'Bendahara',
				'email' => 'bendahara@gmail.com',
				'password' => Hash::make('password')
            ]);

			$superadmin->assignRole($superadmin_role);
			$admin->assignRole($admin_role);
			$treasurer->assignRole($treasurer_role);
			$leader->assignRole($leader_role);
		});
    }
}
