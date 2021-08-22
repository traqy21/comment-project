# Comments System
##### Prepared By: Aries Jay Traqueña

The API is written in the Laravel PHP Framework.
See laravel.com/docs for the Laravel documentation.

## Requirements

- [Docker](https://docs.docker.com/engine/install/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## API Project Setup 

#### 1. Navigate to api folder. Copy .env.example to .env file

```bash 
cd api
cp .env.example .env
```

#### 2. Start the Docker environment.

```bash
docker-compose build
docker-compose up -d 
```

#### 3. To initiate the project. Run the following commands:

```bash  
docker-compose exec api infrastructure/dev/scripts/initiate-project.sh 
```
 
#### Running all tests:
```bash
docker-compose exec api vendor/phpunit/phpunit/phpunit
``` 

#### Entering to docker container:
```bash
docker-compose exec api bash
``` 

##### The api runs in: http://localhost:8080

##


## Frontend Project setup

The Frontend is written in VueJs Framework.

#### 1. Navigate to frontend folder. Copy .env.example to .env file

```bash 
cd frontend
cp .env.example .env
```

#### 2. Run command npm install
```
npm install
```

#### 3. Compiles and hot-reloads for development
```
npm run serve
```

#### Compiles and minifies for production
```
npm run build
```

#### Lints and fixes files
```
npm run lint
```

##### The project runs in: http://localhost:8081