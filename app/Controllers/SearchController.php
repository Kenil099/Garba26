<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\SearchService;

class SearchController extends Controller
{
    private SearchService $searchService;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->searchService = new SearchService();
    }

    public function index(): void
    {
        $query = $this->request->input('q', '');
        $results = $this->searchService->searchAll($query);

        $this->render('explore/search', [
            'title'   => !empty($query) ? "Search: {$query} - Garba26" : "Search Songs & Artists - Garba26",
            'query'   => $query,
            'results' => $results,
        ]);
    }

    public function query(): void
    {
        $query = $this->request->input('q', '');
        $results = $this->searchService->searchAll($query);
        $this->json(['success' => true, 'data' => $results]);
    }
}
