<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BookController extends Controller
{
    function index() 
    {
        $books=Book::all();
        return response()->json($books);
    }

    function show(Book $book)
    {
        $book=Book::find($book);
        if (!$book) {
            // Book not found, 
            return response()->json(['error' => 'Book not found'], 404);
        }

        return response()->json($book);
       
    }

    function store(Request $request) 
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'author'=>'required|string',
            'publish_date'=>'required|date',

        ]);

        if ($validator->fails()){
            $errors=$validator->errors()->all();

            return response()->json(['errors'=>$errors],422);
        }

        $book=Book::create($request->all());
        return response()->json($book);
        
    }

    function update(Request $request,Book $book) 
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'author'=>'required|string',
            'publish_date'=>'required|date',

        ]);

        if ($validator->fails()){
            $errors=$validator->errors()->all();

            return response()->json(['errors'=>$errors],422);
        }

        $book->update($request->all());
        return response()->json($book);
        
    }

    function destroy(Book $book)
     {
        if (!$book) {
            return response()->json(['message' => 'Resource already deleted'], 200);
        }
        
        $book->delete();
        return response()->json([
            'message'=>'deleted successfully',
        ]);
    }
}
