<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Get the number of new subscriptions for the current month.
     */
    public function newSubscription()
    {
        $newSubscription = Subscription::where('status', 'active')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        $oldSubscription = Subscription::where('status', 'active')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
        
        $percentageIncrease = $this->percentageIncrease($newSubscription, $oldSubscription);

        $valueSubscription = Subscription::join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->where('status', 'active')
            ->whereYear('subscriptions.created_at', now()->year)
            ->whereMonth('subscriptions.created_at', now()->month)
            ->sum('value');

        $trend = $percentageIncrease > 0 ? 'positive' : ($percentageIncrease < 0 ? 'negative' : 'neutral');
        
        return response()->json([
            'newSubscription' => $newSubscription,
            'oldSubscription' => $oldSubscription,
            'percentageIncrease' => $percentageIncrease,
            'valueSubscription' => number_format($valueSubscription, 2, ',', '.'),
            'trend' => $trend
        ]);
    }

    /**
     * Get the number of new users for the current month.
     */
    public function newUsers()
    {
        $newUsers = User::whereNot('email', 'rootsce@gmail.com') 
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        $oldUsers = User::whereNot('email', 'rootsce@gmail.com') 
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
        
        $percentageIncrease = $this->percentageIncrease($newUsers, $oldUsers);

        $trend = $percentageIncrease > 0 ? 'positive' : ($percentageIncrease < 0 ? 'negative' : 'neutral');
        
        return response()->json([
            'newUsers' => $newUsers,
            'oldUsers' => $oldUsers,
            'percentageIncrease' => $percentageIncrease,
            'trend' => $trend
        ]);
    }

    /**
     * Get the number of new clients for the current month.
     */
    public function newClients()
    {
        $newClients = Client::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        
        $oldClients = Client::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
        
        $percentageIncrease = $this->percentageIncrease($newClients, $oldClients);

        $trend = $percentageIncrease > 0 ? 'positive' : ($percentageIncrease < 0 ? 'negative' : 'neutral');
        
        return response()->json([
            'newClients' => $newClients,
            'oldClients' => $oldClients,
            'percentageIncrease' => $percentageIncrease,
            'trend' => $trend
        ]);

    }

    /**
     * Get the number of new posts for the current month.
     */
    public function newPosts()
    {
        $newPosts = Post::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        
        $oldPosts = Post::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
        
        $percentageIncrease = $this->percentageIncrease($newPosts, $oldPosts);

        $trend = $percentageIncrease > 0 ? 'positive' : ($percentageIncrease < 0 ? 'negative' : 'neutral');
        
        return response()->json([
            'newPosts' => $newPosts,
            'oldPosts' => $oldPosts,
            'percentageIncrease' => $percentageIncrease,
            'trend' => $trend
        ]);
    }

    /**
     * Calculate the percentage increase between two values.
     */
    private function percentageIncrease($newValue, $oldValue)
    {
        if ($oldValue > 0) {
            return (($newValue - $oldValue) / $oldValue) * 100;
        } elseif ($newValue > 0) {
            return 100;
        }
        return 0;
    }
}
