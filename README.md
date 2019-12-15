# Jake Lehner Coding Exercise

## Installation

Clone the GIT Repo:

```bash
git clone git@github.com:jakelehner/cart-demo.git
cd cart-demo
```

Start the docker containers:

```
docker-compose up -d
```

Once the containers are running, execute the following to initialize the back-end. This script will create the required database tables and seed some products.

> Note: This command will need to be run any time the services are stopped and restarted as this demo does not use persistent storage.

```
docker-compose exec api-php bash init.sh
```

## Accessing the Demo

Once the containers are running and the back-end has been configured, the project can be accesssed using the following URLs:

* Cart Demo: <http://localhost:8081>
* API: <http://localhost:8082>
* API Documentaion: <http://localhost:8083>
