<?php
namespace App\Services;
use App\Models\BlgBook;
class BlgBookService{
    public function createBook(array $data)
    {
        return BlgBook::create($data);
    }

    public function listAllBooks()
    {
        return BlgBook::all();
    }
}