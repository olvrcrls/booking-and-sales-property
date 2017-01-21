<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{

    protected $user;

    /**
     * Class Constructor
     * @param    $user   
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
        $payment_methods = PaymentMethod::select('payment_method_id', 'payment_method_name', 'payment_method_active', 'payment_method_description')
                            ->where('payment_method_active', true)
                            ->orderBy('payment_method_name', 'asc')->get();

        return view('admin.payment_method.index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
                "payment_method_name" => 'required|max:255|unique:payment_methods',
                "payment_method_description" => 'max:1000'
            ]);
        $new_payment_method = PaymentMethod::create([
                'payment_method_name' => request('payment_method_name'),
                'payment_method_description' => request('payment_method_description'),
                'created_by' => $this->user
            ]);
        $this->audit("Added a new payment method named as '{$new_payment_method->payment_method_name}'.");
        return redirect()->back()->with("Successfully added '{$new_payment_method->payment_method_name}'.");
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
     * @param  \App\Models\PaymentMethod $payment_method
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $payment_method)
    {
        return view('admin.payment_method.edit', compact('payment_method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\PaymentMethod $payment_method
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethod $payment_method)
    {
        $this->validate(request(), [
                'payment_method_name' => "required|max:255|unique:payment_methods,payment_method_name,{$payment_method->payment_method_id},payment_method_id",
                'payment_method_description' => 'max:1000'
            ]);
        $old = $payment_method;
        $payment_method->update([
                'payment_method_name' => request('payment_method_name'),
                'payment_method_description' => request('payment_method_description'),
                'modified_date' => date('Y-m-d h:i:s'),
                'modified_by' => $this->user
            ]);
        $this->audit("A payment method has been modified named as {$old->payment_method_name} with the following: 
                            Name : {$payment_method->payment_method_name} 
                            Description : {$payment_method->payment_method_description}. ");
        return redirect()->back()->with('status', "Successfully modified this payment method.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod $payment_method
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $payment_method)
    {
        $payment_method->payment_method_active = false;
        $payment_method->modified_by = $this->user;
        $payment_method->modified_date = date('Y-m-d h:i:s');
        $payment_method->save();
        $this->audit("Payment method '{$payment_method->payment_method_name}' has been removed.");
        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod $payment_method
     * @return \Illuminate\Http\Response
     */
    public function restore(PaymentMethod $payment_method)
    {
        $payment_method->payment_method_active = true;
        $payment_method->modified_by = $this->user;
        $payment_method->modified_date = date('Y-m-d h:i:s');
        $payment_method->save();
        $this->audit("Payment method '{$payment_method->payment_method_name}' has been restored.");
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
