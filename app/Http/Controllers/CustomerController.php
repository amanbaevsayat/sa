<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $root;

    public function __construct()
    {
        $this->root = 'customers';

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("{$this->root}.index", ['customers' => Customer::paginate(45)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("{$this->root}.create", [
            'customerStatuses' => \App\CustomerStatus::all(),
            'subscriptions' => \App\Subscription::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
        return view("{$this->root}.show", ['customer' => $customer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view("{$this->root}.show", ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $subscriptions =  \App\Subscription::all()->sortBy('OriginId');
        $subscriptionTypes = \App\SubscriptionType::all();
        $remarks = \App\Remark::all();
        return view("{$this->root}.edit", [
            'customer' => $customer, 
            'subscriptions' => $subscriptions,
            'subscriptionTypes' => $subscriptionTypes,
            'remarks' => $remarks,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect()->to("/{$this->root}/{$customer->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->to("/{$this->root}");
    }
}
