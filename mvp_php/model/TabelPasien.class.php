<?php
require_once("DB.class.php");

class TabelPasien extends DB
{
    function getPasien()
    {
        // Query mysql select data pasien
        $query = "SELECT * FROM pasien";
        // Mengeksekusi query
        return $this->execute($query);
    }

    function single($query)
    {
        // Mengeksekusi query
        $result = $this->execute($query);

        // Mengambil hasil query dalam bentuk array asosiatif
        $row = mysqli_fetch_assoc($result);

        // Menghapus hasil query dari memori
        mysqli_free_result($result);

        // Mengembalikan hasilnya
        return $row;
    }


    function addPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
    {
        // Query mysql insert data pasien
        $query = "INSERT INTO pasien (nik, nama, tempat, tl, gender, email, telp) 
                  VALUES ('$nik', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";
        // Mengeksekusi query
        return $this->execute($query);
    }

    function updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
    {
        // Query mysql update data pasien
        $query = "UPDATE pasien SET 
                  nik='$nik', 
                  nama='$nama', 
                  tempat='$tempat', 
                  tl='$tl', 
                  gender='$gender', 
                  email='$email', 
                  telp='$telp' 
                  WHERE id=$id";
        // Mengeksekusi query
        return $this->execute($query);
    }

    function deletePasien($id)
    {
        // Query mysql delete data pasien
        $query = "DELETE FROM pasien WHERE id=$id";
        // Mengeksekusi query
        return $this->execute($query);
    }
}
?>
