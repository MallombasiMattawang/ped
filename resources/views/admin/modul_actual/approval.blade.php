<div class="col-md-12">
    <a href="{{ url('/ped-panel/actual-generate?id=' . $baseline->project_id) }}" class="btn btn-default">
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
                Total Progress
            </td>
            <td>
                {{ $sumProgress }} %
            </td>
        </tr>
    </table>
    <hr>
    <ul class="mailbox-attachments clearfix">
        @php
            $n = 0;
        @endphp
        @foreach ($log as $d)
            @php
                $n++;
            @endphp
            <li>
                <span class="mailbox-attachment-icon has-img">
                    {{-- <iframe src="/uploads/{{ $d->actual_evident }}" frameborder="0"></iframe> --}}


                </span>
                <div class="">
                    <table class="table table-bordered">
                        <tr>
                            <td>File Evident</td>
                            <td><a class="btn btn-info btn-sm" href="/uploads/{{ $d->actual_evident }}"
                                    target="_blank" rel="noopener noreferrer"> File</a> </td>
                        </tr>
                        <tr>
                            <td>Volume Actual</td>
                            <td>
                                @if ($d->approval_waspang == 'approve' || $d->approval_tim_ut == 'approve')
                                    {{ $d->actual_volume }} {{ $baseline->satuan }}
                                @elseif ($d->approval_waspang == 'reject' || $d->approval_tim_ut == 'reject')
                                    <del> {{ $d->actual_volume }} {{ $baseline->satuan }}</del>
                                @else
                                {{ $d->actual_volume }} {{ $baseline->satuan }}
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td>Progress Actual</td>
                            <td>
                                @if ($d->approval_waspang == 'approve' || $d->approval_tim_ut == 'approve')
                                    {{ $d->actual_progress }} %
                                @elseif ($d->approval_waspang == 'reject' || $d->approval_tim_ut == 'reject')
                                    <del> {{ $d->actual_progress }} %</del>
                                @else
                                {{ $d->actual_progress }} %
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Progress Status</td>
                            <td>
                                @if ($d->approval_waspang == 'approve' || $d->approval_tim_ut == 'approve')
                                    {{ $d->actual_status }} 
                                @elseif ($d->approval_waspang == 'reject' || $d->approval_tim_ut == 'reject')
                                    <del> {{ $d->actual_status }} </del>
                                @else
                                {{ $d->actual_status }} 
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td>Approval Status</td>
                            <td>
                                @if ($approvalBy == 'WASPANG')
                                    @if ($d->approval_waspang == 'approve')
                                        <span class="label label-success">APPROVED</span>
                                    @elseif ($d->approval_waspang == 'reject')
                                        <span class="label label-danger">REJECTED</span>
                                    @else
                                        <span class="label label-warning">Need Approve</span>
                                    @endif
                                @else
                                    {{ $d->approval_tim_ut != null ? $d->approval_tim_ut : 'Need Approve ' }}
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>Waktu Report</td>
                            <td>{{ $d->created_at }}</td>
                        </tr>
                    </table>
                    @php
                        $cek_atas = $d->id - 1;
                        if ($approvalBy == 'WASPANG') {
                            $cek_approve = \App\Models\LogActual::select(['id', 'approval_waspang'])
                                ->where('id', $cek_atas)
                                ->whereNotNull('approval_waspang')
                                ->first();
                        } else {
                            $cek_approve = \App\Models\LogActual::select(['id', 'approval_tim_ut'])
                                ->where('id', $cek_atas)
                                ->whereNotNull('approval_tim_ut')
                                ->first();
                        }
                        
                    @endphp
                    @if ($d->approval_waspang == null && $d->approval_tim_ut == null)
                        {{-- @if (isset($cek_approve->approval_waspang) || isset($cek_approve->approval_tim_ut) || $n == 1) --}}
                        <table class="table">
                            <tr>
                                <td> <a href="#" class="btn btn-danger btn-sm btn-block addAttr"
                                        data-toggle="modal" data-target="#reject" data-id="{{ $d->id }}">
                                        Reject</a> </td>
                                <td> <a href="#" class="btn btn-success btn-sm btn-block addAttr"
                                        data-toggle="modal" data-target="#approve" data-id="{{ $d->id }}">
                                        Approve</a> </td>
                            </tr>
                        </table>
                        {{-- @endif --}}
                        {{-- <table class="table">
                            <tr>
                                <td> <a href="#" class="btn btn-danger btn-sm btn-block addAttr" data-toggle="modal"
                                        data-target="#reject" data-id="{{ $d->id }}"> Reject</a> </td>
                                <td> <a href="#" class="btn btn-success btn-sm btn-block addAttr" data-toggle="modal"
                                        data-target="#approve" data-id="{{ $d->id }}"> Approve</a> </td>
                            </tr>
                        </table> --}}
                    @else
                        <table class="table">
                            <tr>
                                <td> <a href="#" class="btn btn-danger btn-sm btn-block addAttr" disabled>
                                        Reject</a> </td>
                                <td> <a href="#" class="btn btn-success btn-sm btn-block addAttr" disabled>
                                        Approve</a>
                                </td>
                            </tr>
                        </table>
                    @endif




                </div>
            </li>
        @endforeach

    </ul>
</div>


<!-- Modal -->
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
            url: "{{ url('ped-panel/save-approve') }}",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
            $('#approve').modal('hide');
            //$.admin.reload();
            window.location.reload();
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
            url: "{{ url('ped-panel/save-approve') }}",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
            $('#reject').modal('hide');
            //$.admin.reload();
            window.location.reload();
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
