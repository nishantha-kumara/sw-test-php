<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\File;

class AppTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRootUrl()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testWithQueryString()
    {
        $response = $this->get('/', ['query' => 'multron']);
        $response->assertStatus(200);
    }

    public function testJsonFilesExists()
    {
        $exists = true;
        $exists = File::exists(public_path('json-store/organizations.json'));
        $exists = File::exists(public_path('json-store/tickets.json'));
        $exists = File::exists(public_path('json-store/users.json'));
        $this->assertTrue($exists);
    }
}
