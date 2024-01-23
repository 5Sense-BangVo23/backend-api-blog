<?php
namespace App\Services;
use App\Models\BlgAuthor;


class BlgAuthorService{

    public function createAuthor(array $data)
    {
       
        return BlgAuthor::create($data);
    }

    public function listAllAuthors()
    {
        return BlgAuthor::all();
    }

    public function updateAuthor(int $authorId, array $data)
    {
        $author = BlgAuthor::find($authorId);

        if (!$author) {
            return null;
        }
        $author->update($data);

        return $author;
    }
}