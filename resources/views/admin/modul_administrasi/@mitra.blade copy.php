<style>
    @keyframes blinkrainbow {
        0% {
            color: black
        }

        50% {
            color: white
        }

        100% {
            color: black
        }
    }

    @-webkit-keyframes blinkrainbow {
        0% {
            color: black
        }

        50% {
            color: white
        }

        100% {
            color: black
        }
    }

    .blinkrainbow {
        -webkit-animation: blinkrainbow 1s linear infinite;
        -moz-animation: blinkrainbow 1s linear infinite;
        animation: blinkrainbow 1s linear infinite
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs ">
                    <li class="active"><a href="#tab_form" data-toggle="tab">Info Administrasi</a></li>
                    <li><a class="{{ $project->posisi_doc == 'MITRA AREA' ? 'blinkrainbow' : '' }}" href="#tab_mitra_area"
                            data-toggle="tab">MITRA AREA</a></li>
                    <li><a class="{{ $project->posisi_doc == 'WITEL' ? 'blinkrainbow' : '' }}" href="#tab_witel"
                            data-toggle="tab">WITEL</a></li>
                    <li><a class="{{ $project->posisi_doc == 'MITRA REGIONAL' ? 'blinkrainbow' : '' }}"
                            href="#tab_mitra_regional" data-toggle="tab">MITRA REGIONAL</a></li>
                    <li><a class="{{ $project->posisi_doc == 'TELKOM REGIONAL' ? 'blinkrainbow' : '' }}"
                            href="#tab_telkom_regional" data-toggle="tab">TELKOM REGIONAL</a></li>
                    <li><a class="{{ $project->posisi_doc == 'DOK OK' ? 'blinkrainbow' : '' }}"
                            href="#tab_bast" data-toggle="tab">Penerbitan BAST-1</a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_form">
                        <table class="table table-bordered">

                            <tr>
                                <td width="200">LOP / SITE ID </td>

                                <td>{{ $project->project_name }}</td>
                            </tr>
                            <tr>
                                <td>WITEL</td>
                                <td> {{ $project->supervisi_project->witel_id }}</td>
                            </tr>
                            <tr>
                                <td width="200">STATUS DOK </td>

                                <td>{{ $project->status_doc }}</td>
                            </tr>
                            <tr>
                                <td width="200">POSISI DOK </td>

                                <td>{{ $project->posisi_doc }}</td>
                            </tr>
                            <tr>
                                <td width="200">PROGRESS DOK </td>

                                <td>{{ $project->progress_doc }}</td>
                            </tr>


                        </table>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_mitra_area">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="3">PROSES ADMINISTRASI</th>
                            </tr>
                            <tr>
                                <td>MITRA AREA</td>
                                <td>Kirim ke WITEL</td>
                                <td>Kirim Ke Regional</td>
                            </tr>
                            <tr>
                                <td>{{ $project->supervisi_project->mitra_id }}</td>
                                <td>
                                    @if (Admin::user()->inRoles(['mitra']) && $supervisi->posisi_doc == 'MITRA AREA')
                                        @if ($supervisi->progress_doc == 'PEMBUATAN DOC' || $supervisi->progress_doc == 'REVISI DOC')
                                            <a href="{{ url('ped-panel/add-administrasi?id=' . $baseline->id) }}"
                                                class="btn btn-success"> <i class="fa fa-upload"></i> Upload Doc
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-default" disabled> <i
                                                    class="fa fa-upload"></i>
                                                Upload Doc</a>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-default" disabled> <i class="fa fa-upload"></i>
                                            Disabled</a>
                                    @endif

                                </td>
                                <td>
                                    @if (Admin::user()->inRoles(['mitra']) && $supervisi->posisi_doc == 'MITRA AREA')
                                        @if ($supervisi->progress_doc == 'PENGIRIMAN DOC KE REGIONAL' ||
                                            $supervisi->progress_doc == 'REVISI DOC REGIONAL')
                                            <a href="{{ url('ped-panel/add-administrasi?id=' . $baseline->id) }}"
                                                class="btn btn-default"> <i class="fa fa-upload"></i> Upload Doc</a>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-default" disabled> <i class="fa fa-upload"></i>
                                            Disabled</a>
                                    @endif
                                </td>

                            </tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="tab_witel">
                        <table class="table table-bordered">
                            <tr>
                                <th>Posisi Dokumen</th>
                                <th>Dok Verifikasi</th>
                                <th>Dok Ditandatangani</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>WITEL</td>
                                <td>
                                    @if (isset($witel))
                                        @if ($witel->status == 'VERIFIKASI DOC')
                                            <a href="{{ url('uploads/' . $witel_verifikasi->file_doc) }}"
                                                target="_blank" rel="noopener noreferrer" class="btn btn-warning"> <i
                                                    class="fa fa-file"></i> Dokumen File</a>
                                        @elseif ($witel->status == 'DOC VERIFIED' ||
                                            $witel->status == 'PROSES TANDA TANGAN' ||
                                            $witel->status == 'DOC DITANDA TANGANI')
                                            <a href="{{ url('uploads/' . $witel_approve->file_doc) }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-success">  Doc Verified</a>
                                        @else
                                            NO DATA
                                        @endif
                                    @else
                                        NO DATA
                                    @endif
                                </td>
                                <td>
                                    @if (isset($witel))
                                        @if ($witel->status == 'DOC DITANDA TANGANI')
                                            <a href="{{ url('uploads/' . $witel_ttd->file_doc) }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-success"> <i
                                                    class="fa fa-file"></i> Dokumen Ditanda tangani</a>
                                        @else
                                            NO DATA
                                        @endif
                                    @else
                                        NO DATA
                                    @endif
                                </td>
                                <td>
                                    {{-- VERIFIKASI WITEL --}}

                                    @if (Admin::user()->inRoles(['witel']) &&
                                        $supervisi->progress_doc == 'VERIFIKASI DOC' &&
                                        $supervisi->posisi_doc == 'WITEL')
                                        <a href="#" class="btn btn-danger btn-sm  addAttr" data-toggle="modal"
                                            data-target="#reject" data-id="{{ $supervisi->project_id }}"> Reject</a>
                                        <a href="#" class="btn btn-success btn-sm  addAttr" data-toggle="modal"
                                            data-target="#approve" data-id="{{ $supervisi->project_id }}">
                                            Approve</a>
                                    @endif
                                    {{-- TTD WITEL --}}
                                    @if (Admin::user()->inRoles(['witel']) && $supervisi->progress_doc == 'PROSES TANDA TANGAN')
                                        <a href="#" class="btn btn-success btn-sm  addAttr" data-toggle="modal"
                                            data-target="#ttd" data-id="{{ $supervisi->project_id }}">
                                            Proses Tanda Tangan</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="tab_mitra_regional">
                        <table class="table table-bordered">
                            <tr>
                                <th>Posisi Dokumen</th>
                                <th>Verifikasi Internal</th>
                                <th>Kirim BA Rekonsiliasi</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>MITRA REGIONAL </td>
                                <td>
                                    @if (isset($mitra_regional))
                                        @if ($mitra_regional->status == 'VERIFIKASI INTERNAL')
                                            <a href="{{ url('uploads/' . $regional_verifikasi->file_doc) }}"
                                                target="_blank" rel="noopener noreferrer" class="btn btn-warning"> <i
                                                    class="fa fa-file"></i> Dokumen File</a>
                                        @elseif ($mitra_regional->status == 'DOC VERIFIED' ||
                                            $mitra_regional->status == 'REVISI BA' ||
                                            $mitra_regional->status == 'BA VERIFIED' ||
                                            $mitra_regional->status == 'PENGIRIMAN BA REKON')
                                            <a href="{{ url('uploads/' . $regional_approve->file_doc) }}"
                                                target="_blank" rel="noopener noreferrer" class="btn btn-success"> <i
                                                    class="fa fa-file"></i> Dokumen File</a>
                                        @else
                                            NO DATA
                                        @endif
                                    @else
                                        NO DATA
                                    @endif
                                </td>
                                <td>
                                    @if (Admin::user()->inRoles(['mitra']) && $supervisi->posisi_doc == 'MITRA REGIONAL')
                                        @if ($supervisi->progress_doc == 'PENGIRIMAN BA REKON' || $supervisi->progress_doc == 'REVISI BA')
                                            <a href="{{ url('ped-panel/add-barekon?id=' . $baseline->id) }}"
                                                class="btn btn-default"> <i class="fa fa-upload"></i> Upload BA
                                                Rekon</a>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-default" disabled> <i
                                                class="fa fa-upload"></i>
                                            Disabled</a>
                                    @endif
                                </td>
                                <td>
                                    @if (Admin::user()->inRoles(['mitra']) && $supervisi->progress_doc == 'VERIFIKASI INTERNAL')
                                        <a href="#" class="btn btn-success btn-sm  addAttr" data-toggle="modal"
                                            data-target="#approve" data-id="{{ $supervisi->project_id }}">
                                            Approve & Kirim ke Tel. Regional </a>
                                        <a href="#" class="btn btn-danger btn-sm  addAttr" data-toggle="modal"
                                            data-target="#reject" data-id="{{ $supervisi->project_id }}"> Reject &
                                            Revisi Doc</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="tab_telkom_regional">
                        <table class="table table-bordered">
                            <tr>
                                <th>Posisi Dokumen</th>

                                <th>Dok Verifikasi</th>
                                <th>Dok Ditandatangani</th>
                                <th>Dok BA Rekonsiliasi</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>TELKOM REGIONAL </td>
                                <td>
                                    {{-- VERIFIKASI DOC TELKOM --}}
                                    @if (isset($telkom_regional))

                                        @if ($telkom_regional->status == 'VERIFIKASI DOC')
                                            <a href="{{ url('uploads/' . $telkom_verifikasi->file_doc) }}"
                                                target="_blank" rel="noopener noreferrer" class="btn btn-warning"><i
                                                    class="fa fa-file"></i> Dokumen File</a>
                                        @elseif ($telkom_regional->status == 'DOC VERIFIED' ||
                                            $telkom_regional->status == 'PROSES TANDA TANGAN' ||
                                            $telkom_regional->status == 'DOC DITANDA TANGANI' ||
                                            $telkom_regional->status == 'VERIFIKASI BA' ||
                                            $telkom_regional->status == 'REJECTED BA' ||
                                            $telkom_regional->status == 'BA VERIFIED')
                                            <a href="{{ url('uploads/' . $telkom_approve->file_doc) }}"
                                                target="_blank" rel="noopener noreferrer" class="btn btn-success"><i
                                                    class="fa fa-file"></i> Dokumen File</a>
                                        @else
                                            NO DATA
                                        @endif
                                    @else
                                        NO DATA
                                    @endif

                                </td>
                                <td>
                                    {{-- TTD DOK TELKOM --}}
                                    @if (isset($telkom_regional))
                                        @if ($telkom_regional->status == 'DOC DITANDA TANGANI' ||
                                            $telkom_regional->status == 'VERIFIKASI BA' ||
                                            $telkom_regional->status == 'REJECTED BA' ||
                                            $telkom_regional->status == 'BA VERIFIED')
                                            <a href="{{ url('uploads/' . $telkom_ttd->file_doc) }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-success"> <i
                                                    class="fa fa-file"> </i> Dokumen TTD</a>
                                        @else
                                            NO DATA
                                        @endif
                                    @else
                                        NO DATA
                                    @endif
                                </td>
                                <td>
                                    {{-- VERIFIKASI DOK BA REKON --}}
                                    @if (isset($telkom_verifikasi_ba) || isset($telkom_approve_ba))
                                        @if ($telkom_regional->status == 'DOC DITANDA TANGANI' || $telkom_regional->status == 'VERIFIKASI BA')
                                            <a href="{{ url('uploads/' . $telkom_verifikasi_ba->file_doc) }}"
                                                target="_blank" rel="noopener noreferrer" class="btn btn-warning"> <i
                                                    class="fa fa-file"> </i> Dokumen BA Rekon</a>
                                        @elseif ($telkom_regional->status == 'BA VERIFIED')
                                            <a href="{{ url('uploads/' . $telkom_approve_ba->file_doc) }}"
                                                target="_blank" rel="noopener noreferrer" class="btn btn-success"> <i
                                                    class="fa fa-file"> </i> Dokumen BA Rekon</a>
                                        @else
                                            NO DATA
                                        @endif
                                    @else
                                        NO DATA
                                    @endif
                                </td>
                                <td>
                                    @if (isset($telkom_regional))
                                        @if (Admin::user()->inRoles(['hd-ped', 'administrator']) &&
                                            $telkom_regional->posisi_doc == 'TELKOM REGIONAL' &&
                                            $telkom_regional->status == 'VERIFIKASI DOC')
                                            <a href="#" class="btn btn-success btn-sm  addAttr"
                                                data-toggle="modal" data-target="#approve"
                                                data-id="{{ $supervisi->project_id }}">
                                                Approve</a>
                                            <a href="#" class="btn btn-danger btn-sm  addAttr"
                                                data-toggle="modal" data-target="#reject"
                                                data-id="{{ $supervisi->project_id }}">
                                                Reject</a>
                                        @endif
                                        @if (Admin::user()->inRoles(['hd-ped', 'administrator']) &&
                                            $telkom_regional->posisi_doc == 'TELKOM REGIONAL' &&
                                            $telkom_regional->status == 'VERIFIKASI BA')
                                            <a href="#" class="btn btn-success btn-sm  addAttr"
                                                data-toggle="modal" data-target="#approveBa"
                                                data-id="{{ $supervisi->project_id }}">
                                                Approve BA</a>
                                            <a href="#" class="btn btn-danger btn-sm  addAttr"
                                                data-toggle="modal" data-target="#rejectBa"
                                                data-id="{{ $supervisi->project_id }}">
                                                Reject BA</a>
                                        @endif
                                        @if (Admin::user()->inRoles(['hd-ped', 'administrator']) &&
                                            $telkom_regional->posisi_doc == 'TELKOM REGIONAL' &&
                                            $telkom_regional->status == 'DOC VERIFIED')
                                            <a href="#" class="btn btn-success btn-sm  addAttr"
                                                data-toggle="modal" data-target="#ttd-bast"
                                                data-id="{{ $supervisi->project_id }}">
                                                Proses Tanda Tangan</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>

                    <div class="tab-pane" id="tab_bast">
                        <table class="table table-striped">

                            <tr>
                                <td>Dokumen BAST-1</td>
                                <td>
                                    @if ($supervisi->file_doc_bast)
                                        <a href="{{ url('uploads/' . $supervisi->file_doc_bast) }}" target="_blank"
                                            rel="noopener noreferrer" class="btn btn-default"> <i
                                                class="fa fa-file"></i>
                                            Dokumen BAST-1</a>
                                    @else
                                        NO DATA
                                    @endif
                                </td>

                                <td>
                                    @if (isset($telkom_regional))
                                        @if (Admin::user()->inRoles(['hd-ped', 'administrator']))
                                            @if ($telkom_regional->status == 'BA VERIFIED')
                                                <a href="{{ url('ped-panel/add-bast?id=' . $supervisi->project_id) }}"
                                                    class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;&nbsp;
                                                    Add BAST-1
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                    {{-- @if ($supervisi->file_doc_bast) --}}

                                    {{-- @endif --}}
                                </td>
                            </tr>
                        </table>
                    </div>


                </div>
                <!-- /.tab-content -->
            </div>




        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Timeline Administrasi</h3>
                </div>

                <div class="box-body">
                    <ul class="timeline timeline-inverse">

                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                                MITRA AREA
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    @if (isset($baseline))
                                        <span class="label label-default"></i>
                                            {{ $baseline->created_at }}</span>
                                    @else
                                        NO DATA
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Pembuatan Dokumen</a></h3>

                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    @if (isset($mitra_area))
                                        <span class="label label-default"></i>
                                            {{ $send_to_witel->created_at }}</span>
                                    @else
                                        NO DATA
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Kirim Ke WITEL</a></h3>



                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-purple">
                                WITEL
                            </span>
                        </li>
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    @if (isset($witel))
                                        @if ($witel->status == 'PROSES TANDA TANGAN')
                                            <span class="label label-default"></i>
                                                {{ $witel_approve->created_at }}</span>
                                        @elseif ($witel->status == 'DOC DITANDA TANGANI')
                                            <span class="label label-default"></i>
                                                {{ $witel_approve->created_at }}</span>
                                        @elseif ($witel->status == 'REJECTED')
                                            <span class="label label-danger"></i>
                                                {{ $witel_reject->created_at }}</span>
                                        @else
                                            <span class="label label-default"></i> NO
                                                DATA</span>
                                        @endif
                                    @else
                                        NO DATA
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Verifikasi Doc Mitra
                                        Area</a></h3>

                                <div class="timeline-body">
                                    <div class="">
                                        <table class="table table-bordered">

                                            <tr>
                                                <td>STATUS</td>
                                                <td>
                                                    @if (isset($witel))
                                                        @if ($witel->status == 'PROSES TANDA TANGAN' || $witel->status == 'DOC DITANDA TANGANI')
                                                            <span class="label label-success">DOC
                                                                VERIFIED</span>
                                                        @else
                                                            <span
                                                                class="label label-default">{{ $witel->status }}</span>
                                                        @endif
                                                    @else
                                                        NO DATA
                                                    @endif
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-500px bg-orange"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    @if (isset($witel))
                                        @if ($witel->status == 'DOC DITANDA TANGANI')
                                            <span class="label label-default">
                                                </i>
                                                {{ $witel_ttd->created_at }}</span>
                                        @else
                                            <span class="label label-default">
                                                </i>
                                                NO DATA</span>
                                        @endif
                                    @else
                                        NO DATA
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Proses Tanda Tangan</a></h3>

                                <div class="timeline-body">
                                    <div class="">
                                        <table class="table table-bordered">

                                            <tr>
                                                <td>STATUS</td>
                                                <td>
                                                    @if (isset($witel))
                                                        @if ($witel->status == 'PROSES TANDA TANGAN' || $witel->status == 'DOC DITANDA TANGANI')
                                                            <span
                                                                class="label label-success">{{ $witel->status }}</span>
                                                        @else
                                                            <span class="label label-default">NO DATA</span>
                                                        @endif
                                                    @else
                                                        NO DATA
                                                    @endif
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                                MITRA AREA
                            </span>
                        </li>
                        <!-- /.timeline-label -->

                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    @if (isset($send_to_regional))
                                        <span class="label label-default"></i>
                                            {{ $send_to_regional->created_at }}</span>
                                    @else
                                        NO DATA
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Pengiriman Doc Ke Regional</a>
                                </h3>

                                <div class="timeline-body">
                                    <div class="">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>STATUS</td>
                                                <td>
                                                    @if (isset($mitra_area))
                                                        @if ($mitra_area->status == 'SEND TO REGIONAL' || $mitra_area->status == 'REVISI DOC REGIONAL')
                                                            <span
                                                                class="label label-success">{{ $mitra_area->status }}</span>
                                                        @else
                                                            NO DATA
                                                        @endif
                                                    @else
                                                        NO DATA
                                                    @endif
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-maroon">
                                MITRA REGIONAL
                            </span>
                        </li>
                        <!-- /.timeline-label -->

                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    @if (isset($mitra_regional))
                                        @if ($mitra_regional->status == 'DOC VERIFIED' ||
                                            $mitra_regional->status == 'REVISI BA' ||
                                            $mitra_regional->status == 'BA VERIFIED' ||
                                            $mitra_regional->status == 'PENGIRIMAN BA REKON')
                                            <span class="label label-default"></i>
                                                {{ $regional_approve->created_at }} </span>
                                        @elseif ($mitra_regional->status == 'REJECTED')
                                            <span class="label label-danger"></i>
                                                {{ $regional_reject->created_at }}</span>
                                        @else
                                            <span class="label label-default"> NO
                                                DATA</span>
                                        @endif
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Verifikasi Internal</a></h3>

                                <div class="timeline-body">
                                    <div class="">
                                        <table class="table table-bordered">

                                            <tr>
                                                <td>STATUS</td>
                                                <td>
                                                    @if (isset($mitra_regional))
                                                        @if ($mitra_regional->status == 'VERIFIKASI INTERNAL')
                                                            <span class="label label-success">PROSES VERIFIKASI</span>
                                                        @elseif ($mitra_regional->status == 'DOC VERIFIED' ||
                                                            $mitra_regional->status == 'REVISI BA' ||
                                                            $mitra_regional->status == 'BA VERIFIED' ||
                                                            $mitra_regional->status == 'PENGIRIMAN BA REKON')
                                                            <span class="label label-success">DOC VERIFIED</span>
                                                        @elseif ($mitra_regional->status == 'REJECTED')
                                                            <span class="label label-success">REJECTED</span>
                                                        @endif
                                                    @else
                                                        NO DATA
                                                    @endif

                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </li>

                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-navy">
                                TELKOM REGIONAL
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-check bg-green"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    @if (isset($telkom_regional))
                                        @if ($telkom_regional->status == 'DOC VERIFIED' ||
                                            $telkom_regional->status == 'PROSES TANDA TANGAN' ||
                                            $telkom_regional->status == 'DOC DITANDA TANGANI' ||
                                            $telkom_regional->status == 'VERIFIKASI BA' ||
                                            $telkom_regional->status == 'BA VERIFIED' ||
                                            $telkom_regional->status == 'REJECTED_BA')
                                            <span class="label label-default"></i>
                                                {{ $telkom_approve->created_at }}</span>
                                        @elseif ($telkom_regional->status == 'REJECTED')
                                            <span class="label label-danger"></i>
                                                {{ $telkom_reject->created_at }}</span>
                                        @else
                                            <span class="label label-default"> NO DATA</span>
                                        @endif
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Verifikasi Dokumen</a></h3>

                                <div class="timeline-body">
                                    <div class="">
                                        <table class="table table-bordered">

                                            <tr>
                                                <td>STATUS</td>
                                                <td>
                                                    @if (isset($telkom_regional))
                                                        @if ($telkom_regional->status == 'PROSES TANDA TANGAN' ||
                                                            $telkom_regional->status == 'DOC DITANDA TANGANI' ||
                                                            $telkom_regional->status == 'VERIFIKASI BA' ||
                                                            $telkom_regional->status == 'BA VERIFIED' ||
                                                            $telkom_regional->status == 'REJECTED_BA')
                                                            <span class="label label-success">DOK VERIFED</span>
                                                        @else
                                                            <span
                                                                class="label label-default">{{ $telkom_regional->status }}</span>
                                                        @endif
                                                    @else
                                                        NO DATA
                                                    @endif
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </li>

                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-500px bg-orange"></i>
                            <div class="timeline-item">
                                <span class="time"></i>
                                    @if (isset($telkom_regional))
                                        @if ($telkom_regional->status == 'DOC DITANDA TANGANI' ||
                                            $telkom_regional->status == 'VERIFIKASI BA' ||
                                            $telkom_regional->status == 'BA VERIFIED' ||
                                            $telkom_regional->status == 'REJECTED_BA')
                                            <span class="label label-default"> {{ $telkom_ttd->created_at }}</span>
                                        @else
                                            <span class="label label-default"> NO DATA</span>
                                        @endif
                                    @endif
                                </span>

                                <h3 class="timeline-header"><a href="#">Proses Tanda Tangan</a></h3>

                                <div class="timeline-body">
                                    <div class="">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>DOKUMEN</td>
                                                <td>
                                                    @if (isset($telkom_regional))
                                                        @if ($telkom_regional->status == 'DOC DITANDA TANGANI' ||
                                                            $telkom_regional->status == 'VERIFIKASI BA' ||
                                                            $telkom_regional->status == 'BA VERIFIED' ||
                                                            $telkom_regional->status == 'REJECTED_BA')
                                                            <a href="{{ url('uploads/' . $telkom_ttd->file_doc) }}"
                                                                target="_blank" rel="noopener noreferrer"
                                                                class="btn btn-default"><i class="fa fa-download"></i>
                                                                File Doc</a>
                                                        @else
                                                            NO DATA
                                                        @endif
                                                    @else
                                                        NO DATA
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>STATUS</td>
                                                <td>
                                                    @if (isset($telkom_regional))
                                                        @if ($telkom_regional->status == 'DOC DITANDA TANGANI' ||
                                                            $telkom_regional->status == 'VERIFIKASI BA' ||
                                                            $telkom_regional->status == 'BA VERIFIED' ||
                                                            $telkom_regional->status == 'REJECTED_BA')
                                                            <span
                                                                class="label label-success">DOK OK</span>
                                                        @else
                                                            <span class="label label-default">NO
                                                                DATA</span>
                                                        @endif
                                                    @else
                                                        NO DATA
                                                    @endif
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<div id="reject" class="modal modal-danger fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="foo-reject">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reject Report Activity</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">Yakin untuk Reject report ini ?</h4>
                    <input type="hidden" class="form-control id_log" id="id_log" name="id">
                    <input type="hidden" class="form-control" name="approval" value="reject">
                    <textarea name="approval_message" id="approval_message" class="form-control" rows="5"
                        placeholder="Catatan Reject ..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="approve" class="modal modal-success fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{-- <form action="{{ url('ped-panel/save-approve') }}" method="post"> --}}
            <form id="foo">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Approve Report Activity</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">Yakin untuk Approve report ini ?</h4>
                    <input type="hidden" class="form-control id_log" id="id_log" name="id">
                    <input type="hidden" class="form-control" name="approval" value="approve">
                    <textarea name="approval_message" id="approval_message" class="form-control" rows="5"
                        placeholder="Catatan ..."></textarea>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

