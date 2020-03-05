<?php

namespace Tests\Feature;

use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookManagementTest extends TestCase
{
    //it tears down the database
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        //$this->withoutExceptionHandling();
        $response = $this->post('/books', $this->data());

        $book = Book::first();

        //not need this if you are asserting a redirect
        //$response->assertOk();
        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
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

        $response = $this->post('/books', array_merge($this->data(), ['author_id' => '']));

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->post('/books',$this->data());

        //to grab the id of the book
        $book = Book::first();

        //because of firstOrCreate so that the id return is 2
        $response = $this->patch($book->path(),[
           'title' => 'Charlotte',
            'author_id' => 'Jason',
        ]);
        /*$book = Book::first();
        $title = 'Charlotte';
        $response->assertEquals($title,$book->title);
        dd($book->title);*/
        /*$this->assertDatabaseHas('books',[
           'title' => 'Charlotte',
           'author_id' => 1,
        ]);*/
        $this->assertEquals('Charlotte', Book::first()->title);
        $this->assertEquals(2, Book::first()->author_id);
        //fresh to fetch again in the database
        $response->assertRedirect($book->fresh()->path());
        //$response->assertDat('Charlotte', $book->title);
        //$response->assertEquals(1, $book->author);
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->post('/books',$this->data());

        //to grab the id of the book
        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }

    /** @test */
    public function a_new_author_is_automatically_added()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', [
           'title' => 'Maverick',
            'author_id' => 'Mark',
        ]);

        $book = Book::first();
        $author = Author::first();

        //author is not created so you make a drop down level because its to high up
        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());
    }

    private function data()
    {
        return [
            'title' => 'Maverick',
            'author_id' => 1,
        ];
    }
}
