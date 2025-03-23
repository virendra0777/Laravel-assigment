<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DryerVentCleaning;
use Validator;

class DryerVentCleaningController extends Controller
{
    public function index(Request $request){
        $list = DryerVentCleaning::where('Deleted_at', '0')->get();  
        return $this->successDataMessage('success',$list);
    }

    public function store(Request $request){
        try{
            $input = $request->all();
    
            $validator = Validator::make($input, [
                'dryer_vent_exit_point' => 'required',
                'price' => 'required'
            ]);
    
            if($validator->fails()){
                $errorMessage = $validator->errors()->first();
                return $this->validationErrorMessage($errorMessage);     
            }
            
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['Created_by'] = $request->user()->id;
            $business = DryerVentCleaning::create($input);
            return $this->successMessage('Created Successfully!');
        } catch(Exception $ex){
            return  $this->errorMessage('Server Error!');
        }
    }

    public function update(Request $request){
        try{
            $input = $request->all();
    
            $validator = Validator::make($input, [
                'dryer_vent_exit_point' => 'required',
                'price' => 'required'
            ]);
    
            if($validator->fails()){
                $errorMessage = $validator->errors()->first();
                return $this->validationErrorMessage($errorMessage);       
            }
            
            $business = DryerVentCleaning::findOrFail($request->Id);
            $business->fill([
                'dryer_vent_exit_point' => $input['dryer_vent_exit_point'],
                'price' => $input['price'],
                'Updated_by' => $request->user()->id,
                'Updated_at' => date('Y-m-d H:i:s')
            ]);
            
            $business->save();
            return $this->successMessage('Updated Successfully!');
        } catch(\Exception $ex){
            return  $this->errorMessage('Server Error!');
        }
    }

    public function delete(Request $request, $Id){
        try{
            $business = DryerVentCleaning::findOrFail($Id);
            $business->fill([
                'Updated_at' => date('Y-m-d H:i:s'),
                'Updated_by' => $request->user()->id,
                'Deleted_at' => 1
            ]);
            $business->save();
            return $this->successMessage('Deleted Successfully!');
        } catch(\Exception $ex){
            return  $this->errorMessage('Server Error!');
        }
    }
}
