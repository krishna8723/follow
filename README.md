# Laravel 5 - Twitter-Like-Following

This is an easy and simple package to implement twitter-like-following in laravel 5 applications.  

## Installation

1 - Require Via Composer

``` bash
 composer require frantz/follow
```

2 - Add service provider to the providers' array in the `config\app.php` file.
```php
providers = [
	...
	Frantz\Follow\FollowServiceProvider::class,
	...
];
```
3 - Add the trait to your `User.php` class :

```php
<?php
namespace App;

use Frantz\Follow\Traits\FollowTrait;

class User extends Authenticateble
{
	use FollowTrait;
}
```
4 - Finally, migrate to database ( This automatically migrates a migration file that creates a 'follows' table ):

```bash
php artisan migrate
```

## Available Methods

####Follow a user - Method returns (bool)true .
```php
$user->follow();
```
####Unfollow a user - Method returns (bool)true .
```php
$user->unfollow();
```
####Get all users following `$user` - Method returns a collection of user models .
```php
$user->all_followers();
```
####Get all users `$user` is following - Method returns a collection of user models .
```php
$user->all_following();
```
####Get an array of all user ids following `$user` - Method returns an array of integers .
```php
$user->all_followers_ids();
```
####Get an array of all user ids `$user` is following - Method returns an array of integers .
```php
$user->all_following_ids();
```
####- Check if `$user` is following a user with id = $userId - Method returns ( bool ) true or false.
```php
$user->is_following($userId);
```
####- Check if `$user` is followed by user with id = $userId - Method returns ( bool ) true or false.
```php
$user->is_followed_by($userId);
```
####- Get number of followers of `$user` - Method returns integer.
```php
$user->all_followers_count();
```
####- Get number of users `$user` is following - Method returns integer.
```php
$user->all_following_count();
```




## Credits

- Frantz-Vallie

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
