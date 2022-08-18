
<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">WITEL</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" value="{{ $witel }}" readonly>
                </div>
              </div>       
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">TIPE PROJECT</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" value="{{ $tipe_project }}" readonly>
                </div>
              </div>              
        </form>    
    </div>   
</div>



<div class="table-responsive">
    <table class="table table-bordered table-hover table-dark" id="table-usulan" data-toggle="table"
        data-buttons-class="primary" data-toolbar="#toolbar" data-url="/ped-panel/api/progress-usulan-filter?tipe_project={{ $tipe_project }}&witel={{ $witel }}"
        data-show-refresh="true" data-auto-refresh="true" data-cache="false" data-side-pagination="server">
        <thead class="bg-blue">
            <tr>
                <th rowspan="2" data-halign="center" data-field="sto_id">STO</th>
                <th colspan="2" data-halign="center">Usulan</th>
                <th colspan="2" data-halign="center">Done DRM</th>
                <th colspan="2" data-halign="center">Pelimpahan</th>
                <th colspan="2" data-halign="center">PO/SP</th>
                <th colspan="3" data-halign="center">Total</th>
            </tr>
            <tr>
                <th data-field="nilai_usulan" data-halign="center" data-align="right">Nilai</th>
                <th data-field="port_usulan" data-halign="center" data-align="right">Port</th>
                <th data-field="nilai_drm" data-halign="center" data-align="right">Nilai</th>
                <th data-field="port_drm" data-halign="center" data-align="right">Port</th>
                <th data-field="nilai_pelimpahan" data-halign="center" data-align="right">Nilai</th>
                <th data-field="port_pelimpahan" data-halign="center" data-align="right">Port</th>
                <th data-field="nilai_po" data-halign="center" data-align="right">Nilai</th>
                <th data-field="port_po" data-halign="center" data-align="right">Port</th>
                <th data-field="lop_total" data-halign="center" data-align="right">LOP</th>
                <th data-field="nilai_total" data-halign="center" data-align="right">Nilai</th>
                <th data-field="port_total" data-halign="center" data-align="right">Port</th>
            </tr>
        </thead>
    </table>
</div>


<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.20.2/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js">
</script>
<script>
    var $table = $('#table-usulan')

    $(function() {
        $('#refresh').click(function() {

            $table.bootstrapTable('refresh', {
                url: '/ped-panel/api/progress-usulan-filter?tipe_project={{ $tipe_project }}&witel={{ $witel }}'
            })
        })
    })
    // your custom ajax request here
</script>