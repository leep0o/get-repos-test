<?php

namespace App\Services;

use App\Exceptions\ErrorGetDataException;
use App\Models\Repo;
use App\Models\Owner;
use GuzzleHttp\Client;

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
    public function getDataRepos()// разбить на методы и изменить названия методов
    {
        $response = $this->client->get(self::REPOS_URL);

        if ($response->getStatusCode() !== 200) {
            throw new ErrorGetDataException('Error getting data with code: ' . $response->getStatusCode());
        }

        $this->storeDataRepos(json_decode($response->getBody()));
    }

    /**
     * Store repos data
     *
     * @param array $repos
     */
    public function storeDataRepos(array $repos)
    {
        if (count($repos)) {
            foreach ($repos as $repo) {
                $newOwner = $this->owner->find($repo->owner->id)
                    ?: $this->owner->create([
                        'id' => $repo->owner->id,
                        'name' => $repo->owner->login,
                        'avatar' => $repo->owner->avatar_url,
                    ]);

                $newRepo = $this->owner->find($repo->id)
                    ?: $this->repo->create([
                        'id' => $repo->id,
                        'name' => $repo->full_name,
                        'link' => $repo->html_url,
                        'created_at' => $repo->created_at,
                    ]);

                $newRepo->owner()->associate($newOwner)->save();
            }
        }
    }
}
