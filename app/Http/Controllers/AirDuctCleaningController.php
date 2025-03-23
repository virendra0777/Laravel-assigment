<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AirDuctCleaning;
use Validator;

class AirDuctCleaningController extends Controller
{
    public function index(Request $request){
        $list = AirDuctCleaning::where('Deleted_at', '0')->get();  
        return $this->successDataMessage('success',$list);
    }

    public function store(Request $request){
        try{
            $input = $request->all();
    
            $validator = Validator::make($input, [
                'num_furnace' => 'required',
                'square_footage_min' => 'required',
                'square_footage_max' => 'required',
                'furnace_loc_sidebyside' => 'required',
                'furnace_loc_different' => 'required',
                'final_price' => 'required'
            ]);
    
            if($validator->fails()){
                $errorMessage = $validator->errors()->first();
                return $this->validationErrorMessage($errorMessage);       
            }
            
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['Created_by'] = $request->user()->id;
            $business = AirDuctCleaning::create($input);
            return $this->successMessage('Created Successfully!');
        } catch(\Exception $ex){
            return  $this->errorMessage('Server Error!');
        }
    }

    public function update(Request $request){
        try{
            $input = $request->all();
    
            $validator = Validator::make($input, [
                'num_furnace' => 'required',
                'square_footage_min' => 'required',
                'square_footage_max' => 'required',
                'furnace_loc_sidebyside' => 'required',
                'furnace_loc_different' => 'required',
                'final_price' => 'required'
            ]);
    
            if($validator->fails()){
                $errorMessage = $validator->errors()->first();
                return $this->validationErrorMessage($errorMessage);       
            }
            
            $business = AirDuctCleaning::findOrFail($request->Id);
            $business->fill([
                'num_furnace' => $input['num_furnace'],
                'square_footage_min' => $input['square_footage_min'],
                'square_footage_max' => $input['square_footage_max'],
                'furnace_loc_sidebyside' => $input['furnace_loc_sidebyside'],
                'furnace_loc_different' => $input['furnace_loc_different'],
                'final_price' => $input['final_price'],
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
            $business = AirDuctCleaning::findOrFail($Id);
            $business->fill([
                'Updated_at' => date('Y-m-d H:i:s'),
                'Updated_by' => $request->user()->id,
                'Deleted_at' => 1
            ]);
            $business->save();
            return $this->successMessage('Deleted successfully!');
        } catch(\Exception $ex){
            return  $this->errorMessage('Server Error!');
        }
    }
}
