<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About project
**Instalando o projeto**

**Passos para o rodar o projeto localmente(com docker):**

O projeto se utiliza de contêineres Docker, através do pacote *Laravel Sail* para facilitar a configuração do ambiente de desenvolvimento. Portanto, é necessário que já possua o Docker e o Docker Compose instalados na máquina.

Links para instalação e configuração de Docker:

- [Windows](https://docs.docker.com/docker-for-windows/install/)
- [Linux (Debian based)](https://docs.docker.com/engine/install/ubuntu/)



    1. Faça um clone do projeto para sua máquina local
    2. Crie um arquivo `.env`, recomendamos usar `.env-example` como base `cp .env-exemplo .env`
    3. Adicione ou altere as chaves conforme sua necessidade(atenção aos dados do banco de dados)
    4. acesse a pasta do projeto via console (terminal/PowerShell/CMD)
    5. execute o comando:

    ```
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs
    ```

    6. Após finalizado processamento, execute o comando `docker compose up -d`

    O primeiro comando realiza a instalação dos pacotes via composer especificados no arquivo `composer.json` e uma vez que a instalação termina, a pasta *vendor* passa a ficar disponível no projeto. O comando seguinte levanta os contêineres baseado na descrição de serviços feita no arquivo `docker-compose.yml`.

    Por padrão, não é necessária nenhuma configuração no arquivo *.env* do projeto. Caso seja necessária alguma edição na configuração padrão (relacionado a binding ports ou credenciais de banco de dados), basta editar o arquivo *.env*.

    8. Execute a migrate com o seed com comando `php artisan migrate --seed`

    Esse comando ira cria as tabela no banco, lembre de cria o banco de dados com nome que esta especificado no .env, e também popular com dados fake's para facilitar nossos teste. 

    9. para executa o front-end rode `npm run dev`

Se tudo deu certo até aqui já será possivel via api pegar os dados publicos dos artigos do blog.

**roda sem docker**

 - Requisitos minimos:
    - php82
    - composer 
    - node 

    1. Faça um clone do projeto para sua máquina local
    2. Crie um arquivo `.env`, recomendamos usar `.env-example` como base `cp .env-exemplo .env`
    3. Adicione ou altere as chaves conforme sua necessidade(atenção aos dados do banco de dados)
    4. acesse a pasta do projeto via console (terminal/PowerShell/CMD)
    5. execute o comando:

    ``` 
    composer install 
    ```
    6. crie o banco de dados no seu MySQL com as especificações iguais do .env e rode o comando a seguir para cria as tabelas e popular com dados fake's
    ``` 
    php artisan migrate --seed
    ```
    7. Se tudo deu certo até aqui já será possivel via api pegar os dados publicos dos artigos do blog.

    8. rode o comando para roda toda enginer do Vue.js com Inertia.js do sistema de controle do blog:
    ``` 
    npm run dev
    ```


***observação***

Se tudo de certo o sistema irá cria um usuário padrão inicial, mas vocês tambem pode ser registra.


**Material de Apoio**

[documentação da API no postman](https://documenter.getpostman.com/view/7296995/2sAY4rGRZD)



**contato**

jlbnunes@live.com

[whatsapp](https://api.whatsapp.com/send/?phone=5521983425387&text=""&type=phone_number&app_absent=0)


Se quser sabe mais ou teve algum problema, só me fala!
