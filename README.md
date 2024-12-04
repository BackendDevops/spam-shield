# Laravel Anti-Spam Package

A comprehensive Laravel package designed to protect your application from spam and bot submissions. This package includes several features like Google reCAPTCHA integration, honeypots, form submission timeouts, and random human answerable questions with multilingual support.

## Features

- **Google reCAPTCHA Integration**: Protect your forms with Google reCAPTCHA to prevent automated submissions.
- **Form Submission Timeout Filter**: Reject submissions that are made too quickly (to filter out bots that submit forms almost instantly).
- **Honeypot Input**: Add a hidden field in your forms that only bots will fill in, rejecting any submissions that have values in these fields.
- **Random Human Answerable Questions**: Display questions that only humans can answer, with support for multiple languages including Turkish.
- **Multilingual Support**: Easily add additional languages for the random questions.
- **Configurable Settings**: All features are configurable through a single configuration file.

## Installation

### Step 1: Install the package via Composer

To install the package, run the following command in your Laravel project:

```bash
composer require kvnc/spam-shield
```
### Step 2: Publish the Configuration File
Once the package is installed, you need to publish the configuration file to your Laravel project:
```bash
php artisan vendor:publish --tag=config --provider="AntiSpam\AntiSpamServiceProvider"
```
This will create the `config/antispam.php` configuration file where you can customize the behavior of the package.

## Configuration
After publishing the configuration file, you can modify the settings for various anti-spam features.

### Google reCAPTCHA
To enable Google reCAPTCHA on your forms, set `enabled` to `true` and add your site and secret keys:
```php
'recaptcha' => [
    'enabled' => true,
    'site_key' => env('RECAPTCHA_SITE_KEY', 'your-site-key'),
    'secret_key' => env('RECAPTCHA_SECRET_KEY', 'your-secret-key'),
],
```
Make sure to add your reCAPTCHA keys to the `.env` file:
```php
RECAPTCHA_SITE_KEY=your-site-key
RECAPTCHA_SECRET_KEY=your-secret-key
```
### Form Submission Timeout Filter
To prevent bots from submitting forms too quickly, enable the timeout filter and set the `minimum_seconds` to a value in seconds:
```php
'timeout' => [
    'enabled' => true,
    'minimum_seconds' => 3, // Minimum time (in seconds) between form load and submission
],
```
### Honeypot Field
 Enable the honeypot feature to add a hidden field to your forms that only bots will fill in. Bots will be rejected if they submit the honeypot field.
 ```php
'honeypot' => [
    'enabled' => true,
    'field_name' => 'hidden_field', // Name of the honeypot field
],
```
### Random Questions
Enable the random questions feature to display a question that only a human can answer. You can customize the questions for each language.
```php
'random_questions' => [
    'enabled' => true,
    'questions' => [
        'en' => [
            'What is 2 + 2?' => '4',
            'What is the capital of France?' => 'Paris',
            'What color is the sky on a clear day?' => 'blue',
        ],
        'tr' => [
            '2 + 2 kaç eder?' => '4',
            'Türkiye’nin başkenti neresidir?' => 'Ankara',
            'Gökyüzü açık bir günde ne renktir?' => 'mavi',
        ],
    ],
],
```
You can add as many languages as needed. The package will automatically display the questions based on the current locale.

## Usage
### Adding to Forms
1. Honeypot Field: Simply include the honeypot field in your form. The field will be hidden from the user, and only bots will fill it.
```blade
<form method="POST" action="/submit">
    @csrf
    @include('antispam::honeypot')
    <label for="random_answer">{{ session('random_question') }}</label>
    <input type="text" name="random_answer">
    <button type="submit">Submit</button>
</form>
```
2. Random Questions: The question will be displayed dynamically, and the answer must be provided in the random_answer field.

## Middleware
The package includes middleware that you can register in `app/Http/Kernel.php` to protect your routes from spam:
```php
'anti-spam' => \AntiSpam\Middleware\AntiSpamMiddleware::class,
```
Apply it to your routes or controllers as needed:
```php
Route::post('/submit', 'FormController@submit')->middleware('anti-spam');
```
## Customizing the Questions
You can easily add more questions or modify existing ones by updating the questions section in the `config/antispam.php` file.

For example, add more questions to the English or Turkish language sections or add a new language.
```php
'questions' => [
    'en' => [
        'What is the square root of 16?' => '4',
        'What is the capital of Germany?' => 'Berlin',
    ],
    'tr' => [
        '16’nın karekökü nedir?' => '4',
        'Almanya’nın başkenti neresidir?' => 'Berlin',
    ],
],
```
## Security Features
- **Google reCAPTCHA: Prevents bots from submitting forms by requiring user interaction.
- **Form Submission Timeout: Rejects submissions that occur too quickly after the form is loaded, which is a common behavior for bots.
- **Honeypot Field: Bots will automatically fill out the hidden field, allowing you to reject them based on the presence of data in this field.
- **Random Questions: Randomly generated human-answerable questions that make it hard for bots to submit forms successfully.

## Contributing
We welcome contributions! If you'd like to contribute to this project, please fork the repository, make your changes, and submit a pull request.

## License
This package is licensed under the MIT License. See the LICENSE file for more information.
