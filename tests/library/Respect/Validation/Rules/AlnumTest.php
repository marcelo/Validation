<?php

namespace Respect\Validation\Rules;

class AlnumTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidAlnum
     */
    public function testAlnumValid($validAlnum, $aditional)
    {
        $validator = new Alnum($aditional);
        $this->assertTrue($validator->validate($validAlnum));
    }

    /**
     * @dataProvider providerForInvalidAlnum
     * @expectedException Respect\Validation\Exceptions\AlnumException
     */
    public function testAlnumInvalid($invalidAlnum, $aditional)
    {
        $validator = new Alnum($aditional);
        $validator->assert($invalidAlnum);
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidParameters($aditional)
    {
        $validator = new Alnum($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidAlnum()
    {
        return array(
            array('alganet', ''),
            array('alganet', 'alganet'),
            array('0alg-anet0', '0-9'),
            array('1', ''),
            array('a', ''),
            array('foobar', ''),
            array('rubinho_', '_'),
            array('google.com', '.'),
            array('alganet alganet', ''),
            array("\nabc", ''),
            array("\tdef", ''),
            array("\nabc \t", ''),
            array(0, ''),
        );
    }

    public function providerForInvalidAlnum()
    {
        return array(
            array('@#$', ''),
            array('_', ''),
            array("\t", ''),
            array("\n", ''),
            array('', ''),
            array('dgç', ''),
            array(1e21, ''), //evaluates to "1.0E+21"
            array(null, ''),
            array(new \stdClass, ''),
            array(array(), ''),
        );
    }

}
