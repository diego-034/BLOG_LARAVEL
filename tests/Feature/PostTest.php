<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $credentials= [
        "email" => "test@mail.com",
        "password" => "12345678"
    ];


    public function testCreatePost()
    {
        $response = $this->post('/login', $this->credentials);
        $response->assertRedirect('/home');

        $response = $this->post('/publish', ['post_title' => 'test_create', 'post_body' => 'test_create']);
        $response->assertRedirect('home');
    }

    public function testFailCreatePost()
    {
        $response = $this->post('/login', $this->credentials);
        $response->assertRedirect('/home');
        $response = $this->post('/publish', []);
        $response->assertSeeText('Ocurred an error');
    }

    // public function testUpdatePost()
    // {
    //     $response = $this->post('/login', $this->credentials);
    //     $response->assertRedirect('/home');
    //     $response = $this->post('/post/update/22',['post_title'=> 'test_update','post_body'=>'test_upadate']);
    //     $response->assertStatus(200);
    // }

    // public function testDeletePost()
    // {
    //     $response = $this->post('/login', $this->credentials);
    //     $response->assertRedirect('/home');
    //     $response = $this->delete('/post',['post_id'=> 22]);
    //     $response->assertStatus(200);
    // }

    
}
