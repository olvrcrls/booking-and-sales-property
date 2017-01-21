<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    protected $user;

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
        $amenities = Amenity::select('amenity_id', 'amenity_name', 'amenity_description', 'amenity_active')
                              ->where('amenity_active', true)
                              ->orderBy('amenity_name', 'asc')->get();
        return view('admin.amenity.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                'amenity_name' => 'required|max:255|unique:amenities',
                'amenity_description' => 'max:1000'
            ]);
        $new_amenity = Amenity::create([
                'amenity_name' => request('amenity_name'),
                'amenity_description' => request('amenity_description'),
                'created_by' => $this->user
            ]);
        $this->audit("A new amenity named '{$new_amenity->amenity_name}' has been created.");
        return redirect()->back()->with('status', "Successfully created '{$new_amenity->amenity_name}'.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        return view('admin.amenity.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(Amenity $amenity)
    {
        $this->validate(request(), [
                'amenity_name' => "required|max:255|unique:amenities,amenity_name,{$amenity->amenity_id},amenity_id",
                'amenity_description' => "max:1000"
            ]);
        $old = $amenity;
        $amenity->update([
                'amenity_name' => request('amenity_name'),
                'amenity_description' => request('amenity_description'),
                'modified_date' => date('Y-m-d h:i:s'),
                'modified_by' => $this->user
            ]);
        $this->audit("Modified an amenity named '{$old->amenity_name}' with the following: 
                Name : {$amenity->amenity_name} 
                Description : {$amenity->amenity_description} ");
        return redirect()->back()->with('status', "Successfully updated this amenity.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenity $amenity)
    {
        $amenity->amenity_active = false;
        $amenity->modified_date = date('Y-m-d h:i:s');
        $amenity->modified_by = $this->user;
        $amenity->save();
        $this->audit("An amenity named '{$amenity->amenity_name}' has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function restore(Amenity $amenity)
    {
        $amenity->amenity_active = true;
        $amenity->modified_date = date('Y-m-d h:i:s');
        $amenity->modified_by = $this->user;
        $amenity->save();
        $this->audit("An amenity named '{$amenity->amenity_name}' has been restored.");
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
