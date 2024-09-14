<?php

$binlog = new Binlog('./binlog.010630.sql');
$commands = $binlog->getAllCommands('./all_commands_executeds.sql');

class Binlog
{
    const TABLES = [
        'RECEBIMENTO' => [
            'PK_INDEX' => 1,
            'COLUMNS' => [
                'ID_RECEBIMENTO_RECB',
                'DT_VENCIMENTO_RECB',
                'ID_EMPRESA_EMP',
                'ID_SACADO_SAC',
                'DT_RECEBIMENTO_RECB',
                'FL_STATUS_RECB',
                'ST_OBSERVACAO_RECB',
                'VL_TOTAL_RECB',
                'VL_EMITIDO_RECB',
                'DT_CANCELAMENTO_RECB',
                'DT_GERACAO_RECB',
                'ST_MD5_RECB',
                'DT_IMPRESSAO_RECB',
                'DT_ALTERACAO_SINCRO',
                'ST_NOSSONUMERO_RECB',
                'VL_TXMULTA_RECB',
                'VL_TXJUROS_RECB',
                'FL_PRORATADIA_RECB',
                'FL_COMPOSICAO_RECB',
                'DT_ACORDO_RECB',
                'NM_REMESSA_RECB',
                'FL_REMESSASTATUS_RECB',
                'TX_REMESSAMSG_RECB',
                'FL_IMPORTACAO_RECB',
                'ID_NOTA_NOT',
                'ST_INSTRUCOES_RECB',
                'FL_ONLINE_RECB',
                'ID_CONTA_CB',
                'ID_ONLINE_RECB',
                'NM_IMPRESSOES_RECB',
                'ID_FORMAPAGAMENTO_RECB',
                'ST_OBSERVACAOINTERNA_RECB',
                'FL_NOSSONUMEROFIXO_RECB',
                'ST_DOCUMENTOEX_RECB',
                'DT_LIQUIDACAO_RECB',
                'FL_PROTESTADO_RECB',
                'FL_CARTAO_RECB',
                'TX_CARTAOMENSAGEM_RECB',
                'ST_LABEL_RECB',
                'VL_TXDESCONTO_RECB',
                'ST_NF_RECB',
                'ST_OBSERVACAOEXTERNA_RECB',
                'ST_CIELOTID_RECB',
                'FL_CIELOFORCARPAGAMENTO_RECB',
                'DT_CIELOULTIMATENTATIVA_RECB',
                'ID_CHEQUE_PRE',
                'ID_FECHAMENTO_CFE',
                'ID_USUARIO_USU',
                'ST_MAQUINA_RECB',
                'ID_TRANSACAO_CTR',
                'ID_CONTAORIGINAL_CB',
                'ID_BANDEIRA_BAN',
                'DT_COMPETENCIA_RECB',
                'DT_PREVISAOCREDITO_RECB',
                'ID_ADMCARTOES_ADC',
                'DT_FECHAMENTO_CFE',
                'ST_LABEL2_RECB',
                'FL_PRIMEIRANOTIFICACAO_RECB',
                'FL_SEGUNDANOTIFICACAO_RECB',
                'FL_TERCEIRANOTIFICACAO_RECB',
                'FL_ACORDOFRENTEDECAIXA_RECB',
                'NM_VISTO_RECB',
                'ST_NUMEROAUTORIZACAO_RECB',
                'ID_LOTE_RECB',
                'ID_CONTRATO_MENS',
                'ID_FILIAL_FIL',
                'ST_LABEL3_RECB',
                'FL_PRIMEIRANOTIFICACAOSMS_RECB',
                'FL_SEGUNDANOTIFICACAOSMS_RECB',
                'FL_PRIMEIRANOTIFICACAOCART_RECB',
                'FL_SEGUNDANOTIFICACAOCARTA_RECB',
                'ST_CARTAODETALHES_RECB',
                'FL_TEMCOMISSAO_RECB',
                'ID_FORMA_FRECB',
                'ST_LABEL_MENS',
                'DT_CARTAOTRANSACAO_RECB',
                'ST_ERROCARTAO_RECB',
                'FL_CONVERTERPARANOTA_RECB',
                'ID_ADESAO_PLC',
                'ID_RENOVACAO_PLC',
                'ST_COMPLEMENTOCOMPOSICAO_RECB',
                'ST_TOKENFACILITADOR_RECB',
                'ST_TOKENDACONTA_RECB',
                'ST_CIELOTIDCANCELAMENTO_RECB',
                'VL_TAXACOBRANCA_RECB',
                'ST_HASHPARCELAMENTO_RECB',
                'ST_CARTAOBANDEIRA_RECB',
                'FL_DESPESASVINCULADAS_RECB',
                'FL_QUARTANOTIFICACAO_RECB',
                'ST_TIDCONCILIACAO_RECB',
                'ID_ENDERECO_SEN',
                'FL_MOTIVOCANCELAR_RECB',
                'ST_IDEXTERNO_RECB',
                'FL_CONSULTARTIDTARDIO_RECB',
                'FL_IGNORARBLOQUEIOAUTO_RECB',
                'ST_NUMEROCARTAO_RECB',
                'NM_PARCELACARTAO_RECB',
                'FL_CONCILIADO_RECB',
                'FL_TIPOENTREGA_RECB',
                'ST_CODMOVIMENTACAOREM_RECB',
                'ID_CONTAORIGEM_RECB',
                'FL_CONTRATOPRORROGADO_RECB',
                'ST_MARCADOR_RECB',
                'ID_FORMABOLETO_FRECB',
                'ST_HASHEMAILPAG_RECB',
                'ST_ACCESSKEYCR_RECB',
                'FL_REMESSASTATUSCR_RECB',
                'NM_TENTATIVASENVIOCR_RECB',
                'FL_QUINTANOTIFICACAO_RECB',
                'FL_SEXTANOTIFICACAO_RECB',
                'FL_TERCEIRANOTIFICACAOSMS_RECB',
                'NM_DESCONTOATEDIA_RECB',
                'FL_TXDESCONTOPERSONALIZADA_RECB',
                'ID_RECEBIMENTOANTIGO_RECB',
                'VL_DESCONTOCALCULADO_RECB',
                'ST_SPLITDADOS_RECB',
                'FL_GERACAONOTIFICADA_RECB',
                'NM_VERSAORECEBIMENTO_RECB',
                'NM_VERSAORECEBIMENTOPJBANK_RECB',
                'ST_MOTIVOCANCELOUTROS_RECB',
                'DT_ALTERACAO_RECB',
                'FL_DESCONSIDERARCONTABILIDADE_RECB',
                'ID_PARTIDACONTABIL_PC',
                'ID_PARTIDACONTABILLIQUIDACAO_PC',
                'ID_PARTIDACONTABILBAIXA_PC',
                'DT_VENCIMENTOORIGINAL_RECB',
                'DT_PEDIDOREGISTROPJBANK_RECB',
                'DT_PEDIDOBAIXAPJBANK_RECB',
                'ID_OPERACAOSECURITIZADORA_RECB',
                'FL_STATUSSECURITIZADORA_RECB',
                'ID_OPERACAOPJBANK_RECB',
                'ST_COMPLEMENTOLANCIGNORADO_RECB',
                'DT_SUSPENSAOCANCELADA_RECB',
                'ST_PIXQRCODE_RECB',
                'ST_CODIGOERROCARTAO_RECB',
                'ST_FALHACARTAO_RECB',
                'NM_TENTATIVASCARTAO_RECB',
                'NM_CONVENIOPROPRIOPJBANK_RECB',
                'NM_TAGCRIACAO_RECB',
                'NM_TAGLIQUIDACAO_RECB',
                'ID_SPLIT_RECB'
            ]
        ],
        'COMPO_RECEBIMENTO' => [
            'PK_INDEX' => 6,
            'COLUMNS' => [
                'ST_MESANO_COMP',
                'ST_DESCRICAO_COMP',
                'ST_VALOR_COMP',
                'ID_BOLETO_COMP',
                'ID_SACADO_COMP',
                'ID_COMPOSICAO_COMP',
                'ID_MENSALIDADE_COMP',
                'ID_EMPRESA_COMP',
                'ST_SINCRO_COMP',
                'ST_SINCROSAC_COMP',
                'ID_PRODUTO_PRD',
                'ID_CONTA_CB',
                'ID_BOLETOPMM_COMP',
                'ST_COMPLEMENTO_COMP',
                'FL_ESPECIAL_COMP',
                'ID_PGMTINDEVIDO_COMP',
                'ID_RETORNOITEMDUPLICADO_RETI',
                'ST_CONTA_CONT',
                'ID_PLANOCONTA_PLC',
                'ID_PLANOCLIENTE_PLC',
                'ID_LOTE_COMP',
                'ID_CONTRATO_MENS',
                'ID_FILIAL_FIL',
                'NM_QUANTIDADE_COMP',
                'ID_FATCOMPLEMENTOSTATUS_FACS',
                'ID_VENDEDOR_COMP',
                'ID_INDICADOR_COMP',
                'ID_GERENTE_COMP',
                'ID_PMTINDICACAO_COMP',
                'ID_PMTVENDEDOR_COMP',
                'ID_PMTGERENTE_COMP',
                'FL_REPASSEVENDEDOR_COM',
                'ST_LABEL_MENS',
                'ID_PEDIDO_PED',
                'ID_PROXIMARENOVACAO_RECB',
                'FL_ADICIONALAVULSO_COMP',
                'FL_DESCONTOCUPOMRECO_COMP',
                'FL_STATUS_COMP',
                'NM_PERIODICIDADE_PLA',
                'DT_CONTRATACAO_COMP',
                'DT_CRIACAO_COMP',
                'DT_ALTERACAO_COMP',
                'DT_FATURAREVENTUAL_COMP',
                'DT_VENCIMENTOCALCULADO_COMP'
            ]
        ]
    ];

