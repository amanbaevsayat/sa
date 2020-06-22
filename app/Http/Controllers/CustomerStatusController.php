<?php

namespace App\Http\Controllers;

use App\CustomerStatus;
use Illuminate\Http\Request;

class CustomerStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'CustomerStatusController';
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerStatus  $customerStatus
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerStatus $customerStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerStatus  $customerStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerStatus $customerStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerStatus  $customerStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerStatus $customerStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerStatus  $customerStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerStatus $customerStatus)
    {
        //
    }
}
