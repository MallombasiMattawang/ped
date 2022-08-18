<div class="row">
    <div class="col-md-12">
        <form action="" method="GET">

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
                                <select class="form-control tipe_project" name="tipe_project" style="width: 100%;">
                                    <option value="all">Semua Tipe</option>
                                </select>

                            </div>


                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <select class="form-control select2" name="witel" style="width: 100%;"
                                    placeholder="Pilih Witel">
                                    <option value="">Semua Witel</option>
                                    <option value="GORONTALO">GORONTALO</option>
                                    <option value="MAKASSAR">MAKASSAR</option>
                                    <option value="MALUKU">MALUKU</option>
                                    <option value="PAPUA">PAPUA</option>
                                    <option value="PAPUABARAT">PAPUA BARAT</option>
                                    <option value="SULSELBAR">SULSELBAR</option>
                                    <option value="SULTENG">SULTENG</option>
                                    <option value="SULTRA">SULTRA</option>
                                    <option value="SULUTMALUT">SULUT MALUT</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-2">
                            <button class="btn btn-primary"> Filter</button>

                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-body">
                {{-- <div class="toolbar">
                    <button id="refresh" class="btn btn-secondary">Refresh</button>
                </div>
                <br> --}}
                <div id="tb_usulan"></div>
            </div>
        </div>
    </div>
</div>

<script>
    //$("#tb_usulan").load('/ped-panel/report/tb-usulan');
    @if ($_GET)
        @if ($_GET['witel'] == null)
            $("#tb_usulan").load('/ped-panel/report/tb-usulan');
        @else
            $("#tb_usulan").load(
                '/ped-panel/report/tb-usulan?tipe_project={{ $_GET['tipe_project'] }}&witel={{ $_GET['witel'] }}');
        @endif
    @else
        $("#tb_usulan").load('/ped-panel/report/tb-usulan');
    @endif
</script>
<script type="text/javascript">
    $(function() {
        $('.tipe_project').select2({
            placeholder: 'Pilih Tipe Project...',
            ajax: {
                url: '/ped-panel/api/tipe-project',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.tipe_project,
                                id: item.idtipe_project
                            }
                        })
                    };
                },
                cache: true
            }
        });


    })
</script>
