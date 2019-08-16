<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Bike;
use App\Http\Resources\BikesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BikeController extends Controller
{
    /**
     * Protect update and delete methods, only for authenticated users.
     *
     * @return Unauthorized
     */
    public function __construct() {
        $this->middleware('auth:api')->except(['index']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     * path="/api/bikes",
     * tags={"Bikes"},
     * summary="List Bikes",
     * @SWG\Response(
     * response=200,
     * description="Success: List all Bikes",
     * @SWG\Schema(ref="#/definitions/Bike")
     * ),
     * @SWG\Response(
     * response="404",
     * description="Not Found"
     * )
     * )
     */
    public function index()
    {
        return Bike::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Post(
     * path="/api/bikes",
     * tags={"Bikes"},
     * summary="Create Bike",
     * @SWG\Parameter(
     * name="body",
     * in="body",
     * required=true,
     * @SWG\Schema(ref="#/definitions/Bike"),
     * description="Json format"
     * ),
     * @SWG\Response(
     * response=201,
     * description="Success: A Newly Created Bike",
     * @SWG\Schema(ref="#/definitions/Bike")
     * ),
     * @SWG\Response(
     * response=422,
     * description="Missing mandatory field"
     * ),
     * @SWG\Response(
     * response=404,
     * description="Not Found"
     * ),
     * @SWG\Response(
     * response=405,
     * description="Invalid HTTP Method"
     * )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'mods' => 'required',
            'builder_id' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $createBike = Bike::create([
            'user_id' => $request->user()->id,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'mods' => $request->mods,
            'picture' => $request->picture
        ]);

        return new BikesResource($createBike);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bike  $bike
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Get(
     * path="/api/bikes/{bike}",
     * tags={"Bikes"},
     * summary="Get single Bike",
     * @SWG\Parameter(
     * name="bike",
     * in="path",
     * required=true,
     * type="integer",
     * description="Display the specified Bike."
     * ),
     * @SWG\Response(
     * response=200,
     * description="Success: Return the Bike",
     * @SWG\Schema(ref="#/definitions/Bike")
     * ),
     * @SWG\Response(
     * response=404,
     * description="Not Found"
     * ),
     * @SWG\Response(
     * response=405,
     * description="Invalid HTTP Method"
     * )
     * )
     */
    public function show(Bike $bike)
    {
        return new BikesResource($bike);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bike  $bike
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     * path="/api/bikes/{bike}",
     * tags={"Bikes"},
     * summary="Update Bike",
     * description="Update the specified Bike.",
     * @SWG\Parameter(
     * name="bike",
     * in="path",
     * required=true,
     * type="integer",
     * description="Bike id to update"
     * ),
     * @SWG\Parameter(
     * name="body",
     * in="body",
     * required=true,
     * @SWG\Schema(ref="#/definitions/Bike"),
     * description="Json format"
     * ),
     * @SWG\Response(
     * response=200,
     * description="Success: Return the Bike updated",
     * @SWG\Schema(ref="#/definitions/Bike")
     * ),
     * @SWG\Response(
     * response=422,
     * description="Missing mandatory field"
     * ),
     * @SWG\Response(
     * response=404,
     * description="Not Found"
     * ),
     * @SWG\Response(
     * response=405,
     * description="Invalid HTTP Method"
     * )
     * )
     */
    public function update(Request $request, Bike $bike)
    {
        if ($request->user()->id !== $bike->user_id) {
            return response()->json(['error' => 'You can only edit your own bike.'], 403);
        }
        
        $bike->update($request->only(['make', 'model', 'year', 'mods', 'picture']));
        return new BikesResource($bike);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Delete(
     * path="/api/bikes/{id}",
     * tags={"Bikes"},
     * summary="Delete Bike",
     * description="Delete the specified Bike by id",
     * @SWG\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * type="integer",
     * format="int64",
     * description="Bike id to delete"
     * ),
     * @SWG\Response(
     * response=204,
     * description="Success: successful deleted"
     * ),
     * @SWG\Response(
     * response=404,
     * description="Not Found"
     * ),
     * @SWG\Response(
     * response=405,
     * description="Invalid HTTP Method"
     * )
     * )
     */
    public function destroy($id)
    {
        Bike::findOrFail($id)->delete();
        return response()->json([], 204);
    }
}
