<?php

namespace Tests\Unit;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PostRequestTest extends TestCase
{

    private $rules;

    protected function setUp()
    {
        parent::setUp();

        $this->rules = (new PostRequest())->rules();
    }

    /**
     * @test
     * @dataProvider paramsProvider()
     * @param $title
     * @param $content
     * @param $expect
     */
    public function abnormalRequest($title, $content, $expect): void
    {
        $params = [
            'title' => $title,
            'content' => $content
        ];

        $result = Validator::make($params, $this->rules)->passes();
        $this->assertEquals($expect, $result);
    }

    /**
     * @return array
     */
    public function paramsProvider(): array
    {
        return [
            'expected params' => [
                'a', 'a', true
            ],
            'title is max length' => [
                str_repeat('a', 50), 'a', true
            ],
            'content is max length' => [
                'a', str_repeat('a', 10000), true
            ],
            'title is empty' => [
                '', 'a', false
            ],
            'content is empty' => [
                'a', '', false
            ],
            'title is longer' => [
                str_repeat('a', 51), 'a', false
            ],
            'content is longer' => [
                'a', str_repeat('a', 10001), false
            ]
        ];
    }

}
