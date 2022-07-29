<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\ProjectImport;
use App\Imports\SapImport;
use App\Models\MstSap;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
//use Session;

class ImportController extends Controller
{
    //
    public function index()
    {

        return view('import');
    }

    public function import_project(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_import', $nama_file);

        // import data
        Excel::import(new ProjectImport, public_path('/file_import/' . $nama_file));
        

        // notifikasi dengan session
        Session::flash('sukses', 'Data Project Berhasil Diimport!');

        // alihkan halaman kembali
        //return redirect('/project');
        admin_toastr('Success: Data Project Berhasil diimport', 'success');
        return redirect()->back();
    }

    public function import_sap(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_import', $nama_file);
        
        MstSap::truncate();

        // import data
        Excel::import(new SapImport, public_path('/file_import/' . $nama_file));
        

        // notifikasi dengan session
        Session::flash('sukses', 'Data SAP Berhasil Diimport!');

        // alihkan halaman kembali
        //return redirect('/project');
        admin_toastr('Success: Data SAP Berhasil diimport', 'success');
        return redirect()->back();
    }
}
