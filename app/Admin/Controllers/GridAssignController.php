<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstProject;
use App\Admin\Actions\Project\Baseline;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;

class GridAssignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Daftar Tunggu Assign Project';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstProject());      

        
        if (Admin::user()->inRoles(['hd-ped'])) {
            //$grid->model()->where('witel_id', '=', 'SULSELBAR');
            $grid->model()->where('status_plan', '=', '1');
            $grid->model()->where('assign_by_ped', '=', '0');
        }
        if (Admin::user()->inRoles(['witel'])) {
            $grid->model()->where('witel_id', '=', 'SULSELBAR');
            $grid->model()->where('status_plan', '=', '1');
            $grid->model()->where('assign_by_witel', '=', '0');
        }
        if (Admin::user()->inRoles(['waspang'])) {
            $grid->model()->where('waspang_id', '=', 'WASPANG1');
            $grid->model()->where('status_plan', '=', '1');
            $grid->model()->where('assign_by_waspang', '=', '0');
        }
        if (Admin::user()->inRoles(['tim-ut'])) {
            //$grid->model()->where('waspang_id', '=', 'WASPANG1');
            $grid->model()->where('status_plan', '=', '1');
            $grid->model()->where('assign_by_ut', '=', '0');
        }
        

        

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();

            $actions->add(new Baseline);
        });

        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('lop_site_id', 'LOP / SITE ID');
                $filter->like('tematik', 'TEMATIK');
                $filter->like('witel_id', 'WITEL');
                $filter->like('mitra_id', 'MITRA');
                $filter->like('waspang_id', 'WASPANG');
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->in('status_project', 'STATUS PROJECT')->multipleSelect(['USULAN' => 'USULAN', 'DONE DRM' => 'DONE DRM', 'GRM' => 'GRM', 'PELIMPAHAN' => 'PELIMPAHAN', 'PO/SP' => 'PO/SP', 'DROP' => 'DROP']);
                $filter->between('start_date', 'START DATE')->date();
                $filter->between('end_date', 'END DATE')->date();
            });
        });

        $grid->column('tipe_project', __('TIPE PROJECT'))->width(200)->hide();
        $grid->column('tematik', __('TEMATIK'))->width(200)->sortable();
        $grid->column('wbs', __('Wbs'))->width(200)->hide();
        $grid->column('nde_permintaan', __('Nde permintaan'))->width(200)->hide();
        $grid->column('perihal_nde', __('Perihal nde'))->width(200)->hide();
        $grid->column('nilai_permintaan', __('Nilai permintaan'))->width(200)->hide();
        $grid->column('nde_pelimpahan', __('Nde pelimpahan'))->width(200)->hide();
        $grid->column('tgl_nde_pelimpahan', __('Tgl nde pelimpahan'))->width(200)->hide();
        $grid->column('nilai_pelimpahan', __('Nilai pelimpahan'))->width(200)->hide();
        $grid->column('nomor_kontrak', __('Nomor kontrak'))->width(200)->hide();
        $grid->column('status_sap', __('Status sap'))->width(200)->hide();
        $grid->column('witel_id', __('WITEL'))->width(200)->sortable();
        $grid->column('sto', __('STO'))->width(200)->sortable();
        $grid->column('lop_site_id', __('LOP / SITE ID'))->width(200)->sortable();
        $grid->column('lat', __('Lat'))->width(200)->hide();
        $grid->column('long', __('Long'))->width(200)->hide();
        $grid->column('feeder_ku_kap_12', __('Feeder ku kap 12'))->width(200)->hide();
        $grid->column('feeder_ku_kap_24', __('Feeder ku kap 24'))->width(200)->hide();
        $grid->column('feeder_ku_kap_48', __('Feeder ku kap 48'))->width(200)->hide();
        $grid->column('feeder_ku_kap_96', __('Feeder ku kap 96'))->width(200)->hide();
        $grid->column('feeder_kt_kap_24', __('Feeder kt kap 24'))->width(200)->hide();
        $grid->column('feeder_kt_kap_48', __('Feeder kt kap 48'))->width(200)->hide();
        $grid->column('feeder_kt_kap_96', __('Feeder kt kap 96'))->width(200)->hide();
        $grid->column('feeder_kt_kap_144', __('Feeder kt kap 144'))->width(200)->hide();
        $grid->column('feeder_kt_kap_288', __('Feeder kt kap 288'))->width(200)->hide();
        $grid->column('distribusi_ku_24', __('Distribusi ku 24'))->width(200)->hide();
        $grid->column('distribusi_ku_12', __('Distribusi ku 12'))->width(200)->hide();
        $grid->column('distribusi_ku_8', __('Distribusi ku 8'))->width(200)->hide();
        $grid->column('distribusi_kt_24', __('Distribusi kt 24'))->width(200)->hide();
        $grid->column('distribusi_kt_12', __('Distribusi kt 12'))->width(200)->hide();
        $grid->column('distribusi_kt_8', __('Distribusi kt 8'))->width(200)->hide();
        $grid->column('odp_8', __('Odp 8'))->width(200)->hide();
        $grid->column('odp_16', __('Odp 16'))->width(200)->hide();
        $grid->column('spl_1_8', __('Spl 1 8'))->width(200)->hide();
        $grid->column('spl_1_16', __('Spl 1 16'))->width(200)->hide();
        $grid->column('port', __('PORT'))->width(200)->sortable();
        $grid->column('jenis', __('Jenis'))->width(200)->hide();
        $grid->column('nama_catuan', __('Nama catuan'))->width(200)->hide();
        $grid->column('lat_catuan', __('Lat catuan'))->width(200)->hide();
        $grid->column('long_catuan', __('Long catuan'))->width(200)->hide();
        $grid->column('odc_48', __('Odc 48'))->width(200)->hide();
        $grid->column('odc_96', __('Odc 96'))->width(200)->hide();
        $grid->column('odc_144', __('Odc 144'))->width(200)->hide();
        $grid->column('odc_288', __('Odc 288'))->width(200)->hide();
        $grid->column('odc_576', __('Odc 576'))->width(200)->hide();
        $grid->column('total_odc', __('Total odc'))->width(200)->hide();
        $grid->column('panjang_feeder', __('Panjang feeder'))->width(200)->hide();
        $grid->column('jml_home_pass', __('Jml home pass'))->width(200)->hide();
        $grid->column('material', __('Material'))->width(200)->hide();
        $grid->column('jasa', __('Jasa'))->width(200)->hide();
        $grid->column('total_rab', __('TOTAL RAB'))->width(200)->sortable();
        $grid->column('nilai_capex_per_port', __('NILAI CAPEX PER PORT'))->width(350)->sortable();
        $grid->column('mitra_id', __('MITRA'))->width(200)->sortable();
        $grid->column('waspang_id', __('WASPANG'))->width(200)->sortable();
        $grid->column('status_project', __('STATUS PROJECT'))->width(250)->sortable();
        $grid->column('start_date', __('START DATE'))->width(200)->sortable();
        $grid->column('end_date', __('END DATE'))->width(200)->sortable();

        

        return $grid;
    }

    
}
