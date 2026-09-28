<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Dengarkan log level error/critical → tulis ke log terpisah
        Log::listen(function ($event) {
            if (in_array($event->level, ['error', 'critical'])) {
                file_put_contents(
                    storage_path('logs/alert.log'),
                    '[' . now() . "] [{$event->level}] {$event->message}\n",
                    FILE_APPEND
                );

                // Untuk produksi, kirim ke Slack/email/webhook:
                // Http::timeout(2)->post('https://hooks.slack.com/...', [
                //     'text' => '[INVENTARIS] ' . $event->message,
                // ]);
            }
        });
    }
}
