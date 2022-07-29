<section class="content">
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-plane"></i> Project Summary
                {{ Admin::user()->inRoles(['hd-ped']) }}</h3>
            <div class="pull-right">
                @if (Admin::user()->inRoles(['hd-ped', 'administrator']) && $project->status_project == 'USULAN')
                    <a href="{{ url('ped-panel/acc-form?id=' . $project->id) }}" class="btn btn-danger btn-sm"><i
                            class="fa fa-edit"></i> ACC Project</a>
                    <a href="{{ url('ped-panel/mst-projects/' . $project->id . '/edit') }}"
                        class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Update Project</a>
                @endif
                @if (Admin::user()->inRoles(['mitra', 'administrator']) && $project->status_plan == 0)
                    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#submit_plan"><i
                            class="fa fa-edit"></i> Submit Plan</a>
                @endif
                @if (Admin::user()->inRoles(['hd-ped']) && $project->status_plan == 1 && $project->assign_by_ped == 0)
                    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#assign_plan"><i
                            class="fa fa-edit"></i> Assign Baseline Plane</a>
                @endif
                @if (Admin::user()->inRoles(['witel']) && $project->status_plan == 1 && $project->assign_by_witel == 0)
                    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#assign_plan"><i
                            class="fa fa-edit"></i> Assign Baseline Plane</a>
                @endif
                @if (Admin::user()->inRoles(['waspang']) && $project->status_plan == 1 && $project->assign_by_waspang == 0)
                    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#assign_plan"><i
                            class="fa fa-edit"></i> Assign Baseline Plane</a>
                @endif
                @if (Admin::user()->inRoles(['tim-ut']) && $project->status_plan == 1 && $project->assign_by_ut == 0)
                    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#assign_plan"><i
                            class="fa fa-edit"></i> Assign Baseline Plane</a>
                @endif

                <a href="" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Detail Project</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <td width="200">LOP / SITE ID </td>
                    <td width="10">:</td>
                    <td>{{ $project->lop_site_id }}</td>
                </tr>
                <tr>
                    <td width="200">STATUS </td>
                    <td>:</td>
                    <td>
                        {{ $project->status_project }}

                    </td>
                </tr>
                <tr>
                    <td width="200">WITEL </td>
                    <td>:</td>
                    <td>SULSELBAR</td>
                </tr>
                <tr>
                    <td width="200">MITRA </td>
                    <td>:</td>
                    <td>{{ $project->mitra_id }} </td>
                </tr>
                <tr>
                    <td width="200">NDE PELIMPAHAN </td>
                    <td>:</td>
                    <td>{{ $project->nde_pelimpahan }} </td>
                </tr>

                <tr>
                    <td width="200">NOMOR KONTRAK</td>
                    <td>:</td>
                    <td>{{ $project->nomor_kontrak }} </td>
                </tr>
                <tr>
                    <td width="200">STATUS SAP </td>
                    <td>:</td>
                    <td>{{ $project->status_sap }} </td>
                </tr>
                <tr>
                    <td width="200">START - FINISH PROJECT </td>
                    <td>:</td>
                    <td>{{ $project->start_date }} s.d {{ $project->end_date }}</td>
                </tr>
                <tr>
                    <td width="200">WASPANG </td>
                    <td>:</td>
                    <td>{{ $project->waspang_id }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-gray">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengisian Baseline</span>
                    <span class="info-box-number">
                        @php
                            $progress_baseline = $sumBase;
                        @endphp
                        {{ (int) $progress_baseline }} %
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ (int) $progress_baseline }}%"></div>
                    </div>
                    <span class="progress-description">
                        total {{ $countBase }} List Activity
                    </span>

                </div>

            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-maroon">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Plan</span>
                    <span class="info-box-number">
                        @php
                            $progress_plan = ($countPlan / $countBase) * 100;
                        @endphp
                        {{ (int) $progress_plan }} %
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ (int) $progress_plan }}%"></div>
                    </div>
                    <span class="progress-description">
                        Total Durasi {{ $sumDurasi }} Hari
                    </span>
                </div>

            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Actual</span>
                    <span class="info-box-number">0%</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 20%"></div>
                    </div>
                    <span class="progress-description">
                        Total Durasi 0 Hari
                    </span>
                </div>

            </div>
        </div>
    </div>



    <div class="row"></div>
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-tag"></i> Baseline Activity</h3>
        </div>
        <div class="box-body">
            @if (Admin::user()->inRoles(['hd-ped']))
                <form class="form-prevent" action="{{ url('ped-panel/update-baseline') }}" method="post"
                    enctype="multipart/form-data" autocomplete="off">
            @endif
            @if (Admin::user()->inRoles(['mitra']))
                <form class="form-prevent" action="{{ url('ped-panel/plan-baseline') }}" method="post"
                    enctype="multipart/form-data" autocomplete="off">
            @endif

            @csrf
            <div class="table-responsive">

                <table class="table table-bordered">
                    <tr>
                        <th width="40%" rowspan="2" class="text-center bg-gray disabled color-palette"> <br> List
                            Activity </th>
                        <th width="20%" colspan="3" class="text-center bg-yellow active color-palette">BASELINE PED
                        </th>
                        <th width="30%" colspan="3" class="text-center bg-maroon active color-palette">PLAN MITRA
                        </th>
                        <th width="10%" rowspan="2" class="text-center bg-aqua active color-palette">ACTION PLAN
                        </th>
                    </tr>
                    <tr>

                        <th class="bg-yellow active color-palette text-center">Bobot</th>
                        <th class="bg-yellow active color-palette text-center">Volume</th>
                        <th class="bg-yellow active color-palette text-center">Satuan</th>
                        <th class="bg-maroon active color-palette text-center"> Start</th>
                        <th class="bg-maroon active color-palette text-center"> Finish</th>
                        <th class="bg-maroon active color-palette text-center"> Durasi</th>


                    </tr>
                    @php
                        $n = 0;
                    @endphp
                    @foreach ($lists as $list)
                        @php
                            $n++;
                            if ($list->category_id == 001) {
                                $category = '<span class="label label-default">Preparing</span>';
                            } elseif ($list->category_id == 002) {
                                $category = '<span class="label label-warning">Material Delivery</span>';
                            } elseif ($list->category_id == 003) {
                                $category = '<span class="label label-primary">Installasi & Test Comm</span>';
                            } else {
                                $category = '<span class="label label-success">Clossing</span>';
                            }
                        @endphp
                        <tr>
                            <td>
                                {{ $list->list_activity }} {!! $category !!}
                                <input type="hidden" class="form-control" name="project_id"
                                    value=" {{ $id }} ">
                                <input type="hidden" class="form-control" name="activity_id[]"
                                    value=" {{ $list->id }} ">
                                <input type="hidden" class="form-control" name="category_id[]"
                                    value=" {{ $list->category_id }} ">
                                <input type="hidden" class="form-control" name="list_activity[]"
                                    value=" {{ $list->list_activity }} ">
                            </td>
                            @if (Admin::user()->inRoles(['hd-ped']) && $project->status_project == 'USULAN')
                                <td> <input type="text" class="form-control" name="bobot[]"
                                        value="{{ $list->bobot }}"> </td>
                                <td> <input type="text" class="form-control" name="volume[]"
                                        value="{{ $list->volume }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]"
                                        value="{{ $list->satuan }}"> </td>
                            @else
                                <td class=""> {{ $list->bobot }}</td>
                                <td class="">{{ $list->volume }} </td>
                                <td class=""> {{ $list->satuan }} </td>
                            @endif

                            @if (Admin::user()->inRoles(['mitra']))
                                @if ($project->status_plan == '0')
                                    <td class="text-center"> {{ $list->plan_start }}</td>
                                    <td class="text-center">{{ $list->plan_finish }} </td>
                                    <td class="text-center"> {{ $list->plan_durasi }} </td>
                                    <td>
                                        @php
                                            $cek_atas = $list->id - 1;
                                            $cek_progress = \App\Models\TranBaseline::select(['id', 'plan_finish'])
                                                ->where('id', $cek_atas)
                                                ->first();
                                        @endphp
                                        @if ($n == 1 || $cek_progress->plan_finish)
                                            @if ($list->plan_finish)
                                            <a href="{{ url('ped-panel/add-plan?id=' . $project->id . '&activity=' . $list->id) }}"
                                                class="btn btn-primary"><i class="fa fa-plane"></i>&nbsp;&nbsp;
                                                Add
                                                Plan</a>
                                            @else
                                                <a href="{{ url('ped-panel/add-plan?id=' . $project->id . '&activity=' . $list->id) }}"
                                                    class="btn btn-primary"><i class="fa fa-plane"></i>&nbsp;&nbsp;
                                                    Add
                                                    Plan</a>
                                            @endif
                                        @else
                                        @endif

                                    </td>
                                @else
                                    <td class=""> {{ $list->plan_start }}</td>
                                    <td class="">{{ $list->plan_finish }} </td>
                                    <td class=""> {{ $list->plan_durasi }} </td>
                                @endif
                            @else
                                <td class=""> {{ $list->plan_start }}</td>
                                <td class="">{{ $list->plan_finish }} </td>
                                <td class=""> {{ $list->plan_durasi }} </td>
                            @endif



                        </tr>
                    @endforeach

                </table>
                <hr>
                <button type="submit" class="btn btn-success btn-lg pull-right"><i class="fa fa-save"></i>
                    Submit</button>
            </div>

            </form>

        </div>

    </div>
</section>
<div class="modal fade" id="acc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACC Project</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Info!</h4>
                    Sebelum ACC Project, pastikan kembali kamu sudah mengisi baseline bobot, volume dan satuan tiap
                    list activity.
                    melanjutkan proses ini akan mengubah status project menjadi DRM dan diteruskan ke MITRA untuk
                    pengisian PLAN activity.
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{ url('ped-panel/acc-form?id=' . $project->id) }}" class="btn btn-primary">Lanjut</a>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="submit_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ url('ped-panel/plan-project') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $project->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Plan Project</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible">

                        <h4><i class="icon fa fa-info"></i> Info!</h4>
                        Sebelum Submit Project, pastikan kembali kamu sudah mengisi semua Plan Start dan Finish tiap
                        list activity.
                        melanjutkan proses ini akan mengubah status project menjadi Assignment dan diteruskan ke WITEL,
                        WASPANG, TIM UT
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Plan</button>
                </div>
            </div>
        </form>
    </div>
</div>
