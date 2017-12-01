<?php $this->load->view('admin/v_header');?>
<!-- page content -->
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
				<form method="POST" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label for="smallinput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Tanaman</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->nama_tanaman ?>" name="nama_tanaman" class="form-control col-md-7 col-xs-12" id="smallinput" placeholder="Nama Tanaman">
						</div>
					</div>
					<div class="form-group">
						<label for="mediuminput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Ilmiah</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->nama_ilmiah ?>" name="nama_ilmiah" class="form-control col-md-7 col-xs-12" id="mediuminput" placeholder="Nama Ilmiah">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Famili</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="id_famili">
								<option>Pilih Famili</option>
								<?php foreach ($famili->result() as $key): ?>
									<option value="<?= $key->id ?>" <?php echo ($key->id == $row->id_famili?'selected':'');?>><?= $key->nama; ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Pemanfaatan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->pemanfaatan ?>" name="pemanfaatan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Pemanfaatan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi (Koordinat)</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->latitude ?>" name="latitude" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Latitude"><br><br>
							<input type="text" value="<?= $row->longitude ?>" name="longitude" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Longitude">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Peneliti</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->peneliti ?>" name="peneliti" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Peneliti">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lembaga</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->nama_lembaga ?>" name="nama_lembaga" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Nama Lembaga">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Penelitian</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->tempat_penelitian ?>" name="tempat_penelitian" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Tempat Penelitian">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Etnis</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->nama_etnis ?>" name="nama_etnis" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Nama Etnis">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->tujuan ?>" name="tujuan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Tujuan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Waktu Penelitian</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->waktu_penelitian ?>" name="waktu_penelitian" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Waktu Penelitian">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Metode Penelitian</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->metode_penelitian ?>" name="metode_penelitian" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Metode Penelitian">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Ketinggian Lokasi</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->ketinggian_lokasi ?>" name="ketinggian_lokasi" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Ketinggian Lokasi">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Bentuk Pemanfaatan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->bentuk_pemanfaatan ?>" name="bentuk_pemanfaatan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Bentuk Pemanfaatan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Kandungan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->kandungan ?>" name="kandungan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Kandungan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Cara Penggunaan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->cara_penggunaan ?>" name="cara_penggunaan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Cara Penggunaan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Khasiat</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->khasiat ?>" name="khasiat" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Khasiat">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Media Tanam</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->media_tanam ?>" name="media_tanam" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Media Tanam">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Ciri Fisik</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" value="<?= $row->ciri_fisik ?>" name="ciri_fisik" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Ciri Fisik">
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<a href="<?php echo $this->master->adminUrl($url);?>" class="btn btn-primary">
								Batal
							</a>
							<a href="">
								<input type="submit" value="Simpan" class="btn btn-success">	
							</a>
						</div>
					</div>
				</form>
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
<script>
	$('#provinsi').on('change',function(){
		$.post("<?php echo base_url('index/getKabupaten');?>",{provinsi:$(this).val()},function(data){
			if(data['status']==='200'){
				html = '';
//                            console.log(data["data"][0]);
				for(i=0;i<data['data'].length;i++){
					html += '<option value="'+data["data"][i]["id"]+'">'+data["data"][i]["nama"]+'</option>';
				}
				$("#kabupaten").html(html);
			}
		},"json");
	});
</script>
</body>
</html>