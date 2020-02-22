<?php

namespace App\Http\Controllers;

use App\Services\RepoService;
use Illuminate\View\View;

class RepoController extends Controller
{
    /**
     * @var RepoService
     */
    private $repoService;

    /**
     * RepoController constructor.
     * @param RepoService $repoService
     */
    public function __construct(RepoService $repoService)
    {
        $this->repoService = $repoService;
    }

    /**
     * Repos list
     *
     * @return View
     */
    public function index(): View
    {
        return view('welcome', [
            'repos' => $this->repoService->getRepos()
        ]);
    }
}
