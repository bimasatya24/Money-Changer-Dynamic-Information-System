<?php

namespace App\Imports;

use App\Models\RateHistory;
use App\Models\Upload;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class UpdateWebImport implements ToCollection, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $i = 0;
        $today = now()->toDateString();

        foreach ($rows->slice(5) as $row) {

            if (!isset(KursValasImport::$kurs[$i])) {
                break;
            }

            $mataUang = KursValasImport::$kurs[$i]['mata_uang'];
            $pecahan   = KursValasImport::$kurs[$i]['pecahan'];
            $beli      = $this->formatKurs($row[12]);
            $jual      = $this->formatKurs($row[13]);

            Upload::create([
                'mata_uang' => $mataUang,
                'pecahan'   => $pecahan,
                'beli'      => $beli,
                'jual'      => $jual,
            ]);

            RateHistory::updateOrCreate(
                [
                    'mata_uang' => $mataUang,
                    'pecahan'   => $pecahan,
                    'tanggal'   => $today,
                ],
                [
                    'beli'      => $beli,
                    'jual'      => $jual,
                ]
            );

            $i++;
        }
    }

    private function formatKurs($value)
    {
        if (is_numeric($value) && $value < 1) {
            return round($value, 2);
        }

        return $value;
    }
}
