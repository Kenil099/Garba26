<?php
// tests/SearchTest.php
require_once dirname(__DIR__) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/Song.php';
require_once ROOT_PATH . '/app/Models/Artist.php';
require_once ROOT_PATH . '/app/Models/Album.php';
require_once ROOT_PATH . '/app/Services/SearchService.php';

echo "=== Running SearchTest ===\n";

$service = new \App\Services\SearchService();
$res = $service->searchAll('Tara');

assert(count($res['songs']) > 0, 'Search failed to find Tara Vina Shyam');
echo "✓ Search found " . count($res['songs']) . " songs for 'Tara'.\n";

echo "SearchTest Passed Successfully! 🔍\n";
