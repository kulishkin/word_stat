# Word stats

## Requirements
php 7.4 or above

## Run tests
- Build dev container
    ```
    docker build . --tag php-dev:1
    ```
- Run test
    ```
    docker run --rm -v "$PWD":/usr/projects/app -w /usr/projects/app php-dev:1 composer test
    ```
- Run cs-fixer
    ```
    docker run --rm -v "$PWD":/usr/projects/app -w /usr/projects/app php-dev:1 composer fix
    ```
- Run cover
    ```
    docker run --rm -v "$PWD":/usr/projects/app -w /usr/projects/app php-dev:1 composer cover
    ```
