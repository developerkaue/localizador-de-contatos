# Nome do Projeto

Localizador de contatos.

## Sobre

O sistema consiste em auxiliar o usuario a encontrar determinados contatos atraves do googlemaps.
Consumindo uma api de cadastro e tambem de gerenciamento, integrando com viacep e maps da google para facilitar
a utilizacao das funcionalidades, utilizando tokens para autenticacao e validacao do usuario.

## Funcionalidades


- Cadastro de usuários
- Login e autenticação
- Gerenciamento de contatos
- Sistema de Ajuda para Endereço
- Filtro de Contatos
- Integração com GoogleMaps
- Exclusão de Conta

## Tecnologias Utilizadas

Liste as tecnologias e ferramentas principais que você usou no desenvolvimento do projeto. Por exemplo:

- [Laravel](https://laravel.com/)
- [MySQL](https://www.mysql.com/)
- [Docker](https://www.docker.com/)
- [Tailwind](https://tailwindcss.com/)

## Instalação

Passos para instalar o projeto localmente.

1. Clone o repositório
    ```bash
    git clone https://github.com/developerkaue/localizador-de-contatos.git
    ```
2. Navegue até o diretório do projeto
    ```bash
    cd localizador-de-contatos
    ```
3. Instale as dependências do Composer
    ```bash
    composer install
    ```
4. Instale as dependências do NPM
    ```bash
    npm install
    ```
5. Instale as dependências do Docker
    ```bash
    sudo apt install apt-transport-https ca-certificates curl software-properties-common

    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

    echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

    sudo apt update

    apt-cache policy docker-ce

    sudo apt install docker-ce

    sudo systemctl status docker
    ```
6. Instale as dependências do php
    ```bash
    sudo apt install php libapache2-mod-php

    sudo apt install php-cli


    ```          

## Configuração

Passos para configurar o projeto após a instalação.

1. Rode o docker-compose
    ```bash
    docker-compose up -d
    ```
2. Rode a migrate
    ```bash

    php artisan migrate

    Observacao: Se caso houver um erro informando que a tabela users ja existe, abra seu gerenciador mysql e de um drop na tabela e rode a migrate novamente e tudo ira funcionar.

    ```
3. Configure o arquivo `.env` com suas credenciais de banco de dados e outras configurações necessárias.


## Uso

Instruções para executar o projeto.

1. Inicie o servidor de desenvolvimento
    ```bash
    php artisan serve
    ```

2. Acesse o projeto em seu navegador
    ```
    http://localhost:8000
    ```

## Testes

Instruções para rodar os testes.

1. Execute os testes
    ```bash
    php artisan test
    ```

## Contribuição

Instruções sobre como contribuir para o projeto.

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/sua-feature`)
3. Faça commit das suas alterações (`git commit -m 'Adicionei uma nova feature'`)
4. Faça push para a branch (`git push origin feature/sua-feature`)
5. Abra um Pull Request

## Licença

Sistema criado para comprovar minha experiencia em Laravel e integracoes com API`S