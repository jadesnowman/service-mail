<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldReturnPost()
    {
        $this->get('/api/v1/posts');

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            'success',
            'message',
            'data',
            'code',
            'version',
        ]);
    }

    public function testShouldCreatePost()
    {
        $data = [
            "title" => "Lorem ipsum dolor sit amet",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.",
            "slug" => "lorem-ipsum"
        ];

        $this->post('/api/v1/posts', $data);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                "_id",
                "title",
                "body",
                "slug",
                "updated_at",
                "created_at",
            ],
            'code',
            'version',
        ]);
    }
}
