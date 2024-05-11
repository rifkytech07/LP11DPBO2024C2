<?php

include("../presenter/ProsesPasien.php");
include("../model/TabelPasien.class.php");
class EditView
{
	private $prosespasien;

	function __construct()
	{
		$this->prosespasien = new ProsesPasien();
	}

	function edit($id, $data)
	{
		$this->prosespasien->editPasien($id, $data);
		header("Location: index.php");
		exit();
	}

	function tampilForm($id)
	{
		$pasien = $this->prosespasien->getPasienById($id);
		?>
		<!DOCTYPE html>
		<html>
		<head>
		    <title>Edit Pasien</title>
		</head>
		<body>

		<h1>Edit Pasien</h1>

		<form action="edit.php" method="post">
			<input type="hidden" name="id" value="<?php echo $pasien['id']; ?>">
			<label>Nama:</label><br>
			<input type="text" name="nama" value="<?php echo $pasien['nama']; ?>"><br>
			<label>Tempat:</label><br>
			<input type="text" name="tempat" value="<?php echo $pasien['tempat']; ?>"><br>
			<label>Tanggal Lahir:</label><br>
			<input type="date" name="tl" value="<?php echo $pasien['tl']; ?>"><br>
			<label>Jenis Kelamin:</label><br>
			<select name="jenis_kelamin">
				<option value="Laki-laki" <?php if($pasien['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
				<option value="Perempuan" <?php if($pasien['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
			</select><br>
			<label>Email:</label><br>
			<input type="email" name="email" value="<?php echo $pasien['email']; ?>"><br>
			<label>No. Telepon:</label><br>
			<input type="text" name="no_telepon" value="<?php echo $pasien['no_telepon']; ?>"><br>
			<input type="submit" name="submit" value="Simpan">
		</form>

		</body>
		</html>
		<?php
	}

	function tampil()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$data = array(
				'nama' => $_POST['nama'],
				'tempat' => $_POST['tempat'],
				'tl' => $_POST['tl'],
				'jenis_kelamin' => $_POST['jenis_kelamin'],
				'email' => $_POST['email'],
				'no_telepon' => $_POST['no_telepon']
			);
			$this->edit($_POST['id'], $data);
		} else {
			$this->tampilForm($_GET['id']);
		}
	}
}

$view = new EditView();
$view->tampil();
?>
