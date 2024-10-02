<?php

namespace App\Http\Controllers;

use App\Models\Scategorie;
use Illuminate\Http\Request;

class ScategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try { 
            $scategories=Scategorie::with('categorie')->get(); // Inclut la catégorie liée; 
               
              return response()->json($scategories,200); 
          } catch (\Exception $e) { 
          return response()->json($e->getMessage(),404); 
          } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try { 
            $scategorie=new Scategorie([ 
                "nomscategorie"=>$request->input("nomscategorie"), 
                "imagescategorie"=>$request->input("imagescategorie"), 
                "categorieID"=>$request->input("categorieID") 
 
            ]); 
            $scategorie->save(); 
            return response()->json($scategorie,200); 
        } catch (\Exception $e) { 
            return response()->json($e->getMessage(),404); 
         } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try { 
            $scategorie=Scategorie::with('categorie')->findOrFail($id); 
            return response()->json($scategorie,200); 
             
        } catch (\Exception $e) { 
            return response()->json("Sélection impossible  {$e->getMessage()}"); 
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try { 
            $scategorie=Scategorie::findorFail($id); 
            $scategorie->update($request->all()); 
            return response()->json($scategorie,200); 
 
        } catch (\Exception $e) { 
            return response()->json($e->getMessage(),404); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try { 
            $scategorie=Scategorie::findOrFail($id); 
            $scategorie->delete(); 
            return response()->json("Sous catégorie supprimée avec succes",200); 
        } catch (\Exception $e) { 
            return response()->json($e->getMessage(),404); 
        } 
    }
}
