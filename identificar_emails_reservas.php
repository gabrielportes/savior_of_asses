<?php
const PATH_FILES = './emails/';
const CSV_SEPARATOR = ';';
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
    '=?iso-8859-1?B?VW1hIHBy6S1yZXNlcnZhIGZvaSBhZ2VuZGFkYS4=?=' => 'Uma pré-reserva foi agendada.',
    '=?iso-8859-1?B?U3VhIHJlc2VydmEg6SBhIDK6IGRhIGZpbGE=?=' => 'Sua reserva é a 2º da fila',
    '=?iso-8859-1?B?U3VhIHJlc2VydmEg6SBhIDC6IGRhIGZpbGE=?=' => 'Sua reserva é a 0º da fila',
    '=?iso-8859-1?B?T2zhIGdvc3RhcmlhIGRlIHJlc2VydmFyIG8gc2Fs428gZSBjaHVycmFzcXVlaXJhLi4u?=' => 'Olá gostaria de reservar o salão e churrasqueira...',
    '=?iso-8859-1?B?VW1hIHBy6S1yZXNlcnZhIGZvaSBjb25maXJtYWRhLg==?=' => 'Uma pré-reserva foi confirmada.',
    '=?iso-8859-1?B?U3VhIHJlc2VydmEg6SBhIDG6IGRhIGZpbGE=?=' => 'Reserva foi cancelada.',
    '=?iso-8859-1?B?UmVzZXJ2YSBjaHVycmFzcXVlaXJhIGVtIDEzLzAyLzIwMjI=?=' => 'Reserva churrasqueira em 13/02/2022',
    '=?iso-8859-1?B?UmVzZXJ2YSBjaHVycmFzcXVlaXJhIGVtIDA5LzAyLzIwMjI=?=' => 'Reserva churrasqueira em 09/02/2022',
    '=?iso-8859-1?B?U3VhIHJlc2VydmEg6SBhIDO6IGRhIGZpbGE=?=' => 'Sua reserva é a 3º da fila'
];
const TITULOS_IGNORAR = [
    '=?iso-8859-1?B?RnVuZG8gZGUgUmVzZXJ2YQ==?=',
    '=?iso-8859-1?B?Q09ORE9NzU5JTyBSRVNFUlZBIEFSQVVDwVJJQSB2ZW5jZSBob2plLg==?='
];
$licencas = scandir(PATH_FILES);
foreach ($licencas as $licenca) {
    $dirPath = PATH_FILES . $licenca;
    if (
        substr($licenca, 0, 1) == '.'
        || !is_dir($dirPath)
    ) {
        continue;
    }

    $files = scandir($dirPath);
    $criouCabecalho = false;
    foreach ($files as $file) {
        $fileToPath = $dirPath . DIRECTORY_SEPARATOR . $file;
        if (
            substr($file, 0, 1) == '.'
            || !is_file($fileToPath)
        ) {
            continue;
        }

        if (!$criouCabecalho) {
            adicionarCabecalho($licenca);
            $criouCabecalho = true;
        }

        $f = fopen($fileToPath, 'r');
        $lineNo = 0;
        $email = [
            COLUNA_HASH_ARQUIVO => $file
        ];
        $bcc = false;
        while ($line = fgets($f)) {
            $line = trim(strip_tags($line));
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

        if (!in_array($email[COLUNA_TITULO], TITULOS_IGNORAR)) {
            adicionarDadosEmail($licenca, $email);
        }
        fclose($f);
    }
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

function adicionarCabecalho(string $licenca)
{
    $cabecalho = '';
    foreach (COLUNAS as $coluna) {
        $cabecalho .= "\"{$coluna}\"" . CSV_SEPARATOR;
    }
    $cabecalho .= "\n";

    escreverLinhaNoArquivo($licenca, $cabecalho, 'w');
}

function adicionarDadosEmail(string $licenca, array $email)
{
    $dadosLinha = '';
    foreach (COLUNAS as $coluna) {
        $dado = $email[$coluna] ?? '';
        $dadosLinha .= "\"{$dado}\"" . CSV_SEPARATOR;
    }
    $dadosLinha .= "\n";

    escreverLinhaNoArquivo($licenca, $dadosLinha, 'a');
}

function escreverLinhaNoArquivo(string $licenca, string $conteudo, string $mode = 'w')
{
    $filename = "./resultados/{$licenca}_emails_reservas.csv";
    if (!$fp = fopen($filename, $mode)) {
        echo "Cannot open file ($filename)";
        exit;
    }

    if (fwrite($fp, $conteudo) === false) {
        echo "Cannot write to file ($filename)";
        exit;
    }

    fclose($fp);
}
