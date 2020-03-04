<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookReservationTest extends TestCase
{
    //it tears down the database
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books',[
           'title' => 'Maverick',
            'author' => 'Mark',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
        //comment out
        //$this->withoutExceptionHandling();

        $response = $this->post('/books',[
            'title' => '',
            'author' => 'Mark',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_author_is_required()
    {
        //comment out
        //$this->withoutExceptionHandling();

        $response = $this->post('/books',[
            'title' => 'Maverick',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books',[
            'title' => 'Maverick',
            'author' => 'Mark',
        ]);

        //to grab the id of the book
        $book = Book::first();

        /*$response = */$this->patch('/books/'.$book->id,[
           'title' => 'Charlotte',
            'author' => 'Jason',
        ]);
        /*$book = Book::first();
        $title = 'Charlotte';
        $response->assertEquals($title,$book->title);
        dd($book->title);*/
        $this->assertDatabaseHas('books',[
           'title' => 'Charlotte',
           'author' => 'Jason',
        ]);
        //$response->assertDat('Charlotte', $book->title);
        //$response->assertEquals('Jason', $book->author);
    }
}
