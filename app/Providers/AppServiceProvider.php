<?php

namespace App\Providers;

use App\Policies\NotificationPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
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
        Gate::policy(DatabaseNotification::class, NotificationPolicy::class); // Manual registration policy

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {

            $mailMessage =  (new MailMessage)
                ->subject('Verify Email Address')

                ->view('emails.custom-verify-email', [
                    'url' => $url,
                    'user' => $notifiable,
                ]);

                // $filePath = storage_path('app/public/sample.pdf');

                // $mailMessage->attach($filePath, [
                //     'as' => 'YourFile.pdf', 
                //     'mime' => 'application/pdf',
                // ]);

            return $mailMessage;
        });
    }
}
