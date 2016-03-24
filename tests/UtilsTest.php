<?php

use JansenFelipe\Utils\Mask;
use JansenFelipe\Utils\Utils;

class UtilsTest extends PHPUnit_Framework_TestCase {

    public function testMask() {
        $this->assertEquals('732.584.423-98', Utils::mask('73258442398', Mask::DOCUMENTO));
        $this->assertEquals('732.584.423-98', Utils::mask('73258442398', Mask::CPF));

        $this->assertEquals('13.779.426/0001-37', Utils::mask('13779426000137', Mask::DOCUMENTO));
        $this->assertEquals('13.779.426/0001-37', Utils::mask('13779426000137', Mask::CNPJ));

        $this->assertEquals('31.030-080', Utils::mask('31030080', Mask::CEP));

        $this->assertEquals('(31)3072-7066', Utils::mask('3130727066', Mask::TELEFONE));
        $this->assertEquals('(31)99503-7066', Utils::mask('31995037066', Mask::TELEFONE));

        $this->assertEquals('a1:b2:c3:d4:e5:f6', Utils::mask('a1b2c3d4e5f6', Mask::MAC));
    }

    public function testUnmask() {
        $this->assertEquals('73258442398', Utils::unmask('732.584.423-98'));
        $this->assertEquals('a1b2c3d4e5f6', Utils::unmask('a1:b2:c3:d4:e5:f6'));
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

    public function testUnmoeda() {
        $this->assertEquals(2000, Utils::unmoeda('R$ 2.000,00'));
        $this->assertEquals(3500.22, Utils::unmoeda('US$ 3.500,22', 'US$'));
    }

    public function testIsMac() {
        $this->assertEquals(true, Utils::isMac('a1:b2:c3:d4:e5:f6'));
        $this->assertEquals(true, Utils::isMac('a1b2c3d4e5f6'));
        $this->assertEquals(true, Utils::isMac('a1-b2-c3-d4-e5-f6'));
        $this->assertEquals(false, Utils::isMac('a1b2c3d4e5f6g7'));
    }

    public function testIsIp() {
        $this->assertEquals(false, Utils::isIp('127.0.0'));
        $this->assertEquals(true,  Utils::isIp('127.0.0.1'));
        $this->assertEquals(true,  Utils::isIp('192.168.0.255'));
    }

    public function testNormatizeName(){
        $escape = 'de,do,da,e,dos';
        $this->assertEquals('João da Silva', Utils::normatizeName('joão da silva', $escape));
        $this->assertEquals('José dos Santos e Silva', Utils::normatizeName('JosÉ dos SANTOS E silva', $escape));
        $this->assertEquals('José de Oliveira e Silva', Utils::normatizeName('JOSÉ DE OLIVEIRA E SILVA', $escape));
    }

}
