
<?php
return [
    'recaptcha' => [
        'enabled' => true,
        'site_key' => env('RECAPTCHA_SITE_KEY', ''),
        'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),
    ],
    'timeout' => [
        'enabled' => true,
        'minimum_seconds' => 3,
    ],
    'honeypot' => [
        'enabled' => true,
        'field_name' => 'hidden_field',
    ],
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
];
