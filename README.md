# Savior of Asses
Scripts para recuperar instruções de `INSERT`, `UPDATE` e `DELETE` de um arquivo binlog.

Se o amiguinho do seu time rodar uma instrução no Banco de Dados sem `WHERE`, isso pode salvar teu bumbum. 

### COMO USAR
Para usar, abra o script com o nome da instrução que deseja buscar e altere os lugares comentados.

Exemplo de execução: `php identificar_inserts | tee resultado_inserts.sql`