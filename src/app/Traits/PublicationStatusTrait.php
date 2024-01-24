<?php

namespace App\Traits;

use App\Models\PublishStatus;
use Illuminate\Database\Eloquent\Builder;
use App\Models\BlgBook;

trait PublicationStatusTrait
{
    public function getDefaultPublishStatus()
    {
        $defaultStatus = 'Draft';
        $statusModel = PublishStatus::where('name', $defaultStatus)->first();

        return optional($statusModel)->id;
    }

    public function processPublicationStatus(array $data)
    {
        $statusName = $data['status'] ?? null;
        
        if ($statusName) {
            // Use COLLATE utf8_general_ci for case-insensitive comparison
            $statusModel = PublishStatus::where('name', 'LIKE', $statusName)->collate('utf8_general_ci')->first();
            
            if ($statusModel) {
                $data['publication_status'] = $statusModel->id;
                if ($statusName === 'Published') {
                    // If the status is Published, set the publication_start_date to now
                    $data['publication_start_date'] = now();
    
                    // Set the publication_end_date to the end of the day (23:59:59)
                    $data['publication_end_date'] = now()->endOfDay();
                } else {
                    // If the status is not Published, set the publication_start_date and end_date to null
                    $data['publication_start_date'] = null;
                    $data['publication_end_date'] = null;
                }
            }
        }
    
        return $data;
    }
    

    public function getAllBooks()
    {
        return BlgBook::query();
    }

    public function getPublishedBooks()
    {
        $allBooksQuery = BlgBook::with('status');
        return $this->publishList($allBooksQuery)->get();
    }

    public function publishStatus()
    {
        return PublishStatus::whereIn('name', 
        [
            // 'Draft', 
            // 'Pending Review', 
            'Published', 
            // 'Out of Print', 
            // 'Unavailable',
            // 'Archived', 
            // 'Coming Soon', 
            // 'On Hold', 
            // 'Reprint', 
            // 'Limited Edition', 
            // 'In Progress'
        ])->pluck('id')->toArray();
    }

    public function publishList($model)
    {
        return $model->where(function ($query) {
            $query->whereHas('status', function ($query) {
                $query->whereIn('id', $this->publishStatus());
            })
            ->where(function ($query) {
                $query->where('publication_start_date', '<=', now())->orWhereNull('publication_start_date')
                    ->where('publication_end_date', '>=', now())->orWhereNull('publication_end_date');
            });
        });
    }
    


}
