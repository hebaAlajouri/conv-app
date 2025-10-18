<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\FirebaseAnalyticsService;

class FirebaseAnalyticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $eventName;
    protected int $userId;
    protected array $params;

    /**
     * Create a new job instance.
     */
    public function __construct(string $eventName, int $userId, array $params = [])
    {
        $this->eventName = $eventName;
        $this->userId = $userId;
        $this->params = $params;
    }

    /**
     * Execute the job.
     */
    public function handle(FirebaseAnalyticsService $firebaseAnalyticsService): void
    {
        $firebaseAnalyticsService->logEvent($this->eventName, $this->userId, $this->params);
    }
}