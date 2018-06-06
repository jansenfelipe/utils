# Utils

[![Travis](https://travis-ci.org/jansenfelipe/utils.svg?branch=2.0)](https://travis-ci.org/jansenfelipe/utils)
[![Latest Stable Version](http://img.shields.io/packagist/v/jansenfelipe/utils.svg?style=flat)](https://packagist.org/packages/jansenfelipe/utils)
[![Total Downloads](http://img.shields.io/packagist/dt/jansenfelipe/utils.svg?style=flat)](https://packagist.org/packages/jansenfelipe/utils)
[![MIT license](https://img.shields.io/dub/l/vibe-d.svg)](http://opensource.org/licenses/MIT)


Uma simples classe utilitária com métodos que podem salvar sua vida (ou não)

### Como utilizar

Adicione a library

```sh
$ composer require jansenfelipe/utils
```
    
Adicione o autoload.php do composer no seu arquivo PHP.

```php
require_once 'vendor/autoload.php';  
```

Agora basta chamar os métodos estáticos:

```php
use JansenFelipe\Utils\Utils as Utils;
use JansenFelipe\Utils\Mask as Mask;

Utils::highlighting('Jansen Felipe', 'lipe'); //Jansen Fe<span style="background-color:yellow; color:#000;">lipe</span>

Utils::mask('31030080', Mask::CEP); //Output: 31.030-080

Utils::mask('12345678900', Mask::CPF); //Output: 123.456.789-00
Utils::mask('12345678901234', Mask::CNPJ); //Output: 12.345.678/9012-34

Utils::mask('12345678900', Mask::DOCUMENTO); //Output: 123.456.789-00
Utils::mask('12345678901234', Mask::DOCUMENTO); //Output: 12.345.678/9012-34

Utils::mask('31988710521', Mask::TELEFONE); //Output: (31)98871-0521
Utils::mask('3188710521', Mask::TELEFONE); //Output: (31)8871-0521

Utils::mask('a1b2c3d4e5f6', Mask::MAC); //Output: a1:b2:c3:d4:e5:f6

Utils::unmask('31.030-080'); //Output: 31030080

Utils::unaccents('Êita método bão sô!'); //Output: Eita metodo bao so!   

Utils::isCnpj('45543915000181'); //Output: true
Utils::isCnpj('45.543.915/0001-81'); //Output: true
Utils::isCnpj('84894484804888'); //Output: false

Utils::isCpf('51635916658'); //Output: true
Utils::isCpf('516.359.166-58'); //Output: true
Utils::isCpf('84894484804'); //Output: false
 
Utils::isEmail('jansen.felipe@gmail.com'); //Output: true   
Utils::isEmail('jansen.felipe@'); //Output: false   

Utils::moeda(2000) //Output: R$ 2.000,00   
Utils::moeda('3500.22', 'US$', 2) //Output: US$ 3.500,22   

Utils::unmoeda('R$ 2.000,00') //Output: 2000   
Utils::unmoeda('US$ 3.500,22') //Output: 3500.22

Utils::isMac('a1b2c3d4e5f6') // Output: true
Utils::isMac('a1:b2:c3:d4:e5:f6') // Output: true

Utils::isIp('127.0.0') // Output: false
Utils::isIp('127.0.0.1') // Output: true
Utils::isIp('192.168.0.255') // Output: true

Utils::normatizeName('JosÉ dos SANTOS E silva', 'de,do,da,e,dos')  // Output: José dos Santos e Silva
Utils::normatizeName('JOSÉ DE OLIVEIRA E SILVA', 'de,do,da,e,dos') // Output: José de Oliveira e Silva


```


### License

The MIT License (MIT)

Copyright (c) 2015 Jansen Felipe

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
