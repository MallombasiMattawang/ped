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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <i class="fa fa-cog"></i>
                                    <h3 class="box-title"># Progress Development</h3>
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

                                    <table class="table table-bordered border-success">
                                        <thead class="bg-blue">
                                            <tr>
                                                <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                                                <th rowspan="2" data-field="witel" data-halign="center">MITRA</th>

                                                <th colspan="4" data-halign="center">KONSTRUKSI</th>
                                                <th colspan="4" data-halign="center">ADMINISTRASI</th>
                                            </tr>
                                            <tr>
                                                <th data-field="lop_konstruksi" data-halign="center" data-align="right">
                                                    LOP</th>
                                                <th data-field="nilai_konstruksi_real" data-halign="center"
                                                    data-align="right">NILAI</th>
                                                <th data-field="port_konstruksi_real" data-halign="center"
                                                    data-align="right">PORT</th>
                                                <th data-field="persen_konstruksi" data-halign="center"
                                                    data-align="right">%</th>
                                                <th data-field="lop_administrasi" data-halign="center"
                                                    data-align="right">LOP</th>
                                                <th data-field="nilai_administrasi_real" data-halign="center"
                                                    data-align="right">NILAI</th>
                                                <th data-field="port_administrasi_real" data-halign="center"
                                                    data-align="right">PORT</th>
                                                <th data-field="persen_administrasi" data-halign="center"
                                                    data-align="right">%</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($query as $q)
                                                <?php
                                                $lop_konstruksi = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [1, 95])
                                                    ->count();
                                                $nilai_konstruksi_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNotNull('real_nilai')
                                                    ->whereBetween('progress_actual', [1, 95])
                                                    ->sum('real_nilai');
                                                $nilai_konstruksi_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNull('real_nilai')
                                                    ->whereBetween('progress_actual', [1, 95])
                                                    ->sum('plan_nilai');
                                                $port_konstruksi_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNotNull('real_port')
                                                    ->whereBetween('progress_actual', [1, 95])
                                                    ->sum('real_port');
                                                $port_konstruksi_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNull('real_port')
                                                    ->whereBetween('progress_actual', [1, 95])
                                                    ->sum('plan_port');
                                                
                                                $nilai_administrasi_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNotNull('real_nilai')
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->sum('real_nilai');
                                                $nilai_administrasi_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNull('real_nilai')
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->sum('plan_nilai');
                                                
                                                $port_administrasi_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNotNull('real_port')
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->sum('real_port');
                                                $port_administrasi_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNull('real_port')
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->sum('plan_port');
                                                
                                                $lop_administrasi = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->count();
                                                $lop_total = $lop_konstruksi + $lop_administrasi;
                                                ?>
                                                <tr>
                                                    <td>{{ $q->supervisi_project->witel_id }}</td>
                                                    <td>{{ $q->supervisi_project->mitra_id }}/LOP :
                                                        {{ $q->project_name }}</td>
                                                    <td>{{ $lop_konstruksi }}</td>
                                                    <td>{{ singkat_angka($nilai_konstruksi_real + $nilai_konstruksi_plan) }}
                                                    </td>
                                                    <td>{{ $port_konstruksi_real + $port_konstruksi_plan }}</td>
                                                    <td>{{ $lop_konstruksi != 0 ? round($lop_konstruksi / $d->lop_total, 1) * 100 : 0 }}%
                                                    </td>
                                                    <td>{{ $lop_administrasi }}</td>
                                                    <td>{{ singkat_angka($nilai_administrasi_real + $nilai_administrasi_plan) }}
                                                    </td>
                                                    <td>{{ $port_administrasi_real + $port_administrasi_plan }}</td>
                                                    <td>{{ $lop_administrasi != 0 ? round($lop_administrasi / $lop_total, 1) * 100 : 0 }}%
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>




                        </div>
                    </div>
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
                                        data-toggle="table" data-buttons-class="primary"
                                        data-ajax-options="ajaxOptions" data-url="/ped-panel/api/progress-konstruksi">
                                        <thead class="bg-blue">
                                            <tr>
                                                <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                                                <th rowspan="2" data-field="witel" data-halign="center">MITRA</th>
                                                <th colspan="2" data-halign="center">01. Preparing</th>
                                                <th colspan="2" data-halign="center">02. Mat Delivery </th>
                                                <th colspan="2" data-halign="center">03. MOS</th>
                                                <th colspan="2" data-halign="center">04. Instalasi</th>
                                                <th colspan="2" data-halign="center">05. Install Done</th>
                                                <th colspan="2" data-halign="center">06. Selesai CT</th>
                                                <th colspan="2" data-halign="center">07. Selesai UT</th>
                                                <th colspan="2" data-halign="center">08. Rekon</th>
                                                <th colspan="2" data-halign="center">09. BAST-1</th>

                                            </tr>
                                            <tr>
                                                <th data-field="nilai_preparing" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_preparing" data-halign="center"
                                                    data-align="right">Port</th>
                                                <th data-field="nilai_delivery" data-halign="center"
                                                    data-align="right">Nilai</th>
                                                <th data-field="port_delivery" data-halign="center"
                                                    data-align="right">Port</th>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($query as $q)
                                                <?php
                                                $nilai_preparing = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'PREPARING')
                                                    ->sum('plan_nilai');
                                                $port_preparing = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'PREPARING')
                                                    ->sum('plan_port');
                                                
                                                $nilai_delivery = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'MATERIAL DELIVERY')
                                                    ->sum('plan_nilai');
                                                $port_delivery = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'MATERIAL DELIVERY')
                                                    ->sum('plan_port');
                                                
                                                $nilai_delivery_os = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'MATERIAL DELIVERY ON SITE')
                                                    ->sum('plan_nilai');
                                                $port_delivery_os = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'MATERIAL DELIVERY ON SITE')
                                                    ->sum('plan_port');
                                                
                                                $nilai_instalasi = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'INSTALASI')
                                                    ->sum('plan_nilai');
                                                $port_instalasi = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'INSTALASI')
                                                    ->sum('plan_port');
                                                
                                                $nilai_instal_done = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'INSTALL DONE')
                                                    ->sum('plan_nilai');
                                                $port_instal_done = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'INSTALL DONE')
                                                    ->sum('plan_port');
                                                
                                                $nilai_selesai_ct = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'SELESAI CT')
                                                    ->sum('plan_nilai');
                                                $port_selesai_ct = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'SELESAI CT')
                                                    ->sum('plan_port');
                                                
                                                $nilai_selesai_ut = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'SELESAI UT')
                                                    ->sum('plan_nilai');
                                                $port_selesai_ut = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'SELESAI UT')
                                                    ->sum('plan_port');
                                                
                                                $nilai_rekon = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'REKON')
                                                    ->sum('plan_nilai');
                                                $port_rekon = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'REKON')
                                                    ->sum('plan_port');
                                                
                                                $nilai_bast = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'BAST-1')
                                                    ->sum('plan_nilai');
                                                $port_bast = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_const', 'BAST-1')
                                                    ->sum('plan_port');
                                                ?>
                                                <tr>
                                                    <td>{{ $q->supervisi_project->witel_id }}</td>
                                                    <td>{{ $q->supervisi_project->mitra_id }}/LOP :
                                                        {{ $q->project_name }}</td>
                                                    <td>{{ singkat_angka($nilai_preparing) }}</td>
                                                    <td>{{ $port_preparing }}</td>
                                                    <td>{{ singkat_angka($nilai_delivery) }}</td>
                                                    <td>{{ $port_delivery }}</td>
                                                    <td>{{ singkat_angka($nilai_delivery_os) }}</td>
                                                    <td>{{ $port_delivery_os }}</td>
                                                    <td>{{ singkat_angka($nilai_instalasi) }}</td>
                                                    <td>{{ $port_instalasi }}</td>
                                                    <td>{{ singkat_angka($nilai_instal_done) }}</td>
                                                    <td>{{ $port_instal_done }}</td>
                                                    <td>{{ singkat_angka($nilai_selesai_ct) }}</td>
                                                    <td>{{ $port_selesai_ct }}</td>
                                                    <td>{{ singkat_angka($nilai_selesai_ut) }}</td>
                                                    <td>{{ $port_selesai_ut }}</td>
                                                    <td>{{ singkat_angka($nilai_rekon) }}</td>
                                                    <td>{{ $port_rekon }}</td>
                                                    <td>{{ singkat_angka($nilai_bast) }}</td>
                                                    <td>{{ $port_bast }}</td>



                                                </tr>
                                            @endforeach
                                        </tbody>
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
                                        <thead class="bg-blue">
                                            <tr>
                                                <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                                                <th rowspan="2" data-field="target_project" data-halign="center"
                                                    data-align="right">
                                                    MITRA/ LOP</th>
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
                                        <tbody>
                                            @foreach ($query as $q)
                                                <?php
                                                $target_project = App\Models\TranSupervisi::where('id', $q->id)->count();
                                                $target_port = App\Models\TranSupervisi::where('id', $q->id)->sum('plan_port');
                                                
                                                $install_done = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [88, 100])
                                                    ->count();
                                                $install_port = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [88, 100])
                                                    ->sum('real_port');
                                                $persen_done = $install_port != 0 ? round($install_done / $target_project, 1) * 100 . ' %' : 0;
                                                $no_data = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNull('status_gl_sdi')
                                                    ->count();
                                                $val_abd = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_gl_sdi', 'VALIDASI ABD')
                                                    ->count();
                                                $drawing = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_gl_sdi', 'DRAWING')
                                                    ->count();
                                                $inventory = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_gl_sdi', 'INVENTORY')
                                                    ->count();
                                                $terminasi_uim = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_gl_sdi', 'TERMINASI UIM')
                                                    ->count();
                                                $golive = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('status_gl_sdi', 'GOLIVE')
                                                    ->count();
                                                $persen_golive = $golive != 0 ? round($golive / $target_port, 1) * 100 . ' %' : 0;
                                                $delta_golive = $golive - $install_done;
                                                ?>
                                                <tr>
                                                    <td>{{ $q->supervisi_project->witel_id }}</td>
                                                    <td>{{ $q->supervisi_project->mitra_id }}/LOP :
                                                        {{ $q->project_name }}</td>
                                                    <td>{{ $target_port }}</td>
                                                    <td>{{ $install_done }}</td>
                                                    <td>{{ $install_port }}</td>
                                                    <td>{{ $persen_done }}</td>
                                                    <td>{{ $no_data }}</td>
                                                    <td>{{ $val_abd }}</td>
                                                    <td>{{ $drawing }}</td>
                                                    <td>{{ $inventory }}</td>
                                                    <td>{{ $terminasi_uim }}</td>
                                                    <td>{{ $golive }}</td>
                                                    <td>{{ $persen_golive }}</td>
                                                    <td>{{ $delta_golive }}</td>


                                                </tr>
                                            @endforeach
                                        </tbody>
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
                                    <table class="table table-bordered border-success">
                                        <thead class="bg-blue">
                                            <tr>
                                                <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                                                <th rowspan="2" data-field="witel" data-halign="center">MITRA</th>

                                                <th colspan="3" data-halign="center">STATUS ADMINISTRASI</th>
                                                <th colspan="6" data-halign="center">POSISI DOKUMEN (NILAI)</th>

                                            </tr>
                                            <tr>


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
                                        <tbody>
                                            @foreach ($query as $q)
                                                <?php
                                                $all_project = App\Models\TranSupervisi::where('id', $q->id)->count();
                                                $all_nilai_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNull('real_nilai')
                                                    ->sum('plan_nilai');
                                                $all_nilai_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNotNull('real_nilai')
                                                    ->sum('real_nilai');
                                                
                                                $all_port_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNull('real_port')
                                                    ->sum('plan_port');
                                                $all_port_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereNotNull('real_port')
                                                    ->sum('real_port');
                                                
                                                $project_administrasi = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->count();
                                                $nilai_administrasi_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->whereNull('real_nilai')
                                                    ->sum('plan_nilai');
                                                $nilai_administrasi_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->whereNotNull('real_nilai')
                                                    ->sum('real_nilai');
                                                $port_administrasi_plan = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->whereNull('real_port')
                                                    ->sum('plan_port');
                                                $port_administrasi_real = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->whereBetween('progress_actual', [96, 100])
                                                    ->whereNotNull('real_port')
                                                    ->sum('real_port');
                                                
                                                $mitra_area = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('posisi_doc', 'MITRA AREA')
                                                    ->count();
                                                $witel_area = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('posisi_doc', 'WITEL')
                                                    ->count();
                                                $mitra_regional = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('posisi_doc', 'MITRA REGIONAL')
                                                    ->count();
                                                $telkom_regional = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('posisi_doc', 'TELKOM REGIONAL')
                                                    ->count();
                                                $dok_ok = App\Models\TranSupervisi::where('id', $q->id)
                                                    ->where('progress_doc', 'FINISH')
                                                    ->count();
                                                ?>
                                                <tr>
                                                    <td>{{ $q->supervisi_project->witel_id }}</td>
                                                    <td>{{ $q->supervisi_project->mitra_id }}/LOP :
                                                        {{ $q->project_name }}</td>
                                                    <td>{{ $project_administrasi }}</td>
                                                    <td>{{ singkat_angka($nilai_administrasi_plan + $nilai_administrasi_real) }}</td>
                                                    <td>{{ singkat_angka($port_administrasi_plan + $port_administrasi_real) }}</td>
                                                    <td>{{ $mitra_area }}</td>
                                                    <td>{{ $witel_area }}</td>
                                                    <td>{{ $mitra_regional }}</td>
                                                    <td>{{ $telkom_regional }}</td>
                                                    <td>{{ $dok_ok }}</td>
                                                    <td>{{ ($dok_ok != 0) ? Round($dok_ok / $project_administrasi, 1) * 100 . ' %' : 0 }}</td>


                                                </tr>
                                            @endforeach
                                        </tbody>
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
