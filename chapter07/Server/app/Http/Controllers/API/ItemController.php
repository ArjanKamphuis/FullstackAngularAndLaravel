<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     * path="/api/items",
     * tags={"Items"},
     * summary="List Items",
     * @SWG\Response(
     * response=200,
     * description="Success: List all Items",
     * @SWG\Schema(ref="#/definitions/Item")
     * ),
     * @SWG\Response(
     * response="404",
     * description="Not Found"
     * )
     * )
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Post(
     * path="/api/items",
     * tags={"Items"},
     * summary="Create Item",
     * @SWG\Parameter(
     * name="body",
     * in="body",
     * required=true,
     * @SWG\Schema(ref="#/definitions/Item"),
     * description="Json format"
     * ),
     * @SWG\Response(
     * response=201,
     * description="Success: A Newly Created Item",
     * @SWG\Schema(ref="#/definitions/Item")
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
            'type' => 'required',
            'name' => 'required',
            'company' => 'required',
            'bike_id' => 'required'
        ]);
        return $validator->fails() ? response()->json($validator->errors(), 422) : Item::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Get(
     * path="/api/items/{id}",
     * tags={"Items"},
     * summary="Get Item by Id",
     * @SWG\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * type="integer",
     * description="Display the specified Item by id."
     * ),
     * @SWG\Response(
     * response=200,
     * description="Success: Return the Item",
     * @SWG\Schema(ref="#/definitions/Item")
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
    public function show($id)
    {
        return Item::with('Bike')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     * path="/api/items/{id}",
     * tags={"Items"},
     * summary="Update Item",
     * description="Update the specified Item by Id.",
     * @SWG\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * type="integer",
     * description="Item id to update"
     * ),
     * @SWG\Parameter(
     * name="body",
     * in="body",
     * required=true,
     * @SWG\Schema(ref="#/definitions/Item"),
     * description="Json format"
     * ),
     * @SWG\Response(
     * response=200,
     * description="Success: Return the Item updated",
     * @SWG\Schema(ref="#/definitions/Item")
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'name' => 'required',
            'company' => 'required',
            'bike_id' => 'required'
        ]);
        if($validator->fails()) {
            response()->json($validator->errors(), 422);
        }
        
        $updateItemById = Item::findOrFail($id);
        $updateItemById->update($request->all());
        return $updateItemById;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Delete(
     * path="/api/items/{id}",
     * tags={"Items"},
     * summary="Delete Item",
     * description="Delete the specified Item by id",
     * @SWG\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * type="integer",
     * format="int64",
     * description="Item id to delete"
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
        $deleteItemById - Item::findorFail($id)->delete();
        return response()->json([], 204);
    }
}
