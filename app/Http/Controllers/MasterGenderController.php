<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use Validator;
use Illuminate\Support\Facades\DB;

class MasterGenderController extends Controller
{
    /**
     * Master Gender Create
     */
    public function createGender(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $validator->errors()
            ]);
        }

        $genderall = $request->all();
        $gencreate = Gender::create($genderall);

        return response()->json([
            'status' => true,
            'message' => 'Data Save Successfully!',
            'data' => $gencreate
        ]);
    }

    /**
     * Master Gender List
     */

    public function listGender(Request $request){
        $gender = DB::table('genders')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Show Successfully!',
            'data' => $gender
        ]);
    }

    /**
     * Master Gender Update
     */

    public function putGender(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $validator->errors()
            ]);
        }

        $genderfind = Gender::find($id);

        if(!$genderfind){
           return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $genderfind
           ]);
        }

        $genderall = $request->all();
        $genderupdate = $genderfind->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data Update Successfully!',
            'data' =>  $genderupdate
        ]);
    }

    /**
      * Master Gender Delete
      */

      public function deleteGender(Request $request, $id){
        $genderfind = Gender::find($id);

        if(!$genderfind){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $genderfind
            ]);
        }

        $genderDelete = $genderfind->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Delete Successfully!',
            'data' => $genderDelete
        ]);
      }
}
