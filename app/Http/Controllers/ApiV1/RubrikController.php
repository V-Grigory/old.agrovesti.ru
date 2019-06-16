<?php

namespace App\Http\Controllers\ApiV1;

use App\Rubrik;
use App\Http\Resources\RubrikResource;
use App\Http\Resources\RubriksResource;
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
        header('Access-Control-Allow-Origin: *');
        // $res = Rubrik::with('articles')->limit(10)->get();

        $rubriks = Rubrik::with('children')->with(
            ['articles' => function ($query) {
                $query->select(
                    'name_ru', 'name_en', 'image', 'description', 'introduce', 'on_main', 'updated_at'
                )->where('on_main', '=', 1)
                    ->orderBy('updated_at', 'desc');
            }]
        )->where('on_main', 1)
            ->orderBy('position_number', 'asc')
            ->limit(10)
            ->get();

        return new RubriksResource($rubriks);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
			$res = Rubrik::limit(10)->get();
			//$res = Rubrik::find(22);
      return RubrikResource::collection($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
