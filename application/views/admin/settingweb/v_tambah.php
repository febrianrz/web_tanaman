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
				<?php if(isset($err)):?>
					<div class="alert alert-danger" role="alert">
						<?php echo $err;?>
					</div>
				<?php endif;?>
				<form method="POST" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Judul Buletin <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="judul" id="first-name" required="required" class="form-control col-md-7 col-xs-12" autocomplete="off" autofocus="true">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">File <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="file" id="exampleInputFile" name="userfile">
							<p class="help-block">File Buletin</p>
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