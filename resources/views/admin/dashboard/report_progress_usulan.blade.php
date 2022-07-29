<div class="row">
    <div class="col-md-12">
       
        <table class="table table-bordered" id="table-usulan" data-toggle="table" data-show-refresh="true"
            data-buttons-class="primary" data-ajax-options="ajaxOptions" data-url="ped-panel/api/progress-usulan">
            <thead>
                <tr>
                    <th rowspan="2" data-halign="center" data-field="witel">WITEL</th>
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
<script>
    var $table = $('#table-usulan')
    var $button = $('#button')
    var $customButton = $('#custom')

    $(function() {
        $button.click(function() {
            var names = $("#witel_id").val();
            var result = names.map(function(x) {
                return parseInt(x, 10);
            });
            console.log(result);
            $table.bootstrapTable('filterBy', {
                id: result
            })
        })

        $customButton.click(function() {
            $table.bootstrapTable('filterBy', {
                id: 4
            }, {
                'filterAlgorithm': (row, filters) => {
                    return row.id % filters.id === 0
                }
            })
        })
    })
</script>
