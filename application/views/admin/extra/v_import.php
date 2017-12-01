<?php $this->load->view('admin/v_header');?>
<!-- page content -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">
			<div class="row x_title">
				<div class="col-md-6">
					<h3>Import <small>Database</small></h3>
				</div>
				<div class="col-md-6">
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<form action="" method="POST" class="form-horizontal">
					<div class="form-group">
						<div class="row">
							<div class="col-md-2">
								<label>File Upload</label>		
							</div>
							<div class="col-md-10">
								<input type="file" name="file" id="" class="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-11">
								
							</div>
							<div class="col-md-1">
								<input type="submit" name="submit" value="Import" class="btn btn-danger" id="">
							</div>
							
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