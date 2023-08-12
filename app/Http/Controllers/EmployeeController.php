<?php

namespace App\Http\Controllers;

use App\Models\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Province;
use App\Models\Regencie;
use App\Models\StatusLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function create()
    {
        $divisi = Division::get();
        $jobTitle = JobTitle::get();
        $statusLevel = StatusLevel::get();

        return view('create', [
            'divisi' => $divisi,
            'jobTitle' => $jobTitle,
            'statusLevel' => $statusLevel
        ]);

    }

    public function store(Request $request, Employee $employee)
    {
        // $validateData = $request->validate([
        //     'name' => 'required',
        //     'no_tlpn' => 'required',
        // ]);

        // @dd($request);
        $existingCount = Employee::count();
        $nomorUrut = $existingCount + 1;


        $tglMulaiKerja = Carbon::createFromFormat('Y-m-d', $request->tgl_mulai_kerja);
        $tahunMulaiKerja = $tglMulaiKerja->format('y');
        $bulanMulaiKerja = $tglMulaiKerja->format('m');

        $jenisKelamin = ($request->jk == 'Laki-Laki') ? '1' : '0';

        $nipPgwi = $tahunMulaiKerja . $bulanMulaiKerja . $jenisKelamin . $nomorUrut ;

        $request['nip_pgwi'] = $nipPgwi;
        $request['nama'] = Str::title($request->nama);
        $request['nickname'] = Str::title($request->nickname);
        $request['branch_company_id'] = $request->branch_company_id;

        $employee->create($request->all());

        return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
    }

    public function getProvince()
    {
        $province = Province::get();

        return response()->json($province);
    }

    public function getRegencies($id)
    {
        $regencies = Regencie::where('province_id', $id)->get();

        return response()->json($regencies);
    }

    public function getDistricts($id)
    {
        $distric = District::where('regency_id', $id)->get();

        return response()->json($distric);

    }

    public function getVillage($id)
    {
        $village = Village::where('district_id', $id)->get();

        return response()->json($village);
    }
}
