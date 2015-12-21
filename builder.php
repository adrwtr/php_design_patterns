<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
/**
 * Neste padrão nós especificamos um objeto com vários atributos - HTMLPage
 * Este objeto será criado por nossa classe Builder - HTMLPageBuilder
 *
 * Porém uma outra classe irá fazer o uso do Builder para inicializar os atributos - HTMLPageDirector
 *
 * Observe que HTMLPageBuilder pode ser reescrito - HTMLPadraoPageBuilder
 */

abstract class AbstractPageBuilder {
    abstract function getPage();
}

abstract class AbstractPageDirector {
    abstract function __construct(AbstractPageBuilder $builder_in);
    abstract function buildPage();
    abstract function getPage();
}

// objeto que será criado e construido pelo Builder
// esta classe nao faz parte do padrao
class HTMLPage {

    private $page = NULL;
    private $page_title = NULL;
    private $page_heading = NULL;
    private $page_text = NULL;

    function __construct() {
    }

    function showPage() {
      return $this->page;
    }

    function setTitle($title_in) {
      $this->page_title = $title_in;
    }

    function setHeading($heading_in) {
      $this->page_heading = $heading_in;
    }

    function setText($text_in) {
      $this->page_text .= $text_in;
    }

    function formatPage() {
       $this->page  = '<html>';
       $this->page .= '<head><title>'.$this->page_title.'</title></head>';
       $this->page .= '<body>';
       $this->page .= '<h1>'.$this->page_heading.'</h1>';
       $this->page .= $this->page_text;
       $this->page .= '</body>';
       $this->page .= '</html>';
    }
}


// objeto que será criado e construido pelo Builder
// esta classe nao faz parte do padrao
class XMLPage {

    private $page = NULL;
    private $page_title = NULL;
    private $page_heading = NULL;
    private $page_text = NULL;

    function __construct() {
    }

    function showPage() {
      return $this->page;
    }

    function setTitle($title_in) {
      $this->page_title = $title_in;
    }

    function setHeading($heading_in) {
      $this->page_heading = $heading_in;
    }

    function setText($text_in) {
      $this->page_text .= $text_in;
    }

    function formatPage() {
       $this->page  = '<xml>';
       $this->page .= '<head><title title="'. $this->page_title .'"></title></head>';
       $this->page .= '<body>';
       $this->page .= '<head>' . $this->page_heading.'</head>';
       $this->page .= '<corpo>';
       $this->page .= $this->page_text;
       $this->page .= '</corpo>';
       $this->page .= '</body>';
       $this->page .= '</html>';
    }
}

// Padrão - Builder
class HTMLPageBuilder extends AbstractPageBuilder {

    private $page = NULL;

    // cria o objeto
    function __construct() {
      $this->page = new HTMLPage();
    }

    // funções de construção do objeto

    function setTitle($title_in) {
      $this->page->setTitle($title_in);
    }

    function setHeading($heading_in) {
      $this->page->setHeading($heading_in);
    }

    function setText($text_in) {
      $this->page->setText($text_in);
    }

    function formatPage() {
      $this->page->formatPage();
    }

    function getPage() {
      return $this->page;
    }
}

// Padrão - Builder - 2 para exemplo
class HTMLPadraoPageBuilder extends AbstractPageBuilder {

    private $page = NULL;

    // cria o objeto
    function __construct() {
      $this->page = new XMLPage();
    }

    // funções de construção do objeto

    function setTitle($title_in) {
      $this->page->setTitle("Minha alteração: " . $title_in);
    }

    function setHeading($heading_in) {
      $this->page->setHeading("Minha alteração: " . $heading_in);
    }

    function setText($text_in) {
      $this->page->setText("Minha alteração: " . $text_in);
    }

    function formatPage() {
      $this->page->formatPage();
    }

    function getPage() {
      return $this->page;
    }
}

// Padrão - Builder especializado
class HTMLPageDirector extends AbstractPageDirector {

    private $builder = NULL;

    public function __construct(
        AbstractPageBuilder $builder_in
    ) {
         $this->builder = $builder_in;
    }

    public function buildPage() {
      $this->builder->setTitle('Testing the HTMLPage');
      $this->builder->setHeading('Testing the HTMLPage');
      $this->builder->setText('Testing, testing, testing!');
      $this->builder->setText('Testing, testing, testing, or!');
      $this->builder->setText('Testing, testing, testing, more!');
      $this->builder->formatPage();
    }

    public function getPage() {
      return $this->builder->getPage();
    }
}


// Padrão - Builder especializado
class HTMLPageFuncionario extends AbstractPageDirector {

    private $builder = NULL;

    public function __construct(
        AbstractPageBuilder $builder_in
    ) {
         $this->builder = $builder_in;
    }

    public function buildPage() {
      $this->builder->setTitle('Funcionar');
      $this->builder->setHeading('Funcionar');
      $this->builder->setText('Funcionar');
      $this->builder->setText('Funcionar');
      $this->builder->setText('Funcionar');
      $this->builder->formatPage();
    }

    public function getPage() {
      return $this->builder->getPage();
    }
}

  writeln('INICIA TESTE....:');
  writeln('');

  writeln('teste 1....:');

  // builder html e representação diretor
  $pageBuilder = new HTMLPageBuilder();
  $pageDirector = new HTMLPageDirector($pageBuilder);
  $pageDirector->buildPage();
  $page = $pageDirector->GetPage();
  writeln($page->showPage());
  writeln('');
  writeln('');
  writeln('');

  // builder html e representação funcionario
  $pageBuilder = new HTMLPageBuilder();
  $pageDirector = new HTMLPageFuncionario($pageBuilder);
  $pageDirector->buildPage();
  $page = $pageDirector->GetPage();
  writeln($page->showPage());
  writeln('');
  writeln('');
  writeln('');


  // builder XML e representação diretor
  // - poderia ter sido usado funcionario ou outra representação
  $pageBuilder = new HTMLPadraoPageBuilder();
  $pageDirector = new HTMLPageDirector($pageBuilder);
  $pageDirector->buildPage();
  $page = $pageDirector->GetPage();
  writeln($page->showPage());


  writeln('Fim do teste');

  function writeln($line_in) {
    echo $line_in."<br/>";
  }

/**
 * Intenção
 *
 * 1 - Separar a construção de um objeto complexo da construção de sua representação.
 * Ou seja, estamos separando a construção do objeto HTMLPage de sua representação final HTMLPageDirector.
 *
 * 2 - Desta forma podemos usar o objeto HTMLPageBuilder para construir vários tipos de representação
 * (HTMLPageDirector, HTMLPageFuncionário, etc)
 *
 * 3 - Quando usar: quando a aplicação precisa criar elementos de uma classe complicada (HTMLPage).
 * A especificação (HTMLPageBuilder) da classe complicada fica em um lugar separado de sua representação
 * (HTMLPageDirector, HTMLPageFuncionário, etc);
 */

?>
</body>
</html>