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
				<div class="col-md-6">
                    <h3>
                        <span style="float: right">
	                          <a href="<?php echo base_url('admin/donatur/printpdf');?>" target="_blank" id="link-print"><span class="glyphicon glyphicon-print"></span></a>
                        </span>
                    </h3>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
   		<a href="<?php echo $this->master->adminUrl($url.'/tambah');?>"><button class="btn btn-default"><i class="fa fa-plus" style="font-size: 1em"></i> Tambah</button></a><br>
				<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
              <tr>
              <th>Nama Famili</th>
              <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data->result() as $key): ?>
                  <tr>
                    <td><?= $key->nama ?></td>
                    <td style="text-align: center;">
                      <!-- <a href=""><button class="btn btn-success btn-flat btn-xs">Detail</button></a> -->
                      <a href="<?= base_url('admin/'.$url.'/ubah/'.$key->id) ?>"><button class="btn btn-primary btn-flat btn-xs" style="width: 100%">Edit</button></a>
                    </td>
                  </tr>
              <?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
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
