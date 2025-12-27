<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExportAllTablesToCsv extends Command
{
    protected $signature = 'export:alltables-csv';
    protected $description = 'Export semua tabel database ke file CSV di storage/app/exports';

    public function handle()
    {
        $tables = DB::select('SELECT name FROM sqlite_master WHERE type = "table" AND name NOT LIKE "sqlite_%"');
        $exportPath = storage_path('app/exports');
        if (!is_dir($exportPath)) {
            mkdir($exportPath, 0777, true);
        }
        foreach ($tables as $tableObj) {
            $table = $tableObj->name;
            $rows = DB::table($table)->get();
            if ($rows->isEmpty()) continue;
            $csvFile = fopen("$exportPath/{$table}.csv", 'w');
            // Write header
            fputcsv($csvFile, array_keys((array)$rows[0]));
            // Write rows
            foreach ($rows as $row) {
                fputcsv($csvFile, array_values((array)$row));
            }
            fclose($csvFile);
        }
        $this->info('Semua tabel berhasil diekspor ke storage/app/exports/*.csv');
    }
}
