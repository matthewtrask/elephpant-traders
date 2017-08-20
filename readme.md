# Elephpant Traders

Code behind elephpanttraders.com. 

This is a WIP, yo.

### Prerequesites 

You must have Vagrant, Composer, NPM, and Yarn available to use on your machine.


### Getting up and running
1. Clone this repo to your local machine
2. Cd into the project directory
3. Run `composer install` from the project root
4. Run `npm install` from project root
5. Run `/vendor/bin/homestead make && vagrant up` to install and start VM.
6. SSH into Vagrant box with `vagrant ssh`
7. Cd into the project, and run our migrations `php artisan migrate`
8. Run `$ php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\JWTAuthServiceProvider"`
8. Run `yarn run dev` to build the front end.
9. On your local, add `homestead.dev 192.168.10.10` to your `/etc/hosts` file.
10. Navigate to `homestead.dev` in a browser. 
