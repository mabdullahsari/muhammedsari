<?php declare(strict_types=1);

namespace PreventingSpam;

use CommandBus\Contract\Pipeline;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\AggregateServiceProvider;
use PreventingSpam\Contract\ExecuteAnyway;

final class PreventingSpamServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Clock\ClockServiceProvider::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->app->singleton(ContactMuhammedDetector::class, $this->createContactMuhammedDetector(...));

        $this->app->singleton(DetectorResolver::class, DetectorResolverUsingInflection::class);
        $this->app->singleton(QuarantinedMessageRepository::class, QuarantinedMessageRepositoryUsingSQLite::class);

        $this->app->resolving(Dispatcher::class, $this->configureBus(...));
    }

    private function createContactMuhammedDetector(): ContactMuhammedDetector
    {
        $words = new BlacklistedWordsAnalyzer();

        return new ContactMuhammedDetector(
            email: new BlacklistedEmailsAnalyzer(),
            message: MultiAnalyzer::chain($words, new KeyHeldDownAnalyzer()),
            name: $words,
        );
    }

    private function configureBus(Dispatcher $commands): void
    {
        Pipeline::register(InterceptCommandIfPotentialSpam::class);

        $commands->map([ExecuteAnyway::class => ExecuteAnywayHandler::class]);
    }
}
