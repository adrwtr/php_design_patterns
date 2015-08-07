<?php
/**
 * Exemplo de motor
 * incorreto
 */
class MotorErrado {
   private $potencia;

   public function __construct($p)
   {
      $this->potencia = $p;
   }

   public function getPotencia()
   {
      return $this->potencia;
   }

   public function getTurbo()
   {
      return $this->potencia * 2;
   }
}

/**
 * Exemplo de carro que utiliza um motor
 * incorreto
 */
class CarroErrado {

   private $objMotor;
   private $valor_do_turbo;

   /**
    * Aqui � construido o carro
    * e � usado o new do Motor dentro do carro.
    * OU seja, neste momento a classe CARRO depende da classe motor
    * o que est� errado.
    */
   function construirCarro() {
      $objMotor = new MotorErrado();
      $this->valor_do_turbo = $objMotor->getTurbo();
   }

   function andar() {
      return $this->valor_do_turbo + 10;
   }
}


/**
 * Exemplo correto
 */

/**
 * criamos uma interface para o metodo
 * que ser� utilizado em todos os motores
 */
interface InterfaceMotor {
   public function getTurbo();
}

/**
 * Motor simples que implementa a interface
 */
class Motor implements InterfaceMotor {

   private $potencia;

   public function __construct($p)
   {
      $this->potencia = $p;
   }

   public function getPotencia()
   {
      return $this->potencia;
   }

   // unica fun��o que ser� diferente entre os motores
   public function getTurbo()
   {
      return $this->potencia * 2;
   }
}

/**
 * Motor simples que implementa a interface
 */
class MotorFerrari  implements InterfaceMotor {

   private $potencia;

   public function __construct($p)
   {
      $this->potencia = $p;
   }

   public function getPotencia()
   {
      return $this->potencia;
   }

   // unica fun��o que ser� diferente entre os motores
   public function getTurbo()
   {
      return $this->potencia * 5;
   }
}

/**
 * CUIDADO este motor n�o implementa a interface
 * usar ele deve resolvar em erro
 */
class MotorRenault {

   private $potencia;

   public function __construct($p)
   {
      $this->potencia = $p;
   }

   public function getPotencia()
   {
      return $this->potencia;
   }

   public function getTurbo()
   {
      return $this->potencia * 2;
   }
}


/**
 * Classe carro correta
 */
class Carro {

   private $objMotor;
   private $valor_do_turbo;

   /**
    * INJECAO DE DEPENDENCIA
    */
   function construirCarro(InterfaceMotor $objMotor) {
      $this->valor_do_turbo = $objMotor->getTurbo();
   }

   // usando o valor do turbo
   function andar() {
      return $this->valor_do_turbo + 10;
   }
}

// cria��o dos motores
$objMotor = new Motor(5);
$objMotorFerari = new MotorFerrari(5);
$objMotorRenault = new MotorRenault(5);

// exemplo correto, n�o importa para o carro como o motor foi criado
// desde que o motor seja do tipo inferface motor (satisfa�a o contrato!!!)
$objCarro = new Carro();
$objCarro->construirCarro($objMotor);
echo $objCarro->andar();

echo "<HR>";

// exemplo correto, n�o importa para o carro como o motor foi criado
// desde que o motor seja do tipo inferface motor (satisfa�a o contrato!!!)
$objCarro = new Carro();
$objCarro->construirCarro($objMotorFerari);
echo $objCarro->andar();


// deve disparar uma exe��o do php
$objCarro = new Carro();
$objCarro->construirCarro($objMotorRenault);
echo $objCarro->andar();