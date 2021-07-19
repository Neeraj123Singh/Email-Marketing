<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Utilities\ContainerUtility;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Container;
use phpDocumentor\Reflection\Type;

class ActivateCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $container, $data;

    /**
     * Create a new job instance.
     *
     * @param Container $container
     * @param $data
     */
    public function __construct(Container $container, $data)
    {
        $this->container = $container;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        Log::info('INSIDE JOB');
        //Log::info($this->container->service);
        //Log::info(json_encode($this->data));
        //Log::info(json_encode($this->container));
        $temp = DB::transaction(
            function () {
                $audiences = $this->container->connnectedContainers()->get(['id']);
//                Log::info('audiences: ');
//                Log::info(json_encode($audiences));
                foreach ($audiences as $audience) {
//                    Log::info('audience: ');
//                    Log::info(json_encode($audience->contacts()));
                    Log::info(gettype($audience));
                    $c = ContainerUtility::find($this->container->brand, $audience->pivot->container_id, 'id',[]) ;
//                    Log::info('container found');
//                    Log::info(json_encode($c));
                    $aud_service  = $c->service;
                    Log::info($aud_service);
                    Log::info($aud_service->contacts);

//                    $ccc = $aud_service->contacts();
//                    Log::info($ccc);
//                    foreach ($aud_service as $contact) {
//                        $tmp = $contact->contacts()->get();
//                        Log::info(json_encode($contact));
//                    }
                }
            }
        );
    }
}
