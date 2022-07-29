<div class="box">
    @if (isset($title))
        <div class="box-header with-border">
            <h3 class="box-title"> {{ $title }}</h3>
        </div>
    @endif

    <div class="box-header with-border">
        <div class="pull-right">
            {!! $grid->renderExportButton() !!}
            {!! $grid->renderCreateButton() !!}
        </div>
        <span>
            {!! $grid->renderHeaderTools() !!}
        </span>
    </div>

    {!! $grid->renderFilter() !!}

    <!-- /.box-header -->
    <div class="box-body">
        <ul class="mailbox-attachments clearfix">
            @foreach ($grid->rows() as $row)
                <li>

                    {{-- <span class="mailbox-attachment-icon has-img">
                        <img src="http://localhost:9000/uploads/images/278425263_1065306807723273_5471620982072636455_n.jpg" style="max-width:200px;max-height:200px" class="img img-thumbnail">
                    </span> --}}
                    <div class="mailbox-attachment-info" style="background: #fff !important">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2">
                                    {!! $row->column('project_name') !!}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    MITRA : {!! $row->column('supervisi_project.mitra_id') !!}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    START - FINISH <br>
                                    <?php
                                    $start_date = $row->column('supervisi_project.start_date');
                                    $end_date = $row->column('supervisi_project.end_date');
                                    ?>
                                    <b>{{ date('d-m-Y', strtotime($start_date)) }}
                                    </b>s.d
                                    <b>{{ date('d-m-Y', strtotime($end_date)) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">

                                    <span class="label label-info">TEMATIK :
                                        {{ $row->column('supervisi_project.tematik') }}</span>
                                        <span class="label label-info">WITEL :
                                            {{ $row->column('supervisi_project.witel_id') }}</span>
                                    <span class="label label-success">STATUS SP :
                                        {{ $row->column('supervisi_project.status_project') }}</span>
                                        <span class="label label-warning">STO :
                                            {{ $row->column('supervisi_project.sto_id') }}</span>

                                </td>
                                
                            </tr>
                            <tr>
                                <td>Status Const</td>
                                
                                <td>{!! $row->column('status_const') ? $row->column('status_const') : '-' !!}</td>
                            </tr>
                            <tr>
                                <td>Progress Plan</td>
                                

                                <td>
                                    @php
                                        $today = date('Y-m-d');
                                        $project_id = $row->column('project_id');
                                        $start_date = $row->column('supervisi_project.start_date');
                                        $progress_plan = App\Models\TranBaseline::where('project_id', $project_id)
                                            ->whereBetween('plan_finish', [$start_date, $today])
                                            ->sum('bobot');
                                        echo $progress_plan.' %';
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>Progress Actual</td>
                                
                                <td>{!! $row->column('progress_actual') !!} </td>
                            </tr>
                            <tr>
                                <td>Status Dokumen</td>
                                
                                <td>{!! $row->column('status_doc') ? $row->column('status_doc') : '-' !!}</td>
                            </tr>
                            @if (Admin::user()->inRoles(['witel']))
                                
                                <tr>
                                    <td>Posisi Dokumen</td>
                                    
                                    <td>{!! $row->column('posisi_doc') ? $row->column('posisi_doc') : '-' !!}</td>
                                </tr>
                                <tr>
                                    <td>Progress Dokumen</td>
                                    
                                    <td>{!! $row->column('progress_doc') ? $row->column('progress_doc') : '-' !!}</td>
                                </tr>

                                <tr>
                                    <td colspan="2"><a
                                            href="{{ url('ped-panel/administrasi-generate?id=' . $row->column('project_id')) }}"
                                            class="btn btn-primary btn-block"><i class="fa fa-edit"></i>&nbsp;&nbsp;
                                            Verifikasi Dokumen
                                        </a></td>
                                </tr>
                            @endif

                        </table>
                        @if (Admin::user()->inRoles(['mitra']))
                            <div class="callout callout-default">
                               
                                <?php
                                $cek_plan = 'close';
                                $color_plan = 'red';
                                $cek_actual = 'close';
                                $color_actual = 'red';
                                $cek_administrasi = 'close';
                                $color_administrasi = 'red';
                                if ($row->column('supervisi_project.status_plan') == 1) {
                                    $cek_plan = 'check';
                                    $color_plan = 'green';
                                }
                                if ($row->column('status_doc') == 'KONSTRUKSI' || $row->column('status_doc') == 'ADMINISTRASI') {
                                    $cek_actual = 'hourglass-start';
                                    $color_actual = 'orange';
                                }
                                if ($row->column('status_doc') == 'FINISH') {
                                    $cek_actual = 'check';
                                    $color_actual = 'green';
                                }
                                if ($row->column('status_doc') == 'ADMINISTRASI') {
                                    $cek_administrasi = 'hourglass-start';
                                    $color_administrasi = 'orange';
                                }
                                if ($row->column('status_doc') == 'FINISH') {
                                    $cek_administrasi = 'check';
                                    $color_administrasi = 'green';
                                }
                                ?>
                                <ol>
                                    <span class="text-{{ $color_plan }}"><i class="fa fa-{{ $cek_plan }}"></i>
                                        BasePlan Activity </span> <br>
                                    <span class="text-{{ $color_actual }}"><i class="fa fa-{{ $cek_actual }}"></i>
                                        Actual Project </span> <br>
                                    <span class="text-{{ $color_administrasi }}"><i
                                            class="fa fa-{{ $cek_administrasi }}"></i> Dokumen Administrasi</span>
                                </ol>

                            </div>
                        @endif

                      <hr>
                        <span class="mailbox-attachment-size">
                            {!! $row->column('__row_selector__') !!}
                            <span class="pull-right">
                                {!! $row->column('__actions__') !!}
                            </span>
                        </span>
                        <br>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
    <div class="box-footer clearfix">
        {!! $grid->paginator() !!}
    </div>
    <!-- /.box-body -->
</div>
