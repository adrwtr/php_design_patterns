<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
/**
 * Este padrão é bem simples.
 *
 * 1 - Você cria uma classe abstrata que irá definir uma função abstrata de criação de um objeto.
 * Esta é a classe abstract factory
 *
 * 2 - Então você cria as fabricas concretas, que vão concretizar o metodo abstrato, criando um objeto
 * especifico, conforme cada classe de fabrica concreta
 *
 *
 * O exemplo está usando componentes de form, isso é apenas um exemplo e não necessariamente deve ser levado ao mundo real.
 */

// abstract fatory
abstract class AbstractFactoryComponente {
    abstract function makeComponent();
}

class FactoryComponenteText extends AbstractFactoryComponente {
    public function makeComponent()
    {
        // aqui pode ser usado return new objeto();
        return '<input type="text" name="teste" />';
    }
}

class FactoryComponenteButton extends AbstractFactoryComponente {
    public function makeComponent()
    {
        // aqui pode ser usado return new objeto();
        return '<input type="button" name="botao" value="clique aqui" />';
    }
}


// esta classe não faz parte do padrão
// ela está aqui apenas para mostrar a injeção de dependencia da fabrica
class UtilizadoraDeComponente {

    public function fazerAlgo(AbstractFactoryComponente $obj)
    {
        // o make pode ser utilizado
        writeln($obj->makeComponent());
    }
}

writeln('INICIANDO O TESTE:');
writeln('');

$objFactoryText = new FactoryComponenteText();
$objFactoryButton = new FactoryComponenteButton();

$objUtilizar = new UtilizadoraDeComponente();

$objUtilizar->fazerAlgo($objFactoryText);
$objUtilizar->fazerAlgo($objFactoryButton);

writeln('Fim do Teste');

function writeln($line_in)
{
    echo $line_in . "<br/>";
}

?>


<BR /><BR />
<BR /><BR />
<BR /><BR />
Intenção  <BR /><BR />

- Criar uma interface que irá facilitar a criação de familias de objetos relacionados. Essa interface pode ser usada para injetar dependencia sem usar as classes contretas.  <BR /><BR />

- Criar uma hierarquia que encapsula: muitas possibilidades (no exemplo, criar mais de um metodo em AbstractFactoryComponente)  <BR /><BR />

- Usar o operador new nas classes é considerado perigoso.  <BR /><BR />

- Cliente nunca criam objetos diretamente, eles sempre pedem para as fabricas fazerem isso para eles. (na fabrica tem um return new objeto())

- A criação da familias está na correta definição das classes abstratas, que serão injetadas em funções.

</body>
</html>