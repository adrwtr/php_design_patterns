<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?
/**
 * Neste padrão temos uma classe com os dados
 * e outra classe que inicializa estes dados e executa metodos sobre eles,
 * sem altera-los na classe base
 */

// private class com os dados
class CircleData {

    var $radius;
    var $color;

    public function __construct($radius, $color)
    {
        $this->radius = $radius;
        $this->color = $color;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function getColor()
    {
        return $this->color;
    }
 }

// esta classe vai usar a private class
class Circle {

    private $objCircleData;

    public function __construct($radius, $color)
    {
        $this->objCircleData = new CircleData(
            $radius,
            $color
        );
    }

    // realiza as operações sobre a classe privata
    // porem a implementação está aqui
    public function Circumference()
    {
        return $this->objCircleData->getRadius() * 3.14;
    }

    // realiza as operações sobre a classe privata
    // porem a implementação está aqui
    public function Diameter()
    {
        return $this->objCircleData->getRadius() * 2;
    }

}

$objCirculo = new Circle(10, '#FF0000');

echo "Diametro " . $objCirculo->Diameter();
echo "<BR>";
echo "Circunferencia " . $objCirculo->Circumference();


/**
 * Controla o acesso de escrita a dados de uma classe
 *
 * separa os dados de uma classe, de metodos que trabalham com estes dados
 *
 * Encapsula inicialização de dados
 *
 *
 */

?>
</body>
</html>

