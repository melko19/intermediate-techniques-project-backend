<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function show(Manga $manga) {
        return response()->json($manga,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $manga = Manga::where('title','like',"%$request->key%")
            ->orWhere('author','like',"%$request->key%")->get();

        return response()->json($mangas, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'string|required',
            'author' => 'string|required',
            'publisher' => 'string|required',
            'genre' => 'string|required',
            'price' => 'numeric|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $manga = Manga::create($request->all());
            return response()->json($manga, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Manga $manga) {
        try {
            $manga->update($request->all());
            return response()->json($manga, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Manga $manga) {
        $manga->delete();
        return response()->json(['message'=>'Manga Book deleted.'],202);
    }

    public function index() {
        $mangas = Manga::orderBy('title')->get();
        return response()->json($mangas, 200);
    }
}
