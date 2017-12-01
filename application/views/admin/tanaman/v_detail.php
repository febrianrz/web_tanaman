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
						<th width="200">Nama Tanaman</th>
						<td><?= $row->nama_tanaman ?></td>
					</tr>
					<tr>
						<th>Nama Ilmiah</th>
						<td><?= $row->nama_ilmiah ?></td>
					</tr>
					<tr>
						<th>Famili</th>
						<td><?= $famili->nama ?></td>
					</tr>
		            <tr>
						<th>Pemanfaatan</th>
						<td><?= $row->pemanfaatan ?></td>
					</tr>
		            <tr>
						<th>Latitude</th>
						<td><?= $row->latitude ?></td>
					</tr>
		             <tr>
						<th>Longitude</th>
						<td><?= $row->longitude ?></td>
					</tr>
					 <tr>
						<th>Peneliti</th>
						<td><?= $row->peneliti ?></td>
					</tr>
		             <tr>
						<th>Nama Lembaga</th>
						<td><?= $row->nama_lembaga ?></td>
					</tr>
		             <tr>
						<th>Tempat Penelitian</th>
						<td><?= $row->tempat_penelitian ?></td>
					</tr>
		            <tr>
						<th>Nama Etnis</th>
						<td><?= $row->nama_etnis ?></td>
					</tr>
		            <tr>
						<th>Tujuan</th>
						<td><?= $row->tujuan ?></td>
					</tr>
		             <tr>
						<th>Waktu Penelitian</th>
						<td><?= $row->waktu_penelitian ?></td>
					</tr>
		             <tr>
						<th>Metode Penelitian</th>
						<td><?= $row->metode_penelitian ?></td>
					</tr>
		             <tr>
						<th>Ketinggian Lokasi</th>
						<td><?= $row->ketinggian_lokasi ?></td>
					</tr>
		             <tr>
						<th>Bentuk Pemanfaatan</th>
						<td><?= $row->bentuk_pemanfaatan ?></td>
					</tr>
		             <tr>
						<th>Kandungan</th>
						<td><?= $row->kandungan ?></td>
					</tr>
		             <tr>
						<th>Cara Penggunaan</th>
						<td><?= $row->cara_penggunaan ?></td>
					</tr>
		             <tr>
						<th>Khasiat</th>
						<td><?= $row->khasiat ?></td>
					</tr>
		             <tr>
						<th>Media Tanam</th>
						<td><?= $row->media_tanam ?></td>
					</tr>
		             <tr>
						<th>Ciri Fisik</th>
						<td><?= $row->ciri_fisik ?></td>
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
<!-- footer content -->
<?php $this->load->view('admin/v_footer');?>
</body>
</html>