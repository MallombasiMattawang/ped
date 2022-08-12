<div class="row">
    <div class="col-md-12">
        <form action="" method="GET">
            <input type="hidden" name="filter" value="usulan">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CFU</label>
                                <select class="form-control select2" name="cfu" style="width: 100%;">
                                    <option value="CONST">CONST</option>
                                    <option value="EBIS">EBIS</option>
                                    <option value="WIBS">WIBS</option>
                                </select>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label>WBS</label>
                                <select class="form-control wbs" name="wbs" style="width: 100%;"
                                    multiple="multiple">

                                </select>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label>MITRA</label>
                                <select class="form-control select2" name="witel" style="width: 100%;"
                                    multiple="multiple">
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


                        </div><!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>%TA </label>
                                <input type="text" class="form-control">
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label>%NON TA </label>
                                <input type="text" class="form-control">
                            </div><!-- /.form-group -->

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary"> Search</button>
                </div>
            </div><!-- /.box -->
        </form>
        {{-- <div id="toolbar-sap">
            <div class="col-md-4">
                <div class="form-group">
                    <label>CFU</label>
                    <select class="form-control" data-placeholder="Select a CFU">
                        <option>CONST</option>
                        <option>EBIS</option>
                        <option>WIBS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>WBS</label>
                    <select class="form-control " data-placeholder="Select a WBS">
                        <option>Coming son</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>MITRA</label>
                    <select class="form-control " data-placeholder="Select a Mitra">
                        <option>Coming son</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>%TA</label>
                    <input type="text" class="form-control" value="0" readonly>
                </div>
                <div class="form-group">
                    <label>%NON TA</label>
                    <input type="text" class="form-control" value="0" readonly>
                </div>
            </div>
        </div> --}}
        <table class="table table-bordered border-success" id="table-sap" data-toggle="table" data-show-refresh="true"
            data-buttons-class="primary" data-ajax-options="ajaxOptions" data-url="/ped-panel/api/progress-sap">
            <thead>
                <tr>
                    <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
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
        </table>
    </div>
</div>
<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
<script>
    window.ajaxOptions = {
        beforeSend: function(xhr) {
            xhr.setRequestHeader('custom-auth-token', 'custom-auth-token')
        }
    }
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()


    })
</script>

<script type="text/javascript">
 $(function() {
    $('.wbs').select2({
        placeholder: 'Cari...',
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
