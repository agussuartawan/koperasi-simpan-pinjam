<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
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
			$user = Permission::create(['name' => 'akses user']);
			$klien = Permission::create(['name' => 'akses klien']);
			$tabungan = Permission::create(['name' => 'akses tabungan']);
			$pinjaman = Permission::create(['name' => 'akses pinjaman']);
			$tunggakan = Permission::create(['name' => 'akses tunggakan']);
			$laporan = Permission::create(['name' => 'akses laporan']);

			$superadmin_role = Role::create(['name' => 'Super Admin']);
			$admin_role = Role::create(['name' => 'Admin']);
			$treasurer_role = Role::create(['name' => 'Bendahara']);
			$leader_role = Role::create(['name' => 'Pimpinan']);

			$admin_role->syncPermissions([$user, $klien, $tabungan, $pinjaman, $tunggakan, $laporan]);
			$treasurer_role->syncPermissions([$tabungan, $pinjaman, $tunggakan]);
			$leader_role->syncPermissions([$laporan]);

			$superadmin = User::create([
				'name' => 'Super Admin',
				'email' => 'superadmin@gmail.com',
				'date_in' => Carbon::now(),
				'password' => Hash::make('password')
			]);

			$admin = User::create([
				'name' => 'Admin',
				'email' => 'admin@gmail.com',
				'date_in' => Carbon::now(),
				'password' => Hash::make('password')
			]);

			$leader = User::create([
				'name' => 'Pimpinan',
				'email' => 'pimpinan@gmail.com',
				'date_in' => Carbon::now(),
				'password' => Hash::make('password')
			]);

			$treasurer = User::create([
				'name' => 'Bendahara',
				'email' => 'bendahara@gmail.com',
				'date_in' => Carbon::now(),
				'password' => Hash::make('password')
			]);

			$superadmin->assignRole($superadmin_role);
			$admin->assignRole($admin_role);
			$treasurer->assignRole($treasurer_role);
			$leader->assignRole($leader_role);
		});
	}
}