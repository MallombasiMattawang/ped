<div class="row">
    <div class="col-md-12">
        <form action="" method="GET">
            <input type="hidden" name="filter" value="usulan">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Rekap Progress Usulan</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">

                                <input type="text" class="form-control" name="tipe_project"
                                    placeholder="Tipe Project">
                            </div>


                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="form-group">

                                <select class="form-control select2" name="witel" style="width: 100%;"
                                    placeholder="Pilih Witel">
                                    <option value="">Pilih Witel</option>
                                    <option value="GORONTALO">GORONTALO</option>
                                    <option value="MAKASSAR">MAKASSAR</option>
                                    <option value="MALUKU">MALUKU</option>
                                    <option value="PAPUA">PAPUA</option>
                                    <option value="PAPUA BARAT">PAPUA BARAT</option>
                                    <option value="SULSELBAR">SULSELBAR</option>
                                    <option value="SULTENG">SULTENG</option>
                                    <option value="SULTRA">SULTRA</option>
                                    <option value="SULUT MALUT">SULUT MALUT</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-2">
                            <button class="btn btn-primary"> Search</button>
                            <button class="btn btn-default" onclick="window.location.reload()">All</button>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-body">
                {{-- <div class="toolbar">
                    <button id="refresh" class="btn btn-secondary">Refresh</button>
                </div>
                <br> --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-dark" id="table-usulan" data-toggle="table"
                        data-buttons-class="primary" data-toolbar="#toolbar" data-url="/ped-panel/api/progress-usulan"
                        data-show-refresh="true" data-auto-refresh="true" data-cache="false" data-side-pagination="server">
                        <thead class="bg-yellow">
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
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-body">
                <canvas id="barUsulan" width="400" height="200"></canvas>
            </div>
        </div>

    </div>



</div>
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
                url: '/ped-panel/api/progress-usulan'
            })
        })
    })
    // your custom ajax request here
</script>

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
    $(function() {
        var ctx = document.getElementById("barUsulan").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["USULAN", "DONE DRM", "PELIMPAHAN", "PO/SP"],
                datasets: [{
                    label: '# Penerbitan Izin',
                    data: [
                        0
                    ],
                    backgroundColor: [

                        'rgba(54, 162, 235, 0.2)',


                    ],
                    borderColor: [

                        'rgba(54, 162, 235, 0.8)',


                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
