<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportAllCsvToMysql extends Command
{
    protected $signature = 'import:allcsv-mysql';
    protected $description = 'Import semua file CSV di storage/app/exports ke tabel MySQL';

    public function handle()
    {
        // Nonaktifkan foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $exportPath = storage_path('app/exports');
        $files = glob($exportPath . '/*.csv');
        foreach ($files as $file) {
            $table = basename($file, '.csv');
            $csv = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (count($csv) < 2) continue; // skip jika kosong
            $header = str_getcsv(array_shift($csv));
            DB::table($table)->truncate(); // kosongkan tabel dulu
            foreach ($csv as $line) {
                $values = str_getcsv($line);
                if (count($values) !== count($header)) {
                    // Lewati baris yang tidak valid
                    $this->warn("Baris dilewati di tabel $table karena jumlah kolom tidak sesuai header.");
                    continue;
                }
                $row = array_combine($header, $values);
                // Ubah string kosong menjadi NULL
                foreach ($row as $k => $v) {
                    if ($v === '') {
                        $row[$k] = null;
                    }
                }
                DB::table($table)->insert($row);
            }
            $this->info("Import ke tabel $table selesai.");
        }
        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->info('Semua file CSV berhasil diimport ke MySQL!');
    }
}
