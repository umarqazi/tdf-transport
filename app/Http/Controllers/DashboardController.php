<?php  namespace LaravelAcl\Http\Controllers;

use View;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use LaravelAcl\Vehicle;
use LaravelAcl\User;
use Hash;
use Datatables;
use Config;
class DashboardController extends Controller{

    public function base(Request $request)
    {
        $id=$request->id;
        $modal="";
        if($id){
            $getVehicleInfo=User::find($id);
            $modal="addVehicle";
        }
        else{
            $getVehicleInfo=new User;
        }
        if($request->get('modal')){
            $modal=$request->get('modal');
        }
        $driverList=User::where('type', Config::get('constants.Users.Driver'))->orderBy('id', 'desc')->get();
        return View::make('admin.dashboard.default')->with(['drivers'=>$driverList,'modal'=>$modal,'vehicle'=>$getVehicleInfo]);
    }
    public function pEditVehicle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => 'required',
            'user_first_name' => 'required',
            'user_last_name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'number_plate' => 'required|unique:users,number_plate,'.$request->id,
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            $modal="addVehicle";
            return Redirect::route('dashboard.default', ['id'=>$request->id,'modal'=>$modal])
                ->withErrors($validator)
                ->withInput();
        }
        $id=$request->id;
        if($id){
            $addUser=User::find($id);        }
        else{
            $addUser=new User;
        }
        $addUser->email=$request->email;
        $addUser->user_first_name=$request->user_first_name;
        $addUser->user_last_name=$request->user_last_name;
        $addUser->phone_number=$request->phone_number;
        $addUser->type=Config::get('constants.Users.Driver');
        $addUser->vehicle_name=$request->vehicle_name;
        $addUser->number_plate=$request->number_plate;
        $addUser->activated=$request->activated;
        if($request->password)
        {
            $addUser->password=Hash::make($request->password);
        }
        $addUser->save();
        return Redirect::route('dashboard.default')->withMessage('Les informations sur le véhicule ont été modifiées.');
    }
    public function checking()
    {
        $driverList=User::where('type', Config::get('constants.Users.Driver'))->select('id', 'user_first_name', 'vehicle_name', 'number_plate', 'type', 'email')->orderBy('id', 'desc')->get();
        $driverArray=array();
        foreach($driverList as $key=>$driver){
            $action='<a href="/admin/users/dashboard?id='.$driver->id.'" class="edit"><i class="fa fa-edit fa-fw"></i></a><a href="/admin/users/delete?id='.$driver->id.'" class="trash delete"><i class="fa fa-trash-o fa-fw"></i></a>';
            $driverArray[$key]=['number_plate'=>$driver['number_plate'], 'vehicle_name'=>$driver['vehicle_name'], 'user_first_name'=>$driver['user_first_name'], 'email'=>$driver['email'], 'type'=>$action];
        }
        $columns = ["id", "type", "user_first_name", "user_last_name", "vehicle_name"];
        return Datatables::of($driverArray)->rawColumns(['type'])->make(true);
    }
}
