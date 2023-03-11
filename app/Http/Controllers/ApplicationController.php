<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicationdetail;
use Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Application and application details table data send
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'agreement_no' => 'required',
            'application_id' => 'required',
            'first_agreement_date' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $validator->errors()
           ], 401);
        }

        try {

            $application = new Application;
            $application->agreement_no = $request->agreement_no;
            $application->application_id = $request->application_id	;
            $application->first_agreement_date = $request->first_agreement_date;
            $application->agreement_date = $request->agreement_date;
            $application->expire_date = $request->expire_date;
            $application->allocation_status = $request->allocation_status;
            $application->status = $request->status;
            $application->save_status = $request->save_status;
            $application->save();

            if ($application) {
               $app_Details = new Applicationdetail;
               $app_Details->application_id = $application->id;
               $app_Details->application_name = $request->application_name;
               $app_Details->father_name = $request->father_name;
               $app_Details->mother_name = $request->mother_name;
               $app_Details->mobile_number = $request->mobile_number;
               $app_Details->division_id = $request->division_id;
               $app_Details->district_id = $request->district_id;
               $app_Details->upozilla_id = $request->upozilla_id;
               $app_Details->save();
            }
            
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Create Successfully!',
            'data' => $application
        ]);
    }

    /**
     * final save
     */
    public function finalSave(Request $request, $id)
    {
        
        $application = Application::where('id', $request->id)->first();
        if (!$application) {
            return response()->json([
                'status' => false,
                'message' => 'data not found'
            ]);
        }
        $application->save_status = 2;
        $application->update();

        return response()->json([
            'status' => true,
            'message' => 'final Save Successfully!',
            'data' => $application
        ]);

    }

    /**
     * approval save
     */

     public function approvalSave(Request $request, $id)
     {
        $applicationapp = Application::where('id', $request->id)->first();
        if(!$applicationapp){
            return response()->json([
                'status' =>false,
                'message' => 'data not fuond'
            ]);
        }

        $applicationapp->status = 1;
        $applicationapp->update();

        return response()->json([
            'status' => true,
            'message' => 'approval data save',
            'data' => $applicationapp
        ]);
     }

     /**
      * agreement save update
      */

     public function agreementSave(Request $request, $id)
     {
        $agreementApplication = Application::where('id', $request->id)->first();
        if(!$agreementApplication){
            return response()->json([
                'status' => false,
                'message' => 'data not found'
            ]);
        }

        $agreementApplication->status = 2;
        $agreementApplication->update();
        
        return response()->json([
            'status' => true,
            'message' => 'Agreement Data Save Successfully!',
            'data' => $agreementApplication
        ]);
     }

     /**
      * application(approval,agreement) get
      */

      public function applicationList(Request $request){
        $listApplication = Application::whereIn('status',[1,2])->get();

        return response()->json([
            'status' => true,
            'message' => 'Data List Successfully',
            'data' => $listApplication
        ]);
      }


      public function saveStatusDraf(Request $request){
        $draflist = Application::where('save_status',1)->get();

        return response()->json([
            'status' => true,
            'message' => 'Draf data show successfully!',
            'data' => $draflist
        ]);
      }

      /**
       * list save_status draf
       */
       /*
       public function saveList(Request $request){
        $listSave = Application::whereIn('save_status',[7,8,9])->get();

        return response()->json([
            'status' => true,
            'message' => 'Data get Successfully',
            'data' => $listSave
        ]);
       }
       */


      public function saveStatus(Request $request){
        $saveStaus = Application::where('save_status',2)->get();

        return response()->json([
            'status' => true,
            'message' => 'Save Status Show Successfully',
            'data' => $saveStaus
        ]);
      }

       /**
        * Application  Update
        */

       public function applicationUpdate(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'agreement_no' => 'required',
            'application_id' => 'required',
            'first_agreement_date' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $validator->errors()
           ], 401);
        }

        try {

            $application = Application::find($id);
            $application->agreement_no = $request->agreement_no;
            $application->application_id = $request->application_id	;
            $application->first_agreement_date = $request->first_agreement_date;
            $application->agreement_date = $request->agreement_date;
            $application->expire_date = $request->expire_date;
            $application->allocation_status = $request->allocation_status;
            $application->status = $request->status;
            $application->save_status = $request->save_status;
            $application->save();

            if ($application) {
               $app_Details = Applicationdetail::find($id);
               $app_Details->application_id = $application->id;
               $app_Details->application_name = $request->application_name;
               $app_Details->father_name = $request->father_name;
               $app_Details->mother_name = $request->mother_name;
               $app_Details->mobile_number = $request->mobile_number;
               $app_Details->division_id = $request->division_id;
               $app_Details->district_id = $request->district_id;
               $app_Details->upozilla_id = $request->upozilla_id;
               $app_Details->save();
            }
            
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Create Successfully!',
            'data' => $application
        ]);


       }
}
