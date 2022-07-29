<ul class="timeline">

    <!-- timeline time label -->
    <li class="time-label">
        <span class="bg-blue">
            {{ $project->lop_site_id }} | {{ $baseline->list_activity }}
        </span>
    </li>
    <!-- /.timeline-label -->
    @foreach ($logs as $log)
        <!-- timeline item -->
        <li>
            <!-- timeline icon -->
            <i class="fa fa-envelope bg-blue"></i>
            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{ $log->created_at }}</span>

                <h3 class="timeline-header"><a href="#">Report</a> By Mitra</h3>

                <div class="timeline-body">
                    <a href="/uploads/{{ $log->actual_evident}}" target="_blank"><img style="max-width:200px;max-height:200px" class="img img-thumbnail" src="/uploads/{{ $log->actual_evident}}" alt="evident"> </a>
                    <hr>Catatan : {{ $log->actual_message }}
                </div>

                <div class="timeline-footer">
                    <a
                        class="btn {{ $log->approval_waspang == 'approve' ? 'btn-success' : 'btn-danger' }} btn-xs">{{ $log->approval_waspang }}</a>
                        | Volume {{ $log->actual_volume }}
                </div>
            </div>
        </li>

        <!-- END timeline item -->
    @endforeach


    ...

</ul>
