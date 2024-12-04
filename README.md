
# Laravel Anti-Spam Package

A Laravel package to prevent spam submissions using Google reCAPTCHA, honeypots, form submission timeouts, and random questions.

## Installation

```bash
composer require vendor/laravel-anti-spam
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=config --provider="AntiSpam\\AntiSpamServiceProvider"
```

## Usage

Include the honeypot in your form:

```blade
<form method="POST" action="/submit">
    @csrf
    @include('antispam::honeypot')
    <label for="random_answer">{{ session('random_question') }}</label>
    <input type="text" name="random_answer">
    <button type="submit">Submit</button>
</form>
```
