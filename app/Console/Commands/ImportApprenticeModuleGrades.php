<?php

namespace App\Console\Commands;

use App\Imports\ApprenticeModuleGradesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportApprenticeModuleGrades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:module-grades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the apprentices\' modules and grades';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Excel::import(new ApprenticeModuleGradesImport(), 'Apprentice Grade Data.csv', 'import');
    }
}
