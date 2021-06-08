<?php

namespace App\Console\Commands;

use App\Http\Controllers\TravelsController;
use App\Jobs\GenerateMemory;
use App\Travel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MemoryYearly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memory:yearly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate yearly memory for travel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->subYear()->toDateString();
        $travels = Travel::where('start_date', '=', $date)
            ->get();

        $controller = app()->make(TravelsController::class);

        Log::debug($travels->count());
        foreach ($travels as $travel) {
            Log::debug($travel->title);
            GenerateMemory::dispatch(
                app()->call(
                    [$controller, 'view'],
                    ['id' => $travel->id])->render(),
                $travel->user_id
            );
        }
    }
}
