var assert = require('assert');

/**
 * Entendendo promessas
 *
 * Este exemplo é em javascript, rodando em NODEJS
 * usar o mocha para testar
 *
 *
 * Entendendo o padrão:
 * Basicamente a idéia é separar o escopo entre a execução de uma função e seu callback.
 * Além disso, fica mais fácil tratar o erro.
 *
 * No exemplo A, é executado a função, e em seu callback é executado mais duas funções e um tratamento de erro.
 *
 * No exemplo com pomisse, a função é executada como uma promessa, se ela funcionar,
 * o escopo das duas funções estão separadas, e o tratamento de erros também.
 */


// A - criamos uma função que recebe um array
// e uma callback.
//
// o objetivo desta função é somar os valores do array (TAREFA A)
// e também executar o callback com o resultado
function somaArr(arr, fn)
{

    var somar = 0;

    // executa uma ação simples
    for (var i = 0, l = arr.length; i < l; i++) {
        somar = somar + arr[i];
    }

    // chama um callback
    // TAREFA(B)
    fn(somar);
}




describe(
    'Teste de promessa',
    function()
    {
        it(
            'Executa a soma com callback',
            function() {


                /**
                 * exemplo incorreto
                 * neste exemplo abaixo o callback executa duas ações
                 */

                // executa a função
                somaArr(
                    [
                        10,
                        21,
                        30
                    ],

                    // definição de tarefa TAREFA(B)
                    function (valor) {

                        // TAREFA (B)
                        if (valor % 2 == 0) {
                            console.log('ok B');
                        }

                        // TAREFA (C)
                        if (valor % 2 == 0) {
                            console.log('ok C');
                        }

                        // TAREFA (D) - tratamento de erro
                        console.log('Erro, valor nao é par');
                    }
                );



                /**
                 * exemplo correto
                 */

                var objPromessa = new Promise(
                    function (resolve, reject)
                    {
                        // executa a função
                        somaArr(
                            [
                                10,
                                20,
                                30
                            ],

                            // definição de tarefa TAREFA(B)
                            function (valor) {

                                // TAREFA (B)
                                // TAREFA (C)
                                if (valor % 2 == 0) {
                                    resolve(true);
                                }

                                // TAREFA (C) - tratamento de erro
                                return reject('Erro, valor nao é par');
                            }
                        );
                    }
                );


                objPromessa.then(
                    // TAREFA B
                    function(valor)
                    {
                        console.log("Tarfa B: " + valor);
                        return " aqui ";
                    }
                ).then(
                    // TAREFA C
                    function(valor)
                    {
                        console.log("Tarefa C: " + valor);
                    }
                ).catch(
                    // tratamento de erro
                    function(valor) {
                        console.log("-----");
                        console.log(valor);
                    }
                );

                assert.equal(true, true);
            }
        );
    }
);
