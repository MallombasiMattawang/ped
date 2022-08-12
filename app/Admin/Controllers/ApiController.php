<?php

namespace App\Admin\Controllers;

use App\Models\MstProject;
use App\Models\MstSap;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ApiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'API controller';


    public function witel(Request $request)
    {

        $q = $request->get('q');

        //return MstWitel::where('name', $provinceId)->get(['id', DB::raw('name as text')]);
        $witel = Administrator::where('name', 'like', "%$q%")
            //->where('roles.id', '3')
            ->paginate(null, [DB::raw('id as id'), DB::raw('name as text')]);
        $users = Administrator::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            //->get(['admin_users.*', 'admin_role_users.role_id']);
            ->where('admin_role_users.role_id', '3')
            ->where('admin_users.name', 'like', "%$q%")
            ->paginate(null, [DB::raw('admin_users.id as id'), DB::raw('name as text')]);


        return $users;
    }

    public function wbs(Request $request)
    {

        if ($request->has('q')) {
            $cari =  $request->q;
            //$data = MstSap::select('id', 'wbs_element')->where('wbs_element', 'LIKE', '%$cari%')->get();
            $data = MstSap::select('wbs_element as idwbs', 'wbs_element')
                ->where('wbs_element', 'LIKE', '%' . $cari . '%')
                ->groupBy('wbs_element')
                //->pluck('name', 'name');
                ->get();
            return response()->json($data);
        }
    }

    public function tipe_project(Request $request)
    {

        if ($request->has('q')) {
            $cari =  $request->q;
            //$data = MstSap::select('id', 'wbs_element')->where('wbs_element', 'LIKE', '%$cari%')->get();
            $data = MstProject::select('tipe_project as idtipe_project', 'tipe_project')
                ->where('tipe_project', 'LIKE', '%' . $cari . '%')
                ->groupBy('tipe_project')
                //->pluck('name', 'name');
                ->get();
            return response()->json($data);
        }
    }
}
