<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?
/**
 * O padrao bridge separa a abstração da implementação,
 * aonde pode-se ter uma interface aonde a implementação está muito variada.
 * Ele desacopla abstração
 *
 * A magica está em produz e em realiza.
 * Realiza é a implementação desacoplada
 * E Produz é a chamada para um implementação
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
    // pode ser qualquer coisa, e está desacoplada
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
?>
</body>
</html>