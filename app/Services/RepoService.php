<?php

namespace App\Services;

use App\Models\Repo;
use App\Models\Owner;
use GuzzleHttp\Client;
use App\Exceptions\ErrorGetDataException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RepoService
{
    /**
     * Constant URL data repos
     */
    const REPOS_URL = 'https://api.github.com/users/google/repos';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Repo
     */
    private $repo;

    /**
     * @var Owner
     */
    private $owner;

    /**
     * RepoService constructor.
     * @param Repo $repo
     * @param Owner $owner
     * @param Client $client
     */
    public function __construct(Repo $repo, Owner $owner, Client $client)
    {
        $this->repo = $repo;
        $this->owner = $owner;
        $this->client = $client;
    }

    /**
     * Getting repos data
     *
     * @throws ErrorGetDataException
     */
    public function getDataRepos()
    {
        $response = $this->client->get(self::REPOS_URL);

        if ($response->getStatusCode() !== 200) {
            throw new ErrorGetDataException('Error getting data with code: ' . $response->getStatusCode());
        }

        $this->storeRepos(json_decode($response->getBody()));
    }

    /**
     * Store repos data
     *
     * @param array $repos
     */
    public function storeRepos(array $repos)
    {
        if (count($repos)) {
            foreach ($repos as $repo) {
                $newOwner = $this->owner->find($repo->owner->id)
                    ?: $this->owner->create([
                        'id' => $repo->owner->id,
                        'name' => $repo->owner->login,
                        'avatar' => $repo->owner->avatar_url,
                    ]);

                $newRepo = $this->repo->find($repo->id)
                    ?: $this->repo->create([
                        'id' => $repo->id,
                        'name' => $repo->full_name,
                        'link' => $repo->html_url,
                        'updated_at' => $repo->updated_at,
                    ]);

                $newRepo->owner()->associate($newOwner)->save();
            }
        }
    }

    /**
     * Get repos
     *
     * @return LengthAwarePaginator
     */
    public function getRepos(): LengthAwarePaginator
    {
        return $this->repo
            ->with([
                'owner' => function ($query) {
                    $query->get('name', 'avatar');
                }
            ])
            ->paginate(10);
    }
}
