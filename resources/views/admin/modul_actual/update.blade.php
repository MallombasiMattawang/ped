<section class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">

                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td width="200">LOP / SITE ID </td>
                            <td width="10">:</td>
                            <td>{{ $project->lop_site_id }}</td>
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
                            <td>{{ $supervisi->supervisi_waspang->name }} / {{ $supervisi->supervisi_waspang->nik }}
                                /
                                {{ $supervisi->supervisi_waspang->phone }}</td>
                        </tr>
                        <tr>
                            <td width="200">TIM UT </td>
                            <td>:</td>
                            <td>{{ $supervisi->supervisi_tim_ut->name }} / {{ $supervisi->supervisi_tim_ut->nik }}
                                /
                                {{ $supervisi->supervisi_tim_ut->phone }}</td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-maroon">
                <span class="info-box-icon"><i class="fa fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Progress Plan</span>
                    <span class="info-box-number">

                        {{ (int) $progress_plan }} %

                    </span>

                    <div class="progress">
                        <div class="progress-bar" style="width: {{ (int) $progress_plan }}%"></div>
                    </div>
                    <span class="progress-description">
                        {{-- Total Durasi {{ $progress_plan }} Hari --}}
                    </span>
                </div>

            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Progress Actual</span>
                    <span class="info-box-number">

                        {{ $sum_selesai + $sum_belum }} %
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $supervisi->progress_actual }}%"></div>
                    </div>
                    <span class="progress-description">
                        {{-- Selesai : {{ $sum_selesai }} | Belum : {{ $sum_belum }} --}}
                    </span>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-blue">
                <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Progress Administrasi</span>
                    <span class="info-box-number">
                        @if ($supervisi->posisi_doc == 'MITRA REGIONAL')
                            50 %
                        @elseif ($supervisi->status_doc == 'FINISH')
                            100 %
                        @else
                            0 %
                        @endif

                    </span>
                    <div class="progress">
                        @if ($supervisi->posisi_doc == 'MITRA REGIONAL')
                            <div class="progress-bar" style="width: 50%"></div>
                        @elseif ($supervisi->status_doc == 'FINISH')
                            <div class="progress-bar" style="width: 100%"></div>
                        @else
                            <div class="progress-bar" style="width: 0%"></div>
                        @endif

                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>


    </div>



    <div class="row"></div>
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Baseline Activity</a></li>
            <li><a href="#tab_2" data-toggle="tab">Kurva S</a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
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

                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <tr>
                                    <th width="16%" rowspan="2"
                                        class="text-center bg-gray disabled color-palette"> <br> List
                                        Activity </th>
                                    <th width="16%" colspan="3"
                                        class="text-center bg-yellow active color-palette">BASELINE
                                    </th>
                                    <th width="16%" colspan="3"
                                        class="text-center bg-maroon active color-palette">PLAN
                                    </th>
                                    <th width="16%" colspan="3" class="text-center bg-aqua active color-palette">
                                        PROGRESS
                                        ACTUAL
                                    </th>
                                    <th width="16%" colspan="3" class="text-center bg-green active color-palette">
                                        ACTUAL
                                    </th>
                                    <th width="16%" rowspan="2" class="text-center bg-aqua active color-palette">
                                        ACTION ACTUAL
                                    </th>


                                </tr>
                                <tr>

                                    <th class="bg-yellow active color-palette text-center">Bobot</th>
                                    <th class="bg-yellow active color-palette text-center">Volume Kontrak</th>
                                    <th class="bg-yellow active color-palette text-center">Satuan</th>

                                    <th class="bg-maroon active color-palette text-center"> Start</th>
                                    <th class="bg-maroon active color-palette text-center"> Finish</th>
                                    <th class="bg-maroon active color-palette text-center"> Durasi</th>

                                    <th class="bg-aqua active color-palette text-center"> Volume</th>
                                    <th class="bg-aqua active color-palette text-center"> Progress</th>
                                    <th class="bg-aqua active color-palette text-center"> Durasi</th>

                                    <th class="bg-green active color-palette text-center"> Start</th>
                                    <th class="bg-green active color-palette text-center"> Finish</th>
                                    <th class="bg-green active color-palette text-center"> Status Update</th>


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
                                    @if ($list->activity_id == 1)
                                        <tr class="bg-gray color-palette">
                                            <td>
                                                <b>[001] PREPARING
                                                </b>
                                            </td>
                                            <td colspan="15"> <b>20</b> </td>
                                        </tr>
                                    @endif
                                    @if ($list->activity_id == 3)
                                        <tr class="bg-gray color-palette">
                                            <td>
                                                <b>[002] MATERIAL DELIVERY
                                                </b>
                                            </td>
                                            <td colspan="15"> <b>30</b> </td>
                                        </tr>
                                    @endif
                                    @if ($list->activity_id == 10)
                                        <tr class="bg-gray color-palette">
                                            <td>
                                                <b>[003] INSTALASI & TES COMM
                                                </b>
                                            </td>
                                            <td colspan="15"> <b>40</b> </td>
                                        </tr>
                                    @endif
                                    @if ($list->activity_id == 21)
                                        <tr class="bg-gray color-palette">
                                            <td>
                                                <b>[004] CLOSING
                                                </b>
                                            </td>
                                            <td colspan="15"> <b>10</b> </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class=""> {{ $list->list_activity }} <br> </td>
                                        <td class="text-center"> {{ $list->bobot }}</td>
                                        <td class=" text-center">{{ $list->volume }} </td>
                                        <td class=" text-center"> {{ $list->satuan }} </td>

                                        <td class="text-center">
                                            {{ $list->plan_start ? date('d F Y', strtotime($list->plan_start)) : '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $list->plan_finish ? date('d F Y', strtotime($list->plan_finish)) : '' }}
                                        </td>
                                        <td class="text-center"> {{ $list->plan_durasi }} </td>

                                        <td class="text-center"> {{ $list->actual_start ? $list->actual_volume : '' }}
                                        </td>
                                        <td class=" text-center">
                                            {{ $list->actual_start ? Round($list->actual_progress, 1) . '%' : '' }}
                                        </td>
                                        <td class="text-center"> {{ $list->actual_durasi }} </td>

                                        <td class="text-center">
                                            {{ $list->actual_start ? date('d F Y', strtotime($list->actual_start)) : '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $list->actual_finish ? date('d F Y', strtotime($list->actual_finish)) : '' }}
                                        </td>
                                        <td class="text-center">
                                            @if ($list->actual_task == 'APPROVED')
                                                <span class="label label-success">{{ $list->actual_task }}</span>
                                            @elseif ($list->actual_task == 'NEED APPROVED')
                                                <span class="label label-info">{{ $list->actual_task }}</span>
                                            @elseif ($list->actual_task == 'NEED UPDATED')
                                                <span class="label label-warning">{{ $list->actual_task }}</span>
                                            @else
                                                <span class="label label-danger">{{ $list->actual_task }}</span>
                                            @endif
                                        </td>


                                        <td class="text-center">
                                            @if (Admin::user()->inRoles(['mitra']))
                                                @if ($list->category_id == 001 || $list->category_id == 002)
                                                    @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                                        <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : url('ped-panel/add-actual?id=' . $list->id) }}"
                                                            {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }}
                                                            class="btn btn-primary"><i
                                                                class="fa fa-plus"></i>&nbsp;&nbsp;
                                                            Add Actual
                                                        </a>
                                                    @else
                                                        <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}"
                                                            class="btn btn-info"><i
                                                                class="fa fa-search"></i>&nbsp;&nbsp;

                                                        </a>
                                                    @endif
                                                @endif
                                                {{-- @if ($list->category_id == 002)
                                                @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                                    @if ($cek_last_preparing->actual_finish)
                                                        <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : url('ped-panel/add-actual?id=' . $list->id) }}" {{ $list->actual_task == 'NEED APPROVED' ? 'disabled'  : '' }}
                                                            class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                                                            Add Actual
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}"
                                                        class="btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;
        
                                                    </a>
                                                @endif
                                            @endif --}}
                                                @if ($list->category_id == 003)
                                                    @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                                        @if ($cek_all_delivery == $cek_all_delivery_finish && $list->activity_id < 20)
                                                            <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : url('ped-panel/add-actual?id=' . $list->id) }}"
                                                                {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }}
                                                                class="btn btn-primary"><i
                                                                    class="fa fa-plus"></i>&nbsp;&nbsp;
                                                                Add Actual
                                                            </a>
                                                        @endif
                                                        @if ($cek_all_installasi == $cek_all_installasi_finish && $list->activity_id == 20)
                                                            <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : url('ped-panel/add-actual?id=' . $list->id) }}"
                                                                {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }}
                                                                class="btn btn-primary"><i
                                                                    class="fa fa-plus"></i>&nbsp;&nbsp;
                                                                Add Actual
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}"
                                                            class="btn btn-info"><i
                                                                class="fa fa-search"></i>&nbsp;&nbsp;

                                                        </a>
                                                    @endif
                                                @endif
                                                @if ($list->category_id == 004)
                                                    @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                                        @if ($cek_commisioning_tes == 1 && $list->activity_id == 21)
                                                            <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : url('ped-panel/add-actual?id=' . $list->id) }}"
                                                                {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }}
                                                                class="btn btn-primary"><i
                                                                    class="fa fa-plus"></i>&nbsp;&nbsp;
                                                                Add Actual
                                                            </a>
                                                        @endif
                                                        @if ($cek_ut == 1 && $list->activity_id == 22)
                                                            <a href="{{ url('ped-panel/administrasi-generate?id=' . $list->project_id) }}"
                                                                class="btn btn-warning"><i
                                                                    class="fa fa-file-o"></i>&nbsp;&nbsp;
                                                                Administration Activity
                                                            </a>
                                                        @endif
                                                        @if ($cek_rekon == 1 && $list->activity_id == 23)
                                                            <a href="{{ url('ped-panel/administrasi-generate?id=' . $list->project_id) }}"
                                                                class="btn btn-warning"><i
                                                                    class="fa fa-file-o"></i>&nbsp;&nbsp;
                                                                Administration Activity
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}"
                                                            class="btn btn-info"><i
                                                                class="fa fa-search"></i>&nbsp;&nbsp;

                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                            @if (Admin::user()->inRoles(['waspang', 'administrator', 'hd-ped']))
                                                @php
                                                    $log = App\Models\LogActual::where('tran_baseline_id', $list->id)
                                                        ->whereNull('approval_waspang')
                                                        ->count();
                                                @endphp
                                                @if ($log > 0 && $list->activity_id < 21)
                                                    <a href="{{ url('ped-panel/add-approve?id=' . $list->id) }}"
                                                        class="btn btn-app bg-green">
                                                        <span class="badge bg-yellow">{{ $log }}</span>
                                                        <i class="fa fa-check">
                                                        </i>&nbsp;&nbsp;
                                                        Approval </a>
                                                @endif
                                            @endif
                                            @if (Admin::user()->inRoles(['tim-ut', 'administrator', 'hd-ped']))
                                                @php
                                                    $log = App\Models\LogActual::where('tran_baseline_id', $list->id)
                                                        ->whereNull('approval_tim_ut')
                                                        ->count();
                                                @endphp
                                                @if ($list->actual_task == 'NEED APPROVED' && $list->activity_id == 21)
                                                    <a href="{{ url('ped-panel/add-approve?id=' . $list->id) }}"
                                                        class="btn btn-app bg-green">
                                                        <span class="badge bg-yellow">{{ $log }}</span>
                                                        <i class="fa fa-check"></i>&nbsp;&nbsp;
                                                        Approval UT</a>
                                                @endif
                                            @endif
                                            @if (Admin::user()->inRoles(['administrator', 'hd-ped']))
                                                @if ($list->actual_task == 'APPROVED' || $list->actual_task == 'REJECTED')
                                                    <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}"
                                                        class="btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;

                                                    </a>
                                                @endif
                                            @endif

                                        </td>



                                    </tr>
                                @endforeach

                            </table>


                        </div>



                    </div>

                </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <canvas id="line_target_real" style="width: 100%;"></canvas>
            </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->

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
                        <button type="submit" class="btn btn-primary">Submit Plan</button>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>
{{-- @php
Admin::style('.table {
            #background: #ee99a0;
            border-radius: 0.2rem;
            width: 100%;
            padding-bottom: 1rem;
            color: #212529;
            margin-bottom: 0;
          }
          .table th:nth-child(1),
          .table td:nth-child(1) {
            white-space: nowrap;
            position: sticky;
            left: 0;
            background-color: #ffffd5;
            color: #373737;
          }
         
          
          .table td {
            text-transform: uppercase;
            white-space: nowrap;
            background-color: #ffffd5;
          }');
@endphp --}}
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()


    })
