<?php
/**
 * Este padrao vai melhorando as caracteristicas de um objeto
 */

/**
 * Classe que representa um livro
 */
class Book
{

    private $author;
    private $title;

    function __construct($title_in, $author_in)
    {
        $this->author = $author_in;
        $this->title = $title_in;
    }

    function getAuthor()
    {
        return $this->author;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getAuthorAndTitle()
    {
        return $this->getTitle() . ' de ' . $this->getAuthor();
    }
}

/**
 * Padrao decorator.
 * Esta classe tem as funcoes essenciais do decorador de livros
 */
class BookTitleDecorator
{
    protected $book;
    protected $title;

    public function __construct(Book $book_in)
    {
        $this->book = $book_in;
        $this->resetTitle();
    }

    //doing this so original object is not altered
    function resetTitle()
    {
        $this->title = $this->book->getTitle();
    }

    function showTitle()
    {
        return $this->title;
    }
}

/**
 * Padrao decorator.
 * Este decora o titulo de um livro
 */
class BookTitleExclaimDecorator extends BookTitleDecorator
{
    private $btd;

    public function __construct(BookTitleDecorator $btd_in)
    {
        $this->btd = $btd_in;
    }

    function exclaimTitle()
    {
        $this->btd->title = "!" . $this->btd->title . "!";
    }
}

/**
 * Padrao decorator.
 * Este decora o titulo de um livro
 */
class BookTitleStarDecorator extends BookTitleDecorator
{
    private $btd;

    public function __construct(BookTitleDecorator $btd_in)
    {
        $this->btd = $btd_in;
    }

    function starTitle()
    {
        $this->btd->title = Str_replace(" ", "*", $this->btd->title);
    }
}

writeln('BEGIN TESTING DECORATOR PATTERN');
writeln('');

$meu_livro = new Book('THE BLACK BOOK', 'Adriano Waltrick');

$decorator = new BookTitleDecorator($meu_livro);
$starDecorator = new BookTitleStarDecorator($decorator);
$exclaimDecorator = new BookTitleExclaimDecorator($decorator);

writeln('Titulo Original do Livro : ');
writeln($decorator->showTitle());
writeln('');

writeln('Titulo Alterado pelo decorador 1 : ');
$exclaimDecorator->exclaimTitle();
$exclaimDecorator->exclaimTitle();
writeln($decorator->showTitle());
writeln('');

writeln('Titulo Alterado pelo decorador 2 : ');
$starDecorator->starTitle();
writeln($decorator->showTitle());
writeln('');

writeln('Titulo ao normal novamente: ');
writeln($decorator->resetTitle());
writeln($decorator->showTitle());
writeln('');

writeln('END TESTING DECORATOR PATTERN');

function writeln($line_in)
{
    echo $line_in . "<br/>";
}

?>