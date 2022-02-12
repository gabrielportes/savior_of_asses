# Savior of Asses
Scripts para recuperar instruções de `INSERT`, `UPDATE` e `DELETE` de um arquivo binlog.

Se o amiguinho do seu time rodar uma instrução no Banco de Dados sem `WHERE`, isso pode salvar teu bumbum. 

Tem também um script para ler arquivos de emails (no padrão dos emails de reservas), e extrai algumas informações em csv.

### Script para extrair instruções do binlog
Para usar, abra o script com o nome da instrução que deseja buscar e altere os lugares comentados.

Exemplo de execução: `php identificar_inserts | tee resultado_inserts.sql`


### Script para extrair as informações dos emails
- crie uma pasta `emails` na raiz do script e coloque todos os arquivos dentro dela.
- entre na raiz do projeto e rode o seguinte comando no terminal:
```sh
php identificar_emails_reservas.php
```
- Todos os arquivos csv serão gerados dentro da pasta `resultados`.