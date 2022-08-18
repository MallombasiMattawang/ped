<div class="row">
    <div class="col-md-12">
        <form action="/ped-panel/report/progress-sap-filter" method="POST">
            @csrf
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">

                                <select class="form-control select2" name="cfu" style="width: 100%;">
                                    <option value="all">All CFU</option>
                                    <option value="CONST">CONST</option>
                                    <option value="EBIS">EBIS</option>
                                    <option value="WIBS">WIBS</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control wbs" name="wbs[]" style="width: 100%;"
                                    multiple="multiple">
                                    <option value="all">All WBS</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" name="mitra[]" style="width: 100%;"
                                    multiple="multiple" placeholder="dadad">
                                    <?php
                                    $witel = App\Models\MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                                        ->where('admin_role_users.role_id', '4')
                                        //->pluck('name', 'name');
                                        ->get();
                                    ?>
                                    @foreach ($witel as $d)
                                        <option value="{{ $d->name }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary"> Search</button>

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </form>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Rekap Progress SAP</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-6">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">CFU </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" value="{{ $cfu }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">WBS </label>
                            <div class="col-sm-6">
                                <br>
                                @foreach ($wbs as $w)
                                    <span class="label label-info">{{ $w }}</span>
                                @endforeach

                            </div>
                        </div>

                    </form>

                </div>

                <table class="table table-bordered border-success" id="table-sap">
                    <thead class="bg-blue">
                        <tr>
                            <th rowspan="2" data-field="witel" data-halign="center">MITRA</th>
                            <th colspan="2" data-halign="center">PLAN PELIMPAHAN</th>
                            <th colspan="2" data-halign="center">PR </th>
                            <th colspan="2" data-halign="center">PO</th>
                            <th colspan="2" data-halign="center">GR</th>
                            <th colspan="3" data-halign="center">TOTAL</th>
                        </tr>
                        <tr>
                            <th data-field="total_nilai_plan" data-halign="center" data-align="right">Nilai</th>
                            <th data-field="total_port_plan" data-halign="center" data-align="right">Port</th>
                            <th data-field="total_pr" data-halign="center" data-align="right">Nilai</th>
                            <th data-field="port_pr" data-halign="center" data-align="right">Port</th>
                            <th data-field="total_po" data-halign="center" data-align="right">Nilai</th>
                            <th data-field="port_po" data-halign="center" data-align="right">Port</th>
                            <th data-field="total_gr" data-halign="center" data-align="right">Nilai</th>
                            <th data-field="port_gr" data-halign="center" data-align="right">Port</th>
                            <th data-field="total_lop" data-halign="center" data-align="right">LOP</th>
                            <th data-field="total_nilai" data-halign="center" data-align="right">Nilai</th>
                            <th data-field="total_port" data-halign="center" data-align="right">Port</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mitra as $d)
                            <?php
                            $nilai_plan =  App\Models\MstProject::where('mitra_id', $d)
                                ->whereIn('status_project', ['DONE DRM', 'PELIMPAHAN'])
                                ->sum('rab_total');
                            $port_plan =  App\Models\MstProject::where('mitra_id', $d)
                                ->whereIn('status_project', ['DONE DRM', 'PELIMPAHAN'])
                                ->sum('odp_port');
                            
                            // $nilai_pr =  App\Models\MstSap::where('witel', $d->witel)
                            //     ->where('status_sap', 'PR')
                            //     ->sum('nilai_pr_po_gr');
                            $port_pr =  App\Models\MstProject::where('mitra_id', $d)
                                ->where('status_project', 'PR')
                                ->sum('odp_port');
                            
                            // $nilai_po =  App\Models\MstSap::where('witel', $d->witel)
                            //     ->where('status_sap', 'PO')
                            //     ->sum('nilai_pr_po_gr');
                            $port_po =  App\Models\MstProject::where('mitra_id', $d)
                                ->where('status_project', 'PO')
                                ->sum('odp_port');
                            
                            // $nilai_gr =  App\Models\MstSap::where('witel', $d->witel)
                            //     ->where('status_sap', 'GR')
                            //     ->sum('nilai_pr_po_gr');
                            $port_gr =  App\Models\MstProject::where('mitra_id', $d)
                                ->where('status_project', 'GR')
                                ->sum('odp_port');
                            
                            //$total_lop_sap =  App\Models\MstSap::where('witel', $d->witel)->count();
                            $total_lop_project =  App\Models\MstProject::where('mitra_id', $d)
                                ->whereIn('status_project', ['DONE DRM', 'PELIMPAHAN'])
                                ->count();
                            ?>
                            <tr>
                                <td>{{ $d }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    window.ajaxOptions = {
        beforeSend: function(xhr) {
            xhr.setRequestHeader('custom-auth-token', 'custom-auth-token')
        }
    }
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: "Select Mitra",
        })


    })
</script>

<script type="text/javascript">
    $(function() {
        $('.wbs').select2({
            placeholder: 'Select WBS...',
            ajax: {
                url: '/ped-panel/api/wbs',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.wbs_element,
                                id: item.idwbs
                            }
                        })
                    };
                },
                cache: true
            }
        });


    })
</script>
