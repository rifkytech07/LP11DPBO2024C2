<?php
include("KontrakView.php");
include("../presenter/ProsesPasien.php");

class AddPasien implements KontrakView
{
    function tampilForm()
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Tambah Pasien</title>
        </head>
        <body>

        <h1>Tambah Pasien</h1>

        <form action="add.php" method="post">
            <label>NIK:</label><br>
            <input type="text" name="nik"><br>
            <label>Nama:</label><br>
            <input type="text" name="nama"><br>
            <label>Tempat:</label><br>
            <input type="text" name="tempat"><br>
            <label>Tanggal Lahir:</label><br>
            <input type="date" name="tl"><br>
            <label>Jenis Kelamin:</label><br>
            <select name="jenis_kelamin">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select><br>
            <label>Email:</label><br>
            <input type="email" name="email"><br>
            <label>No. Telepon:</label><br>
            <input type="text" name="no_telepon"><br>
            <input type="submit" name="submit" value="Simpan">
        </form>

        </body>
        </html>
        <?php
    }

    function tampil()
    {
        $this->tampilForm();
    }
}

$view = new AddPasien();
$view->tampil();
?>
