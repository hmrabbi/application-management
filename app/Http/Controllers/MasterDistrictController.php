<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use Validator;
use Illuminate\Support\Facades\DB;

class MasterDistrictController extends Controller
{
    /**
     * Master_District Create
     */
    public function createDistrict(Request $request){
        $validator = Validator::make($request->all(),[
            'division_id' => 'required',
            'name' => 'required',
            'code' => 'required'
        ]);

        if($validator->fails()){
           return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $validator->errors()
           ], 401);
        }

        $inputdist = $request->all();
        $distcreate = District::create($inputdist);

        return response()->json([
            'status' => true,
            'message' => 'Data Create Successfully!',
            'data' => $distcreate
        ]);
    }

    /**
     * Master_District List
     */
    public function listDistrict(Request $request){
        $distlist =  DB::table('districts')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Show Successfull!',
            'data' => $distlist
        ]);
    }

    /**
     * Master_District Update
     */
    public function updateDistrict(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'division_id' => 'required',
            'name' => 'required',
            'code' => 'required'
        ]);

        if($validator->fails()){
           return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $validator->errors()
           ], 401);
        }

        
        $distfind = District::find($id);
        
        if(!$distfind){
           return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $distfind
           ]);
        }

        $inputdist = $request->all();
        $distupdate = $distfind->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data Updated Successfully!',
            'data' => $distupdate
        ]);
    }

    /**
     * delete
     */

    public function deleteDistrict(Request $request, $id){
        $distfind = District::find($id);
        
        if(!$distfind){
           return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $distfind
           ]);
        
        }

        $distdelete = $distfind->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Updated Successfully!',
            'data' => $distdelete
        ]);
    }
}
