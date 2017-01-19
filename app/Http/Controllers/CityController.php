<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{

    protected $user;

    /**
     * Class Constructor
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
        $cities = City::with(['regions' => function ($query) { $query->select(['region_id', 'region_name']); }])
                        ->select('city_id', 'city_name', 'city_region_id', 'url_slug')
                        ->where('city_active', true)
                        ->orderBy('city_name', 'asc')
                        ->get();
        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $regions = \App\Models\Region::select('region_id', 'region_name')
                    ->where('region_active', true)
                    ->orderBy('region_name', 'asc')
                    ->get();
        return view('admin.city.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                'city_name' => 'required|max:255|unique:cities',
                'city_zip_code' => 'required|numeric|digits_between:4,5|unique:cities',
                'city_region' => 'required|numeric'
            ]);
        $new_city = City::create([
                'city_name' => request('city_name'),
                'city_region_id' => request('city_region'),
                'city_zip_code' => request('city_zip_code'),
                'url_slug' => str_slug(request('city_name'), '-'),
                'created_by' => $this->user
            ]);
        $this->audit("A new city named '{$new_city->city_name}' has been created.");
        return redirect()->back()->with('status', "Successfully created '{$new_city->city_name}'.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $regions = \App\Models\Region::select('region_id', 'region_name')
                    ->where('region_active', true)
                    ->orderBy('region_name', 'asc')
                    ->get();
        return view('admin.city.edit', compact('city', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(City $city)
    {
        $this->validate(request(), [
                'city_name' => "required|max:255|unique:cities,city_name,{$city->city_id},city_id",
                'city_zip_code' => "required|numeric|digits_between:4,5|unique:cities,city_zip_code,{$city->city_id},city_id",
                'url_slug' => "required|max:255|unique:cities,url_slug,{$city->city_id},city_id",
                'city_region' => "required|numeric"
            ]);
        $old = $city;
        $url_slug = str_slug(request('url_slug'), '-');
        $city->update([
                'city_name' => request('city_name'),
                'city_zip_code' => request('city_zip_code'),
                'url_slug' => $url_slug,
                'city_region_id' => request('city_region'),
                'modified_date' => date('Y-m-d'),
                'modified_by' => $this->user
            ]);
        $this->audit("Updated '{$old->city_name}' with new data: 
                    Name : $city->city_name
                    Zip Code : $city->city_zip_code
                    Url Slug : $city->url_slug
                    Region ID : $city->city_region_id
            ");
        return redirect()->back()->with('status', "Successfully updated this city record.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->city_active = false;
        $city->modified_date = date('Y-m-d');
        $city->modified_by = $this->user;
        $city->save();
        $this->audit("{$city->city_name} has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function restore(City $city)
    {
        $city->city_active = true;
        $city->modified_date = date('Y-m-d');
        $city->modified_by = $this->user;
        $city->save();
        $this->audit("{$city->city_name} has been restored.");
        return back();
    }

    public function audit($action = '')
    {
        return \App\AuditTrail::create([
                'audit_action' => $action,
                'audit_user' => $this->user
            ]);
    }
}
