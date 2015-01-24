# Utils

[![Travis](https://travis-ci.org/jansenfelipe/utils.svg?branch=1.0)](https://travis-ci.org/jansenfelipe/utils.svg?branch=1.0)
[![Latest Stable Version](https://poser.pugx.org/jansenfelipe/utils/v/stable.svg)](https://packagist.org/packages/jansenfelipe/utils) [![Total Downloads](https://poser.pugx.org/jansenfelipe/utils/downloads.svg)](https://packagist.org/packages/jansenfelipe/utils) [![Latest Unstable Version](https://poser.pugx.org/jansenfelipe/utils/v/unstable.svg)](https://packagist.org/packages/jansenfelipe/utils) [![License](https://poser.pugx.org/jansenfelipe/utils/license.svg)](https://packagist.org/packages/jansenfelipe/utils)

Uma simples classe utilitária com métodos que podem salvar sua vida (ou não)

### Como usar

Adicione no seu arquivo `composer.json` o seguinte registro na chave `require`

    "jansenfelipe/utils": "1.0.*@dev"

Execute

    $ composer update
    
Adicione o autoload.php do composer no seu arquivo PHP.

    require_once 'vendor/autoload.php';  

Agora basta chamar os métodos utilitários da classe JansenFelipe\Utils\Utils();

    use JansenFelipe\Utils\Utils as Utils;
    use JansenFelipe\Utils\Mask as Mask;

    Utils::mask('31030080', Mask::CEP); //Output: 31.030-080
    
    Utils::mask('12345678900', Mask::CPF); //Output: 123.456.789-00
    Utils::mask('12345678901234', Mask::CNPJ); //Output: 12.345.678/9012-34
    
    Utils::mask('12345678900', Mask::DOCUMENTO); //Output: 123.456.789-00
    Utils::mask('12345678901234', Mask::DOCUMENTO); //Output: 12.345.678/9012-34
    
    Utils::mask('31988710521', Mask::TELEFONE); //Output: (31)98871-0521
    Utils::mask('3188710521', Mask::TELEFONE); //Output: (31)8871-0521
    
    Utils::unmask('31.030-080'); //Output: 31030080

    Utils::isCnpj('45543915000181'); //Output: true
    Utils::isCnpj('45.543.915/0001-81'); //Output: true
    Utils::isCnpj('84894484804888'); //Output: false
    
    Utils::isCpf('51635916658'); //Output: true
    Utils::isCpf('516.359.166-58'); //Output: true
    Utils::isCpf('84894484804'); //Output: false

    Utils::unaccents('Êita método bão sô!'); //Output: Eita metodo bao so!    

    Utils::isEmail('jansen.felipe@gmail.com'); //Output: true   
    Utils::isEmail('jansen.felipe@'); //Output: false   

    Utils::moeda(2000) //Output: R$ 2.000,00   
    Utils::moeda('3500.22', 'US$', 2) //Output: US$ 3.500,22   

## (Frameworks)

##### (Laravel)

Abra seu arquivo `config/app.php` e adicione `'JansenFelipe\Utils\Utils'` ao final do array `$providers`

    'providers' => array(

        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'JansenFelipe\Utils\UtilsServiceProvider',
    ),

Adicione também `'Utils' => 'JansenFelipe\Utils\Facade'` no final do array `$aliases`

    'aliases' => array(

        'App'        => 'Illuminate\Support\Facades\App',
        'Artisan'    => 'Illuminate\Support\Facades\Artisan',
        ...
        'Utils'             => 'JansenFelipe\Utils\Facade',
        'Mask'              => 'JansenFelipe\Utils\FacadeMask',
    ),
