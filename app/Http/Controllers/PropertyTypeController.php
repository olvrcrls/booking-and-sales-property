<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PropertyType;

class PropertyTypeController extends Controller
{
    protected $user;
    /**
     * Class Constructor
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->user = \Auth::user()->user_id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property_types = PropertyType::select('property_type_id', 'property_type_name', 'property_type_active',
                                         'property_type_description')
                                        ->where('property_type_active', true)
                                        ->orderBy('property_type_name', 'asc')->get();
        return view('admin.property_type.index', compact('property_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.property_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                'property_type_name' => 'required|max:255|unique:property_types',
                'property_type_description' => 'max:1000'
            ]);
        $new_property_type = PropertyType::create([
                'property_type_name' => request('property_type_name'),
                'property_type_description' => request('property_type_description'),
                'created_by' => $this->user
            ]);
        $this->audit("Added a new property type named '{$new_property_type->property_type_name}'.");
        return redirect()->back()->with('status', "Successfully created '{$new_property_type->property_type_name}'.");
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
     * @param  \App\Models\PropertyType $property_type
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyType $property_type)
    {
        return view('admin.property_type.edit', compact('property_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\PropertyType $property_type
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyType $property_type)
    {
        $this->validate(request(), [
                'property_type_name' => "required|max:255|unique:property_types,property_type_name,{$property_type->property_type_id},property_type_id",
                'property_type_description' => 'max:1000'
            ]);
        $old = $property_type;
        $property_type->update([
                'property_type_name' => request('property_type_name'),
                'property_type_description' => request('property_type_description'),
                'modified_date' => date('Y-m-d h:i:s'),
                'modified_by' => $this->user
            ]);
        $this->audit("Modified '{$old->property_type_name}' into: 
                            Name : '{$property_type->property_type_name}' 
                            Description : '{$property_type->property_type_description}'");
        return redirect()->back()->with('status', "Successfully updated this property type record.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyType $property_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyType $property_type)
    {
        $property_type->property_type_active = false;
        $property_type->modified_date = date('Y-m-d h:i:s');
        $property_type->modified_by = $this->user;
        $property_type->save();
        $this->audit("Property type '{$property_type->property_type_name}' has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\PropertyType $property_type
     * @return \Illuminate\Http\Response
     */
    public function restore(PropertyType $property_type)
    {
        $property_type->property_type_active = true;
        $property_type->modified_date = date('Y-m-d h:i:s');
        $property_type->modified_by = $this->user;
        $property_type->save();
        $this->audit("Property type '{$property_type->property_type_name}' has been restored.");
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
