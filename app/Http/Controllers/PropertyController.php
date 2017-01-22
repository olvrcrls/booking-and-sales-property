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
        $this->middleware('adaccess');
        // \Auth::loginUsingId(1);
        // $this->user = \Auth::user()->user_id;
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
                            }, 'statues' => function ($q) {
                                $q->select(['property_status_id', 'property_status_name']);
                            }, 'types' => function ($q) {
                                $q->select(['property_type_id', 'property_type_name']);
                            }, 'features' => function ($q) {
                                $q->with(['feature_types', function ($sub) { $sub->select(['feature_type_id', 'feature_type_name']); }])
                                    ->select(['feature_id', 'feature_name', 'feature_type_id']);
                            }, 'photos' => function ($q) {
                                $q->select(['property_photo_id', 'property_photo_description', 'file_path']);
                            }])->where('property_active', true)
                               ->orderBy('property_name', 'asc')->get();
        return view('admin.property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // code
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // code
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // code
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //code
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //code
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //code
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
                            }, 'statues' => function ($q) {
                                $q->select(['property_status_id', 'property_status_name']);
                            }, 'types' => function ($q) {
                                $q->select(['property_type_id', 'property_type_name']);
                            }, 'features' => function ($q) {
                                $q->with(['feature_types', function ($sub) { $sub->select(['feature_type_id', 'feature_type_name']); }])
                                    ->select(['feature_id', 'feature_name', 'feature_type_id']);
                            }, 'photos' => function ($q) {
                                $q->select(['property_photo_id', 'property_photo_description', 'file_path']);
                            }])->where('property_active', true)
                               ->orderBy('property_name', 'asc')->get();
    }
}
