<p align="center"><a href="https://muhammedsari.me" target="_blank"><img src="https://github.com/mabdullahsari/muhammedsari/blob/master/public/open-graph/ms.png" alt="Muhammed Sari"></a></p>

# Muhammed Sarı's Blog

This is the source code that powers [my blog](https://muhammedsari.me).

## Installation

These steps assume that you use a mac as your development machine and (will use) [Laravel Valet](https://github.com/laravel/valet) for your development environment.

### Binaries

```shell
brew install php node composer redis git
```

### Clone repository

```shell
cd ~/Sites
git clone git@github.com:mabdullahsari/muhammedsari.git
```

> **Note** As of this point, the commands below assume that you're in the project's root.

### Development environment

```shell
composer global require laravel/valet
valet install
valet use php@8.3
```

```shell
cd ~/Sites/muhammedsari
valet link
valet secure muhammedsari
valet isolate php@8.3
```

```shell
pecl install redis
brew services restart redis
brew services restart php
```

### Dependencies

```shell
composer install --no-scripts
npm install
```

### App environment

```shell
cp .env.example .env
php artisan key:generate
```

### Publishing assets

```shell
php artisan horizon:publish
npm run build
```

### Choose your own password

```shell
php artisan tinker --execute "echo bcrypt('YOUR_PW_HERE')" | pbcopy
```

Navigate to `./src/Identity/UserSeeder.php` and update the password hash of the default user.

### Database & migrations

```shell
touch ./database/database.sqlite
php artisan migrate:fresh --seed
```

## Credits

- [Muhammed Sarı](https://github.com/mabdullahsari)
- [Greg Korba](https://github.com/Wirone)
- [Shawn McCool](https://github.com/ShawnMcCool)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
