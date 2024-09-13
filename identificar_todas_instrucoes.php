<?php

$binlog = new Binlog('./binlog.010630.sql');
$commands = $binlog->getAllCommands('./all_commands_executeds.sql');

class Binlog
{
    const TABLES = [
        'RECEBIMENTO' => 141,
        'COMPO_RECEBIMENTO' => 44
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
        if (!isset(static::TABLES[$table])) {
            throw new Exception('Invalid table name.');
        }

        return static::TABLES[$table] + 1;
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

    protected function getInsertCommand($line, $lineNo, $table, $previousLine, $withTimestamp = true)
    {
        $insert = '';
        $startLine = $lineNo;
        $endLine = $startLine + $this->getCountColumns($table);

        do {
            if ($lineNo >= $startLine) {
                $noHashtag = str_replace(['###', "\n"], ['', ''], $line);
                $replaceVirgula = $noHashtag;

                if ($lineNo != $startLine + 2) {
                    $replaceVirgula = preg_replace('/@\d+=/', ', ', $noHashtag);
                } else {
                    $replaceVirgula = preg_replace('/@\d+=/', '', $noHashtag);
                    $insert = str_replace('SET', ' VALUES (', $insert);
                }

                $insert .= trim($replaceVirgula);
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

    public function getAllCommands(string $writeIntoFile = ''): array
    {
        $lineNo = 0;
        $commands = [];
        $previousLine = '';

        while ($line = fgets($this->binlogFile)) {
            $lineNo++;

            if ($table = $this->isInsert($line)) {
                $command = $this->getInsertCommand(
                    $line,
                    $lineNo,
                    $table,
                    $previousLine,
                    $writeIntoFile
                );

                if ($writeIntoFile) {
                    $this->writeCommandIntoFile($command, $writeIntoFile);
                } else {
                    $commands[] = $command;
                }
            }

            $previousLine = $line;
        }

        fclose($this->binlogFile);

        if ($this->fileToWrite) {
            fclose($this->fileToWrite);
        }

        return $commands;
    }
}
