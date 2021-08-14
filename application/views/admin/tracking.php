<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Tracking Mobil</h1>
		</div>

	</section>
	<div class="card">
		<div class="card-body">
			<p class="text-center text-danger">Lokasi akan menset otomatis dari lokasi anda</p>
			<div id='map' style='width: 100%; height: 65vh;'></div>
			<script>
				mapboxgl.accessToken =
					'pk.eyJ1IjoiYWxmaW5mb3J3b3JrIiwiYSI6ImNrZjUzdWpvbzBhMzIzNHFmNzdxNWZtc28ifQ.pOrZhTiM6kMdOFhWp4kLrw';
				// 
				var lat = '<?= $transaksi->lat ?: '-7.92532900972418' ?>';
				var long = '<?= $transaksi->long ?: '110.38955489092359' ?>';
				// 
				var map = new mapboxgl.Map({
					container: 'map',
					style: 'mapbox://styles/mapbox/streets-v11',
					center: [long, lat],
					zoom: 15
				});
				var marker = new mapboxgl.Marker()
					.setLngLat([long, lat])
					.addTo(map);
				// lat = lat + 0.001;
				// long = long + 0.001;
				setInterval(() => {
					$.ajax({
						type: "GET",
						url: "<?= base_url("admin/transaksi/get_lokasi/$transaksi->id_rental") ?>",
						dataType: "json",
						success: function(response) {
							lat = response.data.lat;
							long = response.data.long;
							map.flyTo({
								center: [
									long,
									lat
								],
							});
							marker.setLngLat([long, lat]);
							console.log(lat + " " + long);
						},
						error(x, y, z) {
							console.log(x);
							console.log(y);
							console.log(z);
						}
					}, function() {}, {
						enableHighAccuracy: true
					})
				}, 1000);
			</script>
		</div>
	</div>
</div>
