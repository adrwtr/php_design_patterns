<?
/**
 * Este padrao cria uma cadeia de ponteiros,
 * aonde a classe A aponta para a classe B, que aponta para C
 *
 * Um valor é passado para a classe A, e caso ela nao consiga processar,
 * ela envia para a B processar, que caso nao consiga, envia para a C
 * criando a cadeida de responsabilidade
 */


// classe a ser tratada com a chain
class Number
{

    var $valor;

    function Number()
    {
        $this->setValor(0);
    }

    function setValor($v)
    {
        $this->valor = $v;
    }

    function getValor()
    {
        return $this->valor;
    }
}

// base da chain, que vai tratar os numeros
// seria uma classe abstrata
class ChainResponsability_number
{

    var $objChainNumber_sucessor;
    var $_name;

    function ChainResponsability_number()
    {
        $this->_name = 'ChainResponsability_number';
        // $this->setSucessor(null);
    }

    function setSucessor(&$obj)
    {
        $this->objChainNumber_sucessor =& $obj;
    }

    function &getSucessor()
    {
        return $this->objChainNumber_sucessor;
    }

    function processa($objNumber)
    {
        return $this->proximo($objNumber);
    }

    function proximo($objNumber)
    {
        echo 'Estou em: ' . $this->_name . "<BR>";

        if ($this->objChainNumber_sucessor != null) {
            echo $this->objChainNumber_sucessor->_name . "<br>";
            return $this->objChainNumber_sucessor->processa($objNumber);
        } else {
            echo "Terminou! Nenhum processador na cadeia";
            return 0;
        }
    }
}

// cadeia 1, processa o numero se ele for < 10
class ChainNumber10 extends ChainResponsability_number
{

    function ChainNumber10()
    {
        $this->_name = 'ChainNumber10';
    }

    function processa($objNumber)
    {
        if ($objNumber->getValor() < 10) {
            echo $objNumber->getValor() . ' processado em ChainNumber10';
            return 1;
        } else {
            return $this->proximo($objNumber);
        }
    }
}

// cadeia 2, processa o numero se ele for > 10 e < 100
class ChainNumber100 extends ChainResponsability_number
{

    function ChainNumber100()
    {
        $this->_name = 'ChainNumber100';
    }

    function processa($objNumber)
    {
        if ($objNumber->getValor() > 10 && $objNumber->getValor() < 100) {
            echo $objNumber->getValor() . ' processado em ChainNumber100';
            return 1;
        } else {
            return $this->proximo($objNumber);
        }
    }
}


// cadeia 3, processa o numero se ele for > 100 e < 1000
class ChainNumberMax extends ChainResponsability_number
{

    function ChainNumberMax()
    {
        $this->_name = 'ChainNumberMax';
    }

    function processa($objNumber)
    {
        if ($objNumber->getValor() > 100 && $objNumber->getValor() < 1000) {
            echo $objNumber->getValor() . ' processado em ChainNumber100';
            return 1;
        } else {
            return $this->proximo($objNumber);
        }
    }
}

// aplica??o
$objInicial = new ChainResponsability_number();
$obj10 = new ChainNumber10();
$obj100 = new ChainNumber100();
$objMax = new ChainNumberMax();

$objInicial->setSucessor($obj10);
$obj10->setSucessor($obj100);
$obj100->setSucessor($objMax);

// ou, se nao enviar por referencia.. usar
// $obj100->setSucessor( $objMax );
// $obj10->setSucessor( $obj100 );
// $objInicial->setSucessor( $obj10 );


$objNumber = new Number();

$objNumber->setValor(5);
$objInicial->processa($objNumber);
echo "<hr>";
$objNumber->setValor(15);
$objInicial->processa($objNumber);
echo "<hr>";
$objNumber->setValor(115);
$objInicial->processa($objNumber);
echo "<hr>";
$objNumber->setValor(22225);
$objInicial->processa($objNumber);
?>