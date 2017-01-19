<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\FeatureType;

class FeatureTypeController extends Controller
{
    protected $user;
    /**
     * Class Constructor
     * @param    $user   
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
        $feature_types = FeatureType::select('feature_type_id', 'feature_type_name', 'feature_type_description', 'feature_type_active')
                                    ->where('feature_type_active', true)
                                    ->orderBy('feature_type_name', 'asc')->get();
        return view('admin.feature_type.index', compact('feature_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feature_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                'feature_type_name' => 'required|max:255|unique:feature_types',
                'feature_type_description' => 'required|max:1000'
            ]);
        $new_feature_type = FeatureType::create([
                'feature_type_name' => request('feature_type_name'),
                'feature_type_description' => request('feature_type_description'),
                'created_by' => $this->user
            ]);
        $this->audit("Created a new feature type named '{$new_feature_type->feature_type_name}'.");
        return redirect()->back()->with('status', "Successfully added '{$new_feature_type->feature_type_name}'.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeatureType $feature_type
     * @return \Illuminate\Http\Response
     */
    public function show(FeatureType $feature_type)
    {
        return view('admin.feature_type.show', compact('feature_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeatureType $feature_type
     * @return \Illuminate\Http\Response
     */
    public function edit(FeatureType $feature_type)
    {
        return view('admin.feature_type.edit', compact('feature_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\FeatureType $feature_type
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureType $feature_type)
    {
        $this->validate(request(), [
                'feature_type_name' => "required|max:255|unique:feature_types,feature_type_name,{$feature_type->feature_type_id},feature_type_id",
                'feature_type_description' => 'required|max:1000'
            ]);
        $old = $feature_type;
        $feature_type->update([
                'feature_type_name' => request('feature_type_name'),
                'feature_type_description' => request('feature_type_description'),
                'modified_date' => date('Y-m-d h:i:s'),
                'modified_by' => $this->user
            ]);
        $this->audit("Modified '{$old->feature_type_name}' with the following: 
                            Name : {'$feature_type->feature_type_name'}
                            Description : {'$feature_type->feature_type_name'}");
        return redirect()->back()->with('status', "Successfully updated this feature type.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeatureType $feature_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeatureType $feature_type)
    {
        $feature_type->feature_type_active = false;
        $feature_type->modified_date = date('Y-m-d h:i:s');
        $feature_type->modified_by = $this->user;
        $feature_type->save();
        $this->audit("A feature type named '{$feature_type->feature_type_name}' has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\FeatureType $feature_type
     * @return \Illuminate\Http\Response
     */
    public function restore(FeatureType $feature_type)
    {
        $feature_type->feature_type_active = true;
        $feature_type->modified_date = date('Y-m-d h:i:s');
        $feature_type->modified_by = $this->user;
        $feature_type->save();
        $this->audit("A feature type named '{$feature_type->feature_type_name}' has been restored.");
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
