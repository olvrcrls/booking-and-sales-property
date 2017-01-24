<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
class PropertyController extends Controller
{
    protected $user;
    /**
     * Class Constructor
     */
    public function __construct()
    {
        /**
        * Assigning middleware for administrator access
        * except for the API fuctions.
        */
        // $this->middleware('adaccess')->except(['list']);
        \Auth::loginUsingId(1);
        $this->user = \Auth::user()->user_id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::with(['cities' => function ($q) {
                                $q->select(['city_id', 'city_name', 'city_region_id']);
                            }, 'statuses' => function ($q) {
                                $q->select(['property_status_id', 'property_status_name']);
                            }, 'types' => function ($q) {
                                $q->select(['property_type_id', 'property_type_name']);
                            }, 'features' => function ($q) {
                                $q->with(['feature_types' => function ($sub) { $sub->select(['feature_type_id', 'feature_type_name']); }])
                                    ->select(['feature_id', 'feature_name', 'feature_type_id']);
                            }, 'photos' => function ($q) {
                                $q->select(['property_photo_id', 'property_photo_description', 'file_path']);
                            }])->select('property_name', 'property_id', 'property_size', 'property_price', 'property_bed_capacity', 'property_bath_capacity', 'property_garage_capacity', 'property_description', 'property_is_negotiable',
                                'property_address', 'property_active', 'property_status_id', 'property_city_id', 'property_type_id', 'url_slug', 'property_is_occupied', 'property_is_sold', 'property_active')
                               ->where('property_active', true)
                               ->where('property_is_sold', false)
                               ->orderBy('property_type_id', 'asc')->get();
        return view('admin.property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = \App\Models\PropertyStatus::select('property_status_id', 'property_status_name')
                                                ->where('property_status_active', true)
                                                ->orderBy('property_status_name', 'asc')
                                                ->get();
        $types = \App\Models\PropertyType::select('property_type_id', 'property_type_name')
                                            ->where('property_type_active', true)
                                            ->orderBy('property_type_name', 'asc')
                                            ->get();
        $cities = \App\Models\City::with(['regions' => function ($q) { $q->select(['region_id', 'region_name']); }]) 
                                ->select('city_id','city_name','city_region_id')
                                ->where('city_active', true)
                                ->orderBy('city_name', 'asc')->get();                                
        return view('admin.property.create', compact('statuses', 'types', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                'property_name' => 'required|max:255|unique:properties',
                'property_description' => 'required|max:5000',
                'property_city' => 'required|numeric',
                'property_type' => 'required|numeric',
                'property_status' => 'required|numeric',
                'property_price' => 'required|numeric',
                'property_size' => 'required|numeric',
                'property_bedroom' => 'required|numeric',
                'property_bathroom' => 'required|numeric',
                'property_garage' => 'required|numeric',
                'property_address' => 'required|max:1500'
            ]);
        $new_property = Property::create([
                'property_name' => request('property_name'),
                'property_city_id' => request('property_city'),
                'property_status_id' => request('property_status'),
                'property_type_id' => request('property_type'),
                'property_price' => request('property_price'),
                'property_bath_capacity' => request('property_bathroom'),
                'property_bed_capacity' => request('property_bedroom'),
                'property_garage_capacity' => request('property_garage'),
                'property_address' => request('property_address'),
                'property_size' => request('property_size'),
                'property_description' => request('property_description'),
                'property_is_negotiable' => (request('is_negotiable') ? 1 : 0),
                'url_slug' => str_slug(request('property_name'), '-'),
                'created_by' => $this->user
            ]);
        $this->audit("A new property has been created named as '{$new_property->property_name}' with the following specifications: 
                            Address : {$new_property->property_address} 
                            City : {$new_property->cities->city_name}
                            Size : {$new_property->property_size} SQ. M.
                            Description : {$new_property->property_description} 
                            Price : {$new_property->property_price} 
                            Bathroom(s) : {$new_property->property_bath_capacity} 
                            Bedroom(s) : {$new_property->property_bed_capacity} 
                            Garage(s) : {$new_property->property_garage_capacity} 
                            Type : {$new_property->types->property_type_name} 
                            Status : {$new_property->statuses->property_status_name} 
                            Negotiable : ". ($new_property->property_is_negotiable ? "Yes" : "No") ." 
                            Occupied : No
                            Sold : No
                            ");
        return redirect()->back()->with('status', "Successfully created a new property named as '{$new_property->property_name}'.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $statuses = \App\Models\PropertyStatus::select('property_status_id', 'property_status_name')
                                                ->where('property_status_active', true)
                                                ->orderBy('property_status_name', 'asc')
                                                ->get();
        $types = \App\Models\PropertyType::select('property_type_id', 'property_type_name')
                                            ->where('property_type_active', true)
                                            ->orderBy('property_type_name', 'asc')
                                            ->get();
        $cities = \App\Models\City::with(['regions' => function ($q) { $q->select(['region_id', 'region_name']); }]) 
                                ->select('city_id','city_name','city_region_id')
                                ->where('city_active', true)
                                ->orderBy('city_name', 'asc')->get(); 
        return view('admin.property.edit', compact('property', 'cities', 'statuses', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(Property $property)
    {
        $this->validate(request(), [
                'property_name' => "required|max:255|unique:properties,property_name,{$property->property_id},property_id",
                'property_description' => 'required|max:5000',
                'property_city' => 'required|numeric',
                'property_type' => 'required|numeric',
                'property_status' => 'required|numeric',
                'property_price' => 'required|numeric',
                'property_size' => 'required|numeric',
                'property_bedroom' => 'required|numeric',
                'property_bathroom' => 'required|numeric',
                'property_garage' => 'required|numeric',
                'property_address' => 'required|max:1500'
            ]);
        $old = $property;
        $property->update([
                'property_name' => request('property_name'),
                'property_city_id' => request('property_city'),
                'property_status_id' => request('property_status'),
                'property_type_id' => request('property_type'),
                'property_price' => request('property_price'),
                'property_bath_capacity' => request('property_bathroom'),
                'property_bed_capacity' => request('property_bedroom'),
                'property_garage_capacity' => request('property_garage'),
                'property_address' => request('property_address'),
                'property_size' => request('property_size'),
                'property_description' => request('property_description'),
                'property_is_negotiable' => (request('is_negotiable') ? 1 : 0),
                'property_is_occupied' => (request('is_occupied') ? 1 : 0),
                'property_is_sold' => (request('is_sold') ? 1 : 0),
                'url_slug' => str_slug(request('property_name'), '-'),
                'modified_date' => date('Y-m-d h:i:s'),
                'modified_by' => $this->user
            ]);
        $this->audit("A property has been modified named as '{$old->property_name}' to '{$property->property_name}' with the following changes: 
                            Address : {$old->property_address} to {$property->property_address}
                            City : {$old->cities->city_name} to {$property->cities->city_name}
                            Size : {$old->property_size} SQ. M. to {$property->property_size} SQ.M.
                            Description : {$old->property_description} to {$property->property_description}
                            Price : {$old->property_price} to {$property->property_price}
                            Bathroom(s) : {$old->property_bath_capacity} to {$property->property_bath_capacity}
                            Bedroom(s) : {$old->property_bed_capacity} to {$property->property_bed_capacity}
                            Garage(s) : {$old->property_garage_capacity} to {$property->property_garage_capacity}
                            Type : {$old->types->property_type_name} to {$property->types->property_type_name}
                            Status : {$old->statuses->property_status_name} to {$property->statuses->property_status_name}
                            Negotiable : ". ($old->property_is_negotiable ? "Yes" : "No") ." to ". ($property->property_is_negotiable ? "Yes" : "No") ."
                            Occupied : ". ($old->property_is_occupied ? "Yes" : "No") ." to ". ($property->property_is_occupied ? "Yes" : "No") ."
                            Sold : No ". ($old->property_is_sold ? "Yes" : "No") ." to ". ($property->property_is_sold ? "Yes" : "No") ."");
        return redirect()->back()->with('status', 'Successfully updated this property record.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->property_active = false;
        $property->modified_date = date('Y-m-d h:i:s');
        $property->modified_by = $this->user;
        $property->save();
        $this->audit("A property named as '{$property->property_name}' has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function restore(Property $property)
    {
        $property->property_active = true;
        $property->modified_date = date('Y-m-d h:i:s');
        $property->modified_by = $this->user;
        $property->save();
        $this->audit("A property named as '{$property->property_name}' has been restored.");
        return back();
    }

    public function audit($action = '')
    {
        return \App\AuditTrail::create([
                'audit_action' => $action,
                'audit_user' => $this->user
            ]);
    }

    // API functions
    /**
    * Returns a list of active properties.
    * @return App\Models\Property $properties
    *
    */
    public function list()
    {
        return $properties = Property::with(['cities' => function ($q) {
                                $q->select(['city_id', 'city_name', 'city_region_id']);
                            }, 'statuses' => function ($q) {
                                $q->select(['property_status_id', 'property_status_name']);
                            }, 'types' => function ($q) {
                                $q->select(['property_type_id', 'property_type_name']);
                            }, 'features' => function ($q) {
                                $q->with(['feature_types', function ($sub) { $sub->select(['feature_type_id', 'feature_type_name']); }])
                                    ->select(['feature_id', 'feature_name', 'feature_type_id']);
                            }, 'photos' => function ($q) {
                                $q->select(['property_photo_id', 'property_photo_description', 'file_path']);
                            }])->select('property_name', 'property_id', 'property_size', 'property_price', 'property_bed_capacity', 'property_bath_capacity', 'property_garage_capacity', 'property_description', 'property_is_negotiable',
                                'property_address', 'property_status_id', 'property_city_id', 'property_type_id', 'url_slug')
                               ->where('property_active', true)
                               ->where('property_is_sold', false)
                               ->orderBy('property_name', 'asc')->get();
    }
}
