<?php

namespace App\Imports;

use App\Models\MstProject;
use App\Models\MstSap;
use App\Models\TranSupervisi;
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

class SapImport implements OnEachRow, WithStartRow, WithMultipleSheets, WithCalculatedFormulas, WithValidation, SkipsEmptyRows
{
    public function onRow(Row $row)
    {

        MstProject::where("lop_site_id", $row[14])
            ->update([
                'status_project' => $row[31]
            ]);
        TranSupervisi::where("project_name", $row[14])
            ->update([
                'real_nilai' => $row[22],
                //'real_port' => $row[31],
            ]);

        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        $doc_date = null;
        $debit_date = null;
        if ($row[21] != null) {
            $doc_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21])->format('Y-m-d');
        }
        if ($row[27] != null) {
            $debit_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[27])->format('Y-m-d');
        }

        MstSap::updateOrCreate(
            [
                'name' => $row[14],
            ],
            [
                'baru_co' => $row[1],
                'cfu' => $row[2],
                'flag' => $row[3],
                'uraian_wbs' => $row[4],
                'comm_release' => $row[5],
                'pay_release' => $row[6],
                'wbs_element' => $row[7],
                'purchasing_doc' => $row[8],
                'kontrak' => $row[9],
                'proses' => $row[10],
                'ref_doc_no' => $row[11],
                'item' => $row[12],
                'cost_elem' => $row[13],
                'name' => $row[14],
                'ses_pelimpahan' => $row[15],
                'witel' => $row[16],
                'id_vendor' => $row[17],
                'vendor' => $row[18],
                'ta_non_ta' => $row[19],
                'user' => $row[20],
                'doc_date' => $doc_date,
                'nilai_pr_po_gr' => $row[22],
                'value_tcur' => $row[23],
                'status_pr' => $row[24],
                'status_po' => $row[25],
                'status_gr' => $row[26],
                'debit_date' => $debit_date,
                'keterangan' => $row[28],
                'achv_progi' => $row[29],
                'tematik' => $row[30],
                'status_sap' => $row[31]
            ]

        );
    }

    public function startRow(): int
    {
        return 2;
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
            //'name' => 'required',
            '14' => 'required'
            // so on
        ];
    }
}
