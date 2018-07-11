
# Aplicação Laravel 5.6

Repositório base para aplicação Laravel 5.6.

Contém todos os arquivos necessários para se montar um ambiente virtual (containers Docker), com as seguintes aplicações:

- php-fpm
- nginx
- postgres
- redis
- laravel-echo
- workspace com:
    - nodejs
    - composer
    - laravel 5.6

Baseado no projeto Laradock, release v5.5.4.

## Utilitários

A pasta `./bin` possui diversos scripts utilitários.

Para configurar o projeto, execute:

```
./bin/install
```

Este script deve ser executado uma única vez.

Após a instalação, para iniciar a aplicação, execute:

```
./bin/run
```

## Exemplos

O projeto conta com um exemplo de uso do Laravel Echo + Redis + VueJS