<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Services\PaymentService;

class SubscriptionController extends Controller
{
    private $root;
    private $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->middleware('auth');
        $this->root = 'subscriptions';
        $this->paymentService = $paymentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("{$this->root}.index", ['subscriptions' => Subscription::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("{$this->root}.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subscription = Subscription::create($request->all());
        $model = $this->paymentService->getSubscription($subscription->OriginId);
        $subscription->update($model);
        return view("{$this->root}.show", ['subscription' => $subscription]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        return view("{$this->root}.show", ['subscription' => $subscription]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }

    public function get(Subscription $subscription)
    {
        $model = $this->paymentService->getSubscription($subscription->OriginId);
        $subscription->update($model);
        return redirect()->back();
    }
}
