<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WeatherController;

class FetchCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-city {city}';
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
        $input = $this->argument('city');
        $results = $this->weatherController->getWeather($input);
        if($this->weatherController->store($results, 'CREATE')){
            $this->info("You have entered " . $input);
            $this->info('Information for city ' . $results['name']);
            $this->info('Temp: ' . $results['main']['temp']);
            $this->info('Humidity: ' . $results['main']['humidity']);
            $this->info('Description: ' . $results['weather'][0]['description']);
        }else{
            $this->info("City already exists, please use the update-cities command for updating.");
        }


    }
}
