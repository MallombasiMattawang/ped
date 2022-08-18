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
                                <select class="form-control select2" name="cfu" style="width: 100%;" required>
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
                                    multiple="multiple" required>
                                    <option value="all">All WBS</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" name="mitra[]" style="width: 100%;"
                                    multiple="multiple" required>
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
                <div class="table-responsive" id="tb_sap"> </div>
            </div>
        </div>

    </div>
</div>

<script>

   
        $("#tb_sap").load('/ped-panel/report/tb-sap');
   
</script>
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
