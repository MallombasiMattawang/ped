<div class="tab-pane" id="tab_timeline_witel">
    <div class="">
        <div class="">
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
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Kirim Ke WITEL</a></h3>

                        <div class="timeline-body">
                            <div class="">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>STATUS</td>
                                        <td>
                                            @if (isset($send_to_witel))
                                                <span
                                                    class="label label-default">{{ $send_to_witel->status }}</span>
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>
                                            @if (isset($mitra_area))
                                                <span
                                                    class="label label-default">{{ $send_to_witel->created_at }}</span>
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            @if (Admin::user()->inRoles(['mitra']) && $supervisi->posisi_doc == 'MITRA AREA')
                                @if ($supervisi->progress_doc == 'PEMBUATAN DOC' || $supervisi->progress_doc == 'REVISI DOC')
                                    <a href="{{ url('ped-panel/add-administrasi?id=' . $baseline->id) }}"
                                        class="btn btn-success"> <i class="fa fa-plus"></i> Kirim
                                        Dokumen</a>
                                @endif

                            @endif
                        </div>
                    </div>
                </li>

                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-purple">
                        WITEL
                    </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Verifikasi Doc Mitra
                                Area</a>
                        </h3>

                        <div class="timeline-body">
                            <div class="">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>DOKUMEN</td>
                                        <td>
                                            @if (isset($witel))
                                                @if ($witel->status == 'VERIFIKASI DOC')
                                                    <a href="{{ url('uploads/' . $witel_verifikasi->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen File</a>
                                                @elseif ($witel->status == 'DOC VERIFIED' ||
                                                    $witel->status == 'PROSES TANDA TANGAN' ||
                                                    $witel->status == 'DOC DITANDA TANGANI')
                                                    <a href="{{ url('uploads/' . $witel_approve->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen File</a>
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
                                            @if (isset($witel))
                                                @if ($witel->status == 'PROSES TANDA TANGAN' || $witel->status == 'DOC DITANDA TANGANI')
                                                    <span class="label label-default">DOC
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
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>
                                            @if (isset($witel))
                                                @if ($witel->status == 'PROSES TANDA TANGAN')
                                                    {{ $witel_approve->created_at }}
                                                @elseif ($witel->status == 'DOC DITANDA TANGANI')
                                                    {{ $witel_approve->created_at }}
                                                @elseif ($witel->status == 'REJECTED')
                                                    {{ $witel_reject->created_at }}
                                                @else
                                                    <span class="label label-default"> NO
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
                        <div class="timeline-footer">
                            @if (Admin::user()->inRoles(['witel']) &&
                                $supervisi->progress_doc == 'VERIFIKASI DOC' &&
                                $supervisi->posisi_doc == 'WITEL')
                                <a href="#" class="btn btn-danger btn-sm  addAttr"
                                    data-toggle="modal" data-target="#reject"
                                    data-id="{{ $supervisi->project_id }}"> Reject</a>
                                <a href="#" class="btn btn-success btn-sm  addAttr"
                                    data-toggle="modal" data-target="#approve"
                                    data-id="{{ $supervisi->project_id }}">
                                    Approve</a>
                            @endif

                        </div>
                </li>
                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-500px bg-orange"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Proses Tanda Tangan</a></h3>

                        <div class="timeline-body">
                            <div class="">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Dokumen</td>
                                        <td>
                                            @if (isset($witel))
                                                @if ($witel->status == 'DOC DITANDA TANGANI')
                                                    <a href="{{ url('uploads/' . $witel_ttd->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen Ditanda
                                                        tangani</a>
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
                                            @if (isset($witel))
                                                @if ($witel->status == 'PROSES TANDA TANGAN' || $witel->status == 'DOC DITANDA TANGANI')
                                                    <span
                                                        class="label label-default">{{ $witel->status }}</span>
                                                @else
                                                    <span class="label label-default">NO
                                                        DATA</span>
                                                @endif
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>
                                            @if (isset($witel))
                                                @if ($witel->status == 'DOC DITANDA TANGANI')
                                                    {{ $witel_ttd->created_at }}
                                                @else
                                                    <span class="label label-default"> NO
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
                        <div class="timeline-footer">
                            @if (Admin::user()->inRoles(['witel']) && $supervisi->progress_doc == 'PROSES TANDA TANGAN')
                                <a href="#" class="btn btn-success btn-sm  addAttr"
                                    data-toggle="modal" data-target="#ttd"
                                    data-id="{{ $supervisi->project_id }}">
                                    Proses Tanda Tangan</a>
                            @endif
                        </div>
                    </div>
                </li>



            </ul>
        </div>
    </div>

</div>
<!-- /.tab-pane -->

<div class="tab-pane" id="tab_timeline_ped">
    <div class="">
        <div class="">
            <ul class="timeline timeline-inverse">
                <!-- timeline time label -->


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
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Pengiriman Doc Ke
                                Regional</a>
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
                                                        class="label label-default">{{ $mitra_area->status }}</span>
                                                @else
                                                    NO DATA
                                                @endif
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>
                                            @if (isset($send_to_regional))
                                                <span
                                                    class="label label-default">{{ $send_to_regional->created_at }}</span>
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            @if (Admin::user()->inRoles(['mitra']) && $supervisi->posisi_doc == 'MITRA AREA')
                                @if ($supervisi->progress_doc == 'PENGIRIMAN DOC KE REGIONAL' ||
                                    $supervisi->progress_doc == 'REVISI DOC REGIONAL')
                                    <a href="{{ url('ped-panel/add-administrasi?id=' . $baseline->id) }}"
                                        class="btn btn-success"> <i class="fa fa-plus"></i> Kirim
                                        Dokumen</a>
                                @endif

                            @endif
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
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Verifikasi Internal</a></h3>

                        <div class="timeline-body">
                            <div class="">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>DOKUMEN</td>
                                        <td>
                                            @if (isset($mitra_regional))
                                                @if ($mitra_regional->status == 'VERIFIKASI INTERNAL')
                                                    <a href="{{ url('uploads/' . $regional_verifikasi->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen File</a>
                                                @elseif ($mitra_regional->status == 'DOC VERIFIED')
                                                    <a href="{{ url('uploads/' . $regional_approve->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen File</a>
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
                                            @if (isset($mitra_regional))
                                                <span
                                                    class="label label-default">{{ $mitra_regional->status }}</span>
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>
                                            @if (isset($mitra_regional))
                                                @if ($mitra_regional->status == 'DOC VERIFIED')
                                                    {{ $regional_approve->created_at }}
                                                @elseif ($mitra_regional->status == 'REJECTED')
                                                    {{ $regional_reject->created_at }}
                                                @else
                                                    <span class="label label-default"> NO
                                                        DATA</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            @if (Admin::user()->inRoles(['mitra']) && $supervisi->progress_doc == 'VERIFIKASI INTERNAL')
                                <a href="#" class="btn btn-success btn-sm  addAttr"
                                    data-toggle="modal" data-target="#approve"
                                    data-id="{{ $supervisi->project_id }}">
                                    Approve & Kirim ke Tel. Regional </a>
                                <a href="#" class="btn btn-danger btn-sm  addAttr"
                                    data-toggle="modal" data-target="#reject"
                                    data-id="{{ $supervisi->project_id }}"> Reject &
                                    Revisi Doc</a>
                            @endif
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
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Verifikasi Dokumen</a></h3>

                        <div class="timeline-body">
                            <div class="">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>DOKUMEN</td>
                                        <td>
                                            @if (isset($telkom_regional))

                                                @if ($telkom_regional->status == 'VERIFIKASI DOC')
                                                    <a href="{{ url('uploads/' . $telkom_verifikasi->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen File</a>
                                                @elseif ($telkom_regional->status == 'DOC VERIFIED' ||
                                                    $telkom_regional->status == 'PROSES TANDA TANGAN' ||
                                                    $telkom_regional->status == 'DOC DITANDA TANGANI')
                                                    <a href="{{ url('uploads/' . $telkom_approve->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen File</a>
                                                @else
                                                    NO DATA
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>STATUS</td>
                                        <td>
                                            @if (isset($telkom_regional))
                                                @if ($telkom_regional->status == 'PROSES TANDA TANGAN' || $telkom_regional->status == 'DOC DITANDA TANGANI')
                                                    <span class="label label-default">DOK
                                                        VERIFED</span>
                                                @else
                                                    <span
                                                        class="label label-default">{{ $telkom_regional->status }}</span>
                                                @endif
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>
                                            @if (isset($telkom_regional))
                                                @if ($telkom_regional->status == 'DOC VERIFIED' ||
                                                    $telkom_regional->status == 'PROSES TANDA TANGAN' ||
                                                    $telkom_regional->status == 'DOC DITANDA TANGANI')
                                                    {{ $telkom_approve->created_at }}
                                                @elseif ($telkom_regional->status == 'REJECTED')
                                                    {{ $telkom_reject->created_at }}
                                                @else
                                                    <span class="label label-default"> NO
                                                        DATA</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="timeline-footer">
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
                            @endif
                        </div>
                    </div>
                </li>

                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-500px bg-orange"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Proses Tanda Tangan</a></h3>

                        <div class="timeline-body">
                            <div class="">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>DOKUMEN</td>
                                        <td>
                                            @if (isset($telkom_regional))
                                                @if ($telkom_regional->status == 'DOC DITANDA TANGANI')
                                                    <a href="{{ url('uploads/' . $telkom_ttd->file_doc) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="btn btn-default">Dokumen Ditanda
                                                        tangani</a>
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
                                                @if ($telkom_regional->status == 'DOC DITANDA TANGANI')
                                                    <span
                                                        class="label label-default">{{ $telkom_regional->status }}</span>
                                                @else
                                                    <span class="label label-default">NO
                                                        DATA</span>
                                                @endif
                                            @else
                                                NO DATA
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL</td>
                                        <td>
                                            @if (isset($telkom_regional))
                                                @if ($telkom_regional->status == 'DOC DITANDA TANGANI')
                                                    {{ $telkom_ttd->created_at }}
                                                @else
                                                    <span class="label label-default"> NO
                                                        DATA</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            @if (isset($telkom_regional))
                                @if (Admin::user()->inRoles(['hd-ped', 'administrator']) &&
                                    $telkom_regional->posisi_doc == 'TELKOM REGIONAL' &&
                                    $telkom_regional->status == 'DOC VERIFIED')
                                    <a href="#" class="btn btn-success btn-sm  addAttr"
                                        data-toggle="modal" data-target="#ttd"
                                        data-id="{{ $supervisi->project_id }}">
                                        Proses Tanda Tangan</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</div>
<!-- /.tab-pane -->