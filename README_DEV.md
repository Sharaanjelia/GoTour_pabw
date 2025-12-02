# Local Development Setup (Windows PowerShell)

This project includes a handy `setup-local.ps1` script to bootstrap a working local dev environment using SQLite, so you don't have to change any configuration files.

Steps (one-liner):

```powershell
cd C:\Gotour_Proyek
powershell -ExecutionPolicy Bypass -File scripts\setup-local.ps1
```

What the script does:
- Copies `.env.example` to `.env` if `.env` doesn't exist
- Ensures `database/database.sqlite` exists
- Runs `composer install` to install PHP dependencies
- Generates `APP_KEY` with `php artisan key:generate`
- Runs migrations with an environment override (DB_CONNECTION=sqlite)
- Runs `php artisan storage:link` (or creates junction on Windows if needed)
- Runs `npm install` and `npm run build`
- Clears caches and compiles views

Notes:
- If you're already using a configured `.env` (for example, MySQL), the script will not modify your `.env`. It will run migrations for SQLite only for the script execution. If you'd like the script to always use SQLite, remove/rename `.env` before running.
- For Linux/macOS users: a similar bash script could be used or you can run the steps manually.

Troubleshooting:
- If you get a permissions error while creating the symlink on Windows, run PowerShell as Administrator or enable Developer Mode.
- If migrations fail, check `storage/logs/laravel.log` for details.

If you'd like, I can also:
- Add a bash equivalent script `scripts/setup-local.sh` (for macOS/Linux)
- Add a one-liner `composer` script to call this setup
- Create a `Makefile` with a `make setup` target

Pick one and I'll add it.