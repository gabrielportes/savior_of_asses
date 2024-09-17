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
        ],
        'SACADO' => [
            'PK_INDEX' => 19,
            'COLUMNS' => [
                'ST_NOME_SAC',
                'ST_NOMEREF_SAC',
                'ST_CGC_SAC',
                'ST_EMAIL_SAC',
                'ST_TELEFONE_SAC',
                'ST_ENDERECO_SAC',
                'ST_COMPLEMENTO_SAC',
                'ST_CIDADE_SAC',
                'ST_ESTADO_SAC',
                'ST_CEP_SAC',
                'ST_INSCRICAO_SAC',
                'TX_OBSERVACAO_SAC',
                'TX_CONTATOS_SAC',
                'ST_DIAVENCIMENTO_SAC',
                'ST_CONTRATO_SAC',
                'DT_CADASTRO_SAC',
                'DT_ALTERACAO_SINCRO',
                'FL_DESATIVAR_SAC',
                'ID_SACADO_SAC',
                'ST_SINCRO_SAC',
                'ST_CODEMP_SAC',
                'ST_SENHA_SAC',
                'CAMPO1',
                'CAMPO2',
                'CAMPO3',
                'CAMPO4',
                'FL_STATUS_SAC',
                'ID_GRUPO_GRP',
                'ST_SACADORNOME_SAC',
                'ST_SACADORCGC_SAC',
                'ST_SINCROORDER_SAC',
                'ST_NUMERO_SAC',
                'DT_DESATIVACAO_SAC',
                'DT_EMISSAORG_SAC',
                'ST_SEXO_SAC',
                'ST_NACIONALIDADE_SAC',
                'DT_NASCIMENTO_SAC',
                'ST_NATURALIDADE_SAC',
                'ST_CELULAR_SAC',
                'ST_CARTEIRAIDENTIDADE_SAC',
                'DT_EMISSAOCARTEIRA_SAC',
                'ST_ORGAO_SAC',
                'ST_NUMTITULOELEITOR_SAC',
                'ST_TITULOZONA_SAC',
                'ST_TITULOSECAO_SAC',
                'DT_EMISSAOTITULO_SAC',
                'ST_OBSSAUDE_SAC',
                'ST_NUMCERTIDAONASCIMENTO_SAC',
                'ST_DISTCERTIDAONASCIMENTO_SAC',
                'ST_CMARCACERTIDAONASCIMENTO_SAC',
                'ST_LIVROCERTIDAOCASAMENTO_SAC',
                'ST_FOLHACERTIDAOCASAMENTO_SAC',
                'ST_CARTCERTIDAOCASAMENTO_SAC',
                'ST_ESTADOCARTORIO_SAC',
                'DT_CERTIDAOCASAMENTO_SAC',
                'FL_SITUACAOMILITAR_SAC',
                'ST_CSMMILITAR_SAC',
                'ST_CERTMILITAR_SAC',
                'ST_RMMILITAR_SAC',
                'DT_EXPEDICAOMILITAR_SAC',
                'ST_RG_SAC',
                'ST_ORGAOEXPEDICAOMILITAR_SAC',
                'FL_TIPOCERTIDAO_SAC',
                'ST_NUMCERTIDAONASCASAMENT_SAC',
                'ST_DISTCERTIDAONASCASAMENT_SAC',
                'ST_CMARCACERTIDAONASCASAMEN_SAC',
                'ST_LIVROCERTIDAONASCASAMENT_SAC',
                'ST_FOLHACERTIDAONASCASAMENT_SAC',
                'ST_CARTCERTIDAONASCASAMENT_SAC',
                'ST_ESTADOCARTORIONASCASAMEN_SAC',
                'ST_BAIRRO_SAC',
                'IDRACA',
                'NM_CARTAO_SAC',
                'NM_MESCARTAOVENCIMENTO_SAC',
                'NM_ANOCARTAOVENCIMENTO_SAC',
                'ST_CARTAOVENCIMENTO_SAC',
                'ST_CARTAOTOKEN_SAC',
                'ST_CARTAOSEGURANCA_SAC',
                'ST_CARTAOBANDEIRA_SAC',
                'ST_NOMEPORTADOR_SAC',
                'ST_DOCUMENTOPORTADOR_SAC',
                'ST_TELEFONEPORTADOR_SAC',
                'ST_INSCMUNICIPAL_SAC',
                'ST_FAX_SAC',
                'ST_CODIGOCONTABIL_SAC',
                'VL_TXPIS_SAC',
                'VL_TXINSS_SAC',
                'VL_TXIRRF_SAC',
                'VL_TXCONTRIBUICAOSOCIAL_SAC',
                'VL_TXCOFINS_SAC',
                'FL_RETERISSQN_SAC',
                'FL_RETERPIS_SAC',
                'FL_RETERINSS_SAC',
                'FL_RETERIRRF_SAC',
                'FL_RETERCONTRIBUICAOSOCIAL_SAC',
                'FL_RETERCOFINS_SAC',
                'FL_PESSOAJURIDICA_SAC',
                'ID_CRMIDENTIFICADOR_SAC',
                'FL_CRMSINCRO_SAC',
                'ST_CEPENTREGA_SAC',
                'ST_ENDERECOENTREGA_SAC',
                'ST_NUMEROENTREGA_SAC',
                'ST_COMPLEMENTOENTREGA_SAC',
                'ST_BAIRROENTREGA_SAC',
                'ST_CIDADEENTREGA_SAC',
                'ST_ESTADOENTREGA_SAC',
                'ST_PONTOREFERENCIAENTREGA_SAC',
                'FL_MESMOEND_SAC',
                'ST_CONTABANCARIA_SAC',
                'ST_AGENCIA_SAC',
                'ST_BANCO_SAC',
                'FL_PAGAMENTOPREF_SAC',
                'ID_FAVORECIDO_FAV',
                'FL_NOTIFICARSMS_SAC',
                'FL_OPTANTESIMPLES_SAC',
                'ST_SUFRAMA_SAC',
                'ST_GATEWAY_SAC',
                'ID_FORMA_FRECB',
                'ST_NOMECARTAO_SAC',
                'ST_TOKENTEMPORARIO_SAC',
                'FL_STATUSCARTAO_SAC',
                'ST_TIDCANCELAMENTO_SAC',
                'DT_TENTATIVACANCELCARTAO_SAC',
                'ST_CAMPOEXTRAGATEWAY_SAC',
                'NM_TENTATIVASCANCELAMENTO_SAC',
                'DT_CONGELAMENTO_SAC',
                'FL_SINCRONIZARSTATUS_SAC',
                'ST_CEI_SAC',
                'FL_BLOQUEIOAUTOIGNORAR_SAC',
                'DT_PENDENTE_SAC',
                'DT_IGNORARSTATUS_SAC',
                'ST_CHAVEALTERACAOCADASTRAL_SAC',
                'FL_TIPODESATIVACAO_SAC',
                'DT_NOTIFICACAODESATIVACAO_SAC',
                'DT_NOTIFICACAOCONGELAR_SAC',
                'VL_TXDESCONTO_SAC',
                'ST_PAIS_SAC',
                'ST_PAISENTREGA_SAC',
                'FL_ENTIDADEPUBLICA_SAC',
                'NM_DIASCARENCIA_SAC',
                'FL_COMPROVANTECONG_SAC',
                'DT_BLOQUEIOAUTO_SAC',
                'NM_VERSAO_SAC',
                'ST_DDD_SAC',
                'VL_TXISSQN_SAC',
                'FL_SINCRONIZARMONGO_SAC',
                'ST_DOCSACADOEX_SAC',
                'FL_NOTAHOMOLOGADO_SAC',
                'FL_NAONOTIFICAR_SAC',
                'ID_CONTACONTABIL_CTC',
                'DT_PROXIMOCONTATOCOBRANCA_SAC',
                'ID_RESPPROXCONTATOCOBRANCA_SAC',
                'NM_QTDTROCACARTAO_SAC',
                'DT_TROCACARTAO_SAC',
                'FL_ESTRANGEIRO_SAC',
                'FL_PORTADORESTRANGEIRO_SAC',
                'FL_REEMBOLSOISSQN_SAC',
                'DT_ALTERACAO_SAC'
            ]
        ],
        'NOTA' => [
            'PK_INDEX' => 1,
            'COLUMNS' => [
                'ID_NOTA_NOT',
                'FL_TIPO_NOT',
                'ST_NUMERO_NOT',
                'FL_STATUS_NOT',
                'ID_CLIENTE_NOT',
                'ID_TRANSPORTADORA_NOT',
                'ID_CFOP_NOT',
                'DT_EMISSAO_NOT',
                'VL_VALOR_NOT',
                'FL_REMESSA_NFE',
                'ST_CHAVEACESSO_NFE',
                'VL_TXISSQN_NOT',
                'VL_TXIRRF_NOT',
                'VL_TXPIS_NOT',
                'VL_TXCOFINS_NOT',
                'VL_TXCONTRIBUICAOSOCIAL_NOT',
                'VL_TXINSS_NOT',
                'VL_TOTALSERVICOS_NOT',
                'VL_TXBASECALC_NOT',
                'VL_BASECALC_NOT',
                'VL_ISSQN_NOT',
                'VL_IRRF_NOT',
                'VL_PIS_NOT',
                'VL_COFINS_NOT',
                'VL_CONTRIBUICAOSOCIAL_NOT',
                'VL_BENEFICIOSOCIAL_NOT',
                'VL_INSS_NOT',
                'VL_TOTALPRODUTOS_NOT',
                'VL_BASEICMS_NOT',
                'VL_ICMS_NOT',
                'VL_BASEICMSSUB_NOT',
                'VL_ICMSSUB_NOT',
                'VL_IPI_NOT',
                'VL_DEDUCOES_NOT',
                'VL_SEGURO_NOT',
                'VL_OUTROSVALORES_NOT',
                'VL_TOTALA_NOT',
                'VL_TOTALB_NOT',
                'VL_TOTALC_NOT',
                'VL_TOTALD_NOT',
                'VL_TOTALE_NOT',
                'VL_TOTALF_NOT',
                'ID_NFELOTE_NOT',
                'ID_NFELOTECANCELAMENTO_NOT',
                'ID_NFSELOTE_NOT',
                'ID_NFSELOTECANCELAMENTO_NOT',
                'ID_CONTA_CB',
                'ST_TRANSPORTADORPLACA_NOT',
                'ST_TRANSPORTADORPLACAUF_NOT',
                'ST_ESPECIEVOLUMES_NOT',
                'ST_MARCAVOLUME_NOT',
                'ST_DADOSADICIONAIS_NOT',
                'ST_NOSSONUMEROA_NOT',
                'ST_NOSSONUMEROB_NOT',
                'ST_NOSSONUMEROC_NOT',
                'ST_NOSSONUMEROD_NOT',
                'ST_NOSSONUMEROE_NOT',
                'ST_NOSSONUMEROF_NOT',
                'ST_NFEASSINATURA_NOT',
                'ST_NFEMENSAGEM_NOT',
                'ST_NFSEASSINATURA_NOT',
                'ST_NFSEMENSAGEM_NOT',
                'ST_NFSEVERIFICADOR_NOT',
                'NM_NUMEROVOLUMES_NOT',
                'NM_DIASPOSVENCIMENTOA_NOT',
                'NM_DIASPOSVENCIMENTOB_NOT',
                'NM_DIASPOSVENCIMENTOC_NOT',
                'NM_DIASPOSVENCIMENTOD_NOT',
                'NM_DIASPOSVENCIMENTOE_NOT',
                'NM_DIASPOSVENCIMENTOF_NOT',
                'NM_CODSERVICO_NOT',
                'NM_VERSAO_NOT',
                'NM_NFSE_NOT',
                'NM_NFE_NOT',
                'TX_NFSEXML_NOT',
                'TX_NFEXML_NOT',
                'FL_NFSESTATUS_NOT',
                'FL_PESSOA_NOT',
                'FL_NFESTATUS_NOT',
                'DT_SAIDA_NOT',
                'NM_RPS_NOT',
                'NM_DANFE_NOT',
                'FL_RETERISSQN_NOT',
                'FL_RETERIRRF_NOT',
                'FL_RETERPIS_NOT',
                'FL_RETERCOFINS_NOT',
                'FL_RETERCONTRIBUICAOSOCIAL_NOT',
                'FL_RETERINSS_NOT',
                'ST_SERIE_NOT',
                'NM_LOTEINTERNO_NOT',
                'FL_CONTAFRETE_NOT',
                'ID_RECEBIMENTO_RECB',
                'ST_URLNFSE_NOT',
                'VL_BASECALCINSS_NOT',
                'VL_BASECALCIRRF_NOT',
                'VL_BASECALCPIS_NOT',
                'VL_BASECALCCOFINS_NOT',
                'VL_BASECALCCSLL_NOT',
                'ID_FILIAL_FIL',
                'VL_DEDUCOESINSS_NOT',
                'VL_DEDUCOESIRRF_NOT',
                'VL_DEDUCOESPIS_NOT',
                'VL_DEDUCOESCOFINS_NOT',
                'VL_DEDUCOESCSLL_NOT',
                'VL_TXPISPRATICADO_NOT',
                'VL_TXCOFINSPRATICADO_NOT',
                'NM_QUANTIDADEVOLUMES_NOT',
                'NM_PESOBRUTOVOL_NOT',
                'NM_PESOLIQUIDOVOL_NOT',
                'ID_ENDERECO_SEN',
                'FL_NATUREZAOPERACAO_NOT',
                'ST_CHAVENFEREFERENCIA_NOT',
                'ST_AMBIENTE_NOT',
                'ST_CHAVEACESSONFSE_NOT',
                'ST_CORRECAO_NOT',
                'NM_VERSAOCORRECAO_NOT',
                'ID_TERCEIRO_NOT',
                'DT_COMPETENCIA_NOT',
                'FL_CONTINGENCIA_NOT',
                'FL_DESCONSIDERARCONTABILIDADE_NOT',
                'ID_PARTIDACONTABIL_PC',
                'ID_PARTIDACONTABILSEMCOBRANCA_PC',
                'DT_CONVERSAO_NOT',
                'DT_CANCELAMENTO_NOT',
                'ST_COMPLEMENTOLANCIGNORADO_NOT',
                'ST_UUID_NOT',
                'ID_EMISSOR_NOT',
                'DT_TRANSMISSAOENVIO_NOT',
                'ST_HASHPARCELAMENTO_RECB',
                'DT_ALTERACAO_NOT'
            ]
        ],
        'NOTA_PRODUTOS' => [
            'PK_INDEX' => 1,
            'COLUMNS' => [
                'ID_NOTA_NOT',
                'ID_PRODUTO_PRD',
                'VL_VALOR_PRD',
                'VL_QUANTIDADE_NPD',
                'ST_COMPLEMENTO_NPD',
                'ST_CSTICMS_NPD',
                'FL_ORIGEMICMS_NPD',
                'FL_MODALIDADEBCICMS_NPD',
                'VL_ALIQUOTAICMS_NPD',
                'FL_MODALIDADEBCSTICMS_NPD',
                'VL_MARGEMVALORADICICMS_NPD',
                'VL_REDUCAOBASECALCSTICMS_NPD',
                'VL_PRECOUNITPAUTASTICMS_NPD',
                'VL_ALIQUOTASTICMS_NPD',
                'VL_REDUCAOBASECALCICMS_NPD',
                'FL_MOTIVODESONERACAOICMS_NPD',
                'VL_BCOPERACAOPROPRIAICMS_NPD',
                'ST_UFPAGAMENTOICMSSTICMS_NPD',
                'VL_ALIQUOTACALCCREDITOICMS_NPD',
                'ST_CSTIPI_NPD',
                'VL_ALIQUOTAIPI_NPD',
                'ST_CSTPIS_NPD',
                'VL_ALIQUOTAPIS_NPD',
                'VL_ALIQUOTAPRODUTOPIS_NPD',
                'VL_ALIQUOTASTPIS_NPD',
                'ST_CSTCOFINS_NPD',
                'VL_ALIQUOTACOFINS_NPD',
                'VL_ALIQUOTAPRODUTOCOFINS_NPD',
                'VL_ALIQUOTASTCOFINS_NPD',
                'ID_CFOP_CFP',
                'VL_BASECALCULOICMS_NPD',
                'VL_BASECALCULOPIS_NPD',
                'VL_BASECALCULOCOFINS_NPD',
                'VL_BASECALCULOIPI_NPD',
                'VL_FRETE_NPD',
                'VL_SEGURO_NPD',
                'ST_CODENQUANDRAMENTOIPI_NPD',
                'VL_ALIQUOTAFCP_NPD',
                'VL_ALIQUOTAINTICMS_NPD',
                'VL_BASECALCULOICMSST_NPD',
                'ST_CONTA_CONT',
                'ID_PLANOCONTA_PLC',
                'ID_PLANOCLIENTE_PLC',
                'NM_PERIODICIDADE_PLA',
                'VL_OUTROSVALORES_NPD',
                'DT_ALTERACAO_NPD'
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
