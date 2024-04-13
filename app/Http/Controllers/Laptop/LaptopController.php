<?php

namespace App\Http\Controllers\Laptop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laptop;
use App\Http\Requests\LaptopRequest;
use Exception;
use App\Http\Resources\LaptopResource;

class LaptopController extends Controller
{
    public function __construct(){
        $this->middleware('jwtauth');
    }
    

    public function index()
    {
        $laptops = Laptop::all();
        return response()->json([
            'message' => 'LAPTOPS LIST',
            'data' => LaptopResource::collection($laptops)
        ],200);
    }
     
    
    public function store(LaptopRequest $request)
    {
        try{
        Laptop::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
            return response()->json(['message' => 'Laptop created succesfully'], 201);
        }
        catch(Exception $e){
            return response()->json(['message' => 'An error has beeen found'], 400);
        }
    }

    
    public function show(Laptop $laptop)
    {
        return response()->json([
            'message' => 'Laptop details',
            'data' => new LaptopResource($laptop),
        ],200);
    }

    
    public function update(LaptopRequest $request, Laptop $laptop)
    {
        try{
        $laptop->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
            return response()->json(['message' => 'Laptop updated succesfully'], 201);
        }
        catch(Exception $e){
            return response()->json(['message' => 'An error has beeen found'], 400);
        }
    }

    
    public function destroy(Laptop $laptop)
    {
        $laptop->delete();
        return response()->json([
            'message' => 'Laptop deleted succesfully'
        ],200);
    }
}
