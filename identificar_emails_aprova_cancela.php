<?php
// SCRIPT PARA TRATAR EMAILS PARA CSV NO PADRÃO DO APROVA OU CANCELA
const PATH_FILES = './emails/';
const CSV_SEPARATOR = '|';
const COLUNA_TITULO = 'titulo';
const COLUNA_DESTINATARIOS = 'destinatarios';
const COLUNA_DATA_ENVIO = 'data_envio';
const COLUNA_CONDOMINIO = 'condominio';
const COLUNA_RESERVA = 'reserva';
const COLUNA_DATA_RESERVA = 'data_reserva';
const COLUNA_HASH_ARQUIVO = 'hash_arquivo';
const COLUNA_UNIDADE = 'unidade';
const COLUNAS = [
    COLUNA_TITULO,
    COLUNA_DESTINATARIOS,
    COLUNA_DATA_ENVIO,
    COLUNA_CONDOMINIO,
    COLUNA_RESERVA,
    COLUNA_DATA_RESERVA,
    COLUNA_UNIDADE,
    COLUNA_HASH_ARQUIVO
];
const PADRAO_TITULO = '/Subject: /';
const PADRAO_DESTINATARIO = '/To: /';
const PADRAO_DATA_ENVIO = '/Date: /';
const PADRAO_CONDOMINIO = '/Condom.*nio: /';
const PADRAO_RESERVA = '/Reserva: /';
const PADRAO_DATA_RESERVA = '/Data: /';
const PADRAO_UNIDADE = '/Unidade: /';
const PADROES = [
    COLUNA_TITULO => PADRAO_TITULO,
    COLUNA_DESTINATARIOS => PADRAO_DESTINATARIO,
    COLUNA_DATA_ENVIO => PADRAO_DATA_ENVIO,
    COLUNA_CONDOMINIO => PADRAO_CONDOMINIO,
    COLUNA_RESERVA => PADRAO_RESERVA,
    COLUNA_DATA_RESERVA => PADRAO_DATA_RESERVA,
    COLUNA_UNIDADE => PADRAO_UNIDADE
];

$files = scandir(PATH_FILES);
$criouCabecalho = false;
foreach ($files as $file) {
    if (substr($file, 0, 1) == '.') {
        continue;
    }
    if (!$criouCabecalho) {
        adicionarCabecalho();
        $criouCabecalho = true;
    }

    $f = fopen(PATH_FILES . $file, 'r');
    $lineNo = 0;
    $email = [
        COLUNA_HASH_ARQUIVO => $file
    ];
    while ($line = fgets($f)) {
        $lineNo++;

        identificarPadrao($email, $line);
        if (count($email) === count(COLUNAS)) {
            adicionarDadosEmail($email);
            $email = [
                COLUNA_HASH_ARQUIVO => $file
            ];
        }
    }
    fclose($f);
}

function identificarPadrao(array &$email, string $linha)
{
    foreach (PADROES as $key => $padrao) {
        if (preg_match($padrao, $linha, $matches)) {
            $email[$key] = preg_replace([$padrao, "/\n/"], '', $linha);
            break;
        }
    }
}

function adicionarCabecalho()
{
    $cabecalho = '';
    foreach (COLUNAS as $coluna) {
        $cabecalho .= "\"{$coluna}\"" . CSV_SEPARATOR;
    }
    echo "{$cabecalho}\n";
}

function adicionarDadosEmail(array $email)
{
    $dadosLinha = '';
    foreach (COLUNAS as $coluna) {
        $dadosLinha .= "\"{$email[$coluna]}\"" . CSV_SEPARATOR;
    }
    echo "{$dadosLinha}\n";
}
