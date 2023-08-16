<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sales;
use Ramsey\Uuid\Uuid;
use App\Models\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Province;
use App\Models\Regencie;
use App\Models\Technician;
use App\Models\StatusLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

    public function update(Request $request, Employee $employee)
    {

    }

    public function register()
    {
        return view('register');
    }

    public function storeRegis(Request $request)
    {
        $employees = Employee::select('nip_pgwi')->get();
        // foreach ($employees as $employee){

            // $dd = Technician::whereIn('employees_nip',  $employees)->get();
            $dd = Technician::leftJoin('employees', 'technicians.employees_nip', '=', 'employees.nip_pgwi')
                            ->where('technicians.katim', '=', 0)
                            ->select('employees.nama')
                            ->get();

            dd($dd);
        // }


        // foreach ($employees as $employee){
        //     if($employee->jabatan_id == 12 || $employee->jabatan_id == 13 || $employee->jabatan_id == 14){
        //         if($employee->status_level_id == 4){
        //             Technician::insert([
        //                 'employees_nip' => $employee->nip_pgwi,
        //                 'katim' => 1
        //             ]);
        //         }else{
        //             Technician::insert([
        //                 'employees_nip' => $employee->nip_pgwi,
        //                 'katim' => 0
        //             ]);
        //         }
        //     }elseif($employee->jabatan_id == 7){
        //         Sales::insert([
        //             'karyawan_nip' => $employee->nip_pgwi,
        //             'komisi_id' => 1,
        //             'level_id' => 1
        //         ]);
        //     }
        // }

        // foreach ($employees as $employee){

        //     Employee::where('nip_pgwi', $employee->nip_pgwi)->update([
        //         // 'slug' => Str::slug($employee->nama, '_'),
        //         'uuid' => Uuid::uuid4()->getHex()
        //     ]);
        // }

        // foreach ($employees as $employee){
        //     if($employee->status_level_id == 4){
        //         User::insert([
        //             'karyawan_nip' => $employee->nip_pgwi,
        //             'uuid' => Uuid::uuid4()->getHex(),
        //             'is_leader' => 1,
        //             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        //         ]);
        //     }else{
        //         User::insert([
        //             'karyawan_nip' => $employee->nip_pgwi,
        //             'uuid' => Uuid::uuid4()->getHex(),
        //             'is_leader' => 0,
        //             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        //         ]);
        //     }
        // }
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
