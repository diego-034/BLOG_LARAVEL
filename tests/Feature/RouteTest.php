<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

   
    public function testWelcome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    public function testLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function testRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function testHome()
    {
        $response = $this->get('/home');
        $response->assertRedirect('login');
    }

    public function testProfile()
    {
        $response = $this->call('GET','/profile/{id}',['id'=> 1]);
        $response->assertRedirect('login');
    }

    public function testPosts()
    {
        $response = $this->call('GET','/posts/{id}',['id'=> 14]);
        $response->assertRedirect('login');
    }

    public function testCreatePost()
    {
        $response = $this->call('POST','/publish');
        $response->assertRedirect('login');
    }

    public function testDeletePost()
    {
        $response = $this->call('DELETE','/post',['id'=> 14]);
        $response->assertRedirect('login');
    }

    public function testUpdatePost()
    {
        $response = $this->call('POST','/post/update/{id}',['id'=> 14]);
        $response->assertRedirect('login');
    }

    public function testCreateComment()
    {
        $response = $this->call('POST','/comment');
        $response->assertRedirect('login');
    }
}
