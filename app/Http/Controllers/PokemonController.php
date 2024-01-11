<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $query=Pokemon::query();

         //filter by name
         if ($request->has('name')){
            $query->where('name','like', '%' . $request->input('name') . '%');
        }

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filter by rarity
        if ($request->has('rarity')) {
            $query->where('rarity', $request->input('rarity'));
        }

        // Filter by level
        if ($request->has('level')) {
            $query->where('level', $request->input('level'));
        }
        
        $pokemons=$query->get();
        return response()->json([
            'status'=>200,
            'pokemons'=>$pokemons,
        ]);
       
    }

    function show($pokemon)
    {
        $pokemon=Pokemon::find($pokemon);

        if  (!$pokemon){
            return response()->json([
                'message' => 'Pokemon not found'], 404);
        }

        return response()->json([
            'pokemon' => $pokemon
         ]);
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'type'      => 'required|string|in:Fire,Water,Grass',
            'level'     => 'required|integer|min:1|max:100',
            'image_url' => 'required|mimes:jpeg,png',
            'price'     => 'required|numeric|min:0.01|max:1000', 
            'rarity'    => 'required|string|in:common,uncommon,rare',
            'quantity'  => 'required|integer|min:1|max:100',
            'status'    => 'nullable|in:0,1', 
            'user_id'   => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors(),
            ]);
        }

        // Get the authenticated user's ID
        $userId = Auth::id();

       

        $pokemon = new Pokemon([
        'name'      => $request->input('name'),
        'type'      => $request->input('type'),
        'level'     => $request->input('level'),
        'price'     => $request->input('price'),
        'rarity'    => $request->input('rarity'),
        'quantity'  => $request->input('quantity'),
        'status'    => $request->input('status'),
        'user_id'   => $userId,
         ]);

         $uploadPath='uploads/pokemon/';
        if ($request->hasFile('image_url')){

            $file=$request->file('image_url');
            $ext=$file->getClientOriginalExtension();
            $fileName=time().'.'.$ext;
            $file->move('uploads/pokemon/', $fileName);
            $pokemon->image_url =  $uploadPath.$fileName;

        }

        $pokemon->save();
         return response()->json([
        'message' => 'Pokemon created successfully',
        'pokemon'=>$pokemon,
    
         ], 201);
    }

    public function update(Request $request, $pokemon)
    {
        ($pokemon);
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'type'      => 'required|string|in:Fire,Water,Grass',
            'level'     => 'required|integer|min:1|max:100',
            'image_url' => 'required|mimes:jpeg,png',
            'price'     => 'required|numeric|min:0.01|max:1000', 
            'rarity'    => 'required|string|in:common,uncommon,rare',
            'quantity'  => 'required|integer|min:1|max:100',
            'status'    => 'nullable|in:0,1', 
            'user_id'   => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors(),
            ]);
        }

         // Get the authenticated user's ID
         $userId = Auth::id();

         $pokemon=Pokemon::find($pokemon);

          // Check if the Pokemon exists
          if (!$pokemon) {
            return response()->json(['error' => 'Pokemon not found'], 404);
        }

            // Update the Pokemon attributes
            $pokemon->name = $request->input('name');
            $pokemon->type = $request->input('type');
            $pokemon->level = $request->input('level');
            $pokemon->price = $request->input('price');
            $pokemon->rarity = $request->input('rarity');
            $pokemon->quantity = $request->input('quantity');
            $pokemon->status = $request->input('status');
            $pokemon->user_id = $userId;

            //image upload

            if ($request->hasFile('image_url')){
                //delete old image
                $path='uploads/pokemon'.$pokemon->image_url;
                if (File::exists($path)){
                    File::delete($path);
                }
                $file=$request->file('image_url');
                $ext=$file->getClientOriginalExtension();
                $fileName=time().'.'.$ext;
                $file->move('uploads/pokemon', $fileName);
                $pokemon->image_url =  $fileName;

            }

            // Save the updated Pokemon
            $pokemon->save();

            return response()->json([
                'message' => 'Pokemon updated successfully',
                'pokemon' => $pokemon,
            ], 200);

    }

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return response()->json([
            'message' => 'Pokemon deleted successfully',
        ], 200);
    }
}
