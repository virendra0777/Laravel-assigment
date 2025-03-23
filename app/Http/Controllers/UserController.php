<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AirDuctCleaning;
use App\Models\DryerVentCleaning;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller {
    
   /*** Login api */
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if($validator->fails()){
                $errorMessage = $validator->errors()->first();
                return $this->validationErrorMessage($errorMessage);       
            }

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                return $this->successDataMessage('User login successfully.',$success);
            } else { 
                return $this->validationErrorMessage('Unauthorised.', ['error'=>'Unauthorised']);
            } 
        } catch(Exception $ex){ 
            return  $this->errorMessage('Server Error!');
        }
    }

    public function logout(Request $request) {
        try{
            $token = $request->user()->token();
            $token->revoke();
            return $this->successMessage('You have been successfully logged out!');
        } catch(\Exception $ex){
            return  $this->errorMessage('Server Error!');
        }
    }

    public function getQuote(Request $request){
        try{
            $areaSQFT = $request->areaSQFT;
            $exitPointOfDryerVent = $request->exitPointOfDryerVent;
            $furnaceType = $request->furnaceType;
            $noOfFurnace = $request->noOfFurnace ? $request->noOfFurnace : 1;
            $zipcode = $request->zipcode;
            $disinfectant = $request->disinfectant;
            $airDuctPrice = 0;
            $disinfectantPrice = ($disinfectant === 'yes' ? 125 : 0);
            $dryerVentPrice = 0;
            $additionalPrice = 0;
            $totalPrice = 0;

            if($areaSQFT && $noOfFurnace){
                $airduct = AirDuctCleaning::where('Deleted_at','0')
                    ->where('num_furnace',$noOfFurnace)
                    ->where(function($q) use($areaSQFT){
                        $q->where('square_footage_min','<',$areaSQFT);
                        $q->where('square_footage_max','>',$areaSQFT);
                    })
                    ->first();
                $airDuctPrice = (isset($airduct->final_price) ? (($furnaceType === 'Side by Side') ? $airduct->furnace_loc_sidebyside : (($furnaceType === 'Different Locations and/or Floors') ? $airduct->furnace_loc_different : $airduct->final_price)) : 0 );
            }
            if($exitPointOfDryerVent){
                $dryerVent = DryerVentCleaning::where('Deleted_at','0')->where('dryer_vent_exit_point',$exitPointOfDryerVent)->first();
                $dryerVentPrice = isset($dryerVent->price) ?  $dryerVent->price : 0;
            }
            $data = [
                'airDuctPrice' => $airDuctPrice, 
                'disinfectantPrice'=> $disinfectantPrice, 
                'dryerVentPrice' => $dryerVentPrice,
                'additionalPrice' => $additionalPrice,
                'totalPrice' => ($airDuctPrice + $disinfectantPrice + $dryerVentPrice + $additionalPrice)
            ];
            return $this->successDataMessage('Success',$data);
        } catch(Exception $ex){
            return  $this->errorMessage('Server Error!');
        }
    }
}