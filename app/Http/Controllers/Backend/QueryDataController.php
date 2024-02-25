<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Query;
use Illuminate\Http\Request;

class QueryDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $queries = Query::all();
        return response()->json($queries);

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trip_id'=>'required',
            'question'=>'required',
            'answer'=>'required'
        ]);

        $query = Query::create($request->post());
        return response()->json([
            'message'=>'Query created successfully',
            'query'=>$query
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Query $query)
    {
        $query->delete();
        return response()->json([
            'message'=>' Query Deleted successfully',
        ]);
    }
}
