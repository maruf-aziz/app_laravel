<?php

namespace App\Http\Controllers;

use App\Models\Suami_istri;
use Illuminate\Http\Request;

class SuamiIstriController extends Controller
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
     * create with id
     */
    public function create2($id){
        
        return view('admin.suamiistri.add', compact('id'));
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
     * @param  \App\Models\Suami_istri  $suami_istri
     * @return \Illuminate\Http\Response
     */
    public function show(Suami_istri $suami_istri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suami_istri  $suami_istri
     * @return \Illuminate\Http\Response
     */
    public function edit(Suami_istri $suami_istri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suami_istri  $suami_istri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suami_istri $suami_istri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suami_istri  $suami_istri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suami_istri $suami_istri)
    {
        //
    }
}
