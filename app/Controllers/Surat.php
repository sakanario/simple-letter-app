<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratModel;
use CodeIgniter\I18n\Time;

class Surat extends Controller
{   
    protected $suratModel;

    public function __construct(){
        $this->suratModel = new SuratModel(); //Consider using CI's way of initialising models
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Surat',
            'letters' => $this->suratModel->findAll()
        ];
        // dd($data);
        return view('Surat/index',$data);

    }

    public function getRomawi($bln){
        switch ($bln){
        case 1: 
            return "I";
        break;
        case 2:
            return "II";
        break;
        case 3:
            return "III";
        break;
        case 4:
            return "IV";
        break;
        case 5:
            return "V";
        break;
        case 6:
            return "VI";
        break;
        case 7:
            return "VII";
        break;
        case 8:
            return "VIII";
        break;
        case 9:
            return "IX";
        break;
        case 10:
            return "X";
        break;
        case 11:
            return "XI";
        break;
        case 12:
            return "XII";
        break;
        }
    }

    public function generateNoSurat($previousKode)
    {
        $myTime = Time::now('Asia/Jakarta', 'en_US');

        $tanggal = $myTime->getDay();
        $bulan = $myTime->getMonth();
        $tahun = $myTime->getYear();

        $kode = $previousKode + 1;

        $no_surat = "UN." . $kode . "/V." . $kode. "/HM." . $tanggal . "." . $bulan . "/" . $this->getRomawi($bulan)  . "/" . $tahun;
        // dd($no_surat);
        return $no_surat;
    }

    public function cetak($id)
    {
        $data = [
            'letters' => $this->suratModel->getById($id)
        ];
        return view('Surat/cetak',$data);
    }

    public function addData()
    {   

        $myTime = Time::now('Asia/Jakarta', 'en_US');
        $bulan = $myTime->getMonth();
        
        $fetchMaxKode = $this->suratModel->query("SELECT max(KODE) as maxKode FROM letters WHERE month(DATE)=$bulan");
        $maxKode = $fetchMaxKode->getResultObject()[0]->maxKode;
        $maxKode = intval($maxKode);
        // dd($maxKode);

        $this->suratModel->save([
            'NO_SURAT' =>   $this->generateNoSurat($maxKode),

            'DATE' =>   $myTime->toDateString(),
            'KODE' =>   $maxKode + 1,

            'NAMA' =>   $this->request->getVar('nama'),
            'JURUSAN' =>   $this->request->getVar('jurusan'),
            'NIM' =>   $this->request->getVar('nim'),
            'NO_ANGGOTA' =>   $this->request->getVar('no_anggota'),
            'ALAMAT' =>   $this->request->getVar('alamat'),
            'USER_ID' => 1 //need update
        ]);
        return redirect()->to('/surat');
    }

    public function delete($id){
        $this->suratModel->delete($id);

        return redirect()->to('/surat');
    }

}