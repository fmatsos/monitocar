### Install instructions

You must have PHP 7.4 and Composer installed.
You can use NPM to install assets dependencies, but Yarn is preferable since only yarn.lock is provided for moment.


Run these commands :

`composer install && [yarn|npm] install`


If this is rst time you intall application, launch:

`php bin/console doctrine:schema:create`

Or `php bin/console doctrine:schema:update --force` to update your database schema.

To add basis datas to database, run fixtures with `php bin/console doctrine:fixtures:load`

And finally `[yarn|npm] run build` to compile assets.