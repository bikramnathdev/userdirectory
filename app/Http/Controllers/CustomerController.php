<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderby('name','asc')->paginate(5);
        return view('customer',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'file' => 'required',
            'dob' => 'required',
            'sold_item' => 'required'
        ]);
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $filename = str_replace(' ','',$filename);
        $path = $file->storeAs('public/images/', $filename);
        $customer = new Customer();
        $customer->name = $request['name'];
        $customer->address = $request['address'];
        $customer->filename = $filename;
        $customer->dob = $request['dob'];
        $customer->sold_item = $request['sold_item'];
        $customer->save();
        return redirect('/customer')->with('success','Customer Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $customer = Customer::find($id);
            return view('customer_edit', compact('customer'));

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
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'file'=>'required'
        ]);
        $request->file('file')->store('images');
        $filename = $request->file->getClientOriginalName();
        Customer::where('id',$id)
        ->update(['name'=>$request['name'],'address'=>$request['address'],'filename'=>$filename]);
        return redirect('/customer')->with('success','Customer Details Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $customer = Customer::find($id);
            $customer->delete();
            return redirect('/customer')->with('success','Customer Removed');

    }

}
