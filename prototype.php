<?
/**
 * Usado para criar clone de classes
 */

// em java ja existe, é usada com implements
class clonar
{

    function clonagem()
    {

    }
}

// nao faz parte do padrao
// mais deve implementar clone em suas subclasses
class carro
{

    var $marca;
    var $objClone;
    var $nome;

    function setMarca($v)
    {
        $this->marca = $v;
    }

    function getMarca()
    {
        return $this->marca;
    }

    function setObjClone($v)
    {
        $this->objClone = $v;
    }

    function getObjClone()
    {
        return $this->objClone;
    }

    function getNome()
    {
        return $this->nome;
    }

    // metodo importante do pattern prototype
    function &clonagem(&$obj)
    {
        return $this->objClone->clonagem($obj);
    }

}

// nao faz parte do padrao
class carroGol extends carro
{

    var $peca_barata;

    function carroGol()
    {
        $this->peca_barata = true;
        $this->setMarca('volkswagen');
        $this->setObjClone(new clonarGol());
        $this->setNome();
    }

    function setNome()
    {
        $this->nome = 'Gol';
    }

    function mostrar()
    {
        echo "Marca: " . $this->getMarca() . '<BR>';
        echo "Nome: " . $this->getNome() . '<BR>';
        echo "Peca Barata" . '<BR>';
        var_dump($this);
        echo "<HR>";
    }
}

// para clonar o gol
class clonarGol extends clonar
{

    function &clonagem(&$obj)
    {
        parent::clonagem();

        $objClone = new carroGol();
        $objClone->peca_barata = $obj->perca_barata;
        $objClone->nome = $obj->getNome();
        $objClone->setMarca($obj->getMarca());

        return $objClone;
    }
}

// nao faz parte do padrao
class carroFiesta extends carro
{

    var $peca_cara;
    var $conforto;

    function carroFiesta()
    {
        $this->peca_cara = true;
        $this->conforto = true;
        $this->setMarca('Ford');
        $this->setObjClone(new clonarFiesta());
        $this->setNome();
    }

    function setNome()
    {
        $this->nome = 'Fiesta';
    }

    function mostrar()
    {
        echo "Marca: " . $this->getMarca() . '<BR>';
        echo "Nome: " . $this->getNome() . '<BR>';
        echo "Peca Cara" . '<BR>';
        echo "Confortavel" . '<BR>';
        var_dump($this);
        echo "<HR>";
    }
}

// para clonar o Fiesta
class clonarFiesta extends clonar
{

    function &clonagem(&$obj)
    {
        parent::clonagem();

        $objClone = new carroFiesta();
        $objClone->peca_barata = $obj->perca_barata;
        $objClone->nome = $obj->getNome();
        $objClone->setMarca($obj->getMarca());
        $objClone->conforto = $obj->conforto;

        return $objClone;
    }
}

// padr?o
class prototype
{

    var $objPrototipo;

    // recebe obj carro que deve ser um objeto abstrato
    function setPrototipo(&$objCarro)
    {
        $this->objPrototipo =& $objCarro;
    }

    // retorna um novo objeto clonado do mesmo tipo do objeto de prototipo
    function criaCarroClone()
    {
        return $this->objPrototipo->clonagem($this->objPrototipo);
    }
}

// execuçao
$objCarro = new carroFiesta();
$objCarro->mostrar();

$objPrototype = new prototype();
$objPrototype->setPrototipo($objCarro);
// cria clone
$objNovoFiesta =& $objPrototype->criaCarroClone();
$objNovoFiesta->mostrar();

$objCarro = new carroGol();
$objPrototype->setPrototipo($objCarro);
// cria clone
$objNovo =& $objPrototype->criaCarroClone();
$objNovo->mostrar();
?>