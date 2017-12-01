<?php $this->load->view('admin/v_header');?>
<!-- page content -->
<style>
	table tr{
		font-size: 1.3em;
	}
</style>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">
			<div class="row x_title">
				<div class="col-md-6">
					<h3><?php echo $title;?></h3>
				</div>
				<div class="col-md-6">
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php if($row){ ?>
					<table class="table table-striped">
						<tr>
							<th width="200">Kode Donatur</th>
							<td>: <?php echo $row->id;?></td>
						</tr>
						<tr>
							<th>Nama Donatur</th>
							<td>: <?php echo $row->nama;?></td>
						</tr>
						<tr>
							<th>Jenis Donasi</th>
							<td>: <?php echo $donasi->jenisdonasi;?></td>
						</tr>
						<tr>
							<th>Nominal</th>
							<td>: Rp<?php echo number_format($donasi->nominal);?></td>
						</tr>
					</table>
				<?php } else { ?>
					<div class="alert alert-danger">
						<strong>Maaf,</strong> data tidak tersedia.
					</div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">
			<div class="row x_title">
				<div class="col-md-6">
					<h3><?php echo $title2;?></h3>
				</div>
				<div class="col-md-6">
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<button type="button" id="tambah-anakasuh" class="btn btn-default btn-flat" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Data Anak Asuh</h4>
							</div>
							<div class="modal-body">
								<table class="table table-striped table-bordered" id="table-tambah-anakasuh">
									<thead>
									<tr>
										<th>No</th>
										<th>Pilih</th>
										<th>Kode</th>
										<th>Nama Anak Asuh</th>
										<th>Tanggal Lahir</th>
										<th>Jenis Kelamin</th>
									</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Close</button>
							</div>

						</div>
					</div>
				</div>
				<br><br>

				<table class="table table-striped table-bordered" id="datatable">
					<thead>
					<th width="10">No</th>
					<th width="100">Kode</th>
					<th>Nama Anak Asuh</th>
					<th>Jenis Kelamin</th>
					<th>Hapus</th>
					</thead>
					<tbody>
					<?php $no=1;foreach($anakasuh->result() as $key): ?>
						<tr>
							<td style="text-align: center"><?php echo $no;?></td>
							<td><?php echo $key->id;?></td>
							<td><?php echo $key->nama;?></td>
							<td><?php echo $key->jkel;?></td>
							<td style="text-align: center"><button class="btn btn-danger btn-xs" onclick="hapusAnakAsuhTable(<?php echo $key->id;?>)">X</button></td>
						</tr>
					<?php $no++;endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
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

//		$('#datatable').dataTable();
	});
	TableManageButtons.init();
</script>
<link href="<?php echo base_url('assets/frontend/icheck');?>/skins/square/blue.css" rel="stylesheet">
<script src="<?php echo base_url('assets/frontend/icheck');?>/icheck.js"></script>
<script>

	$('#tambah-anakasuh').on('click', function(){

		anaksaatini = parseInt($("#datatable tbody tr").length);
		maksimalanak = <?php echo $donasi->keterangan_1;?>;
			if(anaksaatini >= maksimalanak) {
				alert("Maaf, Batas Maksimal Anak Sudah Habis");
				return false;
			} else {
				//ambil semua anak asuh kecuali yg sudah dipilih
				$.post("<?php echo base_url('admin/donatur/getAnakAsuhDonatur/');?>", {
					id:<?php echo $row->id;?>,
					status: ''
				}, function (data) {

					html = "";
					no = 1;
					$.each(data, function (key, value) {
						html += "<tr>";
						html += "<td style='text-align: center'>" + no + "</td>";
						html += "<td style='text-align: center'><input type='checkbox' value='" + value.id + "' class='checkanakasuh'/></td>";
						html += "<td>" + value.id + "</td>";
						html += "<td>" + value.nama + "</td>";
						html += "<td>" + value.tgl_lahir + "</td>";
						html += "<td>" + value.jkel + "</td>";
						html += "</tr>";
						no++;
					});
					$("#table-tambah-anakasuh tbody").html(html);
					$('.checkanakasuh').iCheck({
						checkboxClass: 'icheckbox_square-blue',
						radioClass: 'iradio_square',
						increaseArea: '20%' // optional
					});

					$('.checkanakasuh').on('ifChecked', function (event) {
						$.post("<?php echo base_url('admin/donatur/storeAnakAsuh');?>", {
							anakasuh: $(this).val(),
							donatur: "<?php echo $row->id;?>",
							donasi: "<?php echo $this->input->get('donasi');?>"
						}, function (data) {
							if (!data.status)
								alert(data.msg);
						}, 'json');
					});

					$('.checkanakasuh').on('ifUnchecked', function (event) {
						hapusAnakAsuh($(this).val());
					});
				}, 'json');
			}
	});

	$("#closeModal").on('click',function(){
		refreshAnakAsuh();
	});

	function hapusAnakAsuh(idanakasuh){
		$.post("<?php echo base_url('admin/donatur/deleteAnakAsuh');?>", {anakasuh:idanakasuh,donatur:"<?php echo $row->id;?>",donasi:"<?php echo $this->input->get('donasi');?>"}, function(data){
			if(!data.status)
				alert(data.msg);
		},'json');
		refreshAnakAsuh();
	}

	function hapusAnakAsuhTable(idanakasuh){
		if(confirm("Apakah Anda Yakin Ingin Menghapus ?"))
			hapusAnakAsuh(idanakasuh);
		refreshAnakAsuh();
	}

	function refreshAnakAsuh(){
		$.post("<?php echo base_url('admin/donatur/getAnakAsuhDonatur');?>",{id:<?php echo $row->id;?>,status:'all'},function(data){
			html = "";
			no = 1;
			$.each(data, function(key, value){
				html += "<tr>";
				html += "<td style='text-align: center'>"+no+"</td>";
				html += "<td>"+value.id+"</td>";
				html += "<td>"+value.nama+"</td>";
				html += "<td>"+value.jkel+"</td>";
				html += "<td style='text-align: center'><button class='btn btn-danger btn-xs' onclick='hapusAnakAsuhTable("+value.id+")'>X</button></td>";
				html += "</tr>";
				no++;
			});
			$("#datatable tbody").html(html);
//			$('#datatable').dataTable();
		},'json');
	}
</script>
</body>
</html>