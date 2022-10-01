<?php

namespace App\Providers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class RedirectResponseMessageMacrosServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        foreach ([
            'messages' => 'withMessages',
            'alerts' => 'withAlerts',
        ] as $key => $macro) {
            RedirectResponse::macro($macro, function (mixed $messages) use ($key) {
                $messages = $messages instanceof Collection
                    ? $messages->toArray()
                    : $messages;

                if (! is_array($messages)) {
                    $messages = [$messages];
                }

                return $this->with($key, $messages);
            });
        }
    }
}
