<?php

namespace App\Imports;

use App\Models\Apprentice;
use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use function PHPUnit\Framework\isNull;
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
                // extract values from row
                $grade = $row[9];
                $moduleCode = Str::after($row[2], '#');
                $candidateNumber = Str::after($row[6], '#');

                // validate grade
                if(!(is_int($grade) && $grade >= 0 && $grade <= 100)) {
                    throw new \Exception('Module grades import: Grade is invalid on row ' . $index + 1);
                }

                // get module from module code "#Module" and validate
                $module = Module::where('code', $moduleCode)->first();
                if (!$module) {
                    throw new \Exception('Module grades import: #Module is not returning a module on row ' . $index + 1);
                }

                // get apprentice from candidate number "#Cand Key" and validate
                $apprentice = Apprentice::where('candidate_number', $candidateNumber)->first();
                if (!$apprentice) {
                    throw new \Exception('Module grades import: #Cand Key (column 7) is not returning an apprentice on row ' . $index + 1);
                }

                // get an existing apprenticeModule and update its grade, or if it doesn't exist; attach a new one to the apprentice
                $existingApprenticeModule = $apprentice->modules()->where('code', $moduleCode)->first();

                if ($existingApprenticeModule) {
                    $existingApprenticeModule->pivot->grade = $grade;
                    $existingApprenticeModule->pivot->save();
                }
                else {
                    $apprentice->modules()->attach($module, ['grade' => $grade]);
                }
            }
            catch (\Exception $e) {
                Log::error($e->getMessage());
                continue;
            }

        }
    }
}
