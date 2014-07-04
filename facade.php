<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
/**
 * o padrão facade determina uma classe para realizar comandos de um subsistema.
 * ou seja, a sua classe facade vai se tornar um frontend para outras classes que seu cliente não precisa conhecer.
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
        return "Titulo: " . $this->getTitle() . ' - Autor: ' . $this->getAuthor();
    }
}

// magica está aqui, esta classe executa as 2 outras classes em sequencia:
// 
class CaseReverseFacade
{
    public static function reverseStringCase($stringIn)
    {
        $arrayFromString = ArrayStringFunctions::stringToArray($stringIn);
        $reversedCaseArray = ArrayCaseReverse::reverseCase($arrayFromString);
        $reversedCaseString = ArrayStringFunctions::arrayToString($reversedCaseArray);
        return $reversedCaseString;
    }
}

class ArrayCaseReverse
{
    private static $uppercase_array =
        array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z'
        );
    private static $lowercase_array =
        array(
            'a',
            'b',
            'c',
            'd',
            'e',
            'f',
            'g',
            'h',
            'i',
            'j',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'q',
            'r',
            's',
            't',
            'u',
            'v',
            'w',
            'x',
            'y',
            'z'
        );

    public static function reverseCase($arrayIn)
    {
        $array_out = array();
        for ($x = 0; $x < count($arrayIn); $x++) {
            if (in_array($arrayIn[ $x ], self::$uppercase_array)) {
                $key = array_search($arrayIn[ $x ], self::$uppercase_array);
                $array_out[ $x ] = self::$lowercase_array[ $key ];
            } elseif (in_array($arrayIn[ $x ], self::$lowercase_array)) {
                $key = array_search($arrayIn[ $x ], self::$lowercase_array);
                $array_out[ $x ] = self::$uppercase_array[ $key ];
            } else {
                $array_out[ $x ] = $arrayIn[ $x ];
            }
        }
        return $array_out;
    }
}

class ArrayStringFunctions
{
    public static function arrayToString($arrayIn)
    {
        $string_out = NULL;
        foreach ($arrayIn as $oneChar) {
            $string_out .= $oneChar;
        }
        return $string_out;
    }

    public static function stringToArray($stringIn)
    {
        return str_split($stringIn);
    }
}


writeln('INICIANDO TESTE');
writeln('');

$book = new Book('The Black BOOK', 'Adriano Waltrick');

writeln('Original book title: ' . $book->getTitle());
writeln('');

$bookTitleReversed = CaseReverseFacade::reverseStringCase($book->getTitle());

writeln('Reversed book title: ' . $bookTitleReversed);
writeln('');

writeln('FIM DO TESTE');

function writeln($line_in)
{
    echo $line_in . "<BR>";
}

?>
</body>
</html>