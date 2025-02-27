Docker ubuntu and mysql + laravel setup

checkout and go to cd csv-product/.docker
then  docker-compose up --build -d

go to http://localhost:8081

docker container logs -f ubuntu


commands
docker rm -f $(docker ps -a -q) && docker rmi $(docker images -q) && docker network prune && docker system prune -a -y && docker volume prune -a -y

