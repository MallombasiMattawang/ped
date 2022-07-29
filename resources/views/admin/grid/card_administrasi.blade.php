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
                            @if (Admin::user()->inRoles(['witel', 'hd-ped', 'administrator']))
                                <tr>
                                    <td colspan="2">
                                        {!! $row->column('project_name') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mitra</td>

                                    <td>{!! $row->column('supervisi_project.mitra_id') !!}</td>
                                </tr>
                                <tr>
                                    <td>Witel</td>

                                    <td> {{ $row->column('supervisi_project.witel_id') }}</td>
                                </tr>
                                <tr>
                                    <td>Status Dok</td>

                                    <td>{!! $row->column('status_doc') ? $row->column('status_doc') : '-' !!}</td>
                                </tr>
                                <tr>
                                    <td>Posisi Dok</td>

                                    <td>{!! $row->column('posisi_doc') ? $row->column('posisi_doc') : '-' !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center"> <b>Progress Dok :</b> <br> {!! $row->column('progress_doc') ? $row->column('progress_doc') : '-' !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><a
                                            href="{{ url('ped-panel/administrasi-generate?id=' . $row->column('project_id')) }}"
                                            class="btn btn-default pull-right"><i class="fa fa-edit"></i>&nbsp;&nbsp;
                                            View
                                        </a></td>
                                </tr>
                            @endif

                        </table>

                        <br />
                        <span class="mailbox-attachment-size">
                            {!! $row->column('__row_selector__') !!}
                            <span class="pull-right">
                                {!! $row->column('__actions__') !!}
                            </span>
                        </span>
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
