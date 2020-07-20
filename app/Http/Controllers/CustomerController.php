<?php

namespace App\Http\Controllers;

use App\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Services\SortService;

class CustomerController extends Controller
{
    private $root;
    private $perPage;
    public $sortService;

    public function __construct(SortService $sortService)
    {
        $this->root = 'customers';
        $this->perPage = 45;
        $this->sortService = $sortService;

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

        if ($request->has('needle') && !empty($request->needle)) {
            $name =  $request->needle;
            $phone = preg_replace('/[^0-9]/', '', $request->needle);
            $query = "(name like '%{$name}%'";
            if (!empty($phone)){
                $query .= " OR phone like '%{$phone}%' OR '{$phone}' LIKE CONCAT('%', phone, '%')";
            }
            $query .= ")";
            $customersQuery->whereRaw($query);
        }

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
        if ($request->has('orderBy') && $request->has('orderTarget')) {
            $customersQuery = boolval($request->orderTarget) ? $customersQuery->orderBy($request->orderBy) : $customersQuery->orderByDesc($request->orderBy);
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
            'sortService' => $this->sortService,
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
        $data = $request->all();
        $data['phone'] = preg_replace('/[^0-9]/', '', $data['phone']);
        $data['start_date'] =  Carbon::parse($data['start_date'])->locale('ru')->format('Y-m-d');
        $data['end_date'] =  Carbon::parse($data['end_date'])->locale('ru')->format('Y-m-d');
        $customer = Customer::create($data);
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
        $data['phone'] = preg_replace('/[^0-9]/', '', $data['phone']);
        $data['start_date'] =  Carbon::parse($data['start_date'])->format('Y-m-d');
        $data['end_date'] =  Carbon::parse($data['end_date'])->format('Y-m-d');
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
