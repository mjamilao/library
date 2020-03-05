<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Author;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function only_name_is_required_when_creating_an_author()
    {
        Author::firstOrCreate([
            'name' => 'Markus Amilao',
        ]);

        $this->assertCount(1, Author::all());
    }
}
