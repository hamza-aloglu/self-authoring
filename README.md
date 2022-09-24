# Self Authoring
A text editor for things like task management, journal, todos etc.

## Features

#### Authentication/Authorization
JWT token system is implemented from scratch with the help of [php-jwt](https://github.com/firebase/php-jwt) library.

Email of user is checked at the registration whether if it is deliverable or not with the help of [Emaillable API](https://emailable.com/).

#### Local storage

Users can save their text to browser without logging in using indexedDB browser feature.

#### Backend web API

Backend entry points with requests GET and POST are implemented from scratch.

Routes are registered from controller using attributes with Reflection class

[Routing system](https://github.com/hamza-aloglu/self-authoring/blob/main/app/Router.php) is unit tested with [php-unit](https://phpunit.de/)

------------------------------------------------------------------------------------------------------------------------

[Doctrine](https://www.doctrine-project.org/) is used as ORM and DBAL

<br><br>

Backend: php/mysql

frontend: JS/css
