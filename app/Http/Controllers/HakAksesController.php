<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\HakAkses as Hk;

class HakAksesController extends Controller
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

    public function getAllAkses(): JsonResponse
    {
        $get_data = Hk::select('id', 'nama_akses')->get();
        if ($get_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            return response()->json($get_data, Response::HTTP_OK);
        }
    }

    public function addAkses(Request $request)
    {
        $this->validate($request, [
            'nama_akses' => 'required'
        ]);
        $cek_duplicate = Hk::select('*')->where('nama_akses', $request->nama_akses)->get();
        if ($cek_duplicate->count() > 0) {

            return response()->json([
                'status' => 'success',
                'respon code' => Response::HTTP_FOUND,
                'message' => "your input" . " " . "$request->nama_akses" . " " . "already exists at DB"
            ]);
        } else {
            $input_akses = Hk::create($request->all());
            if ($input_akses == true) {
                return response()->json([
                    'status' => 'success',
                    'respon code' => Response::HTTP_CREATED,
                    'message' => 'Data has been successfully created',
                    'data' => $input_akses
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'respon code' => Response::HTTP_NO_CONTENT,
                    'data' => $input_akses
                ]);
            }
        }
    }

    public function getByAkses(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $query = Hk::select('id', 'nama_akses')->where('id', $request->id);
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
                        'nama_akses' => $isi->nama_akses,
                    ]
                ]);
            }
        }
    }

    public function updateAkses(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required',
            'nama_akses' => 'required'
        ]);


        $update_jabatan = Hk::findOrFail($request->id);
        $run_update = $update_jabatan->update($request->all());
        if ($run_update == true) {
            $query = Hk::select('nama_akses')
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
                'status' => 'error',
                'message' => 'Data has been unsuccessfully modified.!',
                'respon code' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function delAkses(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $cek_data = Hk::select('*')->where('id', $request->id)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Hk::destroy($request->id);

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