<?php

namespace App\Providers;

use App\Events\InvoiceCreated;
use App\Events\ProductCreated;
use App\Listeners\NotifyCustomerOfNewInvoice;
use App\Listeners\SendOrderEmailNotification;
use App\Listeners\SendProductEmailNotification;
use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProductCreated::class => [
            SendProductEmailNotification::class,
        ],

/*        InvoiceCreated::class => [
            NotifyCustomerOfNewInvoice::class
        ],*/

     /*   'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'item.created' => [
            'App\Events\ItemEvent@itemCreated',
        ],
     */

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
