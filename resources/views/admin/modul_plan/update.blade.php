<section class="content">

    <div class="row">

        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="info-box bg-maroon">
                <span class="info-box-icon"><i class="fa fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Plan</span>
                    <span class="info-box-number">
                        @php
                            $progress_plan = $countPlan != 0 ? ($countPlan / $countBase) * 100 : 0;
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
    </div>



    <div class="row"></div>
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-plane"></i> Project Summary
                {{ Admin::user()->inRoles(['hd-ped']) }}</h3>
            <div class="pull-right">

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
                    <td width="200">STATUS PROJECT </td>
                    <td>:</td>
                    <td>
                        {{ $project->status_project }}

                    </td>
                </tr>
                <tr>
                    <td width="200">WITEL </td>
                    <td>:</td>
                    <td>{{ $project->witel_id }}</td>
                </tr>
                <tr>
                    <td width="200">MITRA </td>
                    <td>:</td>
                    <td>{{ $project->mitra_id }} </td>
                </tr>
                {{-- <tr>
                    <td width="200">NDE PELIMPAHAN </td>
                    <td>:</td>
                    <td>{{ $project->nde_pelimpahan }} </td>
                </tr> --}}

                <tr>
                    <td width="200">NOMOR KONTRAK</td>
                    <td>:</td>
                    <td>{{ $project->sap->kontrak }} </td>
                </tr>
                <tr>
                    <td width="200">STATUS SAP </td>
                    <td>:</td>
                    <td>{{ $project->sap->status_sap }} </td>
                </tr>
                <tr>
                    <td width="200">START - FINISH PROJECT </td>
                    <td>:</td>
                    <td>{{ date('d F Y', strtotime($project->start_date)) }} s.d
                        {{ date('d F Y', strtotime($project->end_date)) }}</td>
                </tr>
                <tr>
                    <td width="200">WASPANG </td>
                    <td>:</td>
                    <td>{{ $supervisi->supervisi_waspang->name }} / {{ $supervisi->supervisi_waspang->nik }} /
                        {{ $supervisi->supervisi_waspang->phone }}</td>
                </tr>
                <tr>
                    <td width="200">TIM UT </td>
                    <td>:</td>
                    <td>{{ $supervisi->supervisi_tim_ut->name }} / {{ $supervisi->supervisi_tim_ut->nik }} /
                        {{ $supervisi->supervisi_tim_ut->phone }}</td>
                </tr>


            </table>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-tag"></i> Baseline Activity</h3>
        </div>
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-prevent" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <tr>
                            <th width="40%" rowspan="2" class="text-center bg-gray disabled color-palette"> <br>
                                List
                                Activity </th>
                            <th width="20%" colspan="3" class="text-center bg-yellow active color-palette">
                                BASELINE PED
                            </th>
                            <th width="30%" colspan="3" class="text-center bg-maroon active color-palette">PLAN
                                MITRA
                            </th>
                            @if ($project->status_plan == 0)
                                <th width="10%" rowspan="2" class="text-center bg-aqua active color-palette">
                                    ACTION PLAN
                                </th>
                            @endif

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
                            $n = -1;
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
                            @if ($list->activity_id == 1)
                                <tr class="bg-gray color-palette">
                                    <td>
                                        <b>[001] PREPARING
                                        </b>
                                    </td>
                                    <td colspan="7"> <b>20</b> </td>
                                </tr>
                            @endif
                            @if ($list->activity_id == 3)
                                <tr class="bg-gray color-palette">
                                    <td>
                                        <b>[002] MATERIAL DELIVERY
                                        </b>
                                    </td>
                                    <td colspan="7"> <b>30</b> </td>
                                </tr>
                            @endif
                            @if ($list->activity_id == 10)
                                <tr class="bg-gray color-palette">
                                    <td>
                                        <b>[003] INSTALASI & TES COMM
                                        </b>
                                    </td>
                                    <td colspan="7"> <b>40</b> </td>
                                </tr>
                            @endif
                            @if ($list->activity_id == 21)
                                <tr class="bg-gray color-palette">
                                    <td>
                                        <b>[004] CLOSING
                                        </b>
                                    </td>
                                    <td colspan="7"> <b>10</b> </td>
                                </tr>
                            @endif
                            <tr>
                                <td> {{ $list->list_activity }} </td>
                                <td class=""> {{ $list->bobot }}</td>
                                <td class="">{{ $list->volume }} </td>
                                <td class=""> {{ $list->satuan }} </td>

                                <td class="text-center">
                                    {{ $list->plan_start ? date('d F Y', strtotime($list->plan_start)) : '' }} </td>
                                <td class="text-center">
                                    {{ $list->plan_finish ? date('d F Y', strtotime($list->plan_finish)) : '' }}
                                </td>
                                <td class="text-center"> {{ $list->plan_durasi }} </td>
                                {{-- <td class="text-center"> <input type="text" class="form-control plan_start"
                                        id="plan_start_{{ $n }}" name="plan_start_{{ $n }}"
                                        {{ $n > 0 ? 'readonly' : '' }}></td>
                                <td class="text-center"> <input type="text" class="form-control plan_finish"
                                        id="plan_finish_{{ $n }}" name="plan_finish_{{ $n }}"
                                        {{ $n > 0 ? 'readonly' : '' }}></td>
                                <td class="text-center"> <input type="text" id="plan_durasi_{{ $n }}"
                                        class="form-control" name="plan_durasi_{{ $n }}" readonly></td> --}}
                                @if ($project->status_plan == 0)
                                    <td>
                                        @php
                                            $cek_atas = $list->id - 1;
                                            $cek_progress = \App\Models\TranBaseline::select(['id', 'plan_finish'])
                                                ->where('id', $cek_atas)
                                                ->first();
                                            $cek_progress_atas = '';
                                            if (isset($cek_progress)) {
                                                $cek_progress_atas = $cek_progress->plan_finish;
                                            }
                                        @endphp
                                        @if ($list->activity_id >= 1 && $list->activity_id <= 2)
                                            @if ($list->plan_finish)
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $list->plan_start }}" id="cek"
                                                    class="btn btn-default get-id">&nbsp;&nbsp;Edit Plan</a>
                                            @else
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $project->start_date }}" id="cek"
                                                    class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                    Plan</a>
                                            @endif
                                            {{-- @else
                                            <a href="#" class="btn btn-primary disabled">&nbsp;&nbsp;Add Plan</a> --}}
                                        @endif

                                        @if ($list->activity_id >= 3 && $list->activity_id <= 9)
                                            @if ($list->plan_finish)
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $cek_preparing->plan_finish }}" id="cek"
                                                    class="btn btn-default get-id">&nbsp;&nbsp;Edit Plan</a>
                                            @else
                                                @if ($cek_preparing->plan_finish)
                                                    <a data-toggle="modal" data-target="#createDate"
                                                        data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_preparing->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @else
                                                    <a data-target="#createDate" data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_preparing->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @endif
                                            @endif
                                            {{-- @else
                                        <a href="#" class="btn btn-primary disabled">&nbsp;&nbsp;Add Plan</a> --}}
                                        @endif

                                        @if ($list->activity_id >= 10 && $list->activity_id <= 19 && $cek_all_delivery == $cek_all_delivery_finish)
                                            @if ($list->plan_finish)
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $cek_material->plan_finish }}" id="cek"
                                                    class="btn btn-default get-id">&nbsp;&nbsp;Edit Plan</a>
                                            @else
                                                @if ($cek_material->plan_finish)
                                                    <a data-toggle="modal" data-target="#createDate"
                                                        data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_material->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @else
                                                    <a data-target="#createDate" data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_material->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @endif
                                            @endif
                                        @endif

                                        @if ($list->activity_id == 20 && $cek_all_installasi == $cek_all_installasi_finish)
                                            @if ($list->plan_finish)
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $cek_jointing->plan_finish }}" id="cek"
                                                    class="btn btn-default get-id">&nbsp;&nbsp;Edit Plan</a>
                                            @else
                                                @if ($cek_jointing->plan_finish)
                                                    <a data-toggle="modal" data-target="#createDate"
                                                        data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_jointing->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @else
                                                    <a data-target="#createDate" data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_jointing->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @endif
                                            @endif
                                        @endif
                                        @if ($list->activity_id == 21 && $cek_comtes->plan_finish != null)
                                            @if ($list->plan_finish)
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $cek_comtes->plan_finish }}" id="cek"
                                                    class="btn btn-default get-id">&nbsp;&nbsp;Edit Plan</a>
                                            @else
                                                @if ($cek_comtes->plan_finish)
                                                    <a data-toggle="modal" data-target="#createDate"
                                                        data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_comtes->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @else
                                                    <a data-target="#createDate" data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_comtes->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @endif
                                            @endif
                                        @endif
                                        @if ($list->activity_id == 22 && $cek_ut->plan_finish != null)
                                            @if ($list->plan_finish)
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $cek_ut->plan_finish }}" id="cek"
                                                    class="btn btn-default get-id">&nbsp;&nbsp;Edit Plan</a>
                                            @else
                                                @if ($cek_ut->plan_finish)
                                                    <a data-toggle="modal" data-target="#createDate"
                                                        data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_ut->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @else
                                                    <a data-target="#createDate" data-id="{{ $list->id }}"
                                                        data-activityId="{{ $list->activity_id }}"
                                                        data-name="{{ $list->list_activity }}"
                                                        data-start="{{ $cek_ut->plan_finish }}"
                                                        id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                        Plan</a>
                                                @endif
                                            @endif
                                        @endif
                                        @if ($list->activity_id == 23 && $cek_rekon->plan_finish != null)
                                        @if ($list->plan_finish)
                                            <a data-toggle="modal" data-target="#createDate"
                                                data-id="{{ $list->id }}"
                                                data-activityId="{{ $list->activity_id }}"
                                                data-name="{{ $list->list_activity }}"
                                                data-start="{{ $cek_rekon->plan_finish }}" id="cek"
                                                class="btn btn-default get-id">&nbsp;&nbsp;Edit Plan</a>
                                        @else
                                            @if ($cek_ut->plan_finish)
                                                <a data-toggle="modal" data-target="#createDate"
                                                    data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $cek_rekon->plan_finish }}"
                                                    id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                    Plan</a>
                                            @else
                                                <a data-target="#createDate" data-id="{{ $list->id }}"
                                                    data-activityId="{{ $list->activity_id }}"
                                                    data-name="{{ $list->list_activity }}"
                                                    data-start="{{ $cek_rekon->plan_finish }}"
                                                    id="cek" class="btn btn-primary get-id">&nbsp;&nbsp;Add
                                                    Plan</a>
                                            @endif
                                        @endif
                                    @endif


                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @if ($project->status_plan == 0)
                            <tr>
                                <td colspan="7">
                                    Submit Plan
                                </td>
                                <td>
                                    <a class="btn btn-success" data-toggle="modal" data-target="#submit_plan">
                                        <i class="fa fa-play"></i> SUBMIT PLAN
                                    </a>
                                </td>
                            </tr>
                        @endif

                    </table>


                </div>
            </form>


        </div>

    </div>
