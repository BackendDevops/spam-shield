
<?php
namespace AntiSpam\Helpers;

class QuestionGenerator
{
    public static function getRandomQuestion(): string
    {
        $questions = self::getLocalizedQuestions();
        return array_rand($questions);
    }

    public static function getLocalizedQuestions(): array
    {
        $lang = app()->getLocale();
        $questions = config('antispam.random_questions.questions');
        return $questions[$lang] ?? $questions['en'];
    }

    public static function getAnswerForQuestion(string $question): ?string
    {
        $questions = self::getLocalizedQuestions();
        return $questions[$question] ?? null;
    }
}
