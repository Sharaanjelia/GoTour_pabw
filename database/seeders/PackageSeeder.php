<?php
<?php
// Seeder dinonaktifkan. Data diambil dari SQL dump, tidak perlu insert apapun di sini.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Seeder dinonaktifkan, gunakan SQL dump untuk data.
     */
    public function run(): void
    {
        // Tidak melakukan apa-apa
    }
}
                'email' => 'admin@example.com',
                'name' => 'Admin User',
                'is_admin' => true,
            ]);
        } else {
            // make sure the found user is flagged as admin
            if (!$admin->is_admin) {
                $admin->is_admin = true;
                $admin->save();
            }
        }

        // create sample packages
        Package::factory()->count(9)->create([
            'user_id' => $admin->id,
        ]);
    }
}
