<?php

namespace SRC;

class Funcoes
{
    /*

    Desenvolva uma função que receba como parâmetro o ano e retorne o século ao qual este ano faz parte. O primeiro século começa no ano 1 e termina no ano 100, o segundo século começa no ano 101 e termina no 200.

	Exemplos para teste:

	Ano 1905 = século 20
	Ano 1700 = século 17

     * */
    public function SeculoAno(int $ano): int {
        if ($ano >= 1) {
            $yearString = strval($ano);
            $yearSize = strlen($yearString); 
            $centurie = (int) substr($yearString, 0, $yearSize - 2);

            $lastCenturieYear = $ano === (int) str_pad(strval($centurie), $yearSize, "0");
            return $lastCenturieYear ? $centurie : $centurie + 1; 
        }
    }
	
	/*

    Desenvolva uma função que receba como parâmetro um número inteiro e retorne o numero primo imediatamente anterior ao número recebido

    Exemplo para teste:

    Numero = 10 resposta = 7
    Número = 29 resposta = 23

     * */
    public function PrimoAnterior(int $numero): int {
        if ($numero > 1) {
            $listOfNumbers = [];
            $n = $numero - 1;
            while($n > 1) {
                array_push($listOfNumbers, $n);
                $n--;
            }

            foreach($listOfNumbers as $number) {
                for($i = 2; $i <= $number; $i++) {
                    if ($i == $number) {
                        return $number;
                    }
                    if ($number % $i == 0) {
                        continue 2;
                    }
                }
            }

            return 0;
        }        
    }

    /*

    Desenvolva uma função que receba como parâmetro um array multidimensional de números inteiros e retorne como resposta o segundo maior número.

    Exemplo para teste:

	Array multidimensional = array (
	array(25,22,18),
	array(10,15,13),
	array(24,5,2),
	array(80,17,15)
	);

	resposta = 25

     * */
    public function SegundoMaior(array $arr): int {
        $numbers = array_merge(...$arr);    
        $numbers = array_unique($numbers);
        rsort($numbers);
        return $numbers[1];        
    }
	
    /*
   Desenvolva uma função que receba como parâmetro um array de números inteiros e responda com TRUE or FALSE se é possível obter uma sequencia crescente removendo apenas um elemento do array.

	Exemplos para teste 

	Obs.:-  É Importante  realizar todos os testes abaixo para garantir o funcionamento correto.
         -  Sequencias com apenas um elemento são consideradas crescentes

    [1, 3, 2, 1]  false
    [1, 3, 2]  true
    [1, 2, 1, 2]  false
    [3, 6, 5, 8, 10, 20, 15] false
    [1, 1, 2, 3, 4, 4] false
    [1, 4, 10, 4, 2] false
    [10, 1, 2, 3, 4, 5] true
    [1, 1, 1, 2, 3] false
    [0, -2, 5, 6] true
    [1, 2, 3, 4, 5, 3, 5, 6] false
    [40, 50, 60, 10, 20, 30] false
    [1, 1] true
    [1, 2, 5, 3, 5] true
    [1, 2, 5, 5, 5] false
    [10, 1, 2, 3, 4, 5, 6, 1] false
    [1, 2, 3, 4, 3, 6] true
    [1, 2, 3, 4, 99, 5, 6] true
    [123, -17, -5, 1, 2, 3, 12, 43, 45] true
    [3, 5, 67, 98, 3] true

     * */
    
    
	public function SequenciaCrescente(array $arr): bool {
        if (count($arr) === 1 || count(array_unique($arr)) === 1) {
            return true;
        }
        
        // Iterar sobre cada elemento do array
        for($i = 0; $i < count($arr); $i++) {
            // Criar uma nova array sem o elemento de determinado índice do array original
            $testArray = array_values(array_filter($arr, function($number, $index) use ($i) {
                return $index !== $i ? $number : null;
            }, ARRAY_FILTER_USE_BOTH));
            
            // Verificar se os números no array de teste forma uma sequência crescente
                // Caso negativo, passar para o próximo índice
                // Caso positivo, parar a iteração e retornar "true"
            $j = 0;
            while ($j < count($testArray)) {
                $isLastNumber = $j === count($testArray) - 1;
                if ($isLastNumber) {
                    return true;
                }

                $isSmaller = $testArray[$j] < $testArray[$j + 1];
                if ($isSmaller) {
                    $j++;
                } else {
                    break;
                }
            }
        }
        // Ao finalizar a iteração de todos os índices, retornar "false"
        return false;
    }
}

$functions = new Funcoes();

echo "Testes da função do século para dado ano: \n";
echo "Ano 1905 - Século " . $functions -> SeculoAno(1905) . "\n"; // Retorna 20;
echo "Ano 1700 - Século " . $functions -> SeculoAno(1905) . "\n\n"; // Retorna 17;

echo "Teste da função que encontra segundo maior número em array multidimensional: \n";
$arr =  [[25,22,18],[10,15,13],[24,5,2],[80,17,15]];
$curatedArray = array_unique(array_merge(...$arr));
sort($curatedArray);
echo "Lista de números: " . implode(", ", $curatedArray) . "\n";
echo "Segundo maior número: " . $functions -> SegundoMaior($arr) . "\n\n";

echo "Teste da função que retorna o número primo imediatamente anterior ao número passado. \n";
echo "Número: 10; Resultado: " . $functions -> PrimoAnterior(10) . "\n";
echo "Número: 29; Resultado: " . $functions -> PrimoAnterior(29) . "\n";
echo "Número: 2457648; Resultado: " . $functions -> PrimoAnterior(2457648) . "\n";
echo "Número: 3652; Resultado: " . $functions -> PrimoAnterior(3652) . "\n\n";

echo "Teste da função de checagem de possibilidade de sequência crescente ao retirar um elemento de uma array de inteiros: \n";
$arrays = array(
    [1, 3, 2, 1],
    [1, 3, 2],
    [1, 2, 1, 2],
    [3, 6, 5, 8, 10, 20, 15],
    [1, 1, 2, 3, 4, 4],
    [1, 4, 10, 4, 2],
    [10, 1, 2, 3, 4, 5],
    [1, 1, 1, 2, 3],
    [0, -2, 5, 6],
    [1, 2, 3, 4, 5, 3, 5, 6],
    [40, 50, 60, 10, 20, 30],
    [1, 1],
    [1, 2, 5, 3, 5],
    [1, 2, 5, 5, 5],
    [10, 1, 2, 3, 4, 5, 6, 1],
    [1, 2, 3, 4, 3, 6],
    [1, 2, 3, 4, 99, 5, 6],
    [123, -17, -5, 1, 2, 3, 12, 43, 45],
    [3, 5, 67, 98, 3],
    [1, 1, 1, 1],
    [1]
);

foreach($arrays as $array) {
    echo "Números: (" . implode(", ", $array) . ") -> ";
    echo $functions -> SequenciaCrescente($array) ? "TRUE \n" : "FALSE \n";
}