<?php

namespace App\Http\Controllers;

use App\Band;
use Illuminate\Http\Request;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bands = Band::all();
        return view('bands.index', compact('bands'));
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
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function show(Band $band)
    {
        return view('bands.show', compact('band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function edit(Band $band)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Band $band)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Band  $band
     * @return \Illuminate\Http\Response
     */
    public function destroy(Band $band)
    {
        //
    }
}
