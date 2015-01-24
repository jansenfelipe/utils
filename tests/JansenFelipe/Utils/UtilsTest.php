<?php

namespace JansenFelipe\Utils;

use PHPUnit_Framework_TestCase;

class UtilsTest extends PHPUnit_Framework_TestCase {

    public function testMask() {
        $this->assertEquals('732.584.423-98', Utils::mask('73258442398', Mask::DOCUMENTO));
        $this->assertEquals('732.584.423-98', Utils::mask('73258442398', Mask::CPF));

        $this->assertEquals('13.779.426/0001-37', Utils::mask('13779426000137', Mask::DOCUMENTO));
        $this->assertEquals('13.779.426/0001-37', Utils::mask('13779426000137', Mask::CNPJ));

        $this->assertEquals('31.030-080', Utils::mask('31030080', Mask::CEP));

        $this->assertEquals('(31)3072-7066', Utils::mask('3130727066', Mask::TELEFONE));
        $this->assertEquals('(31)99503-7066', Utils::mask('31995037066', Mask::TELEFONE));
    }

    public function testUnmask() {
        $this->assertEquals('73258442398', Utils::unmask('732.584.423-98'));
    }

    public function testUnaccents() {
        $this->assertEquals('Eita metodo bao so!', Utils::unaccents('Êita método bão sô!'));
    }

    public function testIsCnpj() {
        $this->assertEquals(true, Utils::isCnpj('13779426000137'));
        $this->assertEquals(true, Utils::isCnpj('13.779.426/0001-37'));

        $this->assertEquals(false, Utils::isCnpj('14944426000137'));
    }

    public function testIsCpf() {
        $this->assertEquals(true, Utils::isCpf('73258442398'));
        $this->assertEquals(true, Utils::isCpf('732.584.423-98'));

        $this->assertEquals(false, Utils::isCpf('3234423333'));
    }

    public function testIsEmail() {
        $this->assertEquals(true, Utils::isEmail('jansen.felipe@gmail.com'));

        $this->assertEquals(false, Utils::isEmail('j209f9002'));
        $this->assertEquals(false, Utils::isEmail('jansen.felipe@'));
    }

    public function testMoeda() {
        $this->assertEquals('R$ 2.000,00', Utils::moeda(2000));
        $this->assertEquals('US$ 3.500,22', Utils::moeda('3500.22', 'US$', 2));
    }

}
