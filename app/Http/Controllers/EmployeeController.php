<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use App\Models\Religion;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(5)->withQueryString();
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Employee::paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai()
    {
        $dataagama = Religion::all();
        return view('tambahdata', compact('dataagama'));
    }

    public function insertdata(Request $request)
    {

        $this->validate($request, [
            'nama' => 'required|min:7|max:45',
            'notelpon' => 'required|min:11|max:12',
        ]);

        $data = Employee::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect('pegawai')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function tampildata($id)
    {
        $data = Employee::find($id);
        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        if (session('halaman_url')) {
            return redirect(session('halaman_url'))->with('success', 'Data Berhasil Di Update!');
        }
        return redirect('pegawai')->with('success', 'Data Berhasil Di Update!');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect('pegawai')->with('success', 'Data Berhasil Di Hapus!');
    }

    public function exportpdf()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    public function importexcel(Request $request)
    {
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        Excel::import(new EmployeeImport, \public_path('/EmployeeData/' . $namafile));
        return \redirect()->back();
    }
}
