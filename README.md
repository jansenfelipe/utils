# Utils

----------------------
Uma simples classe utilitária com métodos que podem salvar sua vida (ou não)

### Para utilizar

Adicione no seu arquivo `composer.json` o seguinte registro na chave `require`

    "jansenfelipe/utils": "dev-master"

Execute

    $ composer update

## (Laravel)

Abra seu arquivo `config/app.php` e adicione `'JansenFelipe\Utils\Utils'` ao final do array `$providers`

    'providers' => array(

        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'JansenFelipe\Utils\UtilsServiceProvider',
    ),

Adicione também `'CepGratis' => 'JansenFelipe\Utils\Facade'` no final do array `$aliases`

    'aliases' => array(

        'App'        => 'Illuminate\Support\Facades\App',
        'Artisan'    => 'Illuminate\Support\Facades\Artisan',
        ...
        'Utils'    => 'JansenFelipe\Utils\Facade',
    ),

Agora basta os métodos

    $cep = Utils::mask('31030080', Mask::CEP); //Output: 31.030-080
    $documento = Utils::mask('12345678900', Mask::DOCUMENTO); //Output: 123.456.789-00
    $telefone = Utils::mask('31988710521', Mask::DOCUMENTO); //Output: (31) 98871-0521
    $telefone = Utils::mask('3188710521', Mask::DOCUMENTO); //Output: (31) 8871-0521
    
    $cep = Utils::unmask('31.030-080'); //Output: 31030080

    $string = Utils::unaccents('Êita método bão sô!'); //Output: Eita metodo bao so!

### (No-Laravel)

Adicione o autoload.php do composer no seu arquivo PHP.

    require_once 'vendor/autoload.php';  

Agora basta chamar os métodos utilitários da classe JansenFelipe\Utils\Utils();

    $utils = new JansenFelipe\Utils\Utils();

    $cep = $utils->mask('31030080', Mask::CEP); //Output: 31.030-080
    $documento = $utils->mask('12345678900', Mask::DOCUMENTO); //Output: 123.456.789-00
    $telefone = $utils->mask('31988710521', Mask::DOCUMENTO); //Output: (31) 98871-0521
    $telefone = $utils->mask('3188710521', Mask::DOCUMENTO); //Output: (31) 8871-0521
    
    $cep = $utils->unmask('31.030-080'); //Output: 31030080

    $string = $utils->unaccents('Êita método bão sô!'); //Output: Eita metodo bao so!