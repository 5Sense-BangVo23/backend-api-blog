<?php
namespace App\Services;
use App\Models\BlgBook;
use App\Models\BlgAuthor;
use App\Models\BlgCategory;
use App\Models\BlgPublisher;
use App\Traits\PublicationStatusTrait;
use App\Traits\Loggable;

class BlgBookService{

    use Loggable, PublicationStatusTrait;

    public function createBook(array $data)
    {
        // Define the required fields
        $requiredFields = ['blg_author_id', 'blg_category_id', 'blg_publisher_id', 'publication_status'];

        // Check if all required fields are present in the input data
        if (array_diff($requiredFields, array_keys($data))) {
            \Log::error('Missing required fields: ' . implode(', ', $requiredFields));
            return null;
        }
        // Process publication status
        $data = $this->processPublicationStatus($data);
       
        
        // Validate and set valid foreign keys
        $data['blg_author_id'] = $this->getValidForeignKey('blg_author_id', $data) ?? $this->getDefaultAuthorId();
        $data['blg_category_id'] = $this->getValidForeignKey('blg_category_id', $data) ?? $this->getDefaultCategoryId();
        $data['blg_publisher_id'] = $this->getValidForeignKey('blg_publisher_id', $data) ?? $this->getDefaultPublisherId();

        $data['publication_status'] = $data['publication_status'] ?? $this->getDefaultPublishStatus(); 

        // Check if related objects exist
        if (!$this->existsForeignKey('blg_author_id', $data['blg_author_id']) ||
            !$this->existsForeignKey('blg_category_id', $data['blg_category_id']) ||
            !$this->existsForeignKey('blg_publisher_id', $data['blg_publisher_id'])) {
            // Handle the case where related objects do not exist, return null
            return null;
        }

        // Create the book
        return BlgBook::create($data);
    }


    public function listAllBooks()
    {
        $publishedBooks = $this->publishList(BlgBook::query()->with(['status']))->get();
        return $publishedBooks; 
    }
    
    public function updateBook(int $bookId, array $data)
    {
        $book = BlgBook::find($bookId);

        if (!$book) {
            return null;
        }

        $data = $this->processPublicationStatus($data);
        $book->update($data);

        return $book;
    }

    public function deleteBook(int $bookId)
    {
        $book = BlgBook::find($bookId);

        if ($book) {
            $book->delete();
            return true;
        }

        return false;
    }


    private function getValidForeignKey($key, array $data)
    {
        $value = data_get($data, $key);
        return $value ? ($this->existsForeignKey($key, $value) ? $value : null) : null;
    }
    

    private function existsForeignKey($key, $value)
    {
        switch ($key) {
            case 'blg_author_id':
                return BlgAuthor::find($value) !== null;
            case 'blg_category_id':
                return BlgCategory::find($value) !== null;
            case 'blg_publisher_id':
                return BlgPublisher::find($value) !== null;
            default:
                return false;
        }
    }

    private function getDefaultAuthorId()
    {
        return BlgAuthor::where('name', 'Default Author')->value('id');
    }

    private function getDefaultCategoryId()
    {
        return BlgCategory::where('name', 'Default Category')->value('id');
    }

    private function getDefaultPublisherId()
    {
        return BlgPublisher::where('name', 'Default Publisher')->value('id');
    }

}