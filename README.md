<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel Mongo

- **Eloquent Model Class**

```php
<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;//if using softdelets
use MongoDB\Laravel\Eloquent\Prunable; // see more about prunning

class Post extends Model
{
    use SoftDeletes, Prunable;//optional
    //incase you need to overide the default posts collection name
    protected $collection = 'digest_posts';
    //incase you need to overide the default posts_id field collection name
    protected $primaryKey = 'name';
    //MONGO BSON datatypes allows you to cast the datatypes of a document ??optional
    protected $casts = [
        'created_at' => 'datetime',
    ];
    //if tou want to change the connection string
    protected $connection = 'mongodb';
    //for mass assignment
     protected $fillable = [
        'name',
        'body,
        
    ];

    //or 
    protected $guarded=[

    ];

    /*** public function prunable()
    {
        // matches models in which the body field contains a null value
        return static::whereNull('body');
    }
    protected function pruning()
    {
        // Add cleanup actions, such as logging the Planet 'name' attribute
    }**/
}

```
    
    ***Extend the Authenticatable Model***
```php

<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;

class User extends Authenticatable
{
}

//also in the service provider include
MongoDB\Laravel\Auth\PasswordResetServiceProvider::class,

//Auth scaffold
 composer require laravel/ui
//Generate Basic Scaffolding & with Authentication Using Bootstrap
$ php artisan ui bootstrap $ php artisan ui bootstrap --auth

//Generate Basic Scaffolding & with Authentication Using Vue

$ php artisan ui vue $ php artisan ui vue --auth

```
- **Eloquent Model Relationships**

Eloquent RElationships

***One to one relationship***
***A one to many relationship***
***many to many relationship***

```php
/** start one to one*/
<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Posts extends Model
{
    protected $connection = 'mongodb';

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

/*one to many start: One post many comments*/
<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Post extends Model
{
    protected $connection = 'mongodb';

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

//inverse
<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Comment extends Model
{
    protected $connection = 'mongodb';

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

/**end one to many*/

/*start many to many A post can have many contributors/editors and many contributors/editors can contribute to posts*/
<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsToMany;

class Post extends Model
{
    protected $connection = 'mongodb';

    public function editors(): BelongsToMany
    {
        return $this->belongsToMany(Editor::class);
    }
}
//inverse of many to many

<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsToMany;

class Editor extends Model
{
    protected $connection = 'mongodb';

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}

/**end many to many */
```
Use normal retreival and attaching ORM syntax

- **Schema Builder**

Create a Migration Class

```php
//IN THE .env
#DB_CONNECTION=mysql
DB_CONNECTION=mongodb
//Replace the Illuminate\Database\Schema\Blueprint import with MongoDB\Laravel\Schema\Blueprint
//Migration file
<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $collection) {
            $collection->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('posts');
    }
};

```
Conditionally creating schemas
The following example migration creates a stars collection if a collection named telescopes exists:


```php
$hasCollection = Schema::hasCollection('stars');

if ($hasCollection) {
    Schema::create('telescopes');
}
```
[GOOD MEDIUM READS](https://medium.com/@mohammad.roshandelpoor/how-to-use-mongodb-in-laravel-24e615ee68de)

## Issues Encountered 

```php
Class "MongoDB\Driver\Manager" not found

```
Source For a website not running on fpm ensure that you have the mongodb extension within the current apache php version
Problem is when you install MongoDB on a higher cli php version and downgrade there will be a mismatch.

How I fixed it. I changed my Apache PHP to the version that was selected duging mongo installation.

## Creating APIs 

```php
composer require laravel/sanctum

/**
 *  if you plan to utilize Sanctum to authenticate a SPA, you should add Sanctum's middleware to your api middleware group within your application's
 * **/
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],

//php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
// define the API routes
```