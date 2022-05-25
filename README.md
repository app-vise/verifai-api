# PHP Verifai API client

Access Verifai's backend from your server to get access to Verifai result data

## Documentation

### Installation

Install this package via composer

```bash
composer require app-vise/verifai-api
```

### Usage

#### Obtaining OTP

```php
use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\SessionId;
use Appvise\Verifai\Http\VerifaiResponse;
use Appvise\Verifai\VerifaiClientFactory;
use Exception;

$client = VerifaiClientFactory::make('YOUR_VERIFAI_TOKEN_FROM_DASHBOARD');
$body = new Body('your_handover_url_from_config_or_something');
$otp = $this->client->obtainOTP($body);
```

#### Fetch result

```php
use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\SessionId;
use Appvise\Verifai\Http\VerifaiResponse;
use Appvise\Verifai\VerifaiClientFactory;
use Exception;

$client = VerifaiClientFactory::make('YOUR_VERIFAI_TOKEN_FROM_DASHBOARD');
$sessionId = new SessionId('SESSION_ID_GOT_FROM_FRONTEND_RESULT');
$result = $this->client->getResult($sessionId);
```
