<?php


use Hashemi\Valideto\Valideto;
use PHPUnit\Framework\TestCase;

class ValidetoArrayTest extends TestCase
{
    public function testArray()
    {
        $data = [
            'hobbies' => [
                'cricket',
                'badminton',
                'programming'
            ]
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['array']
        ]);

        $validator->validate();

        self::assertSame($data, $validator->validate());
    }

    public function testArrayFailedMessage()
    {
        $data = [
            'hobbies' => null
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['array']
        ]);

        $validator->validate();

        self::assertSame([
            'hobbies' => [
                'array' => 'This hobbies should be array'
            ]
        ], $validator->getErrorMessages());
    }

    public function testArrayWithNullable()
    {
        $data = [];

        $validator = new Valideto($data, [
            'hobbies' => ['nullable', 'array']
        ]);

        $validator->validate();

        self::assertSame($data, $validator->validate());
    }

    public function testArrayDataWithNullable()
    {
        $data = [
            'hobbies' => [
                'cricket',
                'badminton',
                'programming'
            ]
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['nullable', 'array']
        ]);


        self::assertSame($data, $validator->validate());
    }

    public function testArrayWithNullableFailsMessage()
    {
        $data = [
            'hobbies' => null
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['nullable', 'array']
        ]);

        $validator->validate();

        self::assertSame([
            'hobbies' => [
                'array' => 'This hobbies should be array'
            ]
        ], $validator->getErrorMessages());
    }

    public function testDistinctArray()
    {
        $data = [
            'hobbies' => [
                'cricket',
                'badminton',
                'programming',
            ]
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['array', 'distinct']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testDistinctArrayFailWithMessage()
    {
        $data = [
            'hobbies' => [
                'cricket',
                'badminton',
                'programming',
                'badminton'
            ]
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['array', 'distinct']
        ]);

        $validator->validate();

        $this->assertSame([
            'hobbies' => [
                'distinct' => 'This hobbies has duplicate value'
            ]
        ], $validator->getErrorMessages());
    }
}