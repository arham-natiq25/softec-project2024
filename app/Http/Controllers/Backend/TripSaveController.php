<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Trips;
use Illuminate\Http\Request;

class TripSaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trips::all();
        return response()->json($trips);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
           $name = 'name'=>'required|string|max:25',
           $destination ='destination'=>'required',
           $description = 'description'=>'required',
           $price =  'price'=>'required|integer',
           $start_date = 'start_date'=>'required',
           $end_date = 'end_date'=>'required',
        ]);

        $trip = Trips::create($request->post());
        return response()->json([
            'message'=>'Trip created successfully',
            'trip'=>$trip
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
    public function update(Request $request, Trips $trip)
    {
        $data = $request->validate([
            $name = 'name'=>'required|string|max:25',
            $destination ='destination'=>'required',
            $description = 'description'=>'required',
            $price =  'price'=>'required|integer',
            $start_date = 'start_date'=>'required',
            $end_date = 'end_date'=>'required',
         ]);

        $trip->fill($request->post())->save();
        return response()->json([
            'message'=>'Trip updated successfully',
            'membership'=>$trip,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trips $trip)
    {
        $trip->delete();
        return response()->json([
            'message'=>'Trip Deleted successfully',
        ]);
    }
}
