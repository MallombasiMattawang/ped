
<div class="col-md-6">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">%TA </label>
            <div class="col-sm-2">
              <input type="text" class="form-control" value="{{ $ta }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">%NON TA </label>
            <div class="col-sm-2">
              <input type="text" class="form-control" value="{{ $nonta }}" readonly>
            </div>
          </div>
       
    </form>

</div>

<table class="table table-bordered border-success" id="table-sap" data-toggle="table" data-show-refresh="true"
    data-buttons-class="primary" data-ajax-options="ajaxOptions" data-url="/ped-panel/api/progress-sap">
    <thead class="bg-yellow">
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

<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
