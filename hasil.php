<?php include "config.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Hasil Pendaftaran</title>
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">
	<div class="container mt-4 p-4 bg-white rounded shadow">
		<h2 class="text-center mb-4">Data Pendaftaran Beasiswa</h2>
		<!-- Navbar -->
		<nav class="mb-3">
			<ul class="nav justify-content-center">
				<li class="nav-item"><a class="nav-link btn btn-primary me-2" href="index.php">Beranda</a></li>
				<li class="nav-item"><a class="nav-link btn btn-success me-2" href="daftar.php">Daftar Beasiswa</a></li>
				<li class="nav-item"><a class="nav-link btn btn-info" href="hasil.php">Lihat Hasil</a></li>
			</ul>
		</nav>

		<!-- Tabel Data -->
		<table class="table table-striped table-bordered">
			<thead class="table-primary">
				<tr>
					<th>Nama</th>
					<th>Email</th>
					<th>No HP</th>
					<th>Semester</th>
					<th>IPK</th>
					<th>Beasiswa</th>
					<th>Berkas</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$res = $conn->query("SELECT * FROM pendaftaran");
				while ($row = $res->fetch_assoc()) {
					echo "<tr>
                <td>{$row['nama']}</td>
                <td>{$row['email']}</td>
                <td>{$row['no_hp']}</td>
                <td>{$row['semester']}</td>
                <td>{$row['ipk']}</td>
                <td>{$row['beasiswa']}</td>
                <td><a href='upload/{$row['file_berkas']}' class='btn btn-sm btn-outline-primary'>Download</a></td>
                <td>{$row['status_ajuan']}</td>
            </tr>";
				}
				?>
			</tbody>
		</table>

		<!-- Grafik Monitoring Beasiswa -->
		<h4 class="text-center mt-5">Monitoring Jumlah Pendaftar Berdasarkan Jenis Beasiswa</h4>
		<canvas id="grafikBeasiswa" height="120"></canvas>

		<!-- Grafik Monitoring Semester -->
		<h4 class="text-center mt-5">Monitoring Jumlah Pendaftar Berdasarkan Semester</h4>
		<canvas id="grafikSemester" height="120"></canvas>
	</div>

	<?php
	// Data jumlah pendaftar per jenis beasiswa
	$dataJenis = $conn->query("SELECT beasiswa, COUNT(*) as total FROM pendaftaran GROUP BY beasiswa");
	$labelsJenis = [];
	$valuesJenis = [];
	while ($row = $dataJenis->fetch_assoc()) {
		$labelsJenis[] = $row['beasiswa'];
		$valuesJenis[] = $row['total'];
	}

	// Data jumlah pendaftar per semester
	$dataSemester = $conn->query("SELECT semester, COUNT(*) as total FROM pendaftaran GROUP BY semester ORDER BY semester");
	$labelsSemester = [];
	$valuesSemester = [];
	while ($row = $dataSemester->fetch_assoc()) {
		$labelsSemester[] = 'Semester ' . $row['semester'];
		$valuesSemester[] = $row['total'];
	}
	?>
	<script>
		// Grafik Beasiswa
		new Chart(document.getElementById('grafikBeasiswa'), {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($labelsJenis); ?>,
				datasets: [{
					label: 'Jumlah Pendaftar',
					data: <?php echo json_encode($valuesJenis); ?>,
					backgroundColor: ['#007bff', '#28a745'],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});

		// Grafik Semester
		new Chart(document.getElementById('grafikSemester'), {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($labelsSemester); ?>,
				datasets: [{
					label: 'Jumlah Pendaftar',
					data: <?php echo json_encode($valuesSemester); ?>,
					backgroundColor: '#ffc107',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>
</body>

</html>