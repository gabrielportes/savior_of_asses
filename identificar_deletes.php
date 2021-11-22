<?php
// ALTERAR PARA O NOME DO ARQUIVO QUE VOCÊ QUER LER
$f = fopen('./restore_from_binlog1611-a.sql', 'r');
$lineNo = 0;
while ($line = fgets($f)) {
    $lineNo++;
    // ALTERAR PELA EXPRESSÃO QUE VOCÊ DESEJA IDENTIFICAR (PODERIA SER UMA REGEX)
    if (strpos($line, 'DELETE FROM `DATABASE`.`TABLE`') === false) {
        continue;
    }
    $delete = '';
    $startLine = $lineNo;
    do {
        $noHashtag = str_replace('###', '', $line);
        if ($lineNo == $startLine) {
            $delete = $noHashtag;
        }
        if (strpos($line, '@1=') !== false) {
            // NOME DA CHAVE PRIMÁRIA DA TABELA E ONDE ESTÁ @1 COLOCAR O INDEX CORRESPONDENTE DA PRIMARY KEY
            $delete .= str_replace('@1=', ' WHERE PRIMARY_KEY=', $noHashtag);
            $delete = preg_replace('/\(\d+\)/', '', $delete);
            echo $delete . ";\n\n\n";
            break;
        }
        $lineNo++;
    } while ($line = fgets($f));
}
fclose($f);
