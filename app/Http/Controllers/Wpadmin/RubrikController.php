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
        return view('wpadmin.rubriks.index', [
            'rubriks' => Rubrik::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('wpadmin.rubriks.create', [
            'rubrik'    => [],
            'rubriks'   => Rubrik::with('children')->where('parent_id', 0)->get(),
            'delimiter' => ''
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
        Rubrik::create($request->all());

        return redirect()->route('wpadmin.rubrik.index');
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
        return view ('wpadmin.rubriks.edit', [
            'rubrik'    => $rubrik,
            'rubriks'   => Rubrik::with('children')->where('parent_id', 0)->get(),
            'delimiter' => ''
        ]);
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
        $rubrik->update($request->except('name_en'));

        return redirect()->route('wpadmin.rubrik.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rubrik  $rubrik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubrik $rubrik)
    {
        $rubrik->delete();

        return redirect()->route('wpadmin.rubrik.index');
    }
}
