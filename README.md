# KUR Jogja

## Local Development

This project uses
[Laravel Sail](https://laravel.com/docs/sail) to manage
its local development stack. For more detailed usage instructions take a look at
the [official documentation](https://laravel.com/docs/sail).

### Links

-   **Your Application** http://localhost
-   **Preview Emails via Mailpit** http://localhost:8025
-   **MeiliSearch Administration Panel** http://localhost:7700
-   **MinIO Administration Panel** http://localhost:9000

### Start the development server

```shell
./vendor/bin/sail up
```

You can also use the `-d` option, to start the server in
the background if you do not care about the logs or still want to use your
terminal for other things.

### Build frontend assets

```shell
./vendor/bin/sail npm watch
```

### Run Tests

```shell
./vendor/bin/sail test
```

### Blameable

Readmore: [Blameable](https://github.com/richan-fongdasen/eloquent-blameable)

```
    $table->foreign('created_by')
        ->references('id')->on('users')
        ->onDelete('cascade');

    $table->foreign('updated_by')
        ->references('id')->on('users')
        ->onDelete('cascade');

    $table->foreign('deleted_by')
        ->references('id')->on('users')
        ->onDelete('cascade');
```

### Sanitize user input (NEVER TRUS USER INPUT)

Readmore: [sanitizer](https://github.com/elegantweb/sanitizer)

```
namespace App\Http\Requests;

use Elegant\Sanitizer\Laravel\SanitizesInput;

class MyAwesomeRequest extends Request
{
    use SanitizesInput;

    public function filters()
    {
        return [
            'name' => 'trim|capitalize',
        ];
    }
}
```

### Encrypt sensitive information

#### IMPORTANT WARNING: Protect Your App Key

```
APP_KEY=base64:QikAJAlo0evYLq2RYFxGv/PRrSIfJcNDj2qiFRp1oUs=

```

The encrypted data is lost if you lost or change your APP_KEY

Example:

```
protected $casts = [
    'passport_number' => 'encrypted',
];
```

### Image Optimizer

```
sudo apt-get install jpegoptim
sudo apt-get install optipng
sudo apt-get install pngquant
sudo npm install -g svgo
sudo apt-get install gifsicle
sudo apt-get install webp
sudo apt-get install libavif-bin # minimum 0.9.3
```

sail artisan module:make Testimoni --api && \
sail artisan module:make-request StoreTestimoniRequest Testimoni && \
sail artisan module:make-request UpdateTestimoniRequest Testimoni && \
sail artisan module:make-resource TestimoniCollection --collection Testimoni && \
sail artisan module:make-resource TestimoniResource Testimoni && \
sail artisan module:make-policy TestimoniPolicy Testimoni && \
sail artisan module:make-model Testimoni Testimoni -m
