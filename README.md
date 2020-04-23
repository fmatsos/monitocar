Documentation available here (in French only) : https://docs.monitocar.app/

### Install instructions

You must have PHP 7.4, Composer and Yarn installed.

Run this command to install vendors and assets dependencis, and build assets:

`make install`


If this is the first time you intall application, you must populate database (SQLite for moment).
Run this:

`php bin/console doctrine:schema:create`

Or `php bin/console doctrine:schema:update --force` to update your database schema.

To add basis datas to database, run fixtures with `php bin/console doctrine:fixtures:load`
