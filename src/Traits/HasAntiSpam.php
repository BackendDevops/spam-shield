
<?php
namespace AntiSpam\Traits;

use AntiSpam\Helpers\QuestionGenerator;

trait HasAntiSpam
{
    public function initializeAntiSpam()
    {
        if (config('antispam.timeout.enabled')) {
            session(['form_start_time' => now()]);
        }

        if (config('antispam.random_questions.enabled')) {
            session(['random_question' => QuestionGenerator::getRandomQuestion()]);
        }
    }
}
