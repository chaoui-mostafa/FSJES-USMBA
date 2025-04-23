<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\DoctorantsTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class GenerateDoctorantsTemplate extends Command
{
    protected $signature = 'template:doctorants';
    protected $description = 'Generate Excel template for doctorants import';

    public function handle()
    {
        Excel::store(new DoctorantsTemplateExport, 'public/import_template.xlsx');
        $this->info('Template generated at storage/app/public/import_template.xlsx');

        // Create storage link if it doesn't exist
        if (!file_exists(public_path('storage'))) {
            $this->call('storage:link');
        }
    }
}
