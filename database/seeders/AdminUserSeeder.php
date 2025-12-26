<?php
<?php
// Seeder dinonaktifkan. Data diambil dari SQL dump, tidak perlu insert apapun di sini.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seeder dinonaktifkan, gunakan SQL dump untuk data.
     */
    public function run(): void
    {
        // Tidak melakukan apa-apa
    }
}
            'is_admin' => true,
        ]);

        // additional admin for testing
        User::firstOrCreate([
            'email' => 'admin2@example.com',
        ], [
            'name' => 'Admin Two',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
    }
}
