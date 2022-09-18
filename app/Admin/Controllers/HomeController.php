<?php

namespace App\Admin\Controllers;

use App\Models\MstSap;
use App\Models\LogPlan;
use App\Models\MstWitel;
use App\Models\LogActual;
use App\Models\MstProject;

use App\Models\MstWaspangUt;
use App\Models\TranBaseline;
use Encore\Admin\Layout\Row;
use App\Models\TranSupervisi;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field\Id;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Alert;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Callout;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Collapse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{

    public function index1(Content $content)
    {
        $countProject = 0;
        if (Admin::user()->inRoles(['mitra'])) {
            $countProject = MstProject::where('mitra_id', '=', Admin::user()->id)->count();
        }
        if (Admin::user()->inRoles(['witel'])) {
            $countProject = MstProject::where('witel_id', '=', Admin::user()->name)->count();
        }
        if (Admin::user()->inRoles(['waspang'])) {
            $countProject = TranSupervisi::where('waspang_id', '=', Admin::user()->id)->count();
        }
        if (Admin::user()->inRoles(['tim_ut'])) {
            $countProject = TranSupervisi::where('tim_ut_id', '=', Admin::user()->id)->count();
        }
        if (Admin::user()->inRoles(['hd-ped', 'administrator'])) {
            $countProject = MstProject::count();
        }

        return $content
            ->title('Dashboard Monica')
            ->view('admin.dashboard.index', [
                'countProject' => $countProject,
            ]);
    }

    protected function info($url, $title)
    {
        $content = " <img src=\"/assets/img/telkom_indonesia_logo.png\" class-\"pull-right\" width='100'>";

        return new Callout($content, $title, 'info');
    }

    public function index(Content $content)
    {
        if (Admin::user()->inRoles(['hd-ped', 'administrator', 'witel'])) {
            // $content->title('Dashboard Monica');
            // $content->description('Description...');
            // $tab = new Tab();
            // $menu = view('admin.dashboard.report_progress_usulan');
            // $tab->add('Report Progress Usulan', $menu);

            // $sap = view('admin.dashboard.report_progress_sap');
            // $tab->add('Progress SAP', $sap);

            // $develop = view('admin.dashboard.report_progress_development');
            // $tab->add('Progress Development', $develop);

            // $content->row($tab);
            $content
                ->title('Dashboard Monica')
                ->view('admin.dashboard.welcome', []);
        } elseif (Admin::user()->inRoles(['mitra'])) {
            $lop_total = MstProject::where("mitra_id", Admin::user()->name)->count();
            $lop_konstruksi = TranSupervisi::where("mitra_id", Admin::user()->id)->where('status_doc', 'KONSTRUKSI')->count();
            $lop_administrasi = TranSupervisi::where("mitra_id", Admin::user()->id)->where('status_doc', 'ADMINISTRASI')->count();
            $lop_finish = TranSupervisi::where("mitra_id", Admin::user()->id)->where('status_doc', 'FINISH')->count();
            $content
                ->title('Dashboard Monica')
                ->view('admin.dashboard.report_user', [
                    'countProject' => 10,
                    'lop_total' => $lop_total,
                    'lop_konstruksi' => $lop_konstruksi,
                    'lop_administrasi' => $lop_administrasi,
                    'lop_finish' => $lop_finish
                ]);
        } elseif (Admin::user()->inRoles(['waspang', 'tim-ut'])) {
            $content
                ->title('Dashboard Monica')
                ->view('admin.dashboard.report_approval', []);
        } elseif (Admin::user()->inRoles(['sdi'])) {
            $content
                ->title('Dashboard Monica')
                ->view('admin.dashboard.report_sdi', []);
        }


        return $content;
    }

    public function page_usulan(Content $content)
    {
        $content
            ->title('Dashboard Monica')
            ->view('admin.dashboard.report_progress_usulan', []);

        return $content;
    }

    public function tb_usulan(Request $request)
    {
        if ($_GET) {
            $tipe_project = $_GET['tipe_project'];
            $witel = $_GET['witel'];
            $html = view('admin.dashboard.tb_usulan_filter', [
                'tipe_project' => $tipe_project,
                'witel' => $witel,
            ]);
        } else {
            $html = view('admin.dashboard.tb_usulan');
        }


        return $html;
    }

    public function page_sap(Content $content)
    {
        $content
            ->title('Dashboard Monica')
            ->view('admin.dashboard.report_progress_sap', []);

        return $content;
    }

    public function tb_sap()
    {

        $ta = MstSap::where("ta_non_ta", 'TA')->count();
        $nonta = MstSap::where("ta_non_ta", 'NON TA')->count();
        $html = view('admin.dashboard.tb_sap', [
            'ta' => $ta,
            'nonta' => $nonta,
        ]);

        return $html;
    }

    public function tb_sap_filter(Content $content)
    {
        // print_r($_POST);
        // die();
        $cfu = $_POST['cfu'];
        $wbs = $_POST['wbs'];
        $mitra = $_POST['mitra'];
        $ta = MstSap::where("ta_non_ta", 'TA')->count();
        $nonta = MstSap::where("ta_non_ta", 'NON TA')->count();
        $content->view('admin.dashboard.tb_sap_filter', [
            'ta' => $ta,
            'nonta' => $nonta,
            'cfu' => $cfu,
            'wbs' => $wbs,
            'mitra' => $mitra,
        ]);

        return $content;
    }

    public function tb_dev_filter(Content $content)
    {
        //print_r($_POST);
        //die();
        $tematik = $_POST['tematik'];
        $witel = $_POST['witel'];
        $mitra = $_POST['mitra'];
        $query = TranSupervisi::where('witel_id', 'like', '%' . $witel . '%')->where('mitra_id', 'like', '%' . $mitra . '%')->get();
        $content->view('admin.dashboard.tb_dev_filter', [
            'query' => $query,
            'tematik' => $tematik,
            'witel' => $witel,
            'mitra' => $mitra,
        ]);

        return $content;
    }

    public function tb_dev()
    {
        $tematik = '';
        $witel = '';
        $mitra = '';
        if (isset($_GET['tematik'])) {
            $tematik = $_GET['tematik'];
            $witel = $_GET['witel'];
            $mitra = $_GET['mitra'];
        }
        $html = view('admin.dashboard.tb_dev', [
            'tematik' => $tematik,
            'witel' => $witel,
            'mitra' => $mitra,
        ]);
        return $html;
    }

    public function page_dev(Content $content)
    {
        $tematik = '';
        $witel_2 = '';
        $mitra = '';
        if (isset($_GET['tematik'])) {
            $tematik = $_GET['tematik'];
            $witel_2 = $_GET['witel'];
            $mitra = $_GET['mitra'];
        }
        $content
            ->title('Dashboard Monica')
            ->view('admin.dashboard.report_progress_development', [
                'tematik' => $tematik,
                'witel_2' => $witel_2,
                'mitra' => $mitra,
            ]);

        return $content;
    }

    public function get_plan(Request $request)
    {
        $mitra_id = $_GET['id'];
        $project = TranSupervisi::where("mitra_id", $mitra_id)
            ->get();
        $cart[] = '';
        foreach ($project as $transaction_main) {
            // $json_decoded = json_decode($transaction_main);
            $cart[] = $transaction_main->project_id;
        }
        $posts = TranBaseline::whereIn('project_id', $cart)

            //where('project_id', '=',  9)
            ->orderBy('id', 'ASC')
            ->selectRaw("id")
            ->selectRaw("project_id")
            ->selectRaw("activity_id")
            ->selectRaw("list_activity")
            ->selectRaw("plan_start as start")
            ->selectRaw("plan_finish as end")
            ->get();
        foreach ($posts as $d) {
            if ($d->activity_id >= 1 && $d->activity_id <= 2) {
                $backgroundColor = '#f56954';
                $borderColor = '#f56954';
            } else if ($d->activity_id >= 2 && $d->activity_id <= 9) {
                $backgroundColor = '#f39c12';
                $borderColor = '#f39c12';
            } else if ($d->activity_id >= 10 && $d->activity_id <= 20) {
                $backgroundColor = '#0073b7';
                $borderColor = '#0073b7';
            } else if ($d->activity_id >= 21 && $d->activity_id <= 23) {
                $backgroundColor = '#00a65a';
                $borderColor = '#00a65a';
            }

            $project_name = MstProject::where('id', $d->project_id)->first();
            $d->groupId = $project_name->id;
            $d->title = substr($d->list_activity, 12) . ' / ' . $project_name->lop_site_id;
            $d->backgroundColor =  $backgroundColor;
            $d->borderColor = $borderColor;
            $d->url = url('ped-panel/actual-generate?id=' . $d->project_id);
        }
        //make response JSON
        return response()->json(
            $posts,
            200
        );
    }

    public function get_approval(Request $request)
    {
        $user_id = $_GET['id'];
        if (Admin::user()->inRoles(['waspang'])) {
            $project = TranSupervisi::where("waspang_id", $user_id)
                ->get();
        } elseif (Admin::user()->inRoles(['tim-ut'])) {
            $project = TranSupervisi::where("tim_ut_id", $user_id)
                ->get();
        }

        $cart[] = '';
        foreach ($project as $transaction_main) {
            // $json_decoded = json_decode($transaction_main);
            $cart[] = $transaction_main->project_id;
        }
        $posts = LogActual::whereIn('project_id', $cart)
            // ->whereNotNull('actual_task')
            ->orderBy('id', 'ASC')
            ->selectRaw("id")
            ->selectRaw("project_id")
            ->selectRaw("tran_baseline_id")
            ->selectRaw("approval_waspang")
            ->selectRaw("approval_tim_ut")
            ->selectRaw("created_at as start")
            //->selectRaw("plan_finish as end")

            ->get();
        foreach ($posts as $d) {
            $project_name = MstProject::where('id', $d->project_id)->first();
            $baseline = TranBaseline::where('id', $d->tran_baseline_id)->first();


            if ($baseline->activity_id >= 1 && $baseline->activity_id <= 20) {
                if ($d->approval_waspang == null) {
                    $title = 'WASPANG NEED APPROVED';
                    $backgroundColor = '#f39c12';
                    $borderColor = '#f39c12';
                } elseif ($d->approval_waspang == 'approve') {
                    $title = 'WASPANG APPROVED';
                    $backgroundColor = '#00a65a';
                    $borderColor = '#00a65a';
                } elseif ($d->approval_waspang == 'reject') {
                    $title = 'WASPANG REJECTED';
                    $backgroundColor = '#f56954';
                    $borderColor = '#f56954';
                }
            } else if ($baseline->activity_id == 21) {
                if ($d->approval_tim_ut == null) {
                    $title = 'TIM UT NEED APPROVED';
                    $backgroundColor = '#f39c12';
                    $borderColor = '#f39c12';
                } elseif ($d->approval_tim_ut == 'approve') {
                    $title = 'TIM UT APPROVED';
                    $backgroundColor = '#00a65a';
                    $borderColor = '#00a65a';
                } elseif ($d->approval_tim_ut == 'reject') {
                    $title = 'TIM UT REJECTED';
                    $backgroundColor = '#f56954';
                    $borderColor = '#f56954';
                }
            }
            $d->groupId = $project_name->id;
            // $d->title = $d->list_activity. ' ['. $title. ']';
            $d->title = $title;
            $d->backgroundColor =  $backgroundColor;
            $d->borderColor = $borderColor;
            $d->url = url('ped-panel/add-approve?id=' . $d->tran_baseline_id);
        }
        //make response JSON
        return response()->json(
            $posts,
            200
        );
    }

    public function get_inventory(Request $request)
    {
        $project = TranSupervisi::whereBetween('progress_actual', [88, 100])
            ->selectRaw("id")
            ->selectRaw("project_id")
            ->selectRaw("project_name")
            ->selectRaw("status_gl_sdi")
            ->get();
        foreach ($project as $d) {
            $tgl_ct = TranBaseline::where('project_id', $d->project_id)->where('activity_id', 20)->first();
            if ($d->status_gl_sdi == null) {
                $title = 'NO DATA';
            } else {
                $title = $d->status_gl_sdi;
            }
            $d->title = $d->project_name . ' [STATUS GL SDI : ' . $title . ']';
            $d->start = $tgl_ct->actual_finish;
            $d->url = url('ped-panel/tran-inventory/' . $d->id . '/edit');
        }
        return response()->json(
            $project,
            200
        );
    }

    public function stat(Content $content)
    {
        return $content
            ->title('Dashboard Monica')
            ->row(function (Row $row) {
                $menu = view('admin.dashboard.menu_user');
                $row->column(12, new Box('My Menu', $menu));
            })->row(function (Row $row) {
                $donat_status_sap = view('admin.modul_chart.donat_status_sap');
                $row->column(1 / 3, new Box('CAPEX', $donat_status_sap));

                $line_target_real = view('admin.modul_chart.line_target_real');
                $row->column(1 / 3, new Box('CAPEX', $line_target_real));

                $bar = view('admin.modul_rekap.rekap_sap_today');
                $row->column(1 / 3, new Box('PROGRESS SAP TODAY', $bar));
            })->row(function (Row $row) {

                $bar = view('admin.modul_chart.donat_status_project');
                $row->column(1 / 3, new Box('KONSTRUKSI', $bar));

                $scatter = view('admin.modul_chart.line_progress');
                $row->column(1 / 3, new Box('KONSTRUKSI', $scatter));

                $bar = view('admin..modul_rekap.rekap_project_today');
                $row->column(1 / 3, new Box('PROGRESS PROJECT TODAY', $bar));
            });
    }





    public function progressUsulan(Request $request)
    {
        //$filter = $_GET['witel_id'];
        //echo $filter;
        $posts = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            ->where('role_id', '=',  3)
            //->whereIn('id', [2])
            ->selectRaw("id")
            ->selectRaw("name as witel")
            ->orderBy('name', 'ASC')
            ->get();

        foreach ($posts as $d) {
            $nilai_usulan = MstProject::where("witel_id", $d->witel)->where('status_project', 'USULAN')->sum('rab_total');
            $port_usulan = MstProject::where("witel_id", $d->witel)->where('status_project', 'USULAN')->sum('odp_port');
            $nilai_drm = MstProject::where("witel_id", $d->witel)->where('status_project', 'DONE DRM')->sum('rab_total');
            $port_drm = MstProject::where("witel_id", $d->witel)->where('status_project', 'DONE DRM')->sum('odp_port');
            $nilai_pelimpahan = MstProject::where("witel_id", $d->witel)->where('status_project', 'PELIMPAHAN')->sum('rab_total');
            $port_pelimpahan = MstProject::where("witel_id", $d->witel)->where('status_project', 'PELIMPAHAN')->sum('odp_port');
            $nilai_po = MstProject::where("witel_id", $d->witel)->where('status_project', 'PO')->sum('rab_total');
            $port_po = MstProject::where("witel_id", $d->witel)->where('status_project', 'PO')->sum('odp_port');
            $lop_total = MstProject::where("witel_id", $d->witel)->where('status_project', '!=', 'DROP')->count();

            $d->nilai_usulan = singkat_angka($nilai_usulan);
            $d->port_usulan = singkat_angka($port_usulan);
            $d->nilai_drm = singkat_angka($nilai_drm);
            $d->port_drm = singkat_angka($port_drm);
            $d->nilai_pelimpahan = singkat_angka($nilai_pelimpahan);
            $d->port_pelimpahan = singkat_angka($port_pelimpahan);
            $d->nilai_po = singkat_angka($nilai_po);
            $d->port_po = singkat_angka($port_po);
            $d->lop_total = singkat_angka($lop_total);
            $d->nilai_total = singkat_angka($nilai_usulan + $nilai_drm + $nilai_pelimpahan + $nilai_po);
            $d->port_total = singkat_angka($port_usulan + $port_drm + $port_pelimpahan + $port_po);
        }
        //make response JSON
        return response()->json([
            'rows'    => $posts,
        ], 200);
    }

    public function progressUsulanFilter(Request $request)
    {
        //$filter = $_GET['witel_id'];
        //echo $filter;
        // print_r($_GET);
        $witel_id = $_GET['witel'];
        $tipe_project = $_GET['tipe_project'];

        if ($tipe_project == 'all') {
            $tipe = '';
        } else {
            $tipe = "->where('tipe_project', $tipe_project)";
        }

        if ($witel_id == 'PAPUABARAT') {
            $witel_id = 'PAPUA BARAT';
        }
        if ($witel_id == 'SULUTMALUT') {
            $witel_id = 'SULUT MALUT';
        }

        //    echo $witel_id;
        //     die();
        $posts = MstProject::where('witel_id', $witel_id)
            //->whereIn('id', [2])
            ->selectRaw("id")
            ->selectRaw("sto_id")
            ->groupBy('sto_id')
            ->orderBy('sto_id', 'ASC')
            ->get();

        foreach ($posts as $d) {
            if ($tipe_project == 'all') {
                $nilai_usulan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'USULAN')->sum('rab_total');
                $port_usulan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'USULAN')->sum('odp_port');
                $nilai_drm = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'DONE DRM')->sum('rab_total');
                $port_drm = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'DONE DRM')->sum('odp_port');
                $nilai_pelimpahan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PELIMPAHAN')->sum('rab_total');
                $port_pelimpahan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PELIMPAHAN')->sum('odp_port');
                $nilai_po = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PO')->sum('rab_total');
                $port_po = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PO')->sum('odp_port');
                $lop_total = MstProject::where("sto_id", $d->sto_id)->where('status_project', '!=', 'DROP')->count();
            } else {
                $nilai_usulan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'USULAN')->where('tipe_project', $tipe_project)->sum('rab_total');
                $port_usulan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'USULAN')->where('tipe_project', $tipe_project)->sum('odp_port');
                $nilai_drm = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'DONE DRM')->where('tipe_project', $tipe_project)->sum('rab_total');
                $port_drm = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'DONE DRM')->where('tipe_project', $tipe_project)->sum('odp_port');
                $nilai_pelimpahan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PELIMPAHAN')->where('tipe_project', $tipe_project)->sum('rab_total');
                $port_pelimpahan = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PELIMPAHAN')->where('tipe_project', $tipe_project)->sum('odp_port');
                $nilai_po = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PO')->where('tipe_project', $tipe_project)->sum('rab_total');
                $port_po = MstProject::where("sto_id", $d->sto_id)->where('status_project', 'PO')->where('tipe_project', $tipe_project)->sum('odp_port');
                $lop_total = MstProject::where("sto_id", $d->sto_id)->where('status_project', '!=', 'DROP')->where('tipe_project', $tipe_project)->count();
            }


            $d->nilai_usulan = singkat_angka($nilai_usulan);
            $d->port_usulan = singkat_angka($port_usulan);
            $d->nilai_drm = singkat_angka($nilai_drm);
            $d->port_drm = singkat_angka($port_drm);
            $d->nilai_pelimpahan = singkat_angka($nilai_pelimpahan);
            $d->port_pelimpahan = singkat_angka($port_pelimpahan);
            $d->nilai_po = singkat_angka($nilai_po);
            $d->port_po = singkat_angka($port_po);
            $d->lop_total = singkat_angka($lop_total);
            $d->nilai_total = singkat_angka($nilai_usulan + $nilai_drm + $nilai_pelimpahan + $nilai_po);
            $d->port_total = singkat_angka($port_usulan + $port_drm + $port_pelimpahan + $port_po);
        }
        //make response JSON
        return response()->json([
            'rows'    => $posts,
        ], 200);
    }

    // public function progressSap1(Request $request)
    // {
    //     //get data from table posts
    //     $posts = MstSap::orderBy('witel', 'ASC')
    //         ->selectRaw("mst_sap.witel")
    //         //->selectRaw("project.odp_port as total_port")
    //         ->selectRaw("SUM(mst_sap.status_pr) as total_pr")
    //         ->selectRaw("SUM(mst_sap.status_po) as total_po")
    //         ->selectRaw("SUM(mst_sap.status_gr) as total_gr")
    //         ->selectRaw("SUM(mst_sap.nilai_pr_po_gr) as total_pr_po_gr")
    //         ->selectRaw("COUNT(mst_sap.name) as total_lop")
    //         ->groupBy('mst_sap.witel')
    //         ->get();

    //     foreach ($posts as $d) {
    //         $nilai_plan = MstProject::where("witel_id", $d->witel)->where('status_project', '!=', 'DROP')->sum('rab_total');
    //         $nilai_port = MstProject::where("witel_id", $d->witel)->where('status_project', '!=', 'DROP')->sum('odp_port');
    //         $d->total_nilai_plan = singkat_angka($nilai_plan);
    //         $d->total_port_plan = singkat_angka($nilai_port);
    //         $d->total_pr = singkat_angka($d->total_pr);
    //         $d->total_po = singkat_angka($d->total_po);
    //         $d->total_gr = singkat_angka($d->total_gr);
    //         $d->total_pr_po_gr = singkat_angka($d->total_pr_po_gr);
    //         $d->total_lop = singkat_angka($d->total_lop);
    //     }
    //     //make response JSON
    //     return response()->json([
    //         'rows'    => $posts,
    //     ], 200);
    // }

    public function progressSap(Request $request)
    {
        //get data from table posts
        $posts = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            ->where('role_id', '=',  3)
            ->selectRaw("id")
            ->selectRaw("name as witel")
            ->orderBy('name', 'ASC')
            ->get();

        foreach ($posts as $d) {
            $nilai_plan = MstProject::where("witel_id", $d->witel)->whereIn('status_project', ['DONE DRM', 'PELIMPAHAN'])->sum('rab_total');
            $port_plan = MstProject::where("witel_id", $d->witel)->whereIn('status_project', ['DONE DRM', 'PELIMPAHAN'])->sum('odp_port');

            $nilai_pr = MstSap::where("witel", $d->witel)->where('status_sap', 'PR')->sum('nilai_pr_po_gr');
            $port_pr = MstProject::where("witel_id", $d->witel)->where('status_project', 'PR')->sum('odp_port');

            $nilai_po = MstSap::where("witel", $d->witel)->where('status_sap', 'PO')->sum('nilai_pr_po_gr');
            $port_po = MstProject::where("witel_id", $d->witel)->where('status_project', 'PO')->sum('odp_port');

            $nilai_gr = MstSap::where("witel", $d->witel)->where('status_sap', 'GR')->sum('nilai_pr_po_gr');
            $port_gr = MstProject::where("witel_id", $d->witel)->where('status_project', 'GR')->sum('odp_port');

            $total_lop_sap = MstSap::where("witel", $d->witel)->count();
            $total_lop_project = MstProject::where("witel_id", $d->witel)->whereIn('status_project', ['DONE DRM', 'PELIMPAHAN'])->count();


            $d->total_nilai_plan = singkat_angka($nilai_plan);
            $d->total_port_plan = singkat_angka($port_plan);

            $d->total_pr = singkat_angka($nilai_pr);
            $d->port_pr = singkat_angka($port_pr);

            $d->total_po = singkat_angka($nilai_po);
            $d->port_po = singkat_angka($port_po);

            $d->total_gr = singkat_angka($nilai_gr);
            $d->port_gr = singkat_angka($port_gr);

            $d->total_lop = $total_lop_sap + $total_lop_project;
            $d->total_nilai = singkat_angka($nilai_plan + $nilai_pr + $nilai_po + $nilai_gr);
            $d->total_port = singkat_angka($port_plan + $port_pr + $port_po + $port_gr);
        }
        //make response JSON
        return response()->json([
            'rows'    => $posts,
        ], 200);
    }

    public function progressDev(Request $request)
    {
        $posts = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            ->where('role_id', '=',  3)
            ->selectRaw("id")
            ->selectRaw("name as witel")
            ->orderBy('name', 'ASC')
            ->get();
        foreach ($posts as $d) {
            // $nilai_plan = MstProject::where("witel_id", $d->witel)->where('status_project', '!=', 'DROP')->sum('rab_total');
            $lop_konstruksi = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [1, 95])->count();
            $nilai_konstruksi_real = TranSupervisi::where("witel_id", $d->id)->whereNotNull('real_nilai')->whereBetween('progress_actual', [1, 95])->sum('real_nilai');
            $nilai_konstruksi_plan = TranSupervisi::where("witel_id", $d->id)->whereNull('real_nilai')->whereBetween('progress_actual', [1, 95])->sum('plan_nilai');
            $port_konstruksi_real = TranSupervisi::where("witel_id", $d->id)->whereNotNull('real_port')->whereBetween('progress_actual', [1, 95])->sum('real_port');
            $port_konstruksi_plan = TranSupervisi::where("witel_id", $d->id)->whereNull('real_port')->whereBetween('progress_actual', [1, 95])->sum('plan_port');

            $nilai_administrasi_real = TranSupervisi::where("witel_id", $d->id)->whereNotNull('real_nilai')->whereBetween('progress_actual', [96, 100])->sum('real_nilai');
            $nilai_administrasi_plan = TranSupervisi::where("witel_id", $d->id)->whereNull('real_nilai')->whereBetween('progress_actual', [96, 100])->sum('plan_nilai');

            $port_administrasi_real = TranSupervisi::where("witel_id", $d->id)->whereNotNull('real_port')->whereBetween('progress_actual', [96, 100])->sum('real_port');
            $port_administrasi_plan = TranSupervisi::where("witel_id", $d->id)->whereNull('real_port')->whereBetween('progress_actual', [96, 100])->sum('plan_port');

            $lop_administrasi = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [96, 100])->count();
            $d->lop_total = $lop_konstruksi + $lop_administrasi;
            $d->lop_konstruksi = $lop_konstruksi;
            $d->nilai_konstruksi_real = singkat_angka($nilai_konstruksi_real + $nilai_konstruksi_plan);
            $d->port_konstruksi_real = $port_konstruksi_real + $port_konstruksi_plan;
            $persen_konstruksi = ($lop_konstruksi != 0) ? round($lop_konstruksi / $d->lop_total, 1) * 100 : 0;
            $d->persen_konstruksi = $persen_konstruksi . ' %';
            //$rata=($totalnilai!=0)?($totalnilai/$jumlah,1) * 100:0;

            $d->lop_administrasi = $lop_administrasi;
            $d->nilai_administrasi_real = singkat_angka($nilai_administrasi_real + $nilai_administrasi_plan);
            $d->port_administrasi_real = $port_administrasi_real + $port_administrasi_plan;
            $persen_administrasi = ($lop_administrasi != 0) ? round($lop_administrasi / $d->lop_total, 1) * 100 : 0;
            $d->persen_administrasi = $persen_administrasi . ' %';

            $d->nilai_total =  singkat_angka(($nilai_konstruksi_real + $nilai_konstruksi_plan) + ($nilai_administrasi_real + $nilai_administrasi_plan));
            $d->port_total =  $d->port_konstruksi_real + $d->port_administrasi_real;
            $d->persen_total =  $persen_konstruksi +  $persen_administrasi . ' %';

            // $d->total_port_plan = $nilai_port;
            //dd($d->toJson());

        }
        //make response JSON
        return response()->json([

            'rows'    => $posts,
        ], 200);
    }

    public function progressKonstruksi(Request $request)
    {
        $posts = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            ->where('role_id', '=',  3)
            ->selectRaw("id")
            ->selectRaw("name as witel")
            ->orderBy('name', 'ASC')
            ->get();
        foreach ($posts as $d) {
            $nilai_preparing = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'PREPARING')->sum('plan_nilai');
            $port_preparing = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'PREPARING')->sum('plan_port');

            $nilai_delivery = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'MATERIAL DELIVERY')->sum('plan_nilai');
            $port_delivery = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'MATERIAL DELIVERY')->sum('plan_port');

            $nilai_delivery_os = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'MATERIAL DELIVERY ON SITE')->sum('plan_nilai');
            $port_delivery_os = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'MATERIAL DELIVERY ON SITE')->sum('plan_port');

            $nilai_instalasi = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'INSTALASI')->sum('plan_nilai');
            $port_instalasi = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'INSTALASI')->sum('plan_port');

            $nilai_instal_done = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'INSTALL DONE')->sum('plan_nilai');
            $port_instal_done = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'INSTALL DONE')->sum('plan_port');

            $nilai_selesai_ct = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'SELESAI CT')->sum('plan_nilai');
            $port_selesai_ct = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'SELESAI CT')->sum('plan_port');

            $nilai_selesai_ut = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'SELESAI UT')->sum('plan_nilai');
            $port_selesai_ut = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'SELESAI UT')->sum('plan_port');

            $nilai_rekon = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'REKON')->sum('plan_nilai');
            $port_rekon = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'REKON')->sum('plan_port');

            $nilai_bast = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'BAST-1')->sum('plan_nilai');
            $port_bast = TranSupervisi::where("witel_id", $d->id)->where('status_const', 'BAST-1')->sum('plan_port');

            $d->nilai_preparing = singkat_angka($nilai_preparing);
            $d->port_preparing = $port_preparing;
            $d->nilai_delivery = singkat_angka($nilai_delivery);
            $d->port_delivery = singkat_angka($port_delivery);

            $d->nilai_delivery_os = singkat_angka($nilai_delivery_os);
            $d->port_delivery_os = $port_delivery_os;

            $d->nilai_instalasi = singkat_angka($nilai_instalasi);
            $d->port_instalasi = $port_instalasi;

            $d->nilai_instal_done = singkat_angka($nilai_instal_done);
            $d->port_instal_done = $port_instal_done;

            $d->nilai_selesai_ct = singkat_angka($nilai_selesai_ct);
            $d->port_selesai_ct = $port_selesai_ct;

            $d->nilai_selesai_ut = singkat_angka($nilai_selesai_ut);
            $d->port_selesai_ut = $port_selesai_ut;

            $d->nilai_rekon = singkat_angka($nilai_rekon);
            $d->port_rekon = $port_rekon;

            $d->nilai_bast = singkat_angka($nilai_bast);
            $d->port_bast = $port_bast;

            $d->total_nilai = singkat_angka($nilai_preparing + $nilai_delivery + $nilai_delivery_os + $nilai_instalasi + $nilai_instal_done + $nilai_selesai_ct + $nilai_selesai_ut + $nilai_rekon + $nilai_bast);
            $d->total_port = $port_preparing + $port_delivery + $port_delivery_os + $port_instalasi + $port_instal_done + $port_selesai_ct + $port_selesai_ut + $port_rekon + $port_bast;
        }
        //make response JSON
        return response()->json([

            'rows'    => $posts,
        ], 200);
    }

    public function progressAdministrasi(Request $request)
    {
        $posts = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            ->where('role_id', '=',  3)
            ->selectRaw("id")
            ->selectRaw("name as witel")
            ->orderBy('name', 'ASC')
            ->get();
        foreach ($posts as $d) {
            $all_project = TranSupervisi::where("witel_id", $d->id)->count();
            $all_nilai_plan = TranSupervisi::where("witel_id", $d->id)->whereNull('real_nilai')->sum('plan_nilai');
            $all_nilai_real = TranSupervisi::where("witel_id", $d->id)->whereNotNull('real_nilai')->sum('real_nilai');

            $all_port_plan = TranSupervisi::where("witel_id", $d->id)->whereNull('real_port')->sum('plan_port');
            $all_port_real = TranSupervisi::where("witel_id", $d->id)->whereNotNull('real_port')->sum('real_port');

            $project_administrasi = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [96, 100])->count();
            $nilai_administrasi_plan = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [96, 100])->whereNull('real_nilai')->sum('plan_nilai');
            $nilai_administrasi_real = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [96, 100])->whereNotNull('real_nilai')->sum('real_nilai');
            $port_administrasi_plan = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [96, 100])->whereNull('real_port')->sum('plan_port');
            $port_administrasi_real = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [96, 100])->whereNotNull('real_port')->sum('real_port');

            $mitra_area = TranSupervisi::where("witel_id", $d->id)->where('posisi_doc', 'MITRA AREA')->count();
            $witel_area = TranSupervisi::where("witel_id", $d->id)->where('posisi_doc', 'WITEL')->count();
            $mitra_regional = TranSupervisi::where("witel_id", $d->id)->where('posisi_doc', 'MITRA REGIONAL')->count();
            $telkom_regional = TranSupervisi::where("witel_id", $d->id)->where('posisi_doc', 'TELKOM REGIONAL')->count();
            $dok_ok = TranSupervisi::where("witel_id", $d->id)->where('progress_doc', 'FINISH')->count();


            $d->all_project = $all_project;
            $d->all_nilai = singkat_angka($all_nilai_plan + $all_nilai_real);
            $d->all_port =  singkat_angka($all_port_plan + $all_port_real);
            $d->project_administrasi = $project_administrasi;
            $d->nilai_administrasi = singkat_angka($nilai_administrasi_plan + $nilai_administrasi_real);
            $d->port_administrasi = singkat_angka($port_administrasi_plan + $port_administrasi_real);

            $d->mitra_area = $mitra_area;
            $d->witel_area = $witel_area;
            $d->mitra_regional = $mitra_regional;
            $d->telkom_regional = $telkom_regional;
            $d->dok_ok = $dok_ok;
            $d->persen_ok = ($dok_ok != 0) ? Round($dok_ok / $d->project_administrasi, 1) * 100 . ' %' : 0;
        }
        //make response JSON
        return response()->json([

            'rows'    => $posts,
        ], 200);
    }

    public function progressGolive(Request $request)
    {

        MstProject::where("witel_id", 'SULUTMALUT')
            ->update([
                'witel_id' => 'SULUT MALUT'
            ]);

        $posts = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            ->where('role_id', '=',  3)
            ->selectRaw("id")
            ->selectRaw("name as witel")
            ->orderBy('name', 'ASC')
            ->get();
        foreach ($posts as $d) {
            $target_project = TranSupervisi::where("witel_id", $d->id)->count();
            $target_port = TranSupervisi::where("witel_id", $d->id)->sum('plan_port');

            $install_done = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [88, 100])->count();
            $install_port = TranSupervisi::where("witel_id", $d->id)->whereBetween('progress_actual', [88, 100])->sum('real_port');
            $persen_done = ($install_port != 0) ? round($install_done / $target_project, 1) * 100 . ' %' : 0;


            $d->target_project = $target_project;
            $d->target_port = $target_port;
            $d->install_done = $install_done;
            $d->install_port = $install_port;
            $d->persen_done = $persen_done;
            $d->no_data =  TranSupervisi::where("witel_id", $d->id)->whereNull('status_gl_sdi')->count();
            $d->val_abd =  TranSupervisi::where("witel_id", $d->id)->where('status_gl_sdi', 'VALIDASI ABD')->count();
            $d->drawing =  TranSupervisi::where("witel_id", $d->id)->where('status_gl_sdi', 'DRAWING')->count();
            $d->inventory =  TranSupervisi::where("witel_id", $d->id)->where('status_gl_sdi', 'INVENTORY')->count();
            $d->terminasi_uim =  TranSupervisi::where("witel_id", $d->id)->where('status_gl_sdi', 'TERMINASI UIM')->count();
            $d->golive =  TranSupervisi::where("witel_id", $d->id)->where('status_gl_sdi', 'GOLIVE')->count();
            $d->persen_golive = ($d->golive != 0) ? round($d->golive / $target_port, 1) * 100 . ' %' : 0;
            $d->delta_golive = $d->golive - $install_done;
        }
        //make response JSON
        return response()->json([

            'rows'    => $posts,
        ], 200);
    }

    public function kurvaS($id)
    {
        $project = MstProject::where("id", $id)->first();
        $supervisi = TranSupervisi::where('project_id', $id)->first();
        // $lists = TranBaseline::where("project_id", $id)
        //     ->select('id', 'activity_id', 'bobot', 'plan_durasi', 'plan_start', 'plan_finish')
        //     ->get();
        $lists_asc_date = TranBaseline::where("project_id", $id)->orderBy('plan_finish', 'ASC')->get();
        $end_date_plan = TranBaseline::where("project_id", $id)->whereNotNull('plan_finish')->orderBy('plan_finish', 'Desc')->first();
        $end_date_actual = TranBaseline::where("project_id", $id)->whereNotNull('actual_finish')->orderBy('id', 'Desc')->first();

        $start = $project->start_date;
        $end_plan = $end_date_plan->plan_finish;
        $end_finish = 0;
        if ($end_date_actual) {
            $end_finish = $end_date_actual->actual_finish;
        }

        $end_today = date('Y-m-d');
        $end = $end_plan;
        if ($end_finish > $end_plan) {
            $end = $end_finish;
        }
        if ($supervisi->progress_actual < 100) {
            $end = $end_today;
        }
        $sum_bobot_plan = LogPlan::where('project_id', $project->id)
            ->whereBetween('log_date', [$project->start_date, $start])
            ->sum('log_bobot');
        $sum_bobot_real = TranBaseline::where('project_id', $project->id)
            ->whereBetween('actual_finish', [$project->start_date, $start])
            ->sum('bobot');

        $items = array();
        $i = 1;
        while (strtotime($start) <= strtotime($end)) {
            $items[] = ([
                'date' => $start,
                'bobot_plan' => number_format($sum_bobot_plan, 1, '.', ''),
                'bobot_real' => $sum_bobot_real
            ]);
            $start = date('Y-m-d', strtotime('+1 day', strtotime($start))); //looping tambah 1 date
            $sum_bobot_plan = LogPlan::where('project_id', $project->id)
                ->whereBetween('log_date', [$project->start_date, $start])
                ->sum('log_bobot');
            $sum_bobot_real = TranBaseline::where('project_id', $project->id)
                ->whereBetween('actual_finish', [$project->start_date, $start])
                ->sum('bobot');
        }

        //make response JSON
        return response()->json([
            'status' => 'success',
            'data'   => $items,
            //'date' => $person,
        ], 200);
    }
}
