<?php

$binlog = new Binlog('./binlog.010630.sql');
$commands = $binlog->getAllCommands('./all_commands_executeds.sql');

class Binlog
{
    const TABLES = [
        'NOME_TABELA' => [
            'PK_INDEX' => 1,
            'COLUMNS' => [
                'COLUNA1'
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
