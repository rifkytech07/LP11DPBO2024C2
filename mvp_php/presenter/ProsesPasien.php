<?php

include("KontrakPresenter.php");
require_once(__DIR__ . "/../model/TabelPasien.class.php");

class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender
				$pasien->setEmail($row['email']);
				$pasien->setTelp($row['telp']);


				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}

	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}

	function getEmail($i)
	{
		return $this->data[$i]['email'];
	}

	function getTelp($i)
	{
		return $this->data[$i]['telp'];
	}

	function getDataPasienById($id)
    {
        // Query mysql select data pasien berdasarkan ID
        $query = "SELECT * FROM pasien WHERE id='$id'";
        // Mengeksekusi query dan mengembalikan hasilnya
        return $this->tabelpasien->single($query);
    }

	function getSize()
	{
		return sizeof($this->data);
	}

	function addPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
    {
        try {
            // Buka koneksi
            $this->tabelpasien->open();
            
            // Tambahkan pasien baru ke dalam database
            $this->tabelpasien->addPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp);

            // Ambil kembali data pasien dari database
            $this->tabelpasien->getPasien();

            // Reset data
            $this->data = [];

            // Ambil data pasien
            while ($row = $this->tabelpasien->getResult()) {
                $this->data[] = $row; // Tambahkan data pasien ke dalam list
            }

            // Tutup koneksi
            $this->tabelpasien->close();
        } catch (Exception $e) {
            // Proses error
            echo "Error: " . $e->getMessage();
        }
    }

    function updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
    {
        try {
            // Buka koneksi
            $this->tabelpasien->open();
            
            // Update pasien dengan id tertentu
            $this->tabelpasien->updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);

            // Ambil kembali data pasien dari database
            $this->tabelpasien->getPasien();

            // Reset data
            $this->data = [];

            // Ambil data pasien
            while ($row = $this->tabelpasien->getResult()) {
                $this->data[] = $row; // Tambahkan data pasien ke dalam list
            }

            // Tutup koneksi
            $this->tabelpasien->close();
        } catch (Exception $e) {
            // Proses error
            echo "Error: " . $e->getMessage();
        }
    }

    function deletePasien($id)
    {
        try {
            // Buka koneksi
            $this->tabelpasien->open();
            
            // Hapus pasien dengan id tertentu
            $this->tabelpasien->deletePasien($id);

            // Ambil kembali data pasien dari database
            $this->tabelpasien->getPasien();

            // Reset data
            $this->data = [];

            // Ambil data pasien
            while ($row = $this->tabelpasien->getResult()) {
                $this->data[] = $row; // Tambahkan data pasien ke dalam list
            }

            // Tutup koneksi
            $this->tabelpasien->close();
        } catch (Exception $e) {
            // Proses error
            echo "Error: " . $e->getMessage();
        }
    }
}
