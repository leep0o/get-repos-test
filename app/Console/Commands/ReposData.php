<?php

namespace App\Console\Commands;

use App\Services\RepoService;
use Illuminate\Console\Command;

class ReposData extends Command
{
    /**
     * @var RepoService
     */
    private $repoService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repos:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get repository data';

    /**
     * ReposData constructor.
     * @param RepoService $repoService
     */
    public function __construct(RepoService $repoService)
    {
        parent::__construct();

        $this->repoService = $repoService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->repoService->getDataRepos();
    }
}
