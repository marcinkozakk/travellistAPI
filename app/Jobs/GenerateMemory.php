<?php

namespace App\Jobs;

use App\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class GenerateMemory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $html;
    public $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($html, $user_id)
    {
        $this->html = $html;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('memory')->allow(1)->every(5)->then(function () {
            $path = 'memory/' . uniqid() . '.pdf';

            $pdf = new Mpdf();
            $pdf->WriteHTML($this->html);
            $content = $pdf->Output('', Destination::STRING_RETURN);

            Storage::disk('public')->put($path, $content);
            Notification::create([
                'body' => 'Your memory is ready',
                'user_id' => $this->user_id,
                'concerns_user_id' => $this->user_id,
                'path' => 'public/' . $path
            ]);
        }, function () {
            $this->release(10);
        });


    }
}
