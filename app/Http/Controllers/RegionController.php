<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
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
        $regions = Region::select('region_id', 'region_name', 'region_active')
                    ->where('region_active', true)
                    ->orderBy('region_name', 'asc')->get();
        return view('admin.region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                'region_name' => 'required|max:255|unique:regions'
            ]);
        $new_region = Region::create([
                'region_name' => request('region_name'),
                'created_by' => $this->user
            ]);
        $this->audit("Added new region named as '{$new_region->region_name}'.");
        return redirect()->back()->with('status', "Successfully added {$new_region->region_name}.");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return $region = Region::with(['cities' => function ($query) {
                $query->select(['city_id', 'city_name']);
            }])
            ->select('region_id', 'region_name')
            ->where('region_id', $region->region_id)
            ->get();
        return view('admin.region.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('admin.region.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(Region $region)
    {
        $this->validate(request(), [
                'region_name' => "required|max:255|unique:regions,region_name,{$region->region_id},region_id"
            ]);
        $old = $region;
        $region->update([
                'region_name' => request('region_name'),
                'modified_by' => $this->user,
                'modified_date' => date('Y-m-d h:i:s')
            ]);
        $this->audit("'{$old->region_name}' has been renamed as '{$region->region_name}'.");
        return redirect()->back()->with('status', "Successfully updated this region.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->region_active = false;
        $region->modified_date = date('Y-m-d h:i:s');
        $region->modified_by = $this->user;
        $region->save();
        $this->audit("'{$region->region_name}' has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function restore(Region $region)
    {
        $region->region_active = true;
        $region->modified_date = date('Y-m-d h:i:s');
        $region->modified_by = $this->user;
        $region->save();
        $this->audit("'{$region->region_name}' has been restored.");
        return back();
    }

    /**
     * Audits specified action of the logged in user.
     *
     * @param  string $action
     * @return \App\AuditTrail
     */
    public function audit($action = "")
    {
        return \App\AuditTrail::create([
                'audit_action' => $action,
                'audit_user' => $this->user
            ]);   
    }
}
