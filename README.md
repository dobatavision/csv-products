# Docker Ubuntu and MySQL
# PHP 8.3 / Laravel 

## Setup Instructions

1. Clone the repository and navigate to the `.docker` directory:
   ```bash
   git clone https://github.com/dobatavision/csv-products
   cd csv-products/.docker
   ```

2. Build and start the Docker containers:
   ```bash
   cd csv-products/.docker
   docker-compose up --build -d
   ```
    docker-compose version 1.29.2, build unknown

    docker-py version: 5.0.3

    CPython version: 3.12.3

    OpenSSL version: OpenSSL 3.0.13 30 Jan 2024


3. Access the application at [http://localhost:8081](http://localhost:8081)

4. View the logs of the Ubuntu container:
   ```bash
   docker container logs -f ubuntu
   ```

## Useful Commands

Remove all containers, images, networks, and volumes:
```bash
docker rm -f $(docker ps -a -q) && docker rmi $(docker images -q) && docker network prune && docker system prune -a -y && docker volume prune -a -y
```

## API Endpoints

### Register:
```bash
curl -X POST http://localhost:8081/api/register \
-H "Content-Type: application/json" \
-d '{"name": "user1", "email": "user1@example.com", "password": "123123123", "password_confirmation": "123123123"}'
```

### Login:
```bash
curl -X POST http://localhost:8081/api/login \
-H "Content-Type: application/json" \
-d '{"email": "user1@example.com", "password": "password"}'
```

### Logout:
```bash
curl -X POST http://localhost:8081/api/logout \
-H "Authorization: Bearer {your_token}"
```

### Upload CSV:
```bash
curl -X POST http://localhost:8081/api/upload \
-H "Authorization: Bearer {your_token}" \
-F "file=@/path/to/your/products.csv"
```
### Your Token:
You should copy your access_token from the Body after POST request for Registe or Login:
Example:
```bash
{
    "access_token": "1|rTlWPN89yr9R0AVPHccNEastA7XqFBTfCAGSpnvp3d9cca14",
    "token_type": "Bearer"
}
```
You should use it for value in bearer auth while upload files.
You can use Postman for all request.

## Artisan Commands

```bash
php artisan app:csv_import
php artisan schedule:list
```
