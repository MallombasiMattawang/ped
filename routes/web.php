<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('ped-panel');
});


Route::get('/project', [ImportController::class, 'index'])->name('project');
Route::post('/project/import_project', [ImportController::class, 'import_excel'])->name('import_project');
Route::post('/project/import_sap', [ImportController::class, 'import_sap'])->name('import_sap');
//Route::get('/siswa/export_excel', 'SiswaController@export_excel');
