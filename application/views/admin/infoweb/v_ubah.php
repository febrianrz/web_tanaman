<?php $this->load->view('admin/v_header');?>
<style type="text/css">

	.img-browse{
		border: 2px solid;
		padding:0;
	}
</style>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
	tinymce.init({
		selector: 'textarea',
		height: 500,
		theme: 'modern',
		images_upload_credentials: true,
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools'
		],
		toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		toolbar2: 'print preview media | forecolor backcolor emoticons',
		image_advtab: true,
		content_css: [
			'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
			'//www.tinymce.com/css/codepen.min.css'
		],
		external_filemanager_path:"../filemanager/",
		filemanager_title:"File Manager" ,
		external_plugins: { "filemanager" : "<?php echo base_url();?>assets/filemanager/plugin.min.js"}
	});
</script>
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
						<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nama Info Web<span class="required">*</span>
					</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" autocomplete="off" autofocus="true" value="<?php echo $row->nama;?>" readonly="readonly">
					</div>

				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Content<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<textarea name="isi"><?php echo str_replace('../../','../../../',$row->isi);?></textarea>
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
<!-- Button trigger modal -->
<button type="button" style="display: none" id="img-button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 100000">
<div class="modal-dialog" role="document">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Image Upload</h4>
	</div>
	<div class="modal-body">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Gambar</a></li>
			<!--li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">File</a></li-->
			<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Upload</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content" data-spy="scroll" data-target="#home">
			<div role="tabpanel" class="tab-pane active" id="home"  >home</div>
			<!-- <div role="tabpanel" class="tab-pane" id="messages">File</div> -->
			<div role="tabpanel" class="tab-pane" id="profile">
				<form id="uploadfile" enctype="multipart/form-data" method="post" action="">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Gambar</label>
				    <input type="file" class="" name="file" id="exampleInputEmail1">
				  </div>
				  <input type="submit" value="Upload" class="btn btn-default" id="">
				</form>
				<input type="hidden" id="tmpfile">
				<div class="alert alert-success upload_success" role="alert" style="display: none">
  					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
  					<span class="upload_success_msg"></span>
				</div>
				<div class="alert alert-danger upload_err" role="alert" style="display: none">
  					<span class="upload_err_msg"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
	</div>
</div>
</div>
</div>
<!-- footer content -->
<?php $this->load->view('admin/v_footer');?>
</body>
</html>