</script>
<script>
    $(document).ready(function() {
        var hitung = 0;
        var total = 0;

        $('.form-prevent').find('.jumlah').each(function() {
            //if($(this).is(':checked'))
            //{
            hitung++;
            total = total + parseInt($(this).val());
            //}
        });


        //var jumlah = $(".jumlah").val();

        //var total = parseInt(jumlah);
        $("#total").val(total);

        $(".jumlah").change(function() {
            var hitung = 0;
            var total = 0;
            $('.form-prevent').find('.jumlah').each(function() {
                //if($(this).is(':checked'))
                //{
                hitung++;
                total = total + parseInt($(this).val());
                //}
            });


            //var jumlah = $(".jumlah").val();

            //var total = parseInt(jumlah);
            $("#total").val(total);
        })
    });
</script>
<script>
    $(function() {

        function randomScalingFactor() {
            return Math.floor(Math.random() * 100)
        }

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        var config = {
            type: 'line',
            data: {
                labels: [
                    @foreach ($lists as $list)
                        '{{ $list->list_activity }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Nilai Target',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [
                        @foreach ($lists as $list)
                            '{{ $list->bobot }}',
                        @endforeach
                    ],
                    fill: false,
                }, {
                    label: 'Nilai Realiasai',
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        @foreach ($lists as $list)
                            '{{ $list->progress_bobot }}',
                        @endforeach
                    ],
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'TARGET VS REAL'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    scaleShowValues: true,
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }],
                    // xAxes: [{
                    //     display: true,
                    //     scaleLabel: {
                    //         display: true,
                    //         labelString: 'Month'
                    //     }
                    // }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };

        var ctx = document.getElementById('line_target_real').getContext('2d');
        new Chart(ctx, config);
    });
</script>
