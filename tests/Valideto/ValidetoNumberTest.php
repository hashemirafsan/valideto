<?php


use Hashemi\Valideto\Valideto;
use PHPUnit\Framework\TestCase;

class ValidetoNumberTest extends TestCase
{
    public function testNumber()
    {
        $data = [
            'age' => 12
        ];

        $validator = new Valideto($data, [
            'age' => ['numeric']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testNumberFailsWithMessage()
    {
        $data = [
            'age' => 'something'
        ];

        $validator = new Valideto($data, [
            'age' => ['numeric']
        ]);

        $validator->validate();

        $this->assertSame([
            'age' => [
                'numeric' => 'This age should be numeric'
            ]
        ], $validator->getErrorMessages());
    }

    public function testNumberInteger()
    {
        $data = [
            'age' => 12
        ];

        $validator = new Valideto($data, [
            'age' => ['numeric', 'integer']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testNumberIntegerFailsWithMessage()
    {
        $data = [
            'age' => 'something'
        ];

        $validator = new Valideto($data, [
            'age' => ['numeric', 'integer']
        ]);

        $validator->validate();

        $this->assertSame([
            'age' => [
                'numeric' => 'This age should be numeric',
                'integer' => 'This age should be integer'
            ]
        ], $validator->getErrorMessages());
    }

    public function testNumberFloat()
    {
        $data = [
            'age' => 12.20
        ];

        $validator = new Valideto($data, [
            'age' => ['numeric', 'float']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testNumberFloatFailsWithMessage()
    {
        $data = [
            'age' => 'something'
        ];

        $validator = new Valideto($data, [
            'age' => ['numeric', 'float']
        ]);

        $validator->validate();

        $this->assertSame([
            'age' => [
                'numeric' => 'This age should be numeric',
                'float' => 'This age should be float'
            ]
        ], $validator->getErrorMessages());
    }

    public function testGt()
    {
        $data = [
            'age' => 12
        ];

        $validator = new Valideto($data, [
            'age' => ['gt:11']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testGtFailsMessage()
    {
        $data = [
            'age' => 11
        ];

        $validator = new Valideto($data, [
            'age' => ['gt:11']
        ]);

        $validator->validate();

        $this->assertSame([
            'age' => [
                'gt' => 'This age should be greater than 11'
            ]
        ], $validator->getErrorMessages());
    }

    public function testGte()
    {
        $data = [
            'age' => 11
        ];

        $validator = new Valideto($data, [
            'age' => ['gte:11']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testGteFailsMessage()
    {
        $data = [
            'age' => 10
        ];

        $validator = new Valideto($data, [
            'age' => ['gte:11']
        ]);

        $validator->validate();

        $this->assertSame([
            'age' => [
                'gte' => 'This age should be greater than or equal to 11'
            ]
        ], $validator->getErrorMessages());
    }

    public function testLt()
    {
        $data = [
            'age' => 10
        ];

        $validator = new Valideto($data, [
            'age' => ['lt:11']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testLtFailsMessage()
    {
        $data = [
            'age' => 11
        ];

        $validator = new Valideto($data, [
            'age' => ['lt:11']
        ]);

        $validator->validate();

        $this->assertSame([
            'age' => [
                'lt' => 'This age should be less than 11'
            ]
        ], $validator->getErrorMessages());
    }

    public function testLte()
    {
        $data = [
            'age' => 11
        ];

        $validator = new Valideto($data, [
            'age' => ['lte:11']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testLteFailsMessage()
    {
        $data = [
            'age' => 12
        ];

        $validator = new Valideto($data, [
            'age' => ['lte:11']
        ]);

        $validator->validate();

        $this->assertSame([
            'age' => [
                'lte' => 'This age should be less than or equal to 11'
            ]
        ], $validator->getErrorMessages());
    }

    public function testEqInteger()
    {
        $data = [
            'age' => 11
        ];

        $validator = new Valideto($data, [
            'age' => ['eq:integer:11']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testEqFloat()
    {
        $data = [
            'age' => 11.1
        ];

        $validator = new Valideto($data, [
            'age' => ['eq:float:11.1']
        ]);

        $this->assertSame($data, $validator->validate());
    }
}