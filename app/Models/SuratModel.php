<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'letters';
    protected $primaryKey = 'letter_id';
    protected $allowedFields = ['NAMA', 'JURUSAN','NIM', 'NO_ANGGOTA','ALAMAT','KODE','DATE','NO_SURAT'];

    public function getAll()
    {
        return $this->findAll();
    }

    public function getById($test)
    {
        return $this->find($test);
    }

    // public function save()
    // {
    // }
}