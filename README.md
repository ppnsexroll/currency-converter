# Currency Convert Project 1.0

 ![php](https://img.shields.io/badge/PHP-v7.2.12-red.svg) ![composer](https://img.shields.io/badge/composer-v1.7.2-yellow.svg) ![slim](https://img.shields.io/badge/slim-v3.1-blue.svg)  
## About

API that contains the conversion service that do a conversion between currencies and returns the amount converted
### Setup
  - [Install PHP](PHP)
  - [Install Composer](composer)
  - [Install Docker](docker)
  - [Install Docker Composer](docker-compose)
### Composer Scripts
  - [start](docker-compose-up) - `Will run the application into docker container app`
  - [stop](docker-compose-down) - `Will stop docker container app`
  - [test](phpunit) - `Will run the tests into application`
  - [cs-fix](php-fixer) - `Will fix the php code follow the rules by php-cs-fixer project`
 ### API Documentation
  - Check File: **documentation.swagger**
  - Use this [Swagger UI Editor](swagger-ui-editor) to see all documentation easily
### Packages
  - slim/slim: 3.1
  - monolog/monolog: 1.17
  - rakit/validation: 1.0
  - guzzlehttp/guzzle: ~6.0
  - phpunit/phpunit: >=4.8 < 6.0
  - brainmaestro/composer-git-hooks: 2.6

[PHP]: https://secure.php.net/manual/en/install.php
[composer]: https://getcomposer.org/download/
[docker]: https://docs.docker.com/install/
[docker-compose]: https://docs.docker.com/compose/install/
[documentation]: https://swagger.io
[php-fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer
[phpunit]: https://phpunit.de
[docker-compose-up]: https://docs.docker.com/compose/reference/up/
[docker-compose-down]: https://docs.docker.com/compose/reference/down/
[swagger-ui-editor]: https://editor.swagger.io