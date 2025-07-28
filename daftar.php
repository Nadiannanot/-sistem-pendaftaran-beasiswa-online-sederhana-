<?php include "config.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Form Pendaftaran Beasiswa</title>
</head>

<body>
	<h2>Form Pendaftaran</h2>
	<?php
	$ipk = 3.4;
	?>
	<form method="POST" enctype="multipart/form-data">
		Nama: <input type="text" name="nama" required><br><br>
		Email: <input type="email" name="email" required><br><br>
		No. HP: <input type="number" name="no_hp" required><br><br>
		Semester:
		<select name="semester">
			<?php for ($i = 1; $i <= 6; $i++) echo "<option>$i</option>"; ?>
		</select><br><br>
		IPK: <input type="text" value="<?= $ipk ?>" readonly><br><br>

		<?php if ($ipk >= 3): ?>
			Pilih Beasiswa:
			<select name="beasiswa">
				<option value="Akademik">Beasiswa Akademik</option>
				<option value="Non-Akademik">Beasiswa Non-Akademik</option>
			</select><br><br>
			Upload Berkas: <input type="file" name="file_berkas" required><br><br>
			<button type="submit" name="daftar">Daftar</button>
		<?php else: ?>
			<p style="color:red;">IPK Anda di bawah 3. Tidak bisa mendaftar.</p>
		<?php endif; ?>
	</form>

	<?php
	if (isset($_POST['daftar']) && $ipk >= 3) {
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$no_hp = $_POST['no_hp'];
		$semester = $_POST['semester'];
		$beasiswa = $_POST['beasiswa'];
		$file = $_FILES['file_berkas']['name'];
		$tmp = $_FILES['file_berkas']['tmp_name'];
		move_uploaded_file($tmp, "upload/" . $file);

		$sql = "INSERT INTO pendaftaran (nama,email,no_hp,semester,ipk,beasiswa,file_berkas) 
            VALUES ('$nama','$email','$no_hp','$semester','$ipk','$beasiswa','$file')";
		if ($conn->query($sql)) {
			echo "<p>Pendaftaran berhasil!</p>";
		} else {
			echo "<p>Error: " . $conn->error . "</p>";
		}
	}
	?>
</body>

</html>

<?php
// NAMA : NADIA KHOERUNISA
// NIM : 23040071
// KELAS: 4C
?>