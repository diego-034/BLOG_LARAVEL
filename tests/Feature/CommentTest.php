<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $credentials= [
        "email" => "test2@mail.com",
        "password" => "12345678"
    ];


    public function testCreateComment()
    {
        $response = $this->post('/login', $this->credentials);
        $response->assertRedirect('/home');

        $response = $this->post('/comment', ['comment' => 'test_create', 'post_id' => '20']);
        $response->assertStatus(200);
    }

    public function testFailCreateComment()
    {
        $response = $this->post('/login', $this->credentials);
        $response->assertRedirect('/home');
        $response = $this->post('/comment', []);
        $response->assertSeeText('Ocurred an error');
    }

    // public function testUpdateComment()
    // {
    //     $response = $this->post('/login', $this->credentials);
    //     $response->assertRedirect('/home');
    //     $response = $this->post('/comment/update/22',['comment'=> 'test_update']);
    //     $response->assertStatus(200);
    // }

    public function testDeleteComment()
    {
        $response = $this->post('/login', $this->credentials);
        $response->assertRedirect('/home');
        $response = $this->delete('/comment',['comment_id'=> 22]);
        $response->assertStatus(200);
    }

    
}