{{-- *******************************FOR BA*********************************************************************** --}}
<div id="rejectBa" class="modal modal-danger fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="foo-reject-ba">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reject BA Rekonsiliasi</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">Yakin untuk Reject report ini ?</h4>
                    <input type="hidden" class="form-control id_log" id="id_log" name="id">
                    <input type="hidden" class="form-control" name="approval" value="reject">
                    <textarea name="approval_message" id="approval_message" class="form-control" rows="5"
                        placeholder="Catatan Reject ..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="approveBa" class="modal modal-success fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{-- <form action="{{ url('ped-panel/save-approve') }}" method="post"> --}}
            <form id="foo-ba">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Approve BA Rekonsiliasi</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">Yakin untuk Approve report ini ?</h4>
                    <input type="hidden" class="form-control id_log" id="id_log" name="id">
                    <input type="hidden" class="form-control" name="approval" value="approve">
                    <textarea name="approval_message" id="approval_message" class="form-control" rows="5"
                        placeholder="Catatan ..."></textarea>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="ttd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{-- <form action="{{ url('ped-panel/save-approve') }}" method="post"> --}}
            <form id="foo-ttd" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Signature Activity</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control id_log" id="id_log" name="id">
                    <input type="hidden" class="form-control" name="approval" value="approve">
                    <div class="form-group">
                        <label for="file_doc_ttd">Dokumen dengan tanda tangan</label>
                        <input type="file" id="file_doc_ttd" name="file_doc_ttd">


                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="check"> Proses TTD dan Kirim Ke Mitra Area
                        </label>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="ttd-bast" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{-- <form action="{{ url('ped-panel/save-approve') }}" method="post"> --}}
            <form id="foo-ttd-bast" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Signature Activity & BAST-1</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control id_log" id="id_log" name="id">
                    <input type="hidden" class="form-control" name="approval" value="approve">
                    <div class="form-group">
                        <label for="file_doc_ttd">Dokumen dengan tanda tangan</label>
                        <input type="file" id="file_doc_ttd" name="file_doc_ttd">


                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="check"> Proses TTD Telkom Regional
                        </label>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>


