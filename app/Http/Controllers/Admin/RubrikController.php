<?php

namespace App\Http\Controllers\Admin;

use App\Rubrik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RubrikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.rubriks.index', [
            'rubriks' => Rubrik::paginate[10];
        ])
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
     * @param  \App\Rubrik  $rubrik
     * @return \Illuminate\Http\Response
     */
    public function show(Rubrik $rubrik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rubrik  $rubrik
     * @return \Illuminate\Http\Response
     */
    public function edit(Rubrik $rubrik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rubrik  $rubrik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubrik $rubrik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rubrik  $rubrik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubrik $rubrik)
    {
        //
    }
}
