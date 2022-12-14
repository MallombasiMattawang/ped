<section class="content">
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-plane"></i> Project Summary
                {{ Admin::user()->inRoles(['hd-ped']) }}</h3>
            <div class="pull-right">
                @if (Admin::user()->inRoles(['hd-ped', 'administrator']))
                    <a href="{{ url('ped-panel/acc-form?id=' . $project->id) }}" class="btn btn-danger btn-sm"><i
                            class="fa fa-edit"></i> ACC Project</a>
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
                    <td width="200">STATUS PROJECT </td>
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
                    <td>{{ $project->start_date }} s.d {{ $project->end_date }}</td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                <h4><i class="icon fa fa-edit"></i> Task!</h4>
                {{ $supervisi->task }}
            </div>
        </div>

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
        @if ($project->status_plan == 0)
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box text-center">
                    <div class="box-body">
                        <a class="btn btn-app bg-green" data-toggle="modal" data-target="#submit_plan">
                            <i class="fa fa-play"></i> SUBMIT PLAN
                        </a>
                    </div>
                </div>
            </div>
        @endif


    </div>



    <div class="row"></div>
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>WASPANG</label>
                            <select class="form-control select2" name="waspang_id" required
                                {{ $supervisi->task == 'PENENTUAN WASPANG DAN TIM UT' ? '' : 'disabled' }}>>
                                <option value=""></option>
                                @foreach ($waspang as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $supervisi->waspang_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->name }} / {{ $d->nik }} / {{ $d->phone }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>TIM UT</label>
                            <select class="form-control select2" name="tim_ut_id" required
                                {{ $supervisi->task == 'PENENTUAN WASPANG DAN TIM UT' ? '' : 'disabled' }}>
                                <option value=""></option>
                                @foreach ($tim_ut as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $supervisi->tim_ut_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->name }} / {{ $d->nik }} / {{ $d->phone }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>
                <table class="table table-bordered">
                    <tr>
                        <th width="40%" rowspan="2" class="text-center bg-gray disabled color-palette"> <br> List
                            Activity </th>
                        <th width="20%" colspan="3" class="text-center bg-yellow active color-palette">BASELINE PED
                        </th>
                        <th width="30%" colspan="3" class="text-center bg-maroon active color-palette">PLAN MITRA
                        </th>
                        @if ($project->status_plan == 0)
                            <th width="10%" rowspan="2" class="text-center bg-aqua active color-palette">ACTION PLAN
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
                            <td> {{ $list->list_activity }} {!! $category !!}</td>
                            <td class=""> {{ $list->bobot }}</td>
                            <td class="">{{ $list->volume }} </td>
                            <td class=""> {{ $list->satuan }} </td>

                            {{-- <td class="text-center"> {{ $list->plan_start }}</td>
                            <td class="text-center">{{ $list->plan_finish }} </td>
                            <td class="text-center"> {{ $list->plan_durasi }} </td> --}}
                            <td class="text-center"> <input type="text" class="form-control"
                                    id="plan_start_{{ $n }}" name="plan_start_{{ $n }}"
                                    {{ $n > 1 ? 'readonly' : '' }}></td>
                            <td class="text-center"> <input type="text" class="form-control"
                                    id="plan_finish_{{ $n }}" name="plan_finish_{{ $n }}"
                                    {{ $n > 1 ? 'readonly' : '' }}></td>
                            <td class="text-center"> <input type="text" id="plan_durasi_{{ $n }}"
                                    class="form-control" name="plan_durasi_{{ $n }}"></td>
                            @if ($project->status_plan == 0)
                                <td>
                                    @php
                                        $cek_atas = $list->id - 1;
                                        $cek_progress = \App\Models\TranBaseline::select(['id', 'plan_finish'])
                                            ->where('id', $cek_atas)
                                            ->first();
                                    @endphp
                                    @if ($n == 1 || $cek_progress->plan_finish)
                                        @if ($list->plan_finish)
                                            <a href="{{ url('ped-panel/add-plan?id=' . $list->id) }}"
                                                class="btn btn-primary"><i class="fa fa-plane"></i>&nbsp;&nbsp;
                                                Add
                                                Plan</a>
                                        @else
                                            <a href="{{ url('ped-panel/add-plan?id=' . $list->id) }}"
                                                class="btn btn-primary"><i class="fa fa-plane"></i>&nbsp;&nbsp;
                                                Add
                                                Plan</a>
                                            <button id="cek">Cek</button>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-primary disabled"><i
                                                class="fa fa-plane"></i>&nbsp;&nbsp;
                                            Add
                                            Plan</a>
                                    @endif

                                </td>
                            @endif





                        </tr>
                    @endforeach

                </table>


            </div>



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
                        <button type="submit" class="btn btn-primary">Submit Plan</button>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>
<br><br><br><br><br>
<script>
    @php
        $n = 0;
    @endphp
    @foreach ($lists as $list)
        @php
            $n++;
        @endphp
        $(function() {
            $('#plan_start_{{ $n }}').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                widgetPositioning: {
                    horizontal: 'auto',
                    vertical: 'bottom'
                }
            });

            $('#plan_finish_{{ $n }}').datetimepicker({
                useCurrent: false,
                locale: 'id',
                format: 'YYYY-MM-DD',
                widgetPositioning: {
                    horizontal: 'auto',
                    vertical: 'bottom'
                }
            });

            $('#plan_start_{{ $n }}').on("dp.change", function(e) {
                $('#plan_finish_{{ $n }}').data("DateTimePicker").minDate(e.date);
            });

            $('#plan_finish_{{ $n }}').on("dp.change", function(e) {
                $('#plan_start_{{ $n }}').data("DateTimePicker").maxDate(e.date);
                
                // 

                // 
                if ($('#plan_start_{{ $n + 1 }}').length) {
                    let total = $('#plan_finish_{{ $n }}').val();
                    $('#plan_start_{{ $n + 1 }}').data("DateTimePicker").minDate(e.date);
                    $('#plan_start_{{ $n + 1 }}').data("DateTimePicker").maxDate(e.date);

                    //$("#plan_start_{{ $n + 1 }}").val(total);
                    //$('#plan_start_{{ $n + 1 }}').prop('readonly', false);
                    $('#plan_finish_{{ $n + 1 }}').prop('readonly', false);

                    $('#plan_start_{{ $n - 1 }}').prop('readonly', true);
                    $('#plan_finish_{{ $n - 1 }}').prop('readonly', true);
                    CalcDiff_{{ $n }}()
                } else {
                    alert("Div2 is not exists");
                    CalcDiff_{{ $n }}()
                }


            });
            //$('#plan_finish_{{ $n }}').on("dp.change", function(e) {
            // $("#plan_finish_{{ $n }}").change(function() {
            //     var total = $('#plan_finish_{{ $n }}').val();
            //     $("#plan_start_{{ $n + 1 }}").val(total);
            // });
        });

        function CalcDiff_{{ $n }}() {
            var a = $('#plan_start_{{ $n }}').data("DateTimePicker").date();
            var b = $('#plan_finish_{{ $n }}').data("DateTimePicker").date();
            var timeDiff = 0
            if (b) {
                timeDiff = (b - a) / 1000;
            }
            $('#plan_durasi_{{ $n }}').val(Math.floor(timeDiff / (86400) + 1) + '')
        }
    @endforeach
</script>

{{-- <script>
    $(document).ready(function() {
        $("#cek").click(function() {
            let tgl_awal = $('#plan_start_{{ $n }}').val();
            let tgl_akhir = $('#plan_finish_{{ $n }}').val();
            let total = 0;
            if (new Date(tgl_akhir) < new Date(tgl_awal)) {
                alert('input 2 melebihi tanggal 1!');
            } else {
               // total = tgl_awal + tgl_akhir;
                //$("#plan_durasi_{{ $n }}").val(total);
                var inputHari = 5 //Contoh aja hehe
                var hariKedepan = new Date(new Date().getTime() + (inputHari * 24 * 60 * 60 *
                1000)); // 1000 ini buat pengkalian milisecondnya date object
                $("#plan_durasi_{{ $n }}").val('2');

            }
        })

    });
</script> --}}
