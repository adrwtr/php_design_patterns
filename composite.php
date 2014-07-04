<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?
/**
 * Ao ler sobre o composite lembre-se do diagrama da UML
 * Nada mais é do que uma classe pai que pode ter várias classes filhas.
 * Essa classe pai precisa ter acessos tipo, add, get, remove e display para seus filhos.
 */
abstract class AbstractPrateleira
{
    abstract function getBookInfo($previousBook);

    abstract function getBookCount();

    abstract function setBookCount($new_count);

    abstract function addBook($oneBook);

    abstract function removeBook($oneBook);
}


class OneBook extends AbstractPrateleira
{

    private $title;
    private $author;

    function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * Retorna as informações de um livro
     */
    function getBookInfo($bookToGet)
    {
        if (1 == $bookToGet) {
            return "Título: " . $this->title . " - Autor: " . $this->author;
        } else {
            return FALSE;
        }
    }

    function getBookCount()
    {
        return 1;
    }

    function setBookCount($newCount)
    {
        return FALSE;
    }

    function addBook($oneBook)
    {
        return FALSE;
    }

    function removeBook($oneBook)
    {
        return FALSE;
    }
}

class PrateleiraDeLivros extends AbstractPrateleira
{

    private $oneBooks = array();
    private $bookCount;

    public function __construct()
    {
        $this->setBookCount(0);
    }

    public function getBookCount()
    {
        return $this->bookCount;
    }

    public function setBookCount($newCount)
    {
        $this->bookCount = $newCount;
    }

    public function getBookInfo($bookToGet)
    {
        if ($bookToGet <= $this->bookCount) {
            return $this->oneBooks[ $bookToGet ]->getBookInfo(1);
        } else {
            return FALSE;
        }
    }

    public function addBook($oneBook)
    {
        $this->setBookCount($this->getBookCount() + 1);
        $this->oneBooks[ $this->getBookCount() ] = $oneBook;
        return $this->getBookCount();
    }

    public function removeBook($oneBook)
    {
        $counter = 0;

        while (++$counter <= $this->getBookCount()) {
            if ($oneBook->getBookInfo(1) ==
                $this->oneBooks[ $counter ]->getBookInfo(1)
            ) {
                for ($x = $counter; $x < $this->getBookCount(); $x++) {
                    $this->oneBooks[ $x ] = $this->oneBooks[ $x + 1 ];
                }
                $this->setBookCount($this->getBookCount() - 1);
            }
        }
        return $this->getBookCount();
    }
}

writeln("INICIO DO TESTE");
writeln('');

$firstBook = new OneBook('The Black BOOK', 'Adriano Waltrick');
writeln('(after creating first book) oneBook info: ');
writeln($firstBook->getBookInfo(1));
writeln('');

$secondBook = new OneBook('PHP Bible', 'Converse and Park');
writeln('(after creating second book) oneBook info: ');
writeln($secondBook->getBookInfo(1));
writeln('');

$thirdBook = new OneBook('Design Patterns', 'Nome Autor');
writeln('(after creating third book) oneBook info: ');
writeln($thirdBook->getBookInfo(1));
writeln('');

$books = new PrateleiraDeLivros();

$booksCount = $books->addBook($firstBook);
writeln('(after adding firstBook to books) PrateleiraDeLivros info : ');
writeln($books->getBookInfo($booksCount));
writeln('');

$booksCount = $books->addBook($secondBook);
writeln('(after adding secondBook to books) PrateleiraDeLivros info : ');
writeln($books->getBookInfo($booksCount));
writeln('');

$booksCount = $books->addBook($thirdBook);
writeln('(after adding thirdBook to books) PrateleiraDeLivros info : ');
writeln($books->getBookInfo($booksCount));
writeln('');

$booksCount = $books->removeBook($firstBook);
writeln('(after removing firstBook from books) PrateleiraDeLivros count : ');
writeln($books->getBookCount());
writeln('');

writeln('(after removing firstBook from books) PrateleiraDeLivros info 1 : ');
writeln($books->getBookInfo(1));
writeln('');

writeln('(after removing firstBook from books) PrateleiraDeLivros info 2 : ');
writeln($books->getBookInfo(2));
writeln('');

writeln('END TESTING COMPOSITE PATTERN');

function writeln($line_in)
{
    echo $line_in . "<br/>";
}

?>
</body>
</html>