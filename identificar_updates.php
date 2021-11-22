<?php
// NÚMERO DE COLUNAS QUE TEM NA TABELA + 1
$tam = 2; 
// TODAS AS COLUNAS DA TABELA EM ORDEM DE INDEXAÇÃO
$colunas = [
    'PRIMARY_KEY'
];

// ALTERAR PARA O NOME DO ARQUIVO QUE VOCÊ QUER LER
$f = fopen('./restore_from_binlog1611-a.sql', 'r');
$lineNo = 0;
while ($line = fgets($f)) {
    $lineNo++;
    // ALTERAR PELA EXPRESSÃO QUE VOCÊ DESEJA IDENTIFICAR (PODERIA SER UMA REGEX)
    if (strpos($line, 'UPDATE `DATABASE`.`TABLE`') === false) {
        continue;
    }
    $update = '';
    $startLine = $lineNo;
    $startWhere = $lineNo + 1;
    $startSet = $startWhere + $tam;
    $endWhere = $startLine + $tam;
    $endSet = $endWhere + $tam;
    $endLine = $startLine + 81;
    $set = '';
    $where = '';
    do {
        $noHashtag = str_replace('###', '', $line);
        $replaceVirgula = $noHashtag;

        preg_match('/@\d+\=/', $line, $matches);
        if (isset($matches[0])) {
            $indice = (int) str_replace(['@', '='], ['', ''], $matches[0]);
            $coluna = $colunas[$indice - 1];
        }
        if ($lineNo == $startLine) {
            $update = $noHashtag;
        }

        if (
            strpos($line, '@1=') !== false // ONDE ESTÁ @1 COLOCAR O INDEX CORRESPONDENTE DA PRIMARY KEY
            && $lineNo >= $startWhere
            && $lineNo <= $endWhere
        ) {
            // NOME DA CHAVE PRIMÁRIA DA TABELA E ONDE ESTÁ @1 COLOCAR O INDEX CORRESPONDENTE DA PRIMARY KEY
            $where = str_replace('@1=', ' WHERE PRIMARY_KEY=', $noHashtag);
            $where .= ';';
        }

        if ($lineNo >= $startSet && $lineNo <= $endSet) {
            if ($lineNo != $startSet + 1) {
                $replaceVirgula = preg_replace('/@\d+/', ", {$coluna}", $noHashtag);
            } else {
                $replaceVirgula = preg_replace('/@\d+/', $coluna, $noHashtag);
            }
            $set .= $replaceVirgula;
        }

        if ($lineNo == $endLine) {
            $update .= $set . $where;
            $update = preg_replace('/\(\d+\)/', '', $update);
            echo $update . "\n\n\n";
            break;
        }
        $lineNo++;
    } while ($line = fgets($f));
}
fclose($f);