</section>

<div class="modal fade" id="submit_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ url('ped-panel/plan-submit') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $project->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Plan Project</h5>
                </div>
                <div class="modal-body">

                    @if ((int) $progress_plan == 100)
                        <div class="alert alert-success alert-dismissible">
                            <h4><i class="icon fa fa-info"></i> Info!</h4>
                            Pengisian Plan activity sudah mencapai 100%, anda bisa submit plan ini dan memulai
                            pengerjaan project sembari mengisi Actual Activity
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissible">
                            <h4><i class="icon fa fa-info"></i> Info!</h4>
                            Pengisian Plan activity belum 100%, silahkan isi semua Plan Start dan Plan Finish
                        </div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if ((int) $progress_plan == 100)
                        <button type="submit" class="btn btn-primary submit-modal">Submit Plan</button>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="createDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{-- <form method="post" action="{{ url('ped-panel/save-date-plan') }}" enctype="multipart/form-data"> --}}
        <form id="foo" autocomplete="off">
            @csrf
            <input type="hidden" name="id" value="{{ $project->id }}">
            <input type="hidden" class="form-control" name="baseline_id" id="baseline_id" value="">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Plan Project</h5>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td colspan="3"> <input type="text" class="form-control" name="name"
                                    id="name" value="" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Plan Start
                                <input type="text" class="form-control plan_start" id="plan_start"
                                    name="plan_start">
                            </td>
                            <td class="text-center">
                                Plan Finish
                                <input type="text" class="form-control plan_finish" id="plan_finish"
                                    name="plan_finish">
                            </td>
                            <td class="text-center">
                                Durasi Plan
                                <input type="text" id="plan_durasi" class="form-control" name="plan_durasi"
                                    readonly>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-modal">Save </button>

                </div>
            </div>
        </form>
    </div>
