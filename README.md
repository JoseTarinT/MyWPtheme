# My theme Wordpress Theme

You can run this on the 2pi remote development server.

If you want to run this locally on your machine:

* Install GIT
* Download and install docker and docker-compose ([Docker Desktop](https://www.docker.com/products/docker-desktop) is free and will install both)
* On Windows use WSL2. Use Ubuntu from the Microsoft store and install GIT inside Ubuntu

## Starting up

Follow this to start developing:

1. In a terminal navigate to this directory 

    * In VSCode just press **Control + \`**

2. Run `docker-compose up -d` (This will take a couple of minutes if it's the first time starting it)

    * In VSCode with the docker extension installed, just right click **docker-compose.yml** and click **Compose Up**

3. You'll see the theme running on http://localhost:42235

4. Log in to [wp-admin](http://localhost:42235/wp-admin) with **2pidev** as the username and password

Happy coding!

## SASS and CSS

CSS development on this theme is done with [SASS](https://sass-lang.com/). This allows for developing css with things like variables, functions, nesting and calculations.

The [Bootstrap framework](https://getbootstrap.com/) is used as a basis for SASS. Please check the version in [package.json](package.json) and use the documentation for that version accordingly.

If you update the .scss files in **/theme/sass/** they will get compiled to **/theme/style.css**. The SASS entrypoint file is **/theme/sass/style.scss**.

There are source-maps generated so if you use the browser inspector you can see the original SASS source code even though it's actually minified CSS.

## Development checklist

Please see [CHECKLIST.md](CHECKLIST.md) for items that will be checked in the QAC phase of the website development.

## Database

### Saving a database snapshot:

You can save the database to your local repository with:

```sh
docker exec -i mytheme-db sh -c "mysqldump -umytheme -pj347j903hj4n3 mytheme | gzip" > db/database.sql.gz
```

Commit and push the database file to share it with other people developing the project.

### Loading a database snapshot:

```sh
docker exec -i mytheme-db sh -c "gunzip | mysql -umytheme -pj347j903hj4n3 mytheme" < db/database.sql.gz
```

## Rebuilding docker images

Sometimes this is needed when changing the docker files or the post-install script.

### Rebuild the docker images and keep data:

```sh
docker-compose up -d --build
```

### Rebuild everything:

```sh
docker-compose down -v
docker-compose up -d --build
```

## Development logs

To see the development logs for PHP and SASS development:

```sh
docker-compose logs -f
```

In VSCode with the Docker extension installed you can also right click on the docker-compose group for mytheme and click Compose Logs.

Press **Control + C** to close the log.

## WP-CLI

Log in to the container:

```sh
docker exec -it --user www-data mytheme bash
```

Now you can run your wp commands.

## Releasing the theme

### Automated CI Method (recommended)

Automatically generate a production (optimised) build and upload it to the web server every time you push to the repo.

Set up a GitHub action on a Node/NPM enabled environment that:

1. Runs `./production.sh`
2. Uploads **compiler/theme/** from the repo to **wpcontent/themes/mytheme/** on the web server

(Optional) Set up a cache in CI for the modules folder: **compiler/node_modules**

### ZIP Method

Generate a production build you can upload to a Wordpress instance.

1. Run `./makezip.sh`
2. Navigate to wpadmin on the server you want to release to
3. Remove the theme (you can activate another theme and the delete option will show)
4. Upload the zip file using the Add Theme option in Wordpress
5. Activate the theme
