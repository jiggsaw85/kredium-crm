<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display client page
     *
     * @return View
     */
    public function index(): View
    {
        $clients = Client::orderBy('created_at', 'desc')->get();
        return view('clients.index', compact('clients'));
    }

    /**
     * Display edit client page
     *
     * @param Client $client
     * @return View
     */
    public function edit(Client $client): View
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Display create client page
     *
     * @return View
     */
    public function create(): View
    {
        return view('clients.create');
    }

    /**
     * @param StoreClientRequest $request
     * @return RedirectResponse
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        try {
            $this->clientService->createClient($request->validated());
            return redirect()->route('clients.index')->with('success', 'Client created successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating client: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'request_data' => $request->all(),
            ]);

            return redirect()->route('clients.index')->with('error', 'An error occurred while creating the client. Please try again.');
        }
    }

    /**
     * @param StoreClientRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function update(StoreClientRequest $request, Client $client): RedirectResponse
    {
        try {
            $this->clientService->updateClient($client, $request->validated());
            return redirect()->route('clients.edit', $client->id)->with('success', 'Client updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating client: ' . $e->getMessage(), [
                'client_id' => $client->id,
                'request_data' => $request->all(),
            ]);

            return redirect()->route('clients.edit', $client->id)->with('error', 'An error occurred while updating the client. Please try again.');
        }
    }

    /**
     * @param Client $client
     * @return RedirectResponse
     */
    public function destroy(Client $client): RedirectResponse
    {
        try {
            $this->clientService->deleteClient($client);
            return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting client: ' . $e->getMessage(), [
                'client_id' => $client->id,
            ]);

            return redirect()->route('clients.index')->with('error', 'An error occurred while deleting the client. Please try again.');
        }
    }

}
