<?php

namespace App\Admin\Forms;

use App\Models\MstSap;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;
use App\Imports\SmilleyNilaiImport;
use App\Imports\SmilleyVolumeImport;
use Maatwebsite\Excel\Facades\Excel;

class importSmilley extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'import Tabel Reporting Smilley';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_import di dalam folder public
        $file->move('file_import', $nama_file);

        try
        {
            
            Excel::import(new SmilleyNilaiImport, public_path('/file_import/' . $nama_file));
            //Excel::import(new SmilleyVolumeImport, public_path('/file_import/' . $nama_file));
            admin_success('Processed import successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e)
        {
            $failures = $e->failures();

            foreach ($failures as $failure)
            {
                info($failure->row());
                info($failure->attribute());
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
            admin_error('Processed import Nilai gagal');
        }

        

       
         return redirect()->back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->file('file', 'File Project Import')->rules('required|mimes:xlsx');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
           
        ];
    }
}
