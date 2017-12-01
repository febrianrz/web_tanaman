<?php $this->load->view('admin/v_header');?>
<!-- page content -->
<script>
	$(document).ready(function(){
		$("form#uploadfile").submit(function(){
			var formURL = "<?php echo base_url('index/fileupload');?>";
			console.log(formURL);
			var postData = new FormData($("form#uploadfile")[0]);
			$.ajax({
				type:"POST",
				url:formURL,
				data:postData,
				processData: false,
				contentType: false,
				dataType:"json",
				success:function(data){
					$(".upload_err").slideUp();
					$(".upload_success").slideUp();
					if(data.status){
						$(".upload_err").slideUp();
						$(".upload_success_msg").html(data.msg);
						$(".upload_success").slideDown();
						loadImageTersedia();
						$("form#uploadfile").val('');
					} else {
						$(".upload_success").slideUp();
						$(".upload_err_msg").html(data.msg);
						$(".upload_err").slideDown();
					}
				},
				error:function(xhr,status,error){
					console.log(error);
				}
			});
			return false;
		});

		$("#imgfile").on('click',function(){
			$('#main-gambar').trigger('click');
		});

		$('#main-gambar').on('change', function(){
			var formURL = "<?php echo base_url('admin/settingweb/upload');?>";
			console.log(formURL);
			var postData = new FormData($("form#main-form")[0]);
			$.ajax({
				type:"POST",
				url:formURL,
				data:postData,
				processData: false,
				contentType: false,
				dataType:"json",
				success:function(data){
					if(!data.status)
						alert(data.msg);
					else {
						$("#gmbr").val(data.filename);
						var src = "<?php echo base_url('assets/images/option');?>/"+data.filename;
						$("#imgfile").attr("src", src);
					}
				},
				error:function(xhr,status,error){
					console.log(error);
				}
			});
		});

	});
</script>
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
				<form method="POST" action="" id="main-form" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Jenis Donasi <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="nama" id="first-name" required="required" class="form-control col-md-7 col-xs-12" autocomplete="off" autofocus="true" value="<?php echo $row->nama;?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Value <span class="required">*</span>
						</label>
						<?php if(in_array($row->id,$upload)):?>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<img id="imgfile" src="<?php echo base_url('assets/images/option/'.$row->option);?>" alt="" width="100">
								<input type="file" id="main-gambar" style="display: none" name="file">
								<input type="text" id="gmbr" name="option" style="display: none">
							</div>
						<?php else: ?>

							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="option" id="first-name" required="required" class="form-control col-md-7 col-xs-12" autocomplete="off" autofocus="true" value="<?php echo $row->option;?>">
							</div>
						<?php endif;?>

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
</body>
</html>