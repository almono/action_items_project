<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FunctionalityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testHomepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testImageUpload()
    {
        Storage::fake('photos');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->json('POST', '/upload-file', [
            'action_file' => $file,
            'action_id' => '3',
        ]);

        // Assert the file was stored...
        Storage::disk('local')->assertExiphpsts("photos/" . "3-photo.jpg");

    }
}
