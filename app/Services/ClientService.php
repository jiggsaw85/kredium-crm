<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{
    /**
     * @param array $data
     * @return Client
     */
    public function createClient(array $data): Client
    {
        $data['user_id'] = auth()->id();
        return Client::create($data);
    }

    /**
     * @param Client $client
     * @param array $data
     * @return void
     */
    public function updateClient(Client $client, array $data): void
    {
        $client->update($data);
    }

    /**
     * @param Client $client
     * @return void
     */
    public function deleteClient(Client $client): void
    {
        $client->delete();
    }
}
