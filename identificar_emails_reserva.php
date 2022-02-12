<?php
const LICENCA = 'abrj';
const PATH_FILES = './emails/' . LICENCA . DIRECTORY_SEPARATOR;
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
const PADRAO_DESTINATARIO_BCC = '/Bcc: /';
const PADRAO_DATA_ENVIO = '/Date: /';
const PADRAO_CONDOMINIO = '/Condom.*nio: /';
const PADRAO_RESERVA = '/Reserva: /i';
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
const DE_PARA_TITULO = [
    '=?iso-8859-1?B?U3VhIHJlc2VydmEgZm9pIGFwcm92YWRhLg==?=' => 'Sua reserva foi aprovada',
    '=?iso-8859-1?B?UmVzZXJ2YSBmb2kgY29uZmlybWFkYS4=?=' => 'Reserva foi confirmada.',
    '=?iso-8859-1?B?U3VhIHBy6S1yZXNlcnZhIGZvaSBhZ2VuZGFkYQ==?=' => 'Sua pré-reserva foi agendada',
    '=?iso-8859-1?B?U3VhIHJlc2VydmEgZm9pIGNhbmNlbGFkYS4=?=' => 'Sua reserva foi cancelada.',
    '=?iso-8859-1?B?QXByb3ZlIG91IGNhbmNlbGUgZXN0YSBwcuktcmVzZXJ2YS4=?=' => 'Aprove ou cancele esta pré-reserva.',
    '=?iso-8859-1?B?UmVzZXJ2YSBmb2kgY2FuY2VsYWRhLg==?=' => 'Reserva foi cancelada.',
    '=?iso-8859-1?B?UmVzZXJ2YSBDaHVycmFzcXVlaXJhIGRpYSAxMg==?=' => 'Reserva Churrasqueira dia 12',
];
$files = scandir(PATH_FILES);
$criouCabecalho = false;
foreach ($files as $file) {
    $fileToPath = PATH_FILES . $file;
    if (
        substr($file, 0, 1) == '.'
        || !is_file($fileToPath)
    ) {
        continue;
    }
    if (!$criouCabecalho) {
        adicionarCabecalho();
        $criouCabecalho = true;
    }

    $f = fopen($fileToPath, 'r');
    $lineNo = 0;
    $email = [
        COLUNA_HASH_ARQUIVO => $file
    ];
    $bcc = false;
    while ($line = fgets($f)) {
        $line = trim($line);
        $lineNo++;

        $identificou = identificarPadrao($email, $line);
        if ($identificou) {
            $bcc = false;
        }
        if (
            !$identificou
            && ((!isset($email[COLUNA_DESTINATARIOS])
                && preg_match(PADRAO_DESTINATARIO_BCC, $line))
                || $bcc)
        ) {
            $linha = preg_replace([PADRAO_DESTINATARIO_BCC, "/\r|\n/"], '', $line);
            $email[COLUNA_DESTINATARIOS] = $email[COLUNA_DESTINATARIOS] ?? '';
            $email[COLUNA_DESTINATARIOS] .= $linha;
            $bcc = true;
        }


        if (
            !$identificou
            && !isset($email[COLUNA_CONDOMINIO])
            && preg_match(PADRAO_CONDOMINIO, $line)
        ) {
            $email[COLUNA_CONDOMINIO] = $line;
        }
    }
    adicionarDadosEmail($email);

    fclose($f);
}

function identificarPadrao(array &$email, string $linha): bool
{
    foreach (PADROES as $key => $padrao) {
        $linha = trim($linha);
        if (preg_match($padrao, $linha, $matches)) {
            $linha = preg_replace([$padrao, "/\r|\n/"], '', $linha);
            if (
                $key === COLUNA_TITULO
                && isset(DE_PARA_TITULO[$linha])
            ) {
                $linha = DE_PARA_TITULO[$linha];
            }
            $email[$key] = $linha;

            return true;;
        }
    }

    return false;
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
        $dado = $email[$coluna] ?? '';
        $dadosLinha .= "\"{$dado}\"" . CSV_SEPARATOR;
    }
    echo "{$dadosLinha}\n";
}
