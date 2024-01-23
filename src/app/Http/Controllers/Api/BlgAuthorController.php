<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Author\CreateBlgAuthorRequest;
use App\Http\Requests\Author\UpdateBlgAuthorRequest;
use App\Http\Resources\Author\BlgAuthorResource;
class BlgAuthorController extends Controller
{
    //
    public function createAuthor(CreateBlgAuthorRequest $request){
        $data = $request->validated();
        $author = \Author::createAuthor($data);
        $authorResource = new BlgAuthorResource($author);
        return response()->json($authorResource, 201);
    }

    public function getAllAuthors(){
        $authors = \Author::listAllAuthors();
        $authorsList = BlgAuthorResource::collection($authors);
        return response()->json($authorsList);
    }

    public function updateAuthor($authorId, UpdateBlgAuthorRequest $request){
        $data = $request->validated();
        $author = \Author::updateAuthor($authorId, $data);
        $authorResource = new BlgAuthorResource($author);
        if ($author) {
            return response()->json($authorResource, 200);
        } else {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }
}
