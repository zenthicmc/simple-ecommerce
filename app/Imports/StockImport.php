<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class StockImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $random_string = Str::random(10);
        return new Stock([
            'code' => 'ST-'. $random_string,
            'id_product' => $row[0],
            'isUnlimited' => $row[1],
            'content' => $row[2],
            'expire_at' => $row[3],
        ]);
    }
}
