<?php

namespace App\Imports;

use App\Models\MstProject;
use App\Models\MstSap;
use App\Models\TranSupervisi;
use App\Models\MstSmilleyVolume;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SmilleyVolumeImport implements OnEachRow, WithStartRow, WithMultipleSheets, WithCalculatedFormulas, WithValidation, SkipsEmptyRows
{
    public function onRow(Row $row)
    {

        // MstProject::where("lop_site_id", $row[14])
        //     ->update([
        //         'status_project' => $row[31]
        //     ]);
        // TranSupervisi::where("project_name", $row[14])
        //     ->update([
        //         'real_nilai' => $row[22],
        //         //'real_port' => $row[31],
        //     ]);

        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        MstSmilleyVolume::updateOrCreate(
            // [
            //     'no_kontrak' => $row[10],
            // ],
            [
                'kd_kontrak' => $row[0],
                'no_amdke' => $row[1],
                'kd_wbs' => $row[2],
                'kd_sgrup' => $row[3],
                'pk_owner' => $row[4],
                'kd_lokasi1' => $row[5],
                'ubis_waslak' => $row[6],
                'unit_waslak' => $row[7],
                'waslak_har' => $row[8],
                'ubis_owner' => $row[9],
                'no_kontrak' => $row[10],
                'nm_singkat' => $row[11],
                'tg_edc' => $row[12],
                'tg_toc' => $row[13],
                'nm_tematik' => $row[14],
                'nm_witel' => $row[15],
                'nm_lokasi1' => $row[16],
                'project_site_id' => $row[17],
                'kt_lokasi' => $row[18],
                'site_alamat' => $row[19],
                'pro_plan' => $row[20],
                'pro_actual' => $row[21],
                'pro_bast' => $row[22],
                'status' => $row[23],
                'tg_plan_start' => $row[24],
                'tg_plan_finish' => $row[25],
                'tg_actual_start' => $row[26],
                'no_ut' => $row[27],
                'tg_ut' => $row[28],
                'no_bast1' => $row[29],
                'tg_baut' => $row[30],
                'nm_inf' => $row[31],
                'ni_kap_real' => $row[32],
                'ni_kap_sls' => $row[33],
                'satuan' => $row[34],
                'kt_volume' => $row[35],
                'nm_vendor' => $row[36],
                'tg_bast1' => $row[37]
            ]
        );
    }

    public function startRow(): int
    {
        return 3;
    }

    public function sheets(): array
    {
        return [
            1 => $this,
        ];
    }

    public function rules(): array
    {
        return [
            //'name' => 'required',
            '10' => 'required'
            // so on
        ];
    }
}