</div>
@php

@endphp

<script>
    $(document).ready(function() {

        $(".get-id").click(function() {
            var ids = $(this).attr('data-id');
            var activity_id = $(this).attr('data-activityId');
            var names = $(this).attr('data-name');
            var start = $(this).attr('data-start');
            $("#baseline_id").val(ids);
            $("#name").val(names);
            $("#plan_start").val(start);
            //$("#plan_finish").prop("readonly", true);

            if (start.length == 0) {
                alert('kategori PREPARING belum diisi')
                $('#createDate').modal('hide');
            } else {
                $('#plan_start').data("DateTimePicker").minDate(
                    start);
                $('#plan_finish').data("DateTimePicker").minDate(start);
            }


            if (activity_id == 3 || activity_id == 10 || activity_id == 20 || activity_id == 21 || activity_id == 22 || activity_id == 23) {
                $("#plan_finish").prop("readonly", false);
                //$("#plan_start").prop("readonly", true);

            } else {
                $("#plan_finish").prop("readonly", true);
                $("#plan_start").prop("readonly", false);

            }

            // //$('#myModal').modal('show');
            // const cek = $("#plan_start").val();
            // console.log(cek);
            // if (cek.length == 0) {
            //     $('#plan_start').data("DateTimePicker").minDate(
            //         '{{ $project->start_date }}');
            // } else {
            //     $('#plan_start').data("DateTimePicker").minDate(
            //         start);
            // }


        });

        $(".submit-modal").click(function() {
            //$("#plan_start").val("");
            //$("#plan_finish").val("");
            $('#createDate').modal('hide');
        });

        $(function() {
            $('#plan_start').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                widgetPositioning: {
                    horizontal: 'auto',
                    vertical: 'bottom'
                }
            });
            $('#plan_finish').datetimepicker({
                useCurrent: false,
                locale: 'id',
                format: 'YYYY-MM-DD',
                widgetPositioning: {
                    horizontal: 'auto',
                    vertical: 'bottom'
                }
            });

            $('#plan_start').on("dp.change", function(e) {
                // const start = $("#plan_start").val();
                // console.log(start);
                // $('#plan_finish').data("DateTimePicker").minDate(e.date);
                // if (start.length == 0) {
                //     $('#plan_start').data("DateTimePicker").minDate(
                //         '{{ $project->start_date }}');
                // } else {
                //     $('#plan_start').data("DateTimePicker").minDate(
                //         start);
                // }
                $('#plan_finish').data("DateTimePicker").minDate(e.date);
                $("#plan_finish").prop("readonly", false);

            });

            $('#plan_finish').on("dp.change", function(e) {

                //$('#plan_start').data("DateTimePicker").maxDate(e.date);


                CalcDiff()
            });


        });

        function CalcDiff() {

            var a = $('#plan_start').data("DateTimePicker").date();
            if (a == null) {
                var date = new Date($('#plan_start').val());
                var a = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            }
            var b = $('#plan_finish').data("DateTimePicker").date();
            var timeDiff = 0
            if (b) {
                timeDiff = (b - a) / 1000;
            }
            //alert(today);
            $('#plan_durasi').val(1 + (Math.floor(timeDiff / (86400))))

        }
    });
</script>

<script>
    var request;

    // Bind to the submit event of our form
    $("#foo").submit(function(event) {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var serializedData = $form.serialize();

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        request = $.ajax({
            url: "{{ url('ped-panel/save-date-plan') }}",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
            //$.admin.reload();
            if (response.error) {
                $.admin.toastr.error(response.error, '', {
                    positionClass: "toast-top-center"
                });
            } else {
                $.admin.toastr.success(response.success, '', {
                    positionClass: "toast-top-center"
                });
            }
            //$('#createDate').modal('hide');

            $.admin.reload();
            //alert('success');
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
            $('#createDate').modal('hide');
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function() {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    });
</script>
