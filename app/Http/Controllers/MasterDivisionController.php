<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Validator;

class MasterDivisionController extends Controller
{

    /**
     * Master_Division Create
     */
    public function createDivision(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $validator->errors()
            ], 401);
        }

        $inputdivision = $request->all();
        $division = Division::create($inputdivision);

        return response()->json([
            'status' => true,
            'message' => 'Data Save Successfully!',
            'data' => $division
        ]);
        
    }

    /**
     * Master_Division Get
     */

    public function listDivision(Request $request){
        $divisionget = DB::table('divisions')->get();
        //$products = DB::table('products')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Get Successfully!',
            'data' => $divisionget
        ]);
    }

    /**
     * Master_Division Update
     */

     public function updateDivision(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $validator->errors()
            ], 401);
        }

         $divisionupdate = Division::find($id);

         if(!$divisionupdate){
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found',
                    'errors' => $divisionupdate
                ]);
            }
         
         $divisionAll = $request->all();
         $update = $divisionupdate->update($request->all());
         
         return response()->json([
            'status' => true,
            'message' => 'Data Update Successfully!',
            'data' => $update
         ]);
     }

     /**
      * Master Division Delete
      */

      public function deleteDivision(Request $request, $id){
        $divisiondelete = Division::find($id);

        if(!$divisiondelete){
             return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' =>  $divisiondelete
            ]);
        }

       // $divisionAll = $request->all();
         $delete = $divisiondelete->delete();

         return response()->json([
            'status' => true,
            'message' => 'Data Update Successfully!',
            'data' => $delete
         ]);

      }
}
