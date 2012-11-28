AdminPanel
================

Provides a secure and customizable panel for gathering all the tasks you can perform on a server.


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