    protected $regexTables = '';

    protected $binlogFile;

    protected $fileToWrite;

    public function __construct(string $path)
    {
        $this->binlogFile = fopen($path, 'r');
    }

    protected function regexTables(): string
    {
        if (empty($this->regexTables)) {
            $this->regexTables = implode(
                '|',
                array_keys(static::TABLES)
            );
        }

        return $this->regexTables;
    }

    protected function getCountColumns(string $table): int
    {
        if (!isset(static::TABLES[$table]['COLUMNS'])) {
            throw new Exception('Invalid table name.');
        }

        return count(static::TABLES[$table]['COLUMNS']) + 1;
    }

    protected function getPKIndex(string $table): int
    {
        if (!isset(static::TABLES[$table]['PK_INDEX'])) {
            throw new Exception('Invalid table name.');
        }

        return static::TABLES[$table]['PK_INDEX'];
    }

    protected function getColumnName(string $table, int $index): string
    {
        if (!isset(static::TABLES[$table]['COLUMNS'][$index - 1])) {
            throw new Exception('Invalid table name.');
        }

        return static::TABLES[$table]['COLUMNS'][$index - 1];
    }

    protected function getFileToWrite(string $writeIntoFile)
    {
        if (empty($this->fileToWrite)) {
            if (!$this->fileToWrite = fopen($writeIntoFile, 'w')) {
                echo "Cannot open file ($writeIntoFile)";
                exit;
            }
        }

        return $this->fileToWrite;
    }

