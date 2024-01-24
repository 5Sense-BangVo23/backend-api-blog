<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Book\CreateBlgBookRequest;
use App\Http\Resources\Book\BlgBookResource;


class BlgBookController extends Controller
{
    public function createBook(CreateBlgBookRequest $request)
    {
        $book = \Book::createBook($request->validated());
        
        if ($book) {
            $bookResource = new BlgBookResource($book);
            return response()->json($bookResource, 201);
        }

        return response()->json(['message' => 'Failed to create book.'], 500);
    }

    public function listAllBooks()
    {
        $allBooks = \Book::listAllBooks();  
        $bookResources = BlgBookResource::collection($allBooks);
        return response()->json($bookResources, 200);
    }

}
