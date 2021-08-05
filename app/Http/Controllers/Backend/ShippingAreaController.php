<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function DivisionView(){
        $divisions=ShipDivision::orderby('id','DESC')->get();
        return view('backend.ship.division.view_divisions',compact('divisions'));

    }

    public function DivisionStore(Request $request){
        $request->validate([
            'division_name'=>'required',
        ]);
        ShipDivision::insert([
            'division_name'=>strtoupper($request->division_name),
            'created_at'=>Carbon::now(),
            
        ]);
        $notification=array(
            'message'=>'Division Inserted Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);


    }
    public function DivisionEdit($id){
        $divisions=ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division',compact('divisions'));
    }
    public function DivisionUpdate(Request $request){
        $division_id=$request->id;
        
            ShipDivision::findOrFail($division_id)->update([
                'division_name'=>strtoupper($request->division_name),
                'updated_at'=>Carbon::now(),
            ]);
            $notification=array(
                'message'=>'Division Updated Successfully !',
                'alert-type'=>'info'
            );
            return redirect()->route('manage-division')->with($notification);

        
      

    }
    public function DivisionDelete($id){
        $coupon=ShipDivision::findOrFail($id);
        ShipDivision::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Division Deleted Successfully !',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }



    // District method
    public function DistrictView(){
        $division=ShipDivision::orderby('division_name','ASC')->get();
        $district=ShipDistrict::with('division')->orderby('id','DESC')->get();
        return view('backend.ship.district.view_district',compact('division','district'));

    }

    public function DistrictStore(Request $request){
        $request->validate([
            'division_id'=>"required",
            'district_name'=>'required',
        ]);
        ShipDistrict::insert([
            'division_id'=>$request->division_id,
            'district_name'=>strtoupper($request->district_name),
            'created_at'=>Carbon::now(),
            
        ]);
        $notification=array(
            'message'=>'District Inserted Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);


    }
    public function DistrictEdit($id){
        $division=ShipDivision::orderby('division_name','ASC')->get();
        $district=ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district',compact('division','district'));
    }
    public function DistrictUpdate(Request $request){
        $district_id=$request->id;
        
            ShipDistrict::findOrFail($district_id)->update([
                'district_name'=>strtoupper($request->district_name),
                'updated_at'=>Carbon::now(),
            ]);
            $notification=array(
                'message'=>'District Updated Successfully !',
                'alert-type'=>'info'
            );
            return redirect()->route('manage-district')->with($notification);

        
      

    }
    public function DistrictDelete($id){
        $district=ShipDistrict::findOrFail($id);
        ShipDistrict::findOrFail($id)->delete();
        $notification=array(
            'message'=>'District Deleted Successfully !',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }

     // State method
     public function StateView(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::with('division','district')->orderBy('id','DESC')->get();
            return view('backend.ship.state.view_state',compact('division','district','state'));
    }
    public function StateStore(Request $request){

    	$request->validate([
    		'division_id' => 'required',  
    		'district_id' => 'required', 
    		'state_name' => 'required', 	 
    	]);


	ShipState::insert([

		'division_id' => $request->division_id,
		'district_id' => $request->district_id,
		'state_name' => $request->state_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'State Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    }
    public function StateEdit($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
            return view('backend.ship.state.edit_state',compact('division','district','state'));
        } 

    public function StateUpdate(Request $request,$id){

            ShipState::findOrFail($id)->update([
    
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
    
            ]);
    
            $notification = array(
                'message' => 'State Updated Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('manage-state')->with($notification);
    
    
        } 
        
        public function StateDelete($id){

            ShipState::findOrFail($id)->delete();
    
            $notification = array(
                'message' => 'State Deleted Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
    
        } // end     


}