    protected function writeCommandIntoFile(string $command, string $writeIntoFile)
    {
        $file = $this->getFileToWrite($writeIntoFile);

        if (fwrite($file, "{$command}\n") === false) {
            echo "Cannot write to file ($writeIntoFile)";
            exit;
        }
    }

    protected function isInsert($line): string
    {
        $tablesRegex = $this->regexTables();
        preg_match(
            "/INSERT INTO `\w+`\.`({$tablesRegex})`/",
            $line,
            $matches
        );
        $table = $matches[1] ?? '';

        return $table;
    }

    protected function isUpdate($line): string
    {
        $tablesRegex = $this->regexTables();
        preg_match(
            "/UPDATE `\w+`\.`({$tablesRegex})`/",
            $line,
            $matches
        );
        $table = $matches[1] ?? '';

        return $table;
    }

    protected function isDelete($line): string
    {
        $tablesRegex = $this->regexTables();
        preg_match(
            "/DELETE FROM `\w+`\.`({$tablesRegex})`/",
            $line,
            $matches
        );
        $table = $matches[1] ?? '';

        return $table;
    }

    protected function getInsertCommand($line, $lineNo, $table, $previousLine, $withTimestamp = true): string
    {
        $insert = '';
        $startLine = $lineNo;
        $endLine = $startLine + $this->getCountColumns($table);

        do {
            if ($lineNo >= $startLine) {
                $noHashtag = str_replace(['###', "\n"], ['', ''], $line);
                $replaceComma = $noHashtag;

                if ($lineNo != $startLine + 2) {
                    $replaceComma = preg_replace('/@\d+=/', ', ', $noHashtag);
                } else {
                    $replaceComma = preg_replace('/@\d+=/', '', $noHashtag);
                    $insert = str_replace('SET', ' VALUES (', $insert);
                }

                $insert .= trim($replaceComma);
            }

            if ($lineNo == $endLine) {
                $insert .= ');';
                $insert = preg_replace('/\(\d+\)/', '', $insert);

                if ($withTimestamp) {
                    preg_match('/\d{2}:\d{2}:\d{2}/', $previousLine, $matches);
                    $timestamp = current($matches);
                    $insert .= " -- {$timestamp}";
                }

                break;
            }

            $lineNo++;
        } while ($line = fgets($this->binlogFile));

        return $insert;
    }

