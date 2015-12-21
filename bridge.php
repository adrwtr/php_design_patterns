<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?
/**
 * Imagine que você tem as classes Programador e Homologador(Qualidade)
 * Essas classes realizam trabalhos distintos. Programador programa e Homologador Testa.
 *
 * O nosso sistema irá usar a função produz para as duas classes acima.
 *
 * O padrão Bridge vai separar o que Programador faz com o que Homologador faz através de uma
 * segunda interface chamada Tarefa.
 *
 * Os dois funcionários irão produzir Tarefas, e a tarefa terá a implementação variada para cada produtor.
 *
 * Desta forma, se precisarmos criar um CHEFE, ou um Designer, será fácil pois a implementação estará desacoplada.
 *
 * A magica está em produz e em realiza.
 * Realiza é a implementação desacoplada
 * E Produz é a chamada para um implementação de realiza
 */

interface Colaborador
{
    public function produz();

    public function recebeTarefa(Tarefa $tarefa);
}

class Programador implements Colaborador
{

    private $tarefa;

    public function Programador(Tarefa $tarefa)
    {
        $this->tarefa = $tarefa;
    }

    // aqui está a magica.. o que é tarefa?
    // pode ser qualquer coisa, e está desacoplada (bridge)
    public function produz()
    {
        echo "\nProgramador trabalhando <BR><BR>";
        $this->tarefa->realiza();
    }

    public function recebeTarefa(Tarefa $tarefa)
    {
        $this->tarefa = $tarefa;
    }

}


class Homologador implements Colaborador
{

    var $tarefa;

    public function Homologador(Tarefa $tarefa)
    {
        $this->tarefa = $tarefa;
    }

    public function produz()
    {
        echo "\nHomologador trabalhando  <BR><BR>";
        $this->tarefa->realiza();
    }

    public function recebeTarefa(Tarefa $tarefa)
    {
        $this->tarefa = $tarefa;
    }

}

// bridge
interface Tarefa
{
    public function realiza();
}


class ProgramacaoJava implements Tarefa
{
    public function realiza()
    {
        echo "cria muitas linhas de código Java <BR><BR>";
    }
}

class ProgramacaoRuby implements Tarefa
{
    public function realiza()
    {
        echo "cria muitas linhas de código Ruby <BR><BR>";
    }
}

class TestesAutomatizados implements Tarefa
{
    public function realiza()
    {
        echo "constrói testes automatizados <BR><BR>";
    }
}

class TestesManuais implements Tarefa
{
    public function realiza()
    {
        echo "constrói testes manuais <BR><BR>";
    }
}


// Eu gosto de programar em java, então eu posso criar um programador que executa a tarefa de programar em Java
$tarefaDoProgramador = new ProgramacaoJava();
$programador = new Programador($tarefaDoProgramador);
$programador->produz();

// Eu também gosto de Ruby então poderia desenvolver em Ruby!
$tarefaDoProgramador = new ProgramacaoRuby();
$programador->recebeTarefa($tarefaDoProgramador);
$programador->produz();

// Mas se a situação aperta e me pedem testes automatizados, não tem problema eu posso fazer também!
$tarefaDoProgramador = new TestesAutomatizados();
$programador->recebeTarefa($tarefaDoProgramador);
$programador->produz();

// No caso do colaborador, temos o mesmo, ele faz testes manuais
$tarefaDoHomologador = new TestesManuais();
$homologador = new Homologador($tarefaDoHomologador);
$homologador->produz();

// Mas se a situação aperta ele pode programar até em Ruby!
$tarefaDoHomologador = new ProgramacaoRuby();
$homologador->recebeTarefa($tarefaDoHomologador);
$homologador->produz();


/**
 *  Use este padrão quando:
 *
 *  você precisa altera a implementação em tempo de execução
 *  você tem muitas classes de uma mesma interface, e muitas implementações
 *  você precisa distribuir uma implementação para muitos objetos
 *
 * - Uma ponte entre: O que o cliente precisa(tarefa) e o que a plataforma precisa(produz).
 */

?>
</body>
</html>