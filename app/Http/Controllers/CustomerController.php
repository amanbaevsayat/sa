<?php

namespace App\Http\Controllers;

use App\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $root;
    private $perPage;

    public function __construct()
    {
        $this->root = 'customers';
        $this->perPage = 45;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customersQuery = Customer::query();

        if ($request->has('subscription_type_id')) {
            $customersQuery->whereIn('subscription_type_id', $request->subscription_type_id);
        }
        if ($request->has('remark_id')) {
            $customersQuery->whereIn('remark_id',  $request->remark_id);
        }
        if ($request->has('subscriptionStatus')) {
            $customersQuery->whereHas('subscription', function (Builder $query) use ($request) {
                $query->where('Status', $request->subscriptionStatus);
            });
        }
        $customers = $customersQuery->paginate($this->perPage);
        $subscriptionStatuses = ['Active', 'Rejected', 'Cancelled'];
        $subscriptionTypes = \App\SubscriptionType::all();
        $remarks = \App\Remark::all();
        return view("{$this->root}.index", [
            'customers' => $customers,
            'subscriptionTypes' => $subscriptionTypes,
            'remarks' => $remarks,
            'subscriptionStatuses' => $subscriptionStatuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptions =  \App\Subscription::all()->sortBy('OriginId');
        $subscriptionTypes = \App\SubscriptionType::all();
        $remarks = \App\Remark::all();

        return view("{$this->root}.create", [
            'subscriptions' => $subscriptions,
            'subscriptionTypes' => $subscriptionTypes,
            'remarks' => $remarks,
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
        $data = $request->all();
        $data['start_date'] =  Carbon::createFromFormat('d M Y',  $data['start_date'])->format('Y-m-d');
        $data['end_date'] =  Carbon::createFromFormat('d M Y',  $data['end_date'])->format('Y-m-d');
        $customer->update($data);
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
