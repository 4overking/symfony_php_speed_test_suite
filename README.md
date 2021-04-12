Symfony and PHP speed test suite (Draft)
===================

### :arrow_down: Installation

1. Clone project
    ```bash
    git clone git@github.com:4overking/symfony_php_speed_test_suite.git

2. Run containers
    ```bash
    make up (on windows: docker-compose up -d --build)

2. Install dependencies and load fixtures
    ```bash
    make console (on windows: docker-compose exec php bash)
    composer install
    bin/console doctrine:fixtures:load

### :triangular_ruler: Test results (Not Completed)
   * php8 web       - Requests per second:    853.18 [#/sec] (mean)
   * php8 workerman - Requests per second:    828.70 [#/sec] (mean)
   * php8 swoole    - Requests per second:    794.48 [#/sec] (mean)