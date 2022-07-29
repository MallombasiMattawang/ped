<?php

namespace App\Imports;



use Excel;
use App\Models\MstProject;
use App\Models\MstSap;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ProjectImport implements ToModel, WithStartRow, WithMultipleSheets, WithCalculatedFormulas, WithValidation, SkipsEmptyRows
{
    //use SkipsErrors;

    public function model(array $row)
    {
        $mstSap = MstSap::where('name', $row[9])->first();
        $status_sap = 'USULAN';
        $status_sap_plan = null;
        if(isset($mstSap)) {           
            $status_sap = $mstSap->status_sap;
            $status_sap_plan =$mstSap->status_sap;
        }
        return new MstProject([
            'tipe_project' => $row[1],
            'tematik' => $row[2],
            'nde_permintaan' => $row[3],
            'perihal_nde' => $row[4],
            'tgl_nde' => $row[5],
            'nilai_permintaan' => $row[6],

            'witel_id' => $row[7],
            'sto_id' => $row[8],
            'lop_site_id' => $row[9],
            'feeder_ku_kap_12' => $row[10],
            'feeder_ku_kap_24' => $row[11],
            'feeder_ku_kap_48' => $row[12],
            'feeder_ku_kap_96' => $row[13],
            'feeder_kt_kap_24' => $row[14],
            'feeder_kt_kap_48' => $row[15],
            'feeder_kt_kap_96' => $row[16],
            'feeder_kt_kap_144' => $row[17],
            'feeder_kt_kap_288' => $row[18],
            'distribusi_ku_kap_24_scpt' => $row[19],
            'distribusi_ku_kap_12_scpt' => $row[20],
            'distribusi_ku_kap_8_scpt' => $row[21],
            'distribusi_kt_kap_24_scpt' => $row[22],
            'distribusi_kt_kap_12_scpt' => $row[23],
            'distribusi_kt_kap_8_scpt' => $row[24],
            'odp_odp_8' => $row[25],
            'odp_odp_16' => $row[26],
            'odp_spl_1_8' => $row[27],
            'odp_spl_1_16' => $row[28],
            'odp_port' => $row[29],
            'catuan_jenis' => $row[30],
            'catuan_nama' => $row[31],
            'odc_odc_48' => $row[32],
            'odc_odc_96' => $row[33],
            'odc_odc_144' => $row[34],
            'odc_odc_288' => $row[35],
            'odc_576' => $row[36],
            'odc_total' => $row[37],
            'panjang_feeder' => $row[38],
            'panjang_dist' => $row[39],
            'tiang_baru' => $row[40],
            'jarak_ke_sto' => $row[41],
            'jml_home_pass' => $row[42],
            'rab_material' => $row[43],
            'rab_survey' => $row[44],
            'rab_total' => $row[45],
            'nilai_capex_per_port' => $row[46],
            'mitra_id' => $row[47],
            'status_project' => $status_sap,
            'status_sap' => $status_sap_plan,
            //'status_project' => 'USULAN',
        ]);
    }

    public function startRow(): int
    {
        return 5;
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function rules(): array
    {
        return [
            '9' => 'unique:mst_project,lop_site_id'
            // so on
        ];
    }

    public function customValidationMessages()
    {
        return [
            '9.unique' => 'Name lop_site_id sudah pernah diimport',
        ];
    }
}
