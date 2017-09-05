# Elephpant Traders

[![Travis](https://img.shields.io/travis/rust-lang/rust.svg)](github.com/matthewtrask/elephpant-traders) [![Code Climate](https://img.shields.io/codeclimate/github/kabisaict/flow.svg)](github.com/matthewtrask/elephpant-traders)

Code behind elephpanttraders.com. 

This is a WIP, yo.

### Prerequesites 

You must have Vagrant 1.9.0+, PHP 7, Composer, NodeJS 6+, NPM, and Yarn available to use on your machine.


### Getting up and running
1. Clone this repo to your local machine
2. Cd into the project directory
3. Run `composer install` from the project root
4. Run `npm install` from project root
5. Copy `.env.example` to `.env`
6. Run `/vendor/bin/homestead make && vagrant up` to install and start VM.
7. SSH into Vagrant box with `vagrant ssh`
8. Cd into the project, and run our migrations `php artisan migrate`
9. Run `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\JWTAuthServiceProvider"`
10. Run `php artisan key:generate` to generate a new application key
11. Run `yarn run dev` to build the front end.
12. On your local, add `homestead.dev 192.168.10.10` to your `/etc/hosts` file.
13. Navigate to `homestead.dev` in a browser. 
