AdminPanel
================

Provides a secure and customizable panel for gathering all the tools, projects or bundles stored on a server.
Imagine you have at your disposal a production server with Sonar, Jenkins, RabbitMQ, Satis, PhpMyAdmin...

With this panel you have access all of the management tools you have installed in one place and also you can extend
its functionality via adding new bundles.

## Installation

1.  First download the repository code to your local:

    ``` bash
        cd /path/to/workspace
        git clone git@github.com:nass600/AdminPanel.git
    ```

2.  Create the vhost file in `/etc/apache2/sites-available` directory. We will name it `admin_panel`:

    ``` xml
        <VirtualHost *:80>
            DocumentRoot "/path/to/project/AdminPanel/web"
            ServerName admin.yourcompany.com
            DirectoryIndex app.php

            <Directory "/path/to/project/AdminPanel/web">
                Options Indexes FollowSymLinks Includes ExecCGI
                AllowOverride All
                Order allow,deny
                Allow from all
            </Directory>
        </VirtualHost>
    ```

3. Enable the new site in Apache:

    ``` bash
        sudo a2ensite admin_panel
    ```

4. Add the ServerName to `/etc/hosts` file to be accesible via browser:

    ```
        127.0.0.1	admin.yourcompany.com
    ```

5. Restart Apache:

    ``` bash
        sudo service apache2 restart
    ```

6. Set up the parameters.yml. Copy the included sample file and set your database's parameters inside the new file:

    ``` bash
        cp app/config/parameters.yml.sample app/config/parameters.yml
    ```

7.  Download composer:

    ``` bash
        curl -s https://getcomposer.org/installer | php
        sudo mv composer.phar /user/bin/composer
    ```

8. Run composer to install symfony in your project:

    ``` bash
        cd /path/to/workspace/basic-forms-tutorial
        composer install
    ```

9. Give permissions to your user and the Apache user in order to clean the cache and logs directories:

    ``` bash
        sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
        sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
    ```

10. Clean the cache:

    ``` bash
        app/console cache:clear
    ```

11. Now you should be able to see the welcome page of Symfony2 in the browser on this direction:

    http://basic-forms-tutorial.localhost/app_dev.php


## Configuration


### Adding Tools and Projects

The project configuration must be done via your parameters.yml file so you can install the project in any
environment without dependencies

A fully configured project looks like this:

```yml
    parameters:
        server:
            logo: "/uploads/server-logo.png"
            name: "My server name"
            environment: "production"  # typically: develeopment, pre-production, production...
            ribbon_color: "red"        # values: black, red, blue, green, orange, purple, gray or white
        tools:
            -
                name:  "Jenkins"
                url:   "http://jenkins.yourcompany.com"             # Domain or IP where you have the tool panel
                icon:  "/uploads/tools/jenkins.png"                 # Tool logotype
            -
                name:  "PhpMyAdmin"
                url:   "http://yourcompany.com/phpmyadmin"
                icon:  "/uploads/tools/phpmyadmin.png"
        projects:
            -
                name:  "My Project"
                url:   "http://yourproject.com"
                icon:  "/uploads/projects/my-project.png"
        users:                                                      # List of user who may manage the server
            admin: { password: password, roles: [ 'ROLE_ADMIN' ] }
```


### Adding Bundles

You can also add a bundle to extend the server management functionality. For instance, you could find on github
a bundle for managing cron tasks (https://github.com/michelsalib/BCCCronManagerBundle) or another for system
monitoring (https://github.com/liip/LiipMonitorBundle).

For inserting a bundle, first install it in the project as always. Every bundle comes with installation instructions,
so follow them.

Next, just add a new tool and set the parameter `route` with the routing name of such bundle action you want to point to
instead of a common `url`:

```yml
    parameters:
        tools:
            -
                name:  "Cron Manager"
                route: "BCCCronManagerBundle_index"                 # Main route name where is the bundle's panel
                icon:  "/uploads/tools/logo.png"                    # Bundle logotype if any
```
