<?
/**
Como usar:
Criar as classes Flyweight, que implementam IFlyweight;
Criar uma class FlyweightFactory, que possui uma coleção de IFlyweight;
Implementar as operações (Operation);
Criar um construtor que inicialize a coleção de IFlyweight.
 */

interface ISanduiche
{
    public function getPreco();
}

abstract class Sanduiche implements ISanduiche
{
    var $nome;
    var $preco;

    public function getPreco()
    {
        return 0;
    }

    public function toString()
    {
        return "Tipo: " . $this->nome . " - valor: " . $this->preco;
    }
}


class Hamburger extends Sanduiche
{
    public function __construct()
    {
        $this->nome = "Hamburger";
        $this->preco = 4;
    }

    public function getPreco()
    {
        return $this->preco;
    }
}

class PaoComMortadela extends Sanduiche
{
    public function __construct()
    {
        $this->nome = "PaoComMortadela";
        $this->preco = 1;
    }

    public function getPreco()
    {
        return $this->preco;
    }
}

class Misto extends Sanduiche
{
    public function __construct()
    {
        $this->nome = "Misto";
        $this->preco = 2;
    }

    public function getPreco()
    {
        return $this->preco;
    }
}


/**
 * Fabrica
 */
//FlyweightFactory
class SanduichesFactory
{
    var $arrSanduiches;

    // mágica
    // os objetos estão précriados, ou são acriados apenas uma única vez.
    public function __construct()
    {
        $this->clear();
        $this->add(1, new Hamburger());
        $this->add(2, new PaoComMortadela());
        $this->add(3, new Misto());
        $this->add(4, new Misto());
    }

    public function clear()
    {
        unset($this->arrSanduiches);
        $this->arrSanduiches = array();
    }

    public function add($id, $valor)
    {
        $this->arrSanduiches[ $id ] = $valor;
    }

    function getSanduiche($key)
    {
        if ($this->arrSanduiches[ $key ] != null) {
            return $this->arrSanduiches[ $key ];
        }
    }
}


writeln('INICIANDO TESTE');
writeln('');


$objListaFly = new SanduichesFactory();

writeln("Pedido: " . $objListaFly->getSanduiche(4)->toString());
writeln("Pedido: " . $objListaFly->getSanduiche(3)->toString());

writeln("Pedido: " . $objListaFly->getSanduiche(2)->toString());

// varios pedidos de 1 // mágica
writeln("Pedido: " . $objListaFly->getSanduiche(1)->toString());
writeln("Pedido: " . $objListaFly->getSanduiche(1)->toString());
writeln("Pedido: " . $objListaFly->getSanduiche(1)->toString());
writeln("Pedido: " . $objListaFly->getSanduiche(1)->toString());


function writeln($line_in)
{
    echo $line_in . "<BR>";
}