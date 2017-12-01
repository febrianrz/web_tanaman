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
				<form method="POST" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label for="smallinput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Tanaman</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="nama_tanaman" class="form-control col-md-7 col-xs-12" id="smallinput" placeholder="Nama Tanaman">
						</div>
					</div>
					<div class="form-group">
						<label for="mediuminput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Ilmiah</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="nama_ilmiah" class="form-control col-md-7 col-xs-12" id="mediuminput" placeholder="Nama Ilmiah">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Famili</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="id_famili">
								<option>Pilih Famili</option>
								<?php foreach ($famili->result() as $key): ?>
									<option value="<?= $key->id ?>"><?= $key->nama; ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Pemanfaatan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="pemanfaatan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Pemanfaatan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi (Koordinat)</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="latitude" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Latitude"><br><br>
							<input type="text" name="longitude" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Longitude">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Peneliti</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="peneliti" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Peneliti">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lembaga</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="nama_lembaga" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Nama Lembaga">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Penelitian</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="tempat_penelitian" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Tempat Penelitian">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Etnis</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="nama_etnis" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Nama Etnis">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="tujuan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Tujuan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Waktu Penelitian</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="waktu_penelitian" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Waktu Penelitian">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Metode Penelitian</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="metode_penelitian" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Metode Penelitian">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Ketinggian Lokasi</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="ketinggian_lokasi" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Ketinggian Lokasi">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Bentuk Pemanfaatan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="bentuk_pemanfaatan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Bentuk Pemanfaatan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Kandungan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="kandungan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Kandungan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Cara Penggunaan</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="cara_penggunaan" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Cara Penggunaan">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Khasiat</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="khasiat" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Khasiat">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Media Tanam</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="media_tanam" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Media Tanam">
						</div>
					</div>
					<div class="form-group mb-n">
						<label for="largeinput" class="control-label col-md-3 col-sm-3 col-xs-12">Ciri Fisik</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="ciri_fisik" class="form-control col-md-7 col-xs-12" id="largeinput" placeholder="Ciri Fisik">
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<a href="<?php echo $this->master->adminUrl($url);?>" class="btn btn-primary">
								Batal
							</a>
						
								<input type="submit" id="btnSave" value="Simpan" class="btn btn-success">	
						
						</div>
					</div>
					<input type="hidden" name="status_simpan" value="1" id="status_simpan">
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<br />
<!-- footer content -->
<?php $this->load->view('admin/v_footer');?>

<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
 $(document).ready(function(){
 	function ajaxCall(){
 		$.ajax({
		        type: "POST",
		        url: "<?php echo base_url('admin/tanaman/tambah')?>",
		        dataType : "JSON",
		        data: $("#demo-form2").serialize(),
		        success: function(data){
		        	if(data.status){
			        	alert(data.msg);
				        if(data.status){
				        	window.location.href = "<?=base_url('admin/tanaman');?>";
				        }	
		        	} else {
		        		if(data.code==101){
		        			alert(data.msg);
		        			if(confirm("Apakah Anda Tetap Ingin Menyimpannya?")){
		        				$("#status_simpan").val(2);
		        				ajaxCall();
		        			} else {
		        				alert("Data Tidak Disimpan");
		        			}
		        		} else {
		        			alert("Data Tidak Disimpan");
		        		}
		        	}
			        
		        },

		        error: function (jqXHR, textStatus, errorThrown)
		        {
		        	console.log(jqXHR);
		        	console.log(textStatus);
		            alert('Error get data from ajax');
		        }
		    });	
 	}
    $("#demo-form2").submit(function(){
    	// e.preventDefault();
    	if(confirm("Apakah Anda Yakin")){
    		ajaxCall();
    	}
        
	    return false;
    });
});
 
 
 
function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}
 
function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('person/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
 
function saveData()
{
    $('#btnSave').value('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo base_url('admin/tanaman/tambah')?>";
    } else {
        url = "<?php echo base_url('admin/tanaman/ubah')?>";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#demo-form2').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 		console.log($data);
 		alert('Yessss');
          
            // $('#btnSave').text('save'); //change button text
            // $('#btnSave').attr('disabled',false); //set button enable
 		
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error ');
        }
    });
}
 

</script>


</body>
</html>