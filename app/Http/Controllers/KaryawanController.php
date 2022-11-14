<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Karyawan as Ky;
use function PHPUnit\Framework\isEmpty;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Welcome',
            'respon code' => Response::HTTP_OK
        ]);
    }

    public function getAllKaryawan(): JsonResponse
    {
        $get_data = Ky::all();
        if ($get_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            return response()->json($get_data, Response::HTTP_OK);
        }
    }

    public function addKaryawan(Request $request)
    {
        $this->validate($request, [
            'nama_karyawan' => 'required',
            'jabatan_id' => 'required',
            'akses_id' => 'required',
            'tahun_masuk' => 'required|min:4|numeric'
        ]);
        $cek_duplicate = Ky::select('*')->where('nama_karyawan', $request->nama_karyawan)->get();
        if ($cek_duplicate->count() > 0) {

            return response()->json([
                'status' => 'success',
                'respon code' => Response::HTTP_FOUND,
                'message' => "your input" . " " . "$request->kode_jabatan" . " " . "already exists at DB"
            ]);
        } else {
            $input_karyawan = Ky::create([
                'nama_karyawan' => $request->nama_karyawan,
                'jabatan_id' => $request->jabatan_id,
                'akses_id' => $request->akses_id,
                'tahun_masuk' => $request->tahun_masuk,
                'tgl_masuk' => Carbon::now()->toDateTimeString(),
                'tgl_keluar' => Carbon::now()->toDateTimeString(),
                'status' => 'Nonaktif'
            ]);

            if ($input_karyawan == true) {
                return response()->json([
                    'status' => 'success',
                    'respon code' => Response::HTTP_CREATED,
                    'message' => 'Data has been successfully created',
                    'data' => $input_karyawan
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'respon code' => Response::HTTP_NO_CONTENT,
                    'data' => $input_karyawan
                ]);
            }
        }
    }

    public function getByKaryawan(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $query = Ky::select('id', 'nama_karyawan', 'jabatan_id', 'akses_id', 'tahun_masuk', 'status')->where('id', $request->id);
        $rawdata = $query->get();

        if ($rawdata->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            foreach ($rawdata as $isi) {
                return response()->json([
                    'respon code' => Response::HTTP_FOUND,
                    'message' => 'Data found',
                    'status' => 'success',
                    'data' => [
                        'id' => $isi->id,
                        'nama_karyawan' => $isi->nama_karyawan,
                        'jabatan_id' => $isi->jabatan_id,
                        'akses_id' => $isi->akses_id,
                        'tahun_masuk' => $isi->tahun_masuk,
                        'status' => $isi->status
                    ]
                ]);
            }
        }
    }

    public function setAktif(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required'
        ]);


        $update_jabatan = Ky::findOrFail($request->id);
        $run_update = $update_jabatan->update([
            'id' => $request->id,
            'status' => 'Aktif'
        ]);
        if ($run_update == Response::HTTP_OK) {
            $query = Ky::select('id', 'nama_karyawan', 'status')
                ->where('id', $request->id)
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been successfully modified.!',
                'respon code' => Response::HTTP_OK,
                'data' => $query
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Data has been unsuccessfully modified.!',
                'respon code' => Response::HTTP_OK
            ]);
        }
    }

    public function delKaryawan(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $cek_data = Ky::select('*')->where('id', $request->id)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Ky::destroy($request->id);

            if ($running_hapus == true) {
                return response()->json([
                    'status' => 'success',
                    'respon code' => Response::HTTP_OK,
                    'message' => 'Data has been removed successfully.!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'respon code' => Response::HTTP_NOT_MODIFIED,
                    'message' => 'Data has unsuccessfull removed.!'
                ]);
            }
        }
    }
}