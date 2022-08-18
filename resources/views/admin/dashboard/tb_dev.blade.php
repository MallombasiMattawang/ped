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

                                <input type="text" class="form-control" name="tematik" placeholder="TEMATIK">
                            </div>
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">

                                <select class="form-control select2" name="witel" style="width: 100%;">
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
                        <div class="col-md-4">
                            <div class="form-group">

                                <select class="form-control select2" name="mitra" style="width: 100%;">
                                    <option value="">Pilih Mitra</option>
                                    <?php
                                    $witel = App\Models\MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                                        ->where('admin_role_users.role_id', '4')
                                        //->pluck('name', 'name');
                                        ->get();
                                    ?>
                                    @foreach ($witel as $d)
                                        <option value="{{ $d->name }}">{{ $d->name }}
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

                <table class="table table-bordered border-success" id="table-dev" data-toggle="table"
                    data-buttons-class="primary" data-ajax-options="ajaxOptions" data-url="/ped-panel/api/progress-dev">
                    <thead class="bg-yellow">
                        <tr>
                            <th rowspan="2" data-field="witel" data-halign="center">WITEL</th>
                            <th colspan="4" data-halign="center">KONSTRUKSI</th>
                            <th colspan="4" data-halign="center">ADMINISTRASI</th>
                            <th colspan="4" data-halign="center">TOTAL</th>
                        </tr>
                        <tr>
                            <th data-field="lop_konstruksi" data-halign="center" data-align="right">
                                LOP</th>
                            <th data-field="nilai_konstruksi_real" data-halign="center" data-align="right">NILAI</th>
                            <th data-field="port_konstruksi_real" data-halign="center" data-align="right">PORT</th>
                            <th data-field="persen_konstruksi" data-halign="center" data-align="right">%</th>
                            <th data-field="lop_administrasi" data-halign="center" data-align="right">LOP</th>
                            <th data-field="nilai_administrasi_real" data-halign="center" data-align="right">NILAI</th>
                            <th data-field="port_administrasi_real" data-halign="center" data-align="right">PORT</th>
                            <th data-field="persen_administrasi" data-halign="center" data-align="right">%</th>
                            <th data-field="lop_total" data-halign="center" data-align="right">LOP
                            </th>
                            <th data-field="nilai_total" data-halign="center" data-align="right">
                                NILAI</th>
                            <th data-field="port_total" data-halign="center" data-align="right">
                                PORT</th>
                            <th data-field="persen_total" data-halign="center" data-align="right">%</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        {{ $tematik }}
        @if ($tematik)
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-cog"></i>
                    <h3 class="box-title"># hasil Filter</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">


                    <table class="table table-bordered border-success" id="table-dev" data-toggle="table"
                        data-buttons-class="primary" data-ajax-options="ajaxOptions"
                        data-url="/ped-panel/api/progress-dev-">
                        <thead class="bg-blue">
                            <tr>
                                <th rowspan="2" data-field="witel" data-halign="center">MITRA</th>
                                <th colspan="4" data-halign="center">KONSTRUKSI</th>
                                <th colspan="4" data-halign="center">ADMINISTRASI</th>
                                <th colspan="4" data-halign="center">TOTAL</th>
                            </tr>
                            <tr>
                                <th data-field="lop_konstruksi" data-halign="center" data-align="right">
                                    LOP</th>
                                <th data-field="nilai_konstruksi_real" data-halign="center" data-align="right">NILAI
                                </th>
                                <th data-field="port_konstruksi_real" data-halign="center" data-align="right">PORT
                                </th>
                                <th data-field="persen_konstruksi" data-halign="center" data-align="right">%</th>
                                <th data-field="lop_administrasi" data-halign="center" data-align="right">LOP</th>
                                <th data-field="nilai_administrasi_real" data-halign="center" data-align="right">
                                    NILAI</th>
                                <th data-field="port_administrasi_real" data-halign="center" data-align="right">PORT
                                </th>
                                <th data-field="persen_administrasi" data-halign="center" data-align="right">%</th>
                                <th data-field="lop_total" data-halign="center" data-align="right">LOP
                                </th>
                                <th data-field="nilai_total" data-halign="center" data-align="right">
                                    NILAI</th>
                                <th data-field="port_total" data-halign="center" data-align="right">
                                    PORT</th>
                                <th data-field="persen_total" data-halign="center" data-align="right">%</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        @endif


    </div>
</div>


<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
