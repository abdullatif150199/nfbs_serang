<?php

namespace App\Http\Controllers;

use App\Models\Kampus;
use App\Http\Requests\StoreKampusRequest;
use App\Http\Requests\UpdateKampusRequest;

class KampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreKampusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKampusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kampus  $kampus
     * @return \Illuminate\Http\Response
     */
    public function show(Kampus $kampus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kampus  $kampus
     * @return \Illuminate\Http\Response
     */
    public function edit(Kampus $kampus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKampusRequest  $request
     * @param  \App\Models\Kampus  $kampus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKampusRequest $request, Kampus $kampus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kampus  $kampus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kampus $kampus)
    {
        //
    }
}
