<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\BlgBook;
class BlgBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    
    public function toArray(Request $request): array
    {

        $book = $this->resource;

        if (!$book) {
            return []; 
        }

        return [
            'id' => $book->id,
            'title' => $book->title,
            'description' => $book->description,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
            'author' => $book->author ? [
                'id' => $book->author->id,
                'name' => $book->author->full_name,
            ] : null,
            'category' => $book->category ? [
                'id' => $book->category->id,
                'name' => $book->category->name,
            ] : null,
            'publisher' => $book->publisher ? [
                'id' => $book->publisher->id,
                'name' => $book->publisher->name,
            ] : null,
            'publication_status' => $book->status ? [
                'id' => $book->status->id,
                'name' => $book->status->name,
            ] : null,
        ];

    //     $data = [
    //         'id' => $this->id,
    //         'title' => $this->title,
    //         'description' => $this->description,
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //     ];
    
    //     // Check if the author relationship is loaded and not null
    //     if ($this->relationLoaded('author') && $this->author) {
    //         $data['blg_author_id'] = [
    //             'id' => $this->author->id,
    //             'name' => $this->author->full_name,
    //         ];
    //     } else {
    //         $data['blg_author_id'] = null;
    //     }
    
    //     // Check if the blgCategory relationship is loaded and not null
    //     if ($this->relationLoaded('category') && $this->category) {
    //         $data['category'] = [
    //             'id' => $this->category->id,
    //             'name' => $this->category->name,
    //         ];
    //     } else {
    //         $data['category'] = null;
    //     }
    
    //     // Check if the blgPublisher relationship is loaded and not null
    //     if ($this->relationLoaded('publisher') && $this->publisher) {
    //         $data['publisher'] = [
    //             'id' => $this->publisher->id,
    //             'name' => $this->publisher->name,
    //         ];
    //     } else {
    //         $data['publisher'] = null;
    //     }
    
    //     return $data;
     }
    

}
