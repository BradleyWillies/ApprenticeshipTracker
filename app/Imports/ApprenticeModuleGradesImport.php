<?php

namespace App\Imports;

use App\Models\Apprentice;
use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use function PHPUnit\Framework\throwException;

class ApprenticeModuleGradesImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row)
        {
            if($index == 0) continue;

            try {
                // validate grade
                if(!(is_int($row[9]) && $row[9] >= 0 && $row[9] <= 100)) {
                    throw new \Exception('Grade is invalid');
                }

                $module = Module::where('code', Str::after($row[2], '#'))->first();

                $apprentice = Apprentice::where('candidate_number', Str::after($row[6], '#'))->first();

                $apprentice->modules()->attach($module, ['grade'=>$row[9]]);
            }
            catch (\Exception $e) {
                Log::error($e->getMessage());
                continue;
            }

        }
    }
}
