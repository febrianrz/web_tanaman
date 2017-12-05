<?php $this->load->view('admin/v_header');?>
<!-- page content -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">
			<div class="row x_title">
				<div class="col-md-6">
					<h3>Dashboard Administrator</h3>
				</div>
				<div class="col-md-6">
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row top_tiles">
					<div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="tile-stats">
								<div class="icon"><i class="fa fa-users"></i>
								</div>
								<div class="count">27</div>
								<h3>Hari ini</h3>

								<a href="<?php echo base_url('admin/donatur');?>"><p style="margin-left: 10px">Lihat Detail</p></a>
						</div>
					</div>
					<div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="tile-stats">
							<div class="icon"><i class="fa fa-picture-o"></i>
							</div>
							<div class="count">557</div>

							<h3>Total Tanaman</h3>
							<a href="<?php echo base_url('admin/konfirmasi');?>"><p style="margin-left: 10px">Lihat Detail</p></a>
						</div>
					</div>
				</div>
				<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13340.869438091007!2d106.81417841218085!3d-6.228855758173458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe2bc66c585fbe1c3!2sLembaga+Ilmu+Pengetahuan+Indonesia+(LIPI)!5e0!3m2!1sid!2sid!4v1511797008573" frameborder="0" style="border:2; width: 100%; height: 450px;" allowfullscreen>
				</iframe> -->
				<style type="text/css">
					 #map {
				        height: 450px;
				      }
				</style>
				<div id="map"></div>
			    <script>
			      var map;
			       var locations = [
			       		<?php foreach($data->result() as $dt):?>
							["<?=$dt->nama_tanaman;?>", <?=$dt->latitude;?>, <?=$dt->longitude;?>, "<?=$dt->tempat_penelitian;?>"],
			       		<?php endforeach;?>
    				];
			      function initMap() {

			        map = new google.maps.Map(document.getElementById('map'), {
			          center: {lat: -2.133911, lng: 106.6507525},
			          zoom: 5
			        });
				    var boxList = [];

			        var marker, i;
			        var infowindow = new google.maps.InfoWindow({
		            disableAutoPan: true
		          ,isHidden:false
		          ,pixelOffset: new google.maps.Size(-10, -10)
		          ,closeBoxURL: ""
		          ,pane: "mapPane"
		          ,enableEventPropagation: true
		        });

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        title : locations[i][0],
        map: map
      });

      var boxText = document.createElement("div");
            boxText.id = i;
            boxText.className = "labelText" + i;
            boxText.innerHTML = locations[i][0];
            boxList.push(boxText);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
      	var contentString = '<div id="infoWindow">'
                    +'<div id="bodyContent">'
                    +'<p style="font-weight:bold">'
                    + locations[i][0]
                    +'</p>'
                    +'<p><a target="_blank" href="https://www.google.co.id/maps/?q='+locations[i][1]+','+locations[i][2]+'">'
                    + locations[i][3]
                    +'</a><p>'
                    +'</div>'
                    + '</div>';

        return function() {
          infowindow.setContent(contentString);
          infowindow.open(map, marker);
        }
      })(marker, i)); 

    }
			      }
			    </script>
			    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfGDDV4Sr-udZs7pQLpibZg5SnnCKjdS8&callback=initMap"
			    async defer></script>
			</div>
			<div class="clearfix"></div>	
			<br><br>
			Tes
		</div>
	</div>
</div>
<br />
<!-- footer content -->
<?php $this->load->view('admin/v_footer');?>
</body>
</html>
