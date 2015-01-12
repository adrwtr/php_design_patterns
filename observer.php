<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
/**
 * Imagine que uma classe (classe Obx) precisa executar um comando
 * sempre que outra classe (classe Y) for atualizada. Essa classe que precisa executar um comando (classe Obx)
 * vai observar a outra classe (a classe y) quando a classe (y) for atualizada. A classe y avisa que foi atualizada.
 */

// classes
// essa classe abstrada apenas cria a função update
// nos iremos chamar essa função de atualizarObservador para facilitar o entendimento
abstract class AbstractObserver {
    abstract function update(AbstractAcaoASerObservado $objASerObservado);
    abstract function atualizaObservador(AbstractAcaoASerObservado $objASerObservado);
}

// classe abstrada para os objetos que podem ser observados.
// Esses objetos preciam registrar a classe que vai observar em uma lista.. podendo ter várias
// e também, toda vez que ela executar a ação dela, vai notificar a classe observadora através do notify
abstract class AbstractAcaoASerObservado {
    abstract function attach(AbstractObserver $observador);
    abstract function detach(AbstractObserver $observador);
    abstract function notify();
}

class PatternObserver extends AbstractObserver {
    
    public function __construct() {
    }

    public function update(AbstractAcaoASerObservado $objASerObservado) {
        writeln('Uma ação foi executada:');
        writeln($objASerObservado->getNomeAcaoExecutada());     
        writeln('-------');
    }

    // esta é uma copia do update.. apenas para entendimento geral do padrao
    public function atualizaObservador(AbstractAcaoASerObservado $objASerObservado) {
        $this->update($objASerObservado);
    }
}

class PatternSubject extends AbstractAcaoASerObservado {

    private $favoritePatterns = NULL;
    private $observers = array();

    // usada apenas para exemplo
    private $minhaACAO;

    function __construct() {
        $this->minhaACAO = '';
    }
    
    function attach(AbstractObserver $observer_in) {
        //could also use array_push($this->observers, $observer_in);
        $this->observers[] = $observer_in;
    }

    function detach(AbstractObserver $observer_in) {

        foreach($this->observers as $okey => $oval) {
        if ($oval == $observer_in) { 
            unset($this->observers[$okey]);
        }
      }

    }

    // aqui está a magica 1
    public function notify() {
        foreach($this->observers as $objAbstractObserver) {
            $objAbstractObserver->atualizaObservador($this);
        }
    }

    // toda vez que uma ação for executada, notifica a classe observadora
    // magica 2
    public function acao1() {
        writeln('executao a acao 1');
        $this->minhaACAO = 'acao1';
        $this->notify();
    }

    // toda vez que uma ação for executada, notifica a classe observadora
    // magica 2
    public function acao2() {
        writeln('executao a acao 2');
        $this->minhaACAO = 'acao2';
        $this->notify();
    }

    public function getNomeAcaoExecutada()
    {
        return $this->minhaACAO;
    }    
}



// client

writeln('INICIANDO O TESTE:');
writeln('');


$objObservador = new PatternObserver();


$objExecutor = new PatternSubject();
$objExecutor->attach($objObservador);
$objExecutor->acao1();
$objExecutor->acao2();
$objExecutor->acao1();


$objExecutor->detach($objObservador);
$objExecutor->acao1();


writeln('Fim do TEste');

function writeln($line_in)
{
    echo $line_in . "<br/>";
}

?>
</body>
</html>