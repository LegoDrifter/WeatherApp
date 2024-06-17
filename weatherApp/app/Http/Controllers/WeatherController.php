<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class WeatherController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return $cities;
    }


    public function store($newCity,$operation)
    {
        $weatherId = $newCity['id'];
        $name = $newCity['name'];
        $temp = $newCity['main']['temp'];
        $humidity = $newCity['main']['humidity'];
        $description = $newCity['weather'][0]['description'];
        $flag = null;

        $cities = City::all();
            foreach ($cities as $city) {
                if($city->weather_id == $weatherId){
                    $flag = true;
                }
            }

        if($flag  && $operation == 'UPDATE'){
            $updateCity = City::find($city->id);
            $updateCity->name = $name;
            $updateCity->temp = $temp;
            $updateCity->humidity = $humidity;
            $updateCity->description = $description;
            $updateCity->save();
            return false;
        }else if($flag && $operation == 'CREATE'){
            return false;
        }
        $storeCity = new City();
        $storeCity->weather_id =  $weatherId;
        $storeCity->name =  $name;
        $storeCity->temp =  $temp;
        $storeCity->humidity =  $humidity;
        $storeCity->description = $description;
        $storeCity->save();
        return $storeCity;
    }

    public function getWeather($city)
    {
        $client = new Client();
        $url = "https://open-weather13.p.rapidapi.com/city/{$city}/EN";

        $response = $client->request('GET', $url, [
            'headers' => [
                'x-rapidapi-host' => 'open-weather13.p.rapidapi.com',
                'x-rapidapi-key' => 'ef234e375fmsh36521d6645af39fp13a294jsne53b5ef46da6',
            ],
            'verify' => false,
        ]);
        $data = json_decode($response->getBody()->getContents(), true);


        return $data;
    }
}
