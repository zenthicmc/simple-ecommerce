<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $random_string = Str::random(10);
        $data = [
            'code' => 'ST-'. $random_string,
            'id_product' => $row['id_product'],
            'isUnlimited' => $row['is_unlimited'],
            'content' => $row['content'],
            'expire_at' => $row['expire_at'],
        ];
        
        return new Stock($data);
    }
}
