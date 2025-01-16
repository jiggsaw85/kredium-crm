<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{
    public function createClient(array $data): Client
    {
        $data['user_id'] = auth()->id();
        return Client::create($data);
    }

    public function updateClient(Client $client, array $data): void
    {
        $client->update($data);
    }

    public function deleteClient(Client $client): void
    {
        $client->delete();
    }
}
