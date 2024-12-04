
<?php
namespace AntiSpam\Middleware;

use Closure;
use Illuminate\Http\Request;
use AntiSpam\Helpers\QuestionGenerator;

class AntiSpamMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $config = config('antispam');

        if ($config['honeypot']['enabled']) {
            $field = $config['honeypot']['field_name'];
            if ($request->has($field) && !empty($request->input($field))) {
                abort(403, 'Spam detected.');
            }
        }

        if ($config['timeout']['enabled']) {
            $startTime = session('form_start_time');
            if ($startTime && now()->diffInSeconds($startTime) < $config['timeout']['minimum_seconds']) {
                abort(403, 'Submission too fast.');
            }
        }

        if ($config['random_questions']['enabled']) {
            $question = session('random_question');
            $answer = QuestionGenerator::getAnswerForQuestion($question);
            if (!$answer || $request->input('random_answer') !== $answer) {
                abort(403, __('antispam::messages.incorrect_answer'));
            }
        }

        return $next($request);
    }
}