<script>
    $('.addAttr').click(function() {
        var id = $(this).data('id');
        $('.id_log').val(id);
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
            url: "{{ url('ped-panel/save-administrasi') }}",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
            $('#approve').modal('hide');
            $.admin.reload();
            if (response.error) {
                $.admin.toastr.error(response.error, '', {
                    positionClass: "toast-top-center"
                });
            } else {
                $.admin.toastr.success(response.success, '', {
                    positionClass: "toast-top-center"
                });
            }


            //alert('success');
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
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

<script>
    var request;

    // Bind to the submit event of our form
    $("#foo-reject").submit(function(event) {

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
            url: "{{ url('ped-panel/save-administrasi') }}",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
            $('#reject').modal('hide');
            $.admin.reload();
            if (response.error) {
                $.admin.toastr.error(response.error, '', {
                    positionClass: "toast-top-center"
                });
            } else {
                $.admin.toastr.success(response.success, '', {
                    positionClass: "toast-top-center"
                });
            }


            //alert('success');
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
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

<script>
    var request;

    // Bind to the submit event of our form
    $("#foo-ba").submit(function(event) {

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
            url: "{{ url('ped-panel/save-ba') }}",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
            $('#approve').modal('hide');
            $.admin.reload();
            if (response.error) {
                $.admin.toastr.error(response.error, '', {
                    positionClass: "toast-top-center"
                });
            } else {
                $.admin.toastr.success(response.success, '', {
                    positionClass: "toast-top-center"
                });
            }


            //alert('success');
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
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

<script>
    var request;

    // Bind to the submit event of our form
    $("#foo-reject-ba").submit(function(event) {

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
            url: "{{ url('ped-panel/save-ba') }}",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
            $('#reject').modal('hide');
            $.admin.reload();
            if (response.error) {
                $.admin.toastr.error(response.error, '', {
                    positionClass: "toast-top-center"
                });
            } else {
                $.admin.toastr.success(response.success, '', {
                    positionClass: "toast-top-center"
                });
            }


            //alert('success');
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
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

<script>
    var request;

    // Bind to the submit event of our form
    $("#foo-ttd").submit(function(event) {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea, file");

        // Serialize the data in the form
        //var serializedData = $form.serialize();
        var serializedData = new FormData($form[0]);


        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        request = $.ajax({
            url: "{{ url('ped-panel/save-ttd') }}",
            type: "post",
            data: serializedData,
            processData: false,
            contentType: false,
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console

            console.log("Hooray, it worked!");
            $('#ttd').modal('hide');
            $.admin.reload();
            if (response.error) {
                $.admin.toastr.error(response.error, '', {
                    positionClass: "toast-top-center"
                });
            } else {
                $.admin.toastr.success(response.success, '', {
                    positionClass: "toast-top-center"
                });
            }


            //alert('success');
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
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

<script>
    var request;

    // Bind to the submit event of our form
    $("#foo-ttd-bast").submit(function(event) {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea, file");

        // Serialize the data in the form
        //var serializedData = $form.serialize();
        var serializedData = new FormData($form[0]);


        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        request = $.ajax({
            url: "{{ url('ped-panel/save-ttd-bast') }}",
            type: "post",
            data: serializedData,
            processData: false,
            contentType: false,
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console

            console.log("Hooray, it worked!");
            $('#ttd-bast').modal('hide');
            $.admin.reload();
            if (response.error) {
                $.admin.toastr.error(response.error, '', {
                    positionClass: "toast-top-center"
                });
            } else {
                $.admin.toastr.success(response.success, '', {
                    positionClass: "toast-top-center"
                });
            }


            //alert('success');
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
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
