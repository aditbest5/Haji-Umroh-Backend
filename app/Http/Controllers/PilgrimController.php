<?php

namespace App\Http\Controllers;

use App\Models\Pilgrim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PilgrimController extends Controller
{
    //

    public function index(){
        try{
            $data = Pilgrim::all();

            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data jemaah!",
                "data" =>$data
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                "response_code"=>"500",
                "response_message"=> $th->getMessage(),
            ],500);
        }
    }

    public function store(Request $request){
            try{
                $request->validate([
                    "name" => "required",
                    "nik" => "required|min:16",
                    "birthday_place" => "required",
                    "birthday_date" => "required|date",
                    "address" => "required",
                    "gender" => "required|in:male,female",
                    "package" => "required|in:itikaf,reguler,vip",
                    "room" => "required|in:quint,quad,triple,double,single",
                    "no_passport" => "required",
                    "period_passport" => "required",
                    "ktp_photo" => "required",
                    "kk_photo" => "required",
                    "selfie_photo" => "required",
                    "passport_photo" => "required",
                    "prov_id" => "required|integer",
                    "city_id" => "required|integer",
                    "dis_id" => "required|integer",
                    // "subdis_id" => "required|integer"
                ]);
                
                $data = $request->all();
                $pilgrim = Pilgrim::create($data);
        
                return response()->json([
                    "response_code" => "201",
                    "response_message" => "Berhasil Tambah Jemaah!",
                    "data" => $pilgrim
                ], 201);

            } catch(\Throwable $th){
                return response()->json([
                    "response_code" => "500",
                    "response_message" => "Terjadi Kesalahan",
                    "error" => $th->getMessage(),
                ], 500);
            }
        
    }
    public function update(Request $request,$id){
        try{
            $pilgrim = Pilgrim::findOrfail($id);
            if(!$pilgrim){
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "Jemaah Tidak ditermukan!",
                    "data" => $pilgrim
                ], 404);
            }
            $pilgrim->update($request->all());
          
            $pilgrim->save();
            return response()->json([
                "response_code" => "201",
                "response_message" => "Berhasil Update Data Jemaah!",
                "data" => $pilgrim
            ], 201);
        } catch(\Throwable $th){
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request, $id){
        try{
            Pilgrim::destroy($id);
            return response()->json([
                'response_code' => "201",
                'response_message' => 'Berhasil Hapus!'
            ],201);
        } catch(\Throwable $th){
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
      
    }
}
