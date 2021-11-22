<?php
// NÚMERO DE COLUNAS QUE TEM NA TABELA + 1
$tam = 40;
// ALTERAR PARA O NOME DO ARQUIVO QUE VOCÊ QUER LER
$f = fopen('./restore_from_binlog1611-a.sql', 'r');
$lineNo = 0;
while ($line = fgets($f)) {
    $lineNo++;
    // ALTERAR PELA EXPRESSÃO QUE VOCÊ DESEJA IDENTIFICAR (PODERIA SER UMA REGEX)
    if (strpos($line, 'INSERT INTO `DATABASE`.`TABLE`') === false) {
        continue;
    }
    $insert = '';
    $startLine = $lineNo;
    $endLine = $startLine + $tam;
    do {
        if ($lineNo >= $startLine) {
            $noHashtag = str_replace('###', '', $line);
            $replaceVirgula = $noHashtag;

            if ($lineNo != $startLine + 2) {
                $replaceVirgula = preg_replace('/@\d+=/', ', ', $noHashtag);
            } else {
                $replaceVirgula = preg_replace('/@\d+=/', '', $noHashtag);
                $insert = str_replace('SET', 'VALUES (', $insert);
            }
            $insert .= $replaceVirgula;
        }
        if ($lineNo == $endLine) {
            $insert .= ');';
            $insert = preg_replace('/\(\d+\)/', '', $insert);
            echo $insert . "\n\n\n";
            break;
        }
        $lineNo++;
    } while ($line = fgets($f));
}
fclose($f);
