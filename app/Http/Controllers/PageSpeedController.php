<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnalyzeRequest;
use App\Services\PageSpeedService;
use App\Models\Category;
use App\Models\Strategy;

class PageSpeedController extends Controller
{
    protected $pageSpeedService;

    public function __construct(PageSpeedService $pageSpeedService)
    {
        $this->pageSpeedService = $pageSpeedService;
    }

    public function index()
    {
        $categories = Category::pluck('name');
        $strategies = Strategy::pluck('id','name');
        
        return view('pageSpeedAnalyze', compact('categories', 'strategies'));
    }

    public function analyze(AnalyzeRequest $request)
    {
        $url = $request->input('url');
        $categories = $request->input('categories');
        $strategy = $request->input('strategy');

        $metrics = $this->pageSpeedService->getMetrics($url, $categories, $strategy);

        return response()->json($metrics);
    }
}
