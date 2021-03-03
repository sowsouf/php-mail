# Installation


First of all, add this in composer.json
```
"repositories" : {
    ...
    "ssf/php-mail": {
        "type": "vcs",
        "url": "git@github.com:sowsouf/php-mail.git"
    },
    "ssf/php-support": {
        "type" : "vcs",
        "url"  : "git@github.com:sowsouf/php-support.git"
    }
    ...
}
```

Then run in command-line : 

```
composer require ssf/php-mail
```

Finally, in your .env file
```
MAIL_USER=
MAIL_PASSWORD=
MAIL_HOST=
MAIL_PORT=
MAIL_ENCRYPTION=
```

# Usage
```
use Ssf\Mail\Facades\Mail;

Mail::create()
    ->setTo(RECIPIENT_EMAIL)
    ->text("email content"));

```