<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip_pgwi',
        'uuid',
        'slug',
        'branch_company_id',
        'divisi_id',
        'jabatan_id',
        'status_level_id',
        'tgl_mulai_kerja',
        'no_tlpn',
        'email',
        'nik',
        'nama',
        'nickname',
        'jk',
        'province_id',
        'regencie_id',
        'district_id',
        'village_id',
        'almt_detail',
        'tgl_lahir',
        'agama',
        'status_perkawinan',
        'tempat_lahir',
        'pendidikan_terakhir',
        'nama_instansi',
        'tahun_lulus'

    ];
}
