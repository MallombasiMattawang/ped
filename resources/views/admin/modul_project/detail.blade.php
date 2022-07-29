<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Project</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">Info</a></li>
                        <li><a href="#tab_2-2" data-toggle="tab">Feeder</a></li>
                        <li><a href="#tab_3-2" data-toggle="tab">Distribusi</a></li>
                        <li><a href="#odp" data-toggle="tab">ODP</a></li>
                        <li><a href="#odc" data-toggle="tab">ODC</a></li>
                        <li><a href="#summary-rab" data-toggle="tab">Summary & RAB</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>TIPE PROJECT</td>
                                    <td> {{ $data->tipe_project }} </td>
                                </tr>
                                <tr>
                                    <td>TEMATIK</td>
                                    <td> {{ $data->tematik }} </td>
                                </tr>
                                <tr>
                                    <td>NDE PERMINTAAN</td>
                                    <td> {{ $data->nde_permintaan }} </td>
                                </tr>
                                <tr>
                                    <td>PERIHAL NDE</td>
                                    <td> {{ $data->perihal_nde }} </td>
                                </tr>
                                <tr>
                                    <td>TANGGAL NDE</td>
                                    <td> {{ $data->tgl_nde }} </td>
                                </tr>
                                <tr>
                                    <td>NILAI PERMINTAAN</td>
                                    <td> {{ $data->nilai_permintaan }} </td>
                                </tr>
                                <tr>
                                    <td>NDE PERMINTAAN</td>
                                    <td> {{ $data->nde_pelimpahan }} </td>
                                </tr>
                                <tr>
                                    <td>NOMOR KONTRAK</td>
                                    <td> {{ $data->nomor_kontrak }} </td>
                                </tr>
                                <tr>
                                    <td>STATUS SAP</td>
                                    <td> {{ $data->status_sap }} </td>
                                </tr>
                                <tr>
                                    <td>WITEL </td>
                                    <td> {{ $data->witel_id }} </td>
                                </tr>
                                <tr>
                                    <td>STO</td>
                                    <td> {{ $data->sto_id }} </td>
                                </tr>
                                <tr>
                                    <td>LOP / SITE ID</td>
                                    <td> {{ $data->lop_site_id }} </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2-2">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 12</td>
                                    <td> {{ $data->feeder_ku_kap_12 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 24</td>
                                    <td> {{ $data->feeder_ku_kap_24 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 48</td>
                                    <td> {{ $data->feeder_ku_kap_48 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 96</td>
                                    <td> {{ $data->feeder_ku_kap_96 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 24</td>
                                    <td> {{ $data->feeder_kt_kap_24 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 48</td>
                                    <td> {{ $data->feeder_kt_kap_48 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 96</td>
                                    <td> {{ $data->feeder_kt_kap_96 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 144</td>
                                    <td> {{ $data->feeder_kt_kap_144 }} </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 288</td>
                                    <td> {{ $data->feeder_kt_kap_288 }} </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3-2">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KU KAP 24 SCPT</td>
                                    <td> {{ $data->distribusi_ku_kap_24_scpt }} </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KU KAP 12 SCPT</td>
                                    <td> {{ $data->distribusi_ku_kap_12_scpt }} </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KU KAP 8 SCPT</td>
                                    <td> {{ $data->distribusi_ku_kap_8_scpt }} </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KT KAP 24 SCPT</td>
                                    <td> {{ $data->distribusi_kt_kap_24_scpt }} </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KT KAP 12 SCPT</td>
                                    <td> {{ $data->distribusi_kt_kap_12_scpt }} </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KT KAP 8 SCPT</td>
                                    <td> {{ $data->distribusi_kt_kap_8_scpt }} </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="odc">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>ODC 48</td>
                                    <td> {{ $data->odc_odc_48 }} </td>
                                </tr>
                                <tr>
                                    <td>ODC 96</td>
                                    <td> {{ $data->odc_odc_96 }} </td>
                                </tr>
                                <tr>
                                    <td>ODC 144</td>
                                    <td> {{ $data->odc_odc_144 }} </td>
                                </tr>
                                <tr>
                                    <td>ODC 288</td>
                                    <td> {{ $data->odc_odc_288 }} </td>
                                </tr>
                                <tr>
                                    <td>ODC 576</td>
                                    <td> {{ $data->odc_576 }} </td>
                                </tr>
                                <tr>
                                    <td>ODC TOTAL</td>
                                    <td> {{ $data->odc_total }} </td>
                                </tr>
                            </table>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="odp">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>ODP 8</td>
                                    <td> {{ $data->odp_odp_8 }} </td>
                                </tr>
                                <tr>
                                    <td>ODP 16</td>
                                    <td> {{ $data->odp_odp_16 }} </td>
                                </tr>
                                <tr>
                                    <td>ODP SPL 18</td>
                                    <td> {{ $data->odp_spl_1_8 }} </td>
                                </tr>
                                <tr>
                                    <td>ODP SPL 16</td>
                                    <td> {{ $data->odp_spl_1_16 }} </td>
                                </tr>
                                <tr>
                                    <td>ODP PORT</td>
                                    <td> {{ $data->odp_port }} </td>
                                </tr>
                                <tr>
                                    <td>CATUAN JENIS</td>
                                    <td> {{ $data->catuan_jenis }} </td>
                                </tr>
                                <tr>
                                    <td>CATUAN NAMA</td>
                                    <td> {{ $data->catuan_nama }} </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="summary-rab">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>PANJANG FEEDER</td>
                                    <td> {{ $data->panjang_feeder }} </td>
                                </tr>
                                <tr>
                                    <td>PANJANG DIST</td>
                                    <td> {{ $data->panjang_dist }} </td>
                                </tr>
                                <tr>
                                    <td>TIANG BARU</td>
                                    <td> {{ $data->tiang_baru }} </td>
                                </tr>
                                <tr>
                                    <td>JARAK KE STO</td>
                                    <td> {{ $data->jarak_ke_sto }} </td>
                                </tr>
                                <tr>
                                    <td>JUMLAH HOMEPASS</td>
                                    <td> {{ $data->jml_home_pass }} </td>
                                </tr>
                                <tr>
                                    <td>RAB MATERIAL</td>
                                    <td> {{ separator($data->rab_material) }} </td>
                                </tr>
                                <tr>
                                    <td>RAB SURVEY</td>
                                    <td> {{ separator($data->rab_survey) }} </td>
                                </tr>
                                <tr>
                                    <td>RAB TOTAL</td>
                                    <td> {{ separator($data->rab_total) }} </td>
                                </tr>
                                <tr>
                                    <td>NILAI CAPEX PER PORT</td>
                                    <td> {{ separator($data->nilai_capex_per_port) }} </td>
                                </tr>
                                <tr>
                                    <td>MITRA</td>
                                    <td> {{ $data->mitra_id }} </td>
                                </tr>
                                <tr>
                                    <td>STATUS PROJECT</td>
                                    <td> {{ $data->status_project }} </td>
                                </tr>
                                <tr>
                                    <td>WASPANG</td>
                                    <td> {{ $data->waspang_id }} </td>
                                </tr>
                                <tr>
                                    <td>START PROJECT</td>
                                    <td> {{ $data->start_date }} </td>
                                </tr>
                                <tr>
                                    <td>FINISH PROJECT</td>
                                    <td> {{ $data->end_date }} </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->

    </div>
    <!-- /.col -->
    {{-- <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Menu</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Baseline Project</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Planing Activity</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Actual Activity</a></li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="info-box bg-maroon">
            <span class="info-box-icon"><i class="fa fa-plane"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Progress Plan</span>
                <span class="info-box-number">
                    10 %

                </span>

                <div class="progress">
                    <div class="progress-bar" style="width: 10%"></div>
                </div>
                <span class="progress-description">
                    Total Durasi 10 Hari
                </span>
            </div>
        </div>

        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Progress Actual</span>
                <span class="info-box-number">
                    {{ isset($supervisi->progress_actual) ? $supervisi->progress_actual : 0 }} %
                </span>
                <div class="progress">
                    <div class="progress-bar" style="width: {{ isset($supervisi->progress_actual) ? $supervisi->progress_actual : 0 }}%"></div>
                </div>
                <span class="progress-description">
                    Total Durasi 0 Hari
                </span>
            </div>
        </div>

        <div class="info-box bg-blue">
          <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
  
          <div class="info-box-content">
              <span class="info-box-text">Progress Administrasi</span>
              <span class="info-box-number">
                 
                      0 %
                 
  
              </span>
              <div class="progress">
                  <div class="progress-bar" style="width: 0%"></div>
              </div>
          </div>
          <!-- /.info-box-content -->
      </div>
    </div> --}}


    <!-- /.col -->
</div>
