<?php declare(strict_types=1);

namespace PreventingSpam;

use Illuminate\Support\ServiceProvider;

final class PreventingSpamServiceProvider extends ServiceProvider
{
    public array $singletons = [DetectorResolver::class => DetectorResolverUsingInflection::class];

    public function register(): void
    {
        $this->app->singleton(ContactMuhammedDetector::class, static function () {
            $words = new BlacklistedWordsAnalyzer();

            return new ContactMuhammedDetector(
                new BlacklistedEmailsAnalyzer(),
                MultiAnalyzer::chain($words, new KeyHeldDownAnalyzer()),
                $words,
            );
        });
    }
}
