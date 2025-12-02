# Admin accounts & quick management

This file explains quick ways to create/promote admin users in this project.

1) Using Tinker (one-off, immediate)

Open tinker:

```powershell
php artisan tinker
```

Create a new admin user with a password:

```php
\App\Models\User::create([
  'name' => 'Admin User',
  'email' => 'admin3@example.com',
  'password' => bcrypt('StrongPassword!'),
  'is_admin' => true,
]);
```

Promote an existing user (check exists first):

```php
$u = \App\Models\User::where('email', 'someone@example.com')->first();
if ($u) { $u->update(['is_admin' => true]); }
```

2) Using the Seeder

The project includes `Database\Seeders\AdminUserSeeder` which will create default admin accounts during `php artisan db:seed`.

3) Admin UI (web)

URL: `/admin/users` (protected — you must be logged in as an admin)

From the Admin UI you can:
- list paginated users
- search users by name/email
- create users and set the `is_admin` flag
- toggle admin status and delete users

If you'd like, I can add a role-based system with more granular permissions next.
