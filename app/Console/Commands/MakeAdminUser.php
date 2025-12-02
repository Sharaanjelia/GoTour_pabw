<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * - optional email argument
     * - --name option
     * - --password option
     * - --promote option to promote existing user without creating
     */
    protected $signature = 'user:make-admin {email?} {--name=} {--password=} {--promote : only promote an existing user} {--force : skip confirmation}';

    /**
     * The console command description.
     */
    protected $description = 'Create or promote a user to admin (interactive). Example: php artisan user:make-admin admin@example.com --name="Admin" --password=secret';

    public function handle()
    {
        $email = $this->argument('email');

        if (!$email) {
            $email = $this->ask('Email admin (required)');
        }

        $email = trim($email ?: '');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Email tidak valid. Gunakan format yang benar (contoh: admin@example.com).');
            return 1;
        }

        $user = User::where('email', $email)->first();

        if ($user && !$this->option('promote')) {
            $this->warn("User dengan email $email sudah ada.");
            if (!$this->confirm('Apakah Anda ingin men-promote user ini menjadi admin? (Y/n)')) {
                $this->info('Dibatalkan.');
                return 0;
            }
        }

        if ($user && $this->option('promote')) {
            // promote existing user
            $user->is_admin = true;
            $user->save();

            $this->info("User {$user->email} berhasil dijadikan admin.");
            return 0;
        }

        // either user doesn't exist, or user exists but we confirmed promotion via prompt earlier
        if (!$user) {
            $name = $this->option('name') ?: $this->ask('Nama lengkap');
            $password = $this->option('password');
            if (!$password) {
                $password = $this->secret('Password (input tidak terlihat)');
            }

            if (!$password) {
                // fallback to a random password (but warn)
                $password = bin2hex(random_bytes(5));
                $this->warn('Tidak ada password diberikan — membuat password acak: ' . $password);
            }

            if (!$this->option('force')) {
                $this->info("Akan membuat user: $email (name: $name)");
                if (!$this->confirm('Lanjutkan?')) {
                    $this->info('Dibatalkan.');
                    return 0;
                }
            }

            $user = User::create([
                'name' => $name ?: 'Admin',
                'email' => $email,
                'password' => bcrypt($password),
                'is_admin' => true,
            ]);

            $this->info("Admin created: {$user->email}");
            return 0;
        }

        // In case user exists and we confirmed promotion earlier
        $user->is_admin = true;
        $user->save();
        $this->info("User {$user->email} berhasil dijadikan admin.");
        return 0;
    }
}
