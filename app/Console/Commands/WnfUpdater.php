<?php

namespace App\Console\Commands;

use App\Models\WnfData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class WnfUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wnf:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var string
     */
    private $startUrl;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->startUrl = 'https://back-wnf.pharm-portal.ru/wnf';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = $this->startUrl;
        DB::beginTransaction();
            do {
                $response = Http::retry(5, 100)->get($url)->json();
                $data = array_map(function ($data) {
                    $data['info_letter'] = json_encode($data['info_letter']);
                    return $data;
                }, $response['data']);
                WnfData::upsert($data, ['id']);
            } while (($url = $response['links']['next'] ?? null));
        DB::commit();
        return 0;
    }
}
