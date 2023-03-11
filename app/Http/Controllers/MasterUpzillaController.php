<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upozilla;
use Validator;
use Illuminate\Support\Facades\DB;

class MasterUpzillaController extends Controller
{  
    /**
     * Master_Upzilla Create
     */
    public function createUpzilla(Request $request){
        $validation = Validator::make($request->all(),[
            'division_id' => 'required',
            'district_id' => 'required',
            'name' => 'required',
            'code' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => $validation->errors()
            ], 401);
        }

        $upzilaAll = $request->all();
        $upzilacreate = Upozilla::create($upzilaAll);

        return response()->json([
            'status' => true,
            'message' => 'Data Save Successfully!',
            'data' => $upzilacreate
        ]);
    }

    /**
     * Master_Upzilla List
     */

    public function listUpzilla(Request $request){
        $upzillaList = DB::table('upozillas')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Show Successfully!',
            'data' => $upzillaList
        ]);
    }

     /**
      * Master_Upazilla Update
      */

    public function updateUpzilla(Request $request, $id){
        $validation = Validator::make($request->all(),[
            'division_id' => 'required',
            'district_id' => 'required',
            'name' => 'required',
            'code' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => $validation->errors()
            ], 401);
        }

        $upzillafind = Upozilla::find($id);

        if(!$upzillafind){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Find',
                'errors' => $upzillafind
            ]);
        }

        $upozillaAll = $request->all();
        $upzillaUpdate = $upzillafind->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data Updated Successfully!',
            'data' => $upzillaUpdate
        ]);
     }

     /**
      * Master Upazilla Delete
      */

    public function deleteUpzilla(Request $request, $id){

        $upzilladelete = Upozilla::find($id);
        if(!$upzilladelete){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $upzilladelete
            ]);
        }

        $upzillaDelete =  $upzilladelete->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Delete Successfully!',
            'data' => $upzillaDelete
        ]);
    }

     
}
