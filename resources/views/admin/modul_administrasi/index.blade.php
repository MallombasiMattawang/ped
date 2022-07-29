<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><b>Langkah 1 :</b> Dokumen Rekonsiliasi ke Witel</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                @if (Admin::user()->inRoles(['mitra']) && $supervisi->posisi_doc == 'MITRA AREA')
                                    <a href="{{ url('ped-panel/add-administrasi?id=' . $baseline->id) }}"
                                        class="btn btn-success"> <i class="fa fa-plus"></i> Buat
                                        Dokumen</a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <b>Penjelasan:</b>
                        <p>
                            @if (Admin::user()->inRoles(['mitra']))
                                <ul>
                                    <li>Sebagai Mitra area kamu perlu melakukan pembuatan dokumen administrasi project
                                        pada
                                        tahap
                                        Rekonsiliasi </li>
                                    <li>Upload file Dokumen administrasi untuk dilakukan verifikasi dan approval WITEL
                                    </li>
                                    <li>Lakukan revisi dokumen apabila ada perbaikan, kemudian upload kembali</li>
                                </ul>
                            @endif
                            @if (Admin::user()->inRoles(['witel']))
                                <ul>
                                    <li>Sebagai Witel area kamu perlu melakukan verifikasi dan approval dokumen
                                        administrasi
                                        project pada
                                        tahap
                                        Rekonsiliasi </li>
                                    <li>Jika dokumen di Reject masukan catatan revisi untuk mitra </li>
                                </ul>
                            @endif


                        </p>
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Mitra Area</th>
                                <th>Witel Tujuan</th>
                                <th>Status</th>
                                <th>File Dok.</th>
                                <th>Catatan</th>
                                @if (Admin::user()->inRoles(['witel']) && $supervisi->progress_doc == 'VERIFIKASI DOC')
                                    <th>Action</th>
                                @endif
                            </tr>
                            <?php
                            $status = 'default';
                            $ket = 'Belum ada dokumen';
                            if ($supervisi->posisi_doc == 'MITRA AREA' && $supervisi->progress_doc == 'REVISI DOC') {
                                $status = 'danger';
                                $ket = 'REJECTED';
                            } elseif ($supervisi->posisi_doc == 'WITEL' && $supervisi->progress_doc == 'VERIFIKASI DOC') {
                                $status = 'warning';
                                $ket = 'NEED APPROVED';
                            } elseif ($supervisi->posisi_doc == 'MITRA REGIONAL' || $supervisi->posisi_doc == 'PED' || $supervisi->progress_doc == 'FINISH') {
                                $status = 'success';
                                $ket = 'APPROVED';
                            }
                            ?>
                            <tr>
                                <td>{{ $supervisi->id }}</td>
                                <td>{{ $supervisi->supervisi_project->mitra_id }}</td>
                                <td>{{ $supervisi->supervisi_project->witel_id }}</td>
                                <td><span class="label label-{{ $status }}">{{ $ket }}</span>
                                </td>

                                <td>@if ($supervisi->file_doc_witel)
                                    <a href="{{ url('uploads/' . $supervisi->file_doc_witel) }}" target="_blank"
                                        class="btn btn-default btn-file"><i class="fa fa-paperclip"></i>Download
                                        File</a>
                                @endif </td>
                                <td>
                                    @if ($ket == 'REJECTED')
                                        {{ $baseline->approval_message }}
                                    @endif
                                </td>
                                @if (Admin::user()->inRoles(['witel']) && $supervisi->progress_doc == 'VERIFIKASI DOC')
                                    <td> <a href="#" class="btn btn-danger btn-sm btn-block addAttr" data-toggle="modal"
                                            data-target="#reject" data-id="{{ $supervisi->project_id }}"> Reject</a>
                                        <a href="#" class="btn btn-success btn-sm btn-block addAttr" data-toggle="modal"
                                            data-target="#approve" data-id="{{ $supervisi->project_id }}">
                                            Approve</a>
                                    </td>
                                @endif
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>




    </div>
    @if ($supervisi->posisi_doc == 'MITRA REGIONAL' || ($supervisi->posisi_doc == 'PED' && Admin::user()->inRoles(['mitra', 'hd-ped', 'administrator'])))
        <div class="col-md-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title"><b>Langkah 2 :</b>Dokumen Rekonsiliasi ke Telkom Regional /PED</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            @if (Admin::user()->inRoles(['mitra']) && $supervisi->posisi_doc == 'MITRA REGIONAL')
                                <a href="{{ url('ped-panel/add-administrasi?id=' . $baseline->id) }}"
                                    class="btn btn-success"> <i class="fa fa-plus"></i> Buat
                                    Dokumen</a>
                            @endif

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if (Admin::user()->inRoles(['mitra']))
                        <b>Penjelasan :</b>
                        <ul>
                            <li>Sebagai Mitra regional kamu perlu melakukan verifikasi internal dan
                                penandatanganan pada dokumen administrasi
                            </li>
                            <li>Upload file Dokumen administrasi untuk dilakukan verifikasi dan approval oleh
                                Telkom Regional / Admin PED
                            </li>
                            <li>Lakukan revisi dokumen apabila ada perbaikan, kemudian upload kembali</li>
                        </ul>
                    @endif
                    @if (Admin::user()->inRoles(['hd-ped', 'administrator']))
                        <ul>
                            <li>Sebagai Admin-PED / Telkom Regional kamu perlu melakukan verifikasi dan approval dokumen
                                administrasi
                                project pada
                                tahap
                                Rekonsiliasi </li>
                            <li>Jika dokumen di Reject masukan catatan revisi untuk mitra regional </li>
                        </ul>
                    @endif
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Mitra Regional</th>
                            <th>Tujuan</th>
                            <th>Status</th>
                            <th>File Dok.</th>
                            <th>Catatan</th>
                            @if (Admin::user()->inRoles(['hd-ped', 'administrator']))
                                <th>Action</th>
                            @endif
                        </tr>
                        <?php
                        $status = 'default';
                        $ket = 'Belum ada dokumen';
                        if ($supervisi->posisi_doc == 'MITRA REGIONAL' && $supervisi->progress_doc == 'REVISI DOC') {
                            $status = 'danger';
                            $ket = 'REJECTED';
                        } elseif ($supervisi->posisi_doc == 'PED' && $supervisi->progress_doc == 'VERIFIKASI DOC') {
                            $status = 'warning';
                            $ket = 'NEED APPROVED';
                        } elseif ($supervisi->progress_doc == 'FINISH') {
                            $status = 'success';
                            $ket = 'APPROVED';
                        }
                        ?>
                        <tr>
                            <td>{{ $supervisi->id }}</td>
                            <td>{{ $supervisi->supervisi_project->mitra_id }}</td>
                            <td>Telkom Regional</td>
                            <td><span class="label label-{{ $status }}">{{ $ket }}</span>
                            </td>

                            <td>
                                @if ($supervisi->file_doc_ped)
                                    <a href="{{ url('uploads/' . $supervisi->file_doc_ped) }}" target="_blank"
                                        class="btn btn-default btn-file"><i class="fa fa-paperclip"></i>Download
                                        File</a>
                                @endif

                            </td>
                            <td>
                                @if ($ket == 'REJECTED')
                                    {{ $baseline->approval_message }}
                                @endif

                            </td>
                            @if (Admin::user()->inRoles(['hd-ped', 'administrator']) && $ket == 'NEED APPROVED')
                                <td> <a href="#" class="btn btn-danger btn-sm btn-block addAttr" data-toggle="modal"
                                        data-target="#reject" data-id="{{ $supervisi->project_id }}"> Reject</a>
                                    <a href="#" class="btn btn-success btn-sm btn-block addAttr" data-toggle="modal"
                                        data-target="#approve" data-id="{{ $supervisi->project_id }}">
                                        Approve</a>
                                </td>
                            @endif
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    @endif
</div>

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
                    <textarea name="approval_message" id="approval_message" class="form-control" rows="5" placeholder="Catatan ..."></textarea>
                    
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
