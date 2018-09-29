As linguagem utilizadas nesse projeto são PHP com o framework Laravel, e JS com o framework IONIC.
Esse projeto tem como objetivo para o trabalho da faculdade, utilizamos dados fakers para poder alimentar nossa aplicação, o PHP com Laravel irá executar os seeders que chamará as factories e nesse ponto estarei chamando uma biblioteca chamada PHP Faker, com isso o ionic irá consumir as informações e o aplicativo ficara cheio de informações fakers e bem apresentável.  

# Como inicializar o projeto

    git clone https://github.com/jhonatasfender/college-project-third-semester.git
Logo em seguida acesse a pastas `cd college-project-third-semester`

### Estrutura do projeto 
├── backend
│   ├── app
│   ├── artisan
│   ├── bootstrap
│   ├── composer.json
│   ├── composer.lock
│   ├── composer.phar
│   ├── config
│   ├── database
│   ├── package.json
│   ├── package-lock.json
│   ├── phpunit.xml
│   ├── public
│   ├── resources
│   ├── routes
│   ├── server.php
│   ├── storage
│   ├── tests
│   ├── vendor
│   └── webpack.mix.js
├── doc
│   ├── college-project-third-semester.mwb
│   └── college-project-third-semester.mwb.bak
├── front
│   ├── config
│   ├── config.xml
│   ├── ionic.config.json
│   ├── node_modules
│   ├── package.json
│   ├── package-lock.json
│   ├── platforms
│   ├── plugins
│   ├── resources
│   ├── src
│   ├── tsconfig.json
│   ├── tslint.json
│   ├── typings
│   └── www
└── README.md

## PHP 
Acesse o diretório `cd backend/`, estarei partindo do ponto aonde presumo que já tenha o composer instalado em sua maquina, e a versão do PHP necessária para executar o Laravel. 

 - Execute o comando `composer install`
 - Crie uma base de dados com o nome `mysql> create database college-project-third-semester`
 - Execute migation do Laravel `php artisan migrate --seed`
 - E para finalizar `php artisan serve`

## IONIC
Nessa parte partirei do ponto aonde você já tem o minimo para executar o ionic.
 - Acesse o diretório `cd front/`
 - Execute o comando `npm i`
 - E para finalizar `ionic serve`

Caso deseje executar o aplicativo no Android

 - Execute o comando `ionic cordova run --prod --device --optimizejs
`

