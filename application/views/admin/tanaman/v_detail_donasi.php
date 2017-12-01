<?php $this->load->view('admin/v_header');?>
<!-- page content -->
<style>
	table tr{
		font-size: 1.3em;
	}
	table th{
		text-align: center;
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
						<th>Jenis Donasi</th>
						<td>: <?php echo ucfirst($donasi->periode);?></td>
					</tr>
					<tr>
						<th>Keterangan</th>
						<td>
							<?php //ota
							if($donasi->id_jenis_donasi == 1): ?>
								<ul>
									<?php foreach($detailota->result() as $key):?>
										<li>
											Rp<?php echo number_format($key->nominal).' x '.$key->total_anak_asuh.' '.$key->nama;?>
										</li>
									<?php endforeach;?>
								</ul>
							<?php endif;?>
						</td>
					</tr>
					<?php if($donasi->id_jenis_donasi == 1): ?>
					<tr>
						<th style="text-align: right"><small>Anak Asuh</small></th>
						<td>:
							<?php //ota
							if($anakasuh->num_rows() == 0): ?>
								<a href="<?php echo base_url('admin/donatur/set?donatur='.$row->id.'&donasi='.$this->input->get('donasi', true));?>"><button class="btn btn-success btn-xs">Kaitkan</button></a>
							<?php else:?>
								<a href="<?php echo base_url('admin/donatur/set?donatur='.$row->id.'&donasi='.$this->input->get('donasi', true));?>"><button class="btn btn-primary btn-xs">Edit</button></a>&nbsp;
								<?php foreach($anakasuh->result() as $key):?>
									<a href="<?php echo base_url('admin/anakasuh/detail/'.$key->id);?>"><?php echo $key->nama;?></a>,
								<?php endforeach;?>
							<?php endif;?>
						</td>
					</tr>
					<?php endif;?>
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
				<button type="button" id="tambah-pembayaran" class="btn btn-default btn-flat" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Data Anak Asuh</h4>
							</div>
							<div class="modal-body">
								<form action="<?php echo base_url('admin/donatur/storePembayaran');?>" id="savepembayaran" method="post">
									<div class="form-group">
										<label for="kode">Kode Donatur</label>
										<input type="text" name="donatur" class="form-control" value="<?php echo $row->id;?>" readonly="readonly">
									</div>
<!--									<div class="form-group">-->
<!--										<label for="kode">Kode Donasi</label>-->
										<input type="hidden" name="donasi" class="form-control" value="<?php echo $this->input->get('donasi');?>" readonly="readonly">
<!--									</div>-->
									<div class="form-group">
										<label for="kode">Nominal</label>
										<input type="number" name="nominal" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="kode">Keterangan</label>
										<textarea name="keterangan" id="" class="form-control" required></textarea>
									</div>

							</div>
							<div class="modal-footer">
								<button class="btn btn-primary" id="saveModal">Simpan</button>
								</form>

								<button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Close</button>

							</div>

						</div>
					</div>
				</div>
				<br><br>

				<table class="table table-striped table-bordered">
					<thead>
					<th width="10">No</th>
					<th>Keterangan</th>
					<th>Nominal</th>
					<th>Tanggal</th>
					<th>Hapus</th>
					</thead>
					<tbody>
					<?php $total = 0;$no=1;foreach($pembayaran->result() as $key):?>
						<tr>
							<td style="text-align: center"><?php echo $no;?></td>
							<td><?php echo $key->keterangan;?></td>
							<td style="text-align: center;">Rp<?php echo number_format($key->nominal);?></td>
							<td style="text-align: center;"><?php echo date('d F Y - H:i', strtotime($key->tanggal_dibuat));?> WIB</td>
							<td style="text-align: center;"><button class="btn btn-danger" onclick="hapusPembayaran('<?php echo $key->id;?>')">Hapus</button></td>
						</tr>
					<?php $total += $key->nominal;$no++;endforeach;?>
					</tbody>
					<tfoot>
					<tr>
						<th colspan="2" style="text-align: center;">Total</th>
						<th style="text-align: center;">Rp<?php echo number_format($total);?></th>
					</tr>
					</tfoot>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- footer content -->
<?php $this->load->view('admin/v_footer');?>
<script>
	$(document).ready(function(){
		$("#savepembayaran").submit(function(){
			$.post("<?php echo base_url('admin/donatur/storePembayaran');?>",$(this).serialize(), function(data){
				if(data.status) {
					alert(data.msg);
					window.location.reload(true);
				} else
					alert(data.msg);
			}, 'json');
			return false;
		});
	})

	function hapusPembayaran(idpembayaran){
		if(confirm('Apakah anda yakin ingin menghapus?')){
			$.post("<?php echo base_url('admin/donatur/deletePembayaran');?>",{id:idpembayaran}, function(data){
				if(data.status)
					window.location.reload(true);
				else
					alert(data.msg);
			}, 'json');
		}
	}
</script>
</body>
</html>