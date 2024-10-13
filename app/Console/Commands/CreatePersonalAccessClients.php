<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\PersonalAccessClient;

class CreatePersonalAccessClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:create-personal-access-clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create personal access clients for web and mobile';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::beginTransaction(); // Start the transaction

        try {
            $this->createClient('web');
            $this->createClient('mobile');
            $this->createClient("others");
            DB::commit();
            $this->info('Personal access clients created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            $this->error('Failed to create personal access clients: ' . $e->getMessage());
        }
    }

    private function createClient($name): void
    {
        // Check if a client with the same name already exists
        $existingClient = Client::where('name', $name)->first();

        if ($existingClient) {
            $this->info("Personal access client '{$name}' already exists with ID: {$existingClient->id}");
            return; // Skip creation if the client already exists
        }

        // Create the client since it doesn't exist
        $client = Client::create([
            'user_id' => null,
            'name' => $name,
            'redirect' => '',
            'secret' => Str::random(40),
            'personal_access_client' => true,
            'password_client' => false,
            'revoked' => false,
        ]);

        // Store the generated client ID in the oauth_personal_access_clients table
        PersonalAccessClient::create([
            'client_id' => $client->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->info("Personal access client '{$name}' created successfully.");
        $this->info("Client ID: {$client->id}");
        $this->info("Client Secret: {$client->secret}");
    }
}
