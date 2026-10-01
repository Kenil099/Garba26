<?php
namespace App\Services;

use App\Models\Song;

class SongService
{
    public function getHomeSections(): array
    {
        return [
            'featured'       => Song::getFeatured(6),
            'popular'        => Song::getPopular(10),
            'two_taali'      => Song::getByStyle('2-Taali', 8),
            'three_taali'    => Song::getByStyle('3-Taali', 8),
            'sanedo'         => Song::getByStyle('Sanedo', 6),
            'dakla'          => Song::getByStyle('Dakla', 6),
            'united_way'     => Song::getByTradition('United Way', 8),
        ];
    }

    public function getDetails(int $id): ?array
    {
        return Song::findWithDetails($id);
    }
}
