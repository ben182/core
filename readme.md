# Core
## A Laravel 5.7 Starter Template

Includes a new Laravel 5.7 installation plus

- PHP-CS-fixer configuration file
- Automatic fix before commit
- Debugbar
- Laravel Telescope
- Laravel Backup
- Laravel IDE Helper
- Hashslug
- Laravel Deployer
- Bugsnag
- Laravel Self Diagnosis
- Backup tasks schedulded through the scheduler
- A new filesystem s3 driver for backups
- Stylelint Config

2 new helper commands:

- Init
    - Command: php artisan init
    - Copies .env.example to .env
    - Generates app key
    - Sets up PHP-CS-fixer automatic fix before commit
- Deploy Infos
    - Command: deploy:infos
    - Sets the app version in the .env file and sends a new release to bugsnag
    - The current git tag will be used as the current version
