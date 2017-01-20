<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PropertyStatus;

class PropertyStatusController extends Controller
{
    protected $user;
    /**
     * Class Constructor
     * @param    $user   
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
        $property_statuses = PropertyStatus::select('property_status_name', 'property_status_active', 'property_status_description', 'property_status_id')
                                            ->where('property_status_active', true)
                                            ->orderBy('property_status_name', 'asc')->get();
        return view('admin.property_status.index', compact('property_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.property_status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                'property_status_name' => 'required|max:255|unique:property_statuses',
                'property_status_description' => 'max:1000'
            ]);
        $new_property_status = PropertyStatus::create([
                'property_status_name' => request('property_status_name'),
                'property_status_description' => request('property_status_description'),
                'created_by' => $this->user
            ]);
        $this->audit("A new property named as '{$new_property_status->property_status_name}' has been created.");
        return redirect()->back()->with('status', "Successfully created '{$new_property_status->property_status_name}'.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyStatus $property_status
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyStatus $property_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyStatus $property_status
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyStatus $property_status)
    {
        return view('admin.property_status.edit', compact('property_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyStatus $property_status
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyStatus $property_status)
    {
        $this->validate(request(), [
                'property_status_name' => "required|max:255|unique:property_statuses,property_status_name,{$property_status->property_status_id},property_status_id",
                'property_status_description' => 'max:1000'
            ]);
        $old = $property_status;
        $property_status->update([
                'property_status_name' => request('property_status_name'),
                'property_status_description' => request('property_status_description'),
                'modified_by' => $this->user,
                'modified_date' => date('Y-m-d h:i:s')
            ]);
        $this->audit("Modified property status named as '{$old->property_status_name}' with the following: 
                    Name : '{$property_status->property_status_name}',
                    Description : '{$property_status->property_status_description}'
            ");
        return redirect()->back()->with('status', "Successfully updated this property status record.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyStatus $property_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyStatus $property_status)
    {
        $property_status->property_status_active = false;
        $property_status->modified_date = date('Y-m-d h:i:s');
        $property_status->modified_by = $this->user;
        $property_status->save();
        $this->audit("Property status '{$property_status->property_status_name}' has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\PropertyStatus $property_status
     * @return \Illuminate\Http\Response
     */
    public function restore(PropertyStatus $property_status)
    {
        $property_status->property_status_active = true;
        $property_status->modified_date = date('Y-m-d h:i:s');
        $property_status->modified_by = $this->user;
        $property_status->save();
        $this->audit("Property status '{$property_status->property_status_name}' has been restored.");
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
