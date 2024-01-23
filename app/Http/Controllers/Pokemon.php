<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemons;
use Illuminate\Support\Facades\Http;

class Pokemon extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pokemon_id' => 'required|integer',
                'pokemon_name' => 'required|string',
            ]);
    
            $record = new Pokemons;
    
            $record->pokemon_id = $validatedData['pokemon_id'];
            $record->pokemon_name = $validatedData['pokemon_name'];
    
            $record->save();

            return response()->json(['status'=>'success', 'message'=> 'Pokemon saved!'],200);
        }

        catch(\Exception $e){
            return response()->json(['status'=>'error', 'message'=>$e->getMessage()],500);
        }
    }
    public function generate(Request $request){
        try {
            $validatedData = $request->validate([
                'pokemon_id' => 'required|integer',
            ]);
            
            $pokemon = HTTP::get("https://pokeapi.co/api/v2/pokemon/{$request->pokemon_id}");

            $record = new Pokemons;
    
            $record->pokemon_id = $pokemon['id'];
            $record->pokemon_name = $pokemon['name'];
    
            $record->save();
            
            $imageUrl = $pokemon['sprites']['other']['official-artwork']['front_default'];

            return response()->json(['pokemon_image'=>$imageUrl, 'pokemon_name'=>$pokemon['name']],200);
        }
            
        catch(Exception $e){
            return response()->json(['status'=>'error', 'message'=>$e->getMessage()],500);
        }
    }
}