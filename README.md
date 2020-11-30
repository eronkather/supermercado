# supermercado
Projeto Supermercado

## Como rodar o projeto

Clonar o projeto para a pasta padrão do apache

---
**NOTE**

Não irá rodar em servidor embotido do php pois o projeto reescreve a url no htaccess para recuperar as rotas .

---

O arquivo de configuração do banco de dados é o Config.php

instalar as dependências do projeto com o comando 
```bash
composer install
```
Criar a base de dados
```bash
psql -U postgres -c 'create database supermercado'
``` 
Restaurar o backup do banco
```bash
psql -h localhost -U postgres -d supermercado < supermercado.backup
```
 


## Como instalar e rodar os testes
```bash
./vendor/bin/phpunit --colors tests
```