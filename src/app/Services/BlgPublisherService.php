<?php

namespace App\Services;
use App\Models\BlgPublisher;

class BlgPublisherService{
   
    public function createPublisher(array $data)
    {
        return BlgPublisher::create($data);
    }

    public function listAllPublishers()
    {
        return BlgPublisher::all();
    }

    public function updatePublisher(int $publisherId, array $data)
    {
        $publisher = BlgPublisher::find($publisherId);

        if ($publisher) {
            $publisher->update($data);
            return $publisher;
        }

        return null;
    }
}