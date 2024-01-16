<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\RefferalModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ExportKodeRefferal extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, WithCustomValueBinder
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RefferalModel::where('acara_id', 3)->get();
    }

    public function headings(): array
    {
        return ["Nama", "No Kuota", "Email", "Phone", "Kode", "Status", "Expired"];
    }

    public function map($row): array
    {
        $fields = [
            $row->und_nama,
            $row->und_kuota_no,
            $row->und_email,
            $row->und_user,
            $row->und_kode,
            $row->und_status,
            $row->und_exp
        ];
        return $fields;
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
