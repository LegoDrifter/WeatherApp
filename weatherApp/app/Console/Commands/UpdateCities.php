<?php

namespace App\Console\Commands;

use App\Http\Controllers\WeatherController;
use App\Models\City;
use Illuminate\Console\Command;

class UpdateCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-cities';
    protected $weatherController;


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @param $weatherController
     */
    public function __construct(WeatherController $weatherController)
    {
        parent::__construct();
        $this->weatherController = $weatherController;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cities = City::all();
        foreach ($cities as $city) {
            $data = $this->weatherController->getWeather($city->name);
            if(!$this->weatherController->store($data,'UPDATE')){
                $this->info("City updated successfully");
            }else{
                $this->error("City update failed");
            }

        }
    }
}
