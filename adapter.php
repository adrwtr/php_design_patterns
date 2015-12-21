<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
/**
 * Imagine que nao pode alterar a classe simplebook.
 * Mais a aplicação final precisa usar o método getAuthorAndTitle
 *
 * Então é criado um BookAdapter para conter o metodo necessário.
 */


class SimpleBook
{

    private $author;
    private $title;

    function __construct($author_in, $title_in)
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
}

class BookAdapter
{
    private $book;

    function __construct(SimpleBook $book_in)
    {
        $this->book = $book_in;
    }

    function getAuthorAndTitle()
    {
        return $this->book->getTitle() . ' de ' . $this->book->getAuthor();
    }
}

// client

writeln('INICIANDO O TESTE:');
writeln('');

$book = new SimpleBook("THE BLACK BOOK", "Adriano Waltrick");
$bookAdapter = new BookAdapter($book);

writeln('Autor de Título: ' . $bookAdapter->getAuthorAndTitle());
writeln('');

writeln('Fim do TEste');

function writeln($line_in)
{
    echo $line_in . "<br/>";
}
?>
</body>
</html>