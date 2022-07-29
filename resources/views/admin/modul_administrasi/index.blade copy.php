<div class="col-md-12">
    <a href="{{ url('/ped-panel/tran-administrasi') }}" class="btn btn-default">
        <i class="fa fa-angle-double-left"></i> Back
    </a>
</div>
<hr>
<div class="col-md-12">
    <table class="table table-bordered">
        <tr>
            <td>
                Lop Site ID
            </td>
            <td>
                {{ $baseline->project->lop_site_id }}
            </td>
        </tr>
        <tr>
            <td>
                List Activity
            </td>
            <td>
                {{ $baseline->list_activity }}
            </td>
        </tr>
        <tr>
            <td>
                Volume Kontrak
            </td>
            <td>
                {{ $baseline->volume }} {{ $baseline->satuan }}
            </td>
        </tr>
        <tr>
            <td>
                Status Dokumen
            </td>
            <td>
                {{ $supervisi->status_doc }}
            </td>
        </tr>
        <tr>
            <td>
                Posisi Dokumen
            </td>
            <td>
                {{ $supervisi->posisi_doc }}
            </td>
        </tr>
        <tr>
            <td>
                Progress Dokumen
            </td>
            <td>
                {{ $supervisi->progress_doc }}
            </td>
        </tr>
        <tr>
            <td>
                Task :
                @if (Admin::user()->inRoles(['mitra']))
                    @if ($supervisi->progress_doc == 'PENGIRIMAN DOC' && $supervisi->posisi_doc == 'MITRA REGIONAL')
                        <blockquote> Lakukan Pemeriksaan internal, Tanda tangan dan kirim dokumen ke PED / Telkom
                            Regional
                        </blockquote>
                    @endif
                    @if ($supervisi->progress_doc == 'PEMBUATAN DOC')
                        <blockquote> Kirim dokumen administrasi ke WITEL untu di Verifikasi
                        </blockquote>
                    @endif
                @endif
                @if (Admin::user()->inRoles(['witel']))
                    @if ($supervisi->progress_doc == 'PENGIRIMAN DOC')
                        <blockquote> Selesai
                        </blockquote>
                    @endif
                    @if ($supervisi->progress_doc == 'PEMBUATAN DOC')
                        <blockquote> Lakukan Verifikasi dan approval dokumen dari mitra
                        </blockquote>
                    @endif

                @endif
            </td>
            <td>
                @if (Admin::user()->inRoles(['mitra']))
                    @if ($supervisi->posisi_doc == 'MITRA AREA' || $supervisi->posisi_doc == 'MITRA REGIONAL')
                        <a href="{{ url('/ped-panel/add-administrasi?id=' . $baseline->id) }}"
                            class="btn btn-app text-center">
                            <i class="fa fa-upload"></i> Upload Doc
                        </a>
                    @endif
                @endif

                @if (Admin::user()->inRoles(['witel']))
                    @if ($supervisi->posisi_doc == 'WITEL')
                        <a href="#" class="btn btn-app bg-green text-center addAttr" data-toggle="modal"
                            data-target="#approve" data-id="{{ $supervisi->project_id }}">
                            <i class="fa fa-check"></i> APPROVE WITEL
                        </a>
                        <a href="#" class="btn btn-app bg-red text-center addAttr" data-toggle="modal"
                            data-target="#reject" data-id="{{ $supervisi->project_id }}">
                            <i class="fa fa-close"></i> REJECT WITEL
                        </a>
                    @endif
                @endif

                @if (Admin::user()->inRoles(['hd-ped','administrator']))
                    @if ($supervisi->posisi_doc == 'PED' && $supervisi->progress_doc != 'DOC OK')
                        <a href="#" class="btn btn-app bg-green text-center addAttr" data-toggle="modal"
                            data-target="#approve" data-id="{{ $supervisi->project_id }}">
                            <i class="fa fa-check"></i> APPROVE PED
                        </a>
                        <a href="#" class="btn btn-app bg-red text-center addAttr" data-toggle="modal"
                            data-target="#reject" data-id="{{ $supervisi->project_id }}">
                            <i class="fa fa-close"></i> REJECT PED
                        </a>
                    @endif
                @endif

            </td>
        </tr>
    </table>
    <hr>
    <iframe src="/uploads/{{ $supervisi->file_doc }}" frameborder="0" width="100%" height="800"></iframe>
    <!-- Modal -->
    <div id="reject" class="modal modal-danger fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{ url('ped-panel/save-administrasi') }}" method="post">
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
                <form action="{{ url('ped-panel/save-administrasi') }}" method="post">
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

    <script>
        $('.addAttr').click(function() {
            var id = $(this).data('id');
            $('.id_log').val(id);
        });
    </script>
