<?php

namespace Craftbeef\LaravelRdwApi;

use Craftbeef\LaravelRdwApi\exceptions\InvalidEndPointException;
use Craftbeef\LaravelRdwApi\exceptions\InvalidFuelTypeException;
use Craftbeef\LaravelRdwApi\exceptions\InvalidVehicleLicenseException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LaravelRDWApi
{
    protected $endpoints = [
        'vehicles_fuel' => '8ys7-d773',
        'vehicles_classes' => 'kmfi-hrps',
        'vehicles' => 'm9d7-ebf2',
    ];

    protected array $fueltypes = [
        'Diesel',
        'Benzine',
        'Elektriciteit',
        'LPG',
        'Waterstof',
        'LNG',
        'Alcohol',
        'CNG'
    ];

    /**
     * Class constructor.
     *
     * Initializes a new instance of the LaravelRDWApi class.
     * Initializes a new GuzzleHttp\Client instance with the base URI and headers required to access the RDW API.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://opendata.rdw.nl/resource/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-App-Token' => config('laravel-rdw-api.token')
            ],
            'verify' => false,
        ]);
    }

    /**
     * Get a vehicle by license plate.
     *
     * @param string $licenseplate The license plate of the vehicle.
     * @return array The data of the vehicle.
     * @throws InvalidVehicleLicenseException|GuzzleException If the license plate is invalid or the data is empty.
     */
    public function getVehicleByLicenseplate($licenseplate)
    {
        try {
            $url = $this->endpoints['vehicles'] . '.json?kenteken=' . $this->formatLicensePlate($licenseplate);
            $response = $this->client->request('GET', $url);
            $data = json_decode($response->getBody(), true);
            if (empty($data)) {
                throw new InvalidVehicleLicenseException();
            }
            return $data;
        } catch (Exception $e) {
            throw new InvalidVehicleLicenseException();
        }
    }

    /**
     * Format the license plate to uppercase and remove any non-word characters.
     *
     * @param string $licenseplate The license plate to format.
     * @return string The formatted license plate.
     */
    public function formatLicensePlate($licenseplate)
    {
        $licenseplate = strtoupper($licenseplate);
        return preg_replace('/\W/', '', $licenseplate);
    }

    /**
     * Get vehicles by vehicle class.
     *
     * @param string $vehicleClass The vehicle class to search for.
     * @return array The data of the vehicles.
     * @throws GuzzleException If the endpoint is invalid or the data is empty.
     * @throws InvalidEndPointException If the endpoint is invalid or the data is empty.
     */
    public function getVehiclesByVehicleClass($vehicleClass)
    {
        try {
            $url = $this->endpoints['vehicles_classes'] . '.json?voertuigklasse_omschrijving=' . $vehicleClass;
            $response = $this->client->request('GET', $url);
            $data = json_decode($response->getBody(), true);
            if (empty($data)) {
                throw new InvalidEndPointException();
            }
            return $data;
        } catch (Exception $e) {
            throw new InvalidEndPointException();
        }
    }

    //get vehicles by fuel type check if fuel type is valid if not throw InvalidFuelTypeException

    /**
     * Get vehicles by fuel type.
     *
     * @param string $fuelType The fuel type to search for.
     * @return array The data of the vehicles.
     * @throws GuzzleException If the fuel type is invalid or the data is empty.
     * @throws InvalidFuelTypeException If the fuel type is invalid or the data is empty.
     */
    public function getVehiclesByFuelType($fuelType)
    {
        try {
            if (!in_array($fuelType, $this->fueltypes)) {
                throw new InvalidFuelTypeException();
            }
            $url = $this->endpoints['vehicles_fuel'] . '.json?brandstof_omschrijving=' . $fuelType;
            $response = $this->client->request('GET', $url);
            $data = json_decode($response->getBody(), true);
            if (empty($data)) {
                throw new InvalidFuelTypeException();
            }
            return $data;
        } catch (Exception $e) {
            throw new InvalidFuelTypeException();
        }
    }

    /**
     * Get all vehicles.
     *
     * @return array The data of the vehicles.
     * @throws GuzzleException If the endpoint is invalid or the data is empty.
     * @throws InvalidEndPointException If the endpoint is invalid or the data is empty.
     */
    public function getAllVehicles()
    {
        try {
            $url = $this->endpoints['vehicles'] . '.json';
            $response = $this->client->request('GET', $url);
            $data = json_decode($response->getBody(), true);
            if (empty($data)) {
                throw new InvalidEndPointException();
            }
            return $data;
        } catch (Exception $e) {
            throw new InvalidEndPointException();
        }
    }
}
