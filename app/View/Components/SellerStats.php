<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class SellerStats extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public User $seller)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        /**
         * @var Illuminate\Database\Eloquent\Collection
         * */

        $services = $this->seller->services;

        $numberOfOrders = $services->flatMap(function ($service) {
            return $service->orders;
        })->count();

        $numberOfDoneOrders = $services->flatMap(function ($service) {
            return $service->orders->where('status', 'done');
        })->count();

        $numberOfPositiveReviews = $services->flatMap(function ($service) {
            return $service->orders->where('review_type', 'positive');
        })->count();

        $numberOfNegativeReviews = $services->flatMap(function ($service) {
            return $service->orders->where('review_type', 'negative');
        })->count();

        return view(
            'components.seller-stats',
            compact([
                'numberOfOrders',
                'numberOfDoneOrders',
                'numberOfPositiveReviews',
                'numberOfNegativeReviews'
            ])
        );
    }
}
