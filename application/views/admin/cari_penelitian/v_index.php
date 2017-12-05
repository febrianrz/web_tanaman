<?php $this->load->view('admin/v_header');?>
<link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
thead th {
  text-align: center;
}

.btn-flat{
  border-radius: 0;
}

.fa{
  font-size: 2.5em;
}

.fa-check-circle{
  color: #33dd00;
}

.fa-remove{
  color: #dd3300;
}
</style>
<!-- page content -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">
			<div class="row x_title">
				<div class="col-md-6">
					<h3><?php echo $title;?>
          </h3>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <form method="GET" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
            <label for="smallinput" class="control-label col-md-3 col-sm-3 col-xs-12">Judul Penelitian</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="judul_penelitian" class="form-control col-md-7 col-xs-12" id="smallinput" placeholder="Judul Penelitian" value="<?=$this->input->get('judul_penelitian');?>">
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <input style="width: 100%" type="submit" id="btnSave" value="Cari" class="btn btn-success">   
            </div>
          </div>
          <!-- <input type="hidden" name="status_simpan" value="1" id="status_simpan"> -->
        </form>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if($this->input->get('judul_penelitian')):?>
          <?php if($data):?>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                  <tr>
                  <th>Nama Tanaman</th>
                  <th>Nama Ilmiah</th>
                  <th>Famili</th>
                  <th>Pemanfaatan</th>
                  <th>Lokasi (Koordinat)</th>
                  <th>Peneliti</th>
                  <th>Nama Lembaga</th>
                  <th>Tempat Penelitian</th>
                  <th>Nama Etnis</th>
                  <th>Tujuan</th>
                  <th>Waktu Penelitian</th>
                  <th>Metode Penelitian</th>
                  <th>Ketinggian Lokasi</th>
                  <th>Bentuk Pemanfaatan</th>
                  <th>Kandungan</th>
                  <th>Cara Penggunaan</th>
                  <th>Khasiat</th>
                  <th>Media Tanam</th>
                  <th>Ciri Fisik</th>
                  <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $key): ?>
                    <tr>
                      <td><?= $key->nama_tanaman ?></td>
                      <td><?= $key->nama_ilmiah ?></td>
                      <td><?= $key->nama_famili ?></td>
                      <td><?= $key->pemanfaatan ?></td>
                      <td><?= $key->longitude ?> BT dan <?= $key->latitude ?> LS</td>
                      <td><?= $key->peneliti ?></td>
                      <td><?= $key->nama_lembaga ?></td>
                      <td><?= $key->tempat_penelitian ?></td>
                      <td><?= $key->nama_etnis ?></td>
                      <td><?= $key->tujuan ?></td>
                      <td><?= $key->waktu_penelitian ?></td>
                      <td><?= $key->metode_penelitian ?></td>
                      <td><?= $key->ketinggian_lokasi ?></td>
                      <td><?= $key->bentuk_pemanfaatan ?></td>
                      <td><?= $key->kandungan ?></td>
                      <td><?= $key->cara_penggunaan ?></td>
                      <td><?= $key->khasiat ?></td>
                      <td><?= $key->media_tanam ?></td>
                      <td><?= $key->ciri_fisik ?></td>
                      <td style="text-align: center;">
                        <a href="<?= base_url('admin/'.$url.'/detail/'.$key->id) ?>"><button class="btn btn-success btn-flat btn-xs">Detail</button></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
              </tbody>
            </table>
          <?php else:?>
            <center><i><strong><h4>Maaf, Data Tidak Ditemukan</h4></strong></i></center>
          <?php endif;?>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<br />
<!-- footer content -->
<?php $this->load->view('admin/v_footer');?>
<!-- Datatables-->
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.bootstrap.js"></script>
<script src="js/datatables/dataTables.buttons.min.js"></script>
<script src="js/datatables/buttons.bootstrap.min.js"></script>
<script src="js/datatables/jszip.min.js"></script>
<script src="js/datatables/pdfmake.min.js"></script>
<script src="js/datatables/vfs_fonts.js"></script>
<script src="js/datatables/buttons.html5.min.js"></script>
<script src="js/datatables/buttons.print.min.js"></script>
<script src="js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="js/datatables/dataTables.keyTable.min.js"></script>
<script src="js/datatables/dataTables.responsive.min.js"></script>
<script src="js/datatables/responsive.bootstrap.min.js"></script>
<script src="js/datatables/dataTables.scroller.min.js"></script>


<!-- pace -->
<script src="js/pace/pace.min.js"></script>
<script>
  var handleDataTableButtons = function() {
    "use strict";
    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
      dom: "Bfrtip",
      buttons: [{
        extend: "copy",
        className: "btn-sm"
      }, {
        extend: "csv",
        className: "btn-sm"
      }, {
        extend: "excel",
        className: "btn-sm"
      }, {
        extend: "pdf",
        className: "btn-sm"
      }, {
        extend: "print",
        className: "btn-sm"
      }],
      responsive: !0
    })
  },
  TableManageButtons = function() {
    "use strict";
    return {
      init: function() {
        handleDataTableButtons()
      }
    }
  }();
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
      keys: true
    });
    $('#datatable-responsive').DataTable({
      "order": [[ 0, "desc" ]]
    });
    $('#datatable-scroller').DataTable({
      ajax: "js/datatables/json/scroller-demo.json",
      deferRender: true,
      scrollY: 380,
      scrollCollapse: true,
      scroller: true
    });
    var table = $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });

    $('.input-sm').on('keyup',function(){
      var base_url = "<?php echo base_url('admin/donatur/printpdf?like=');?>";
      $('#link-print').attr('href',base_url+$(this).val());
    });
  });
  TableManageButtons.init();
</script>
</body>
</html>
