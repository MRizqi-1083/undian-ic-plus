<?php

namespace App\Imports;

use App\Models\RefferalModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportKodeRefferal implements ToCollection, WithChunkReading
{
    public function  __construct($session_id, $acara_id)
    {
        $this->session_id = $session_id;
        $this->acara_id = $acara_id;
    }

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {

            if ($row[0] != "No") {
                $f = substr($row[2], -2);
                for ($i = 0; $i < $row[3]; $i++) {
                    // RefferalModel::create(
                    $data = [
                        'und_email' => $row[1],
                        'und_user' => $row[2],
                        'und_nama' => $row[4],
                        'und_kode' => strtoupper($f) . strtoupper(substr(md5($i . microtime(true)), 0, 7)) . $i,
                        'und_exp' => date('Y-m-d', strtotime("+1 week")),
                        'und_status' => 'aktif',
                        'acara_id' => $this->acara_id,
                        'und_create_by' => $this->session_id,
                        'und_kuota_no' => $i + 1
                    ];
                    // );
                };
            }
        }

        var_dump($data);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
