<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Author;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_author_can_be_created()
    {
        //$this->withoutExceptionHandling();
        //endpoint
        $this->post('/authors', $this->data());

        $author = Author::all();

        $this->assertCount(1, $author);
        //check to make sure that the response is a carbon instance
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('2020/05/03', $author->first()->dob->format('Y/d/m'));
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_dob_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }

    private function data(){
        return [
            'name' => 'Author Name',
            'dob' => '03/05/20',
        ];
    }
}