    protected function getUpdateCommand($line, $lineNo, $table, $previousLine, $withTimestamp = true): string
    {
        $update = '';
        $startLine = $lineNo;
        $startWhere = $lineNo + 1;
        $startSet = $startWhere + $this->getCountColumns($table);
        $endWhere = $startLine + $this->getCountColumns($table);
        $endSet = $endWhere + $this->getCountColumns($table);
        $endLine = $startLine + ($this->getCountColumns($table) * 2) + 2;
        $pkIndex = $this->getPKIndex($table);
        $pkName = $this->getColumnName($table, $pkIndex);
        $set = '';
        $where = '';

        do {
            $noHashtag = trim(str_replace(['###', "\n"], ['', ''], $line));
            $replaceVirgula = $noHashtag;

            preg_match('/@\d+\=/', $line, $matches);

            if (isset($matches[0])) {
                $index = (int) str_replace(['@', '='], ['', ''], $matches[0]);
                $column = $this->getColumnName($table, $index);
            }

            if ($lineNo == $startLine) {
                $update = $noHashtag;
            }

            if (
                strpos($line, "@{$pkIndex}=") !== false
                && $lineNo >= $startWhere
                && $lineNo <= $endWhere
            ) {
                $where = str_replace("@{$pkIndex}=", "WHERE {$pkName} = ", $noHashtag);
                $where .= ';';
            }

            if ($lineNo >= $startSet && $lineNo <= $endSet) {
                if ($lineNo != $startSet + 1) {
                    $replaceVirgula = preg_replace('/@\d+/', ", {$column}", $noHashtag);
                } else {
                    $replaceVirgula = preg_replace('/@\d+/', " {$column}", $noHashtag);
                }

                $set .= $replaceVirgula;
            }

            if ($lineNo == $endLine) {
                $update .= " {$set} {$where}";
                $update = trim(preg_replace('/\(\d+\)/', '', $update));

                if ($withTimestamp) {
                    preg_match('/\d{2}:\d{2}:\d{2}/', $previousLine, $matches);
                    $timestamp = current($matches);
                    $update .= " -- {$timestamp}";
                }

                break;
            }

            $lineNo++;
        } while ($line = fgets($this->binlogFile));

        return $update;
    }

    protected function getDeleteCommand($line, $lineNo, $table, $previousLine, $withTimestamp = true): string
    {
        $delete = '';
        $startLine = $lineNo;
        $pkIndex = $this->getPKIndex($table);
        $pkName = $this->getColumnName($table, $pkIndex);

        do {
            $noHashtag = trim(str_replace(['###', "\n"], ['', ''], $line));

            if ($lineNo == $startLine) {
                $delete = $noHashtag;
            }

            if (strpos($line, "@{$pkIndex}=") !== false) {
                $delete .= str_replace("@{$pkIndex}=", " WHERE {$pkName} = ", $noHashtag);
                $delete = preg_replace('/\(\d+\)/', '', $delete);
                $delete .= ';';

                if ($withTimestamp) {
                    preg_match('/\d{2}:\d{2}:\d{2}/', $previousLine, $matches);
                    $timestamp = current($matches);
                    $delete .= " -- {$timestamp}";
                }

                break;
            }

            $lineNo++;
        } while ($line = fgets($this->binlogFile));

        return $delete;
    }

    protected function getCommand($line, $lineNo, $previousLine, $withTimestamp = true): string
    {
        if ($table = $this->isInsert($line)) {
            return $this->getInsertCommand(
                $line,
                $lineNo,
                $table,
                $previousLine,
                $withTimestamp
            );
        }

        if ($table = $this->isUpdate($line)) {
            return $this->getUpdateCommand(
                $line,
                $lineNo,
                $table,
                $previousLine,
                $withTimestamp
            );
        }

        if ($table = $this->isDelete($line)) {
            return $this->getDeleteCommand(
                $line,
                $lineNo,
                $table,
                $previousLine,
                $withTimestamp
            );
        }

        return '';
    }

    public function getAllCommands(string $writeIntoFile = ''): array
    {
        $lineNo = 0;
        $commands = [];
        $previousLine = '';

        while ($line = fgets($this->binlogFile)) {
            $lineNo++;
            $command = $this->getCommand(
                $line,
                $lineNo,
                $previousLine
            );
            $previousLine = $line;

            if (!$command) {
                continue;
            }

            if ($writeIntoFile) {
                $this->writeCommandIntoFile($command, $writeIntoFile);
            } else {
                $commands[] = $command;
            }
        }

        fclose($this->binlogFile);

        if ($this->fileToWrite) {
            fclose($this->fileToWrite);
        }

        return $commands;
    }
}
