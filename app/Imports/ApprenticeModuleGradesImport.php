<?php

namespace App\Imports;

use App\Models\Apprentice;
use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
                if(!(is_int($row[2]) && $row[2] >= 0 && $row[2] <= 100)) {
                    throw new \Exception('Grade is invalid');
                }

                $module = Module::firstOrCreate([
                    'name' => $row[1],
                    'block_id' => 1,
                ]);

                $apprentice = Apprentice::whereHas('user', function(Builder $query) use ($row){
                    $query->where('name', $row[0]);
                })->firstOrFail();

                $apprentice->modules()->attach($module, ['grade'=>$row[2]]);
            }
            catch (\Exception $e) {
                Log::error($e->getMessage());
                continue;
            }

        }
    }
}
