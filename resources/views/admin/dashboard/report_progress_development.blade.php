<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Progress Development</a></li>
                <li><a href="#tab_2" data-toggle="tab">Progress Konstruksi</a></li>
                <li><a href="#tab_3" data-toggle="tab">Progress GOLIVE</a></li>
                <li><a href="#tab_4" data-toggle="tab">Progress Administrasi</a></li>

            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">

                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <i class="fa fa-cog"></i>
                                    <h3 class="box-title"># Progress Konstruksi</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="/ped-panel/report/progress-dev-filter" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">

                                                    <input type="text" class="form-control" name="tematik"
                                                        placeholder="TEMATIK">
                                                </div>
                                            </div><!-- /.col -->
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <select class="form-control select2" name="witel"
                                                        style="width: 100%;">
                                                        <option value="">Pilih Witel</option>
                                                        <option value="48">GORONTALO</option>
                                                        <option value="44">MAKASSAR</option>
                                                        <option value="49">MALUKU</option>
                                                        <option value="50">PAPUA</option>
                                                        <option value="51">PAPUA BARAT</option>
                                                        <option value="2">SULSELBAR</option>
                                                        <option value="45">SULTENG</option>
                                                        <option value="46">SULTRA</option>
                                                        <option value="47">SULUT MALUT</option>
                                                    </select>
                                                </div><!-- /.form-group -->

                                            </div><!-- /.col -->
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <select class="form-control select2" name="mitra"
                                                        style="width: 100%;">
                                                        <option value="">Pilih Mitra</option>
                                                        <?php
                                                        $witel = App\Models\MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                                                            ->where('admin_role_users.role_id', '4')
                                                            //->pluck('name', 'name');
                                                            ->get();
                                                        ?>
                                                        @foreach ($witel as $d)
                                                            <option value="{{ $d->id }}">{{ $d->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div><!-- /.form-group -->

                                            </div><!-- /.col -->
                                            <div class="col-md-2">
                                                <button class="btn btn-primary">Filter</button>
                                            </div>
                                        </div><!-- /.row -->
                                    </form>
                                    <table class="table table-bordered border-success" id="table-konstruksi"
                                        data-toggle="table" data-buttons-class="primary" data-ajax-options="ajaxOptions"
                                        data-url="/ped-panel/api/progress-konstruksi">
                                        <thead class="bg-yellow">
                                            <tr>
                                                <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                                                <th colspan="2" data-halign="center">01. Preparing</th>
                                                <th colspan="2" data-halign="center">02. Mat Delivery </th>
                                                <th colspan="2" data-halign="center">03. MOS</th>
                                                <th colspan="2" data-halign="center">04. Instalasi</th>
                                                <th colspan="2" data-halign="center">05. Install Done</th>
                                                <th colspan="2" data-halign="center">06. Selesai CT</th>
                                                <th colspan="2" data-halign="center">07. Selesai UT</th>
                                                <th colspan="2" data-halign="center">08. Rekon</th>
                                                <th colspan="2" data-halign="center">09. BAST-1</th>
                                                <th colspan="2" data-halign="center">TOTAL</th>
                                            </tr>
                                            <tr>
                                                <th data-field="nilai_preparing" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_preparing" data-halign="center" data-align="right">
                                                    Port</th>
                                                <th data-field="nilai_delivery" data-halign="center" data-align="right">
                                                    Nilai</th>
                                                <th data-field="port_delivery" data-halign="center" data-align="right">
                                                    Port</th>
                                                <th data-field="nilai_delivery_os" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_delivery_os" data-halign="center"
                                                    data-align="right">Port</th>
                                                <th data-field="nilai_instalasi" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_instalasi" data-halign="center"
                                                    data-align="right">Port</th>
                                                <th data-field="nilai_instal_done" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_instal_done" data-halign="center"
                                                    data-align="right">Port</th>
                                                <th data-field="nilai_selesai_ct" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_selesai_ct" data-halign="center"
                                                    data-align="right">Port</th>
                                                <th data-field="nilai_selesai_ut" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_selesai_ut" data-halign="center"
                                                    data-align="right">Port</th>
                                                <th data-field="nilai_rekon" data-halign="center" data-align="right">
                                                    Nilai</th>
                                                <th data-field="port_rekon" data-halign="center" data-align="right">
                                                    Port</th>
                                                <th data-field="nilai_bast" data-halign="center" data-align="right">
                                                    Nilai</th>
                                                <th data-field="port_bast" data-halign="center" data-align="right">
                                                    Port</th>
                                                <th data-field="total_nilai" data-halign="center" data-align="right">
                                                    Nilai</th>
                                                <th data-field="total_port" data-halign="center" data-align="right">
                                                    Port</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                    </div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <i class="fa fa-cog"></i>
                                    <h3 class="box-title"># Progress Golive</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="/ped-panel/report/progress-dev-filter" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">

                                                    <input type="text" class="form-control" name="tematik"
                                                        placeholder="TEMATIK">
                                                </div>
                                            </div><!-- /.col -->
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <select class="form-control select2" name="witel"
                                                        style="width: 100%;">
                                                        <option value="">Pilih Witel</option>
                                                        <option value="48">GORONTALO</option>
                                                        <option value="44">MAKASSAR</option>
                                                        <option value="49">MALUKU</option>
                                                        <option value="50">PAPUA</option>
                                                        <option value="51">PAPUA BARAT</option>
                                                        <option value="2">SULSELBAR</option>
                                                        <option value="45">SULTENG</option>
                                                        <option value="46">SULTRA</option>
                                                        <option value="47">SULUT MALUT</option>
                                                    </select>
                                                </div><!-- /.form-group -->

                                            </div><!-- /.col -->
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <select class="form-control select2" name="mitra"
                                                        style="width: 100%;">
                                                        <option value="">Pilih Mitra</option>
                                                        <?php
                                                        $witel = App\Models\MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                                                            ->where('admin_role_users.role_id', '4')
                                                            //->pluck('name', 'name');
                                                            ->get();
                                                        ?>
                                                        @foreach ($witel as $d)
                                                            <option value="{{ $d->id }}">{{ $d->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div><!-- /.form-group -->

                                            </div><!-- /.col -->
                                            <div class="col-md-2">
                                                <button class="btn btn-primary">Filter</button>
                                            </div>
                                        </div><!-- /.row -->
                                    </form>
                                    <table class="table table-bordered border-success" id="table-golive"
                                        data-toggle="table" data-buttons-class="primary"
                                        data-ajax-options="ajaxOptions" data-url="/ped-panel/api/progress-golive">
                                        <thead class="bg-yellow">
                                            <tr>
                                                <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                                                <th rowspan="2" data-field="target_project" data-halign="center"
                                                    data-align="right">
                                                    TARGET LOP</th>
                                                <th rowspan="2" data-field="target_port" data-halign="center"
                                                    data-align="right">
                                                    TARGET PORT </th>
                                                <th colspan="3" data-halign="center">INSTALL DONE</th>
                                                <th colspan="7" data-halign="center">PROGRESS GOLIVE (PORT)</th>
                                                <th colspan="5" data-halign="center">GAP INSTALL DONE VS GOLIVE
                                                </th>
                                            </tr>
                                            <tr>
                                                <th data-field="install_done" data-halign="center"
                                                    data-align="right">LOP</th>
                                                <th data-field="install_port" data-halign="center"
                                                    data-align="right">PORT</th>
                                                <th data-field="persen_done" data-halign="center" data-align="right">
                                                    % LOP</th>

                                                <th data-field="no_data" data-halign="center" data-align="right">NO
                                                    DATA</th>
                                                <th data-field="val_abd" data-halign="center" data-align="right">VAL
                                                    ABD</th>
                                                <th data-field="drawing" data-halign="center" data-align="right">
                                                    DRAWING</th>
                                                <th data-field="inventory" data-halign="center" data-align="right">
                                                    INVENTORY</th>
                                                <th data-field="terminasi_uim" data-halign="center"
                                                    data-align="right">TERMINASI UIM</th>
                                                <th data-field="golive" data-halign="center" data-align="right">
                                                    GOLIVE</th>
                                                <th data-field="persen_golive" data-halign="center"
                                                    data-align="right">% GL</th>

                                                <th data-field="delta_golive" data-halign="center"
                                                    data-align="right">DELTA GOLIVE</th>
                                                <th data-field="" data-halign="center" data-align="right">COMPLETING
                                                    ABD</th>
                                                <th data-field="" data-halign="center" data-align="right">QE NEEDED
                                                </th>
                                                <th data-field="" data-halign="center" data-align="right">OLT NEEDED
                                                </th>
                                                <th data-field="" data-halign="center" data-align="right">OGP GOLIVE
                                                </th>

                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_4">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <i class="fa fa-file"></i>
                                    <h3 class="box-title">#Posisi Dokumen Administrasi</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="/ped-panel/report/progress-dev-filter" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">

                                                    <input type="text" class="form-control" name="tematik"
                                                        placeholder="TEMATIK">
                                                </div>
                                            </div><!-- /.col -->
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <select class="form-control select2" name="witel"
                                                        style="width: 100%;">
                                                        <option value="">Pilih Witel</option>
                                                        <option value="48">GORONTALO</option>
                                                        <option value="44">MAKASSAR</option>
                                                        <option value="49">MALUKU</option>
                                                        <option value="50">PAPUA</option>
                                                        <option value="51">PAPUA BARAT</option>
                                                        <option value="2">SULSELBAR</option>
                                                        <option value="45">SULTENG</option>
                                                        <option value="46">SULTRA</option>
                                                        <option value="47">SULUT MALUT</option>
                                                    </select>
                                                </div><!-- /.form-group -->

                                            </div><!-- /.col -->
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <select class="form-control select2" name="mitra"
                                                        style="width: 100%;">
                                                        <option value="">Pilih Mitra</option>
                                                        <?php
                                                        $witel = App\Models\MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                                                            ->where('admin_role_users.role_id', '4')
                                                            //->pluck('name', 'name');
                                                            ->get();
                                                        ?>
                                                        @foreach ($witel as $d)
                                                            <option value="{{ $d->id }}">{{ $d->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div><!-- /.form-group -->

                                            </div><!-- /.col -->
                                            <div class="col-md-2">
                                                <button class="btn btn-primary">Filter</button>
                                            </div>
                                        </div><!-- /.row -->
                                    </form>
                                    <table class="table table-bordered border-success" id="table-administrasi"
                                        data-toggle="table" data-buttons-class="primary"
                                        data-ajax-options="ajaxOptions"
                                        data-url="/ped-panel/api/progress-administrasi">
                                        <thead class="bg-yellow">
                                            <tr>
                                                <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                                                <th colspan="3" data-halign="center">ALL PROJECT</th>
                                                <th colspan="3" data-halign="center">STATUS ADMINISTRASI</th>
                                                <th colspan="6" data-halign="center">POSISI DOKUMEN (NILAI)</th>

                                            </tr>
                                            <tr>
                                                <th data-field="all_project" data-halign="center" data-align="right">
                                                    LOP</th>
                                                <th data-field="all_nilai" data-halign="center" data-align="right">
                                                    NILAI</th>
                                                <th data-field="all_port" data-halign="center" data-align="right">
                                                    PORT</th>

                                                <th data-field="project_administrasi" data-halign="center"
                                                    data-align="right">LOP</th>
                                                <th data-field="nilai_administrasi" data-halign="center"
                                                    data-align="right">NILAI</th>
                                                <th data-field="port_administrasi" data-halign="center"
                                                    data-align="right">PORT</th>

                                                <th data-field="mitra_area" data-halign="center" data-align="right">
                                                    MITRA AREA</th>
                                                <th data-field="witel_area" data-halign="center" data-align="right">
                                                    WITEL</th>
                                                <th data-field="mitra_regional" data-halign="center"
                                                    data-align="right">MITRA REG</th>
                                                <th data-field="telkom_regional" data-halign="center"
                                                    data-align="right">TREG</th>
                                                <th data-field="dok_ok" data-halign="center" data-align="right">DOC
                                                    OK</th>
                                                <th data-field="persen_ok" data-halign="center" data-align="right">%
                                                    OK</th>


                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>



<script>
    $("#tab_1").load('/ped-panel/report/tb-dev');
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
