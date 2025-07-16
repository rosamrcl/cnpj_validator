<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

require_once 'CNPJValidator.php';

class CNPJValidatorTest extends TestCase
{
    /**
     * @dataProvider cnpjProvider
     */

    public function testIsValid($cnpj, $expected)
    {
        $validator = new CNPJValidator();
        $this->assertEquals($expected, $validator->isValid($cnpj));
    }

    public function cnpjProvider()
    {
        return [
            ["11.222.333/0001-81", true],
            ["11222333000181", true],
            ["00.000.000/0000-00", false],
            ["12345678901234", false],
            ["11.111.111/1111-11", false],
            ["67.654.321/0001-55", false],
            ["06.990.590/0001-23", true],
            ["06990590000123", true],
            ["", false],
            ["abc", false],
            ["123", false]
        ];
    }
}
