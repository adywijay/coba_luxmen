<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Jabatan as Jb;
use function PHPUnit\Framework\isEmpty;

class JabatanController extends Controller
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

    public function getAllJabatan(): JsonResponse
    {
        $get_data = Jb::select('id', 'kode_jabatan', 'nama_jabatan')->get();
        if ($get_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            return response()->json($get_data, Response::HTTP_OK);
        }
    }

    public function addJabatan(Request $request)
    {
        $this->validate($request, [
            'kode_jabatan' => 'required',
            'nama_jabatan' => 'required'
        ]);
        $cek_duplicate = Jb::select('*')->where('kode_jabatan', $request->kode_jabatan)->get();
        if ($cek_duplicate->count() > 0) {

            return response()->json([
                'status' => 'success',
                'respon code' => Response::HTTP_FOUND,
                'message' => "your input" . " " . "$request->kode_jabatan" . " " . "already exists at DB"
            ]);
        } else {
            $input_jabatan = Jb::create($request->all());
            if ($input_jabatan == true) {
                return response()->json([
                    'status' => 'success',
                    'respon code' => Response::HTTP_CREATED,
                    'message' => 'Data has been successfully created',
                    'data' => $input_jabatan
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'respon code' => Response::HTTP_NO_CONTENT,
                    'data' => $input_jabatan
                ]);
            }
        }
    }

    public function getByJabatan(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $query = Jb::select('id', 'kode_jabatan', 'nama_jabatan')->where('id', $request->id);
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
                        'kode_jabatan' => $isi->kode_jabatan,
                        'nama_jabatan' => $isi->nama_jabatan
                    ]
                ]);
            }
        }
    }

    public function updateJabatan(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required',
            'kode_jabatan' => 'required',
            'nama_jabatan' => 'required'
        ]);


        $update_jabatan = Jb::findOrFail($request->id);
        $run_update = $update_jabatan->update($request->all());
        if ($run_update == Response::HTTP_OK) {
            $query = Jb::select('kode_jabatan', 'nama_jabatan')
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

    public function delJabatan(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $cek_data = Jb::select('*')->where('id', $request->id)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Jb::destroy($request->id);

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