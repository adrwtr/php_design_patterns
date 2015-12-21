<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
/**
 * 1 - Este padrao define uma classe abstrata com uma função
 * que indicará a criação de um objeto baseado em um parametro
 *
 * 2 - As classes concretas que irão extender, irão definir a função
 * de criação de acordo com a sua familia de produtos, que será decidido dinamicamente
 * de acordo com o parametro passado
 */

// classe abstrata com o metodo que indica o que será criado baseado
// em um parametro
abstract class AbstractFactoryMethod {
    abstract function makeSmartPhone($ds_param);
}

// Concreta: cria produtos relacionados
class LGFactoryMethod extends AbstractFactoryMethod {

    function makeSmartPhone($ds_param)
    {
        switch ($ds_param) {
            case "l7":
                return new LgL7();
            break;

            case "l9":
                return new LgL9();
            break;

            case "lVoit":
                return new LgVoit();
            break;
        }
    }
}

// Concreta: cria produtos relacionados
class SansungFactoryMethod extends AbstractFactoryMethod {

    function makeSmartPhone($ds_param)
    {
        switch ($ds_param) {
            case "note":
                return new SansungNote();
            break;

            case "tab":
                return new SangungTab();
            break;

            case "J":
                return new SangunJ();
            break;
        }
    }
}

// esta classe não faz parte do padrão
// ela está aqui apenas para mostrar a injeção de dependencia da fabrica
class CriarCelular {

    public function fazerAlgo(AbstractFactoryMethod $obj, $ds_param)
    {
        $objCelular = $obj->makeSmartPhone($ds_param);
        // o make pode ser utilizado
        var_dump($objCelular);
        writeln('');
    }
}

// nao faz parte do padrao
class LgL7{}; class LgL9{}; class LgVoit{};
class SansungNote{}; class SangungTab{}; class SangunJ{};

writeln('INICIANDO O TESTE:');
writeln('');

$objLGFactoryMethod = new LGFactoryMethod();
$objSansungFactoryMethod = new SansungFactoryMethod();

$objCriarCelular = new CriarCelular();

$objCriarCelular->fazerAlgo($objLGFactoryMethod, 'l7');
$objCriarCelular->fazerAlgo($objLGFactoryMethod, 'l9');
$objCriarCelular->fazerAlgo($objLGFactoryMethod, 'lVoit');

writeln('Outra familia:');
writeln('');

$objCriarCelular->fazerAlgo($objSansungFactoryMethod, 'note');
$objCriarCelular->fazerAlgo($objSansungFactoryMethod, 'tab');
$objCriarCelular->fazerAlgo($objSansungFactoryMethod, 'J');

writeln('Fim do Teste');

function writeln($line_in)
{
    echo $line_in . "<br/>";
}


/**
 * Intenção
 *
 * - Crar uma interface de criação de objetos, porém deixa que suas subclasses definam o que será instanciado.
 *
 * - Uma classe pai especifica todos os padrões de criação. E delega os detalhes de criação para as suas classes filhas.
 *
 * - Factory Method é similar ao Abstract Factory mais sem a enfase em familias de objetos.
 *
 * - Os clientes estão desacoplados dos detalhes de criação das classes derivadas. Desta forma temos criação de objetos com polimorfismo.
 */
?>
</body>
</html>

