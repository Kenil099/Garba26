<?php
namespace App\Services;

use App\Models\History;

class HistoryService
{
    public function logPlay(int $userId, int $songId): void
    {
        History::record($userId, $songId);
    }

    public function getUserHistory(int $userId, int $limit = 20): array
    {
        return History::getRecent($userId, $limit);
    }
}
