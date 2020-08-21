<?php

namespace App\Matrix;

use Illuminate\Http\Request;

class Specifications
{
    private $vehicle;

    private $service;

    private $weight;

    private $fee;

    private $initial_fee;

    private $budget;

    private $kilometers;

    public function __construct(Request $request)
    {
        $this->service    = $request->service;
        $this->vehicle    = $request->vehicle;
        $this->weight     = $request->weight;
        $this->budget     = $request->budget;
        $this->kilometers = round($request->kilometers);
    }

    public function initialize()
    {
        if ($this->vehicle == 'motorcycle') {
            if ($this->service == 'padala') {
                if ($this->weight <= 5) {
                    $this->fee         = 8;
                    $this->initial_fee = 70;
                }
                if ($this->weight <= 10 && $this->weight > 5) {
                    $this->fee         = 9;
                    $this->initial_fee = 80;
                }
                if ($this->weight <= 20 && $this->weight > 10) {
                    $this->fee         = 10;
                    $this->initial_fee = 90;
                }
                if ($this->weight > 20) {
                    $this->fee         = 13;
                    $this->initial_fee = 110;
                }
            }
            if ($this->service == 'pabili') {
                $this->fee = 12;
                if ($this->budget < 1500) {
                    $this->initial_fee = 100;
                }
                if ($this->budget > 1501) {
                    $this->initial_fee = 120;
                }
            }
            if ($this->service == 'pa-grocery') {
                $this->fee = 15;
                if ($this->budget < 1500) {
                    $this->initial_fee = 200;
                }
                if ($this->budget <= 3000 && $this->budget > 1500) {
                    $this->initial_fee = 250;
                }
                if ($this->budget > 3000) {
                    $this->initial_fee = 300;
                }
            }
        }

        return $this;
    }

    public function get()
    {
        if ($this->kilometers == 0) {
            return 0;
        }

        return $this->initial_fee + ($this->fee * ($this->kilometers - 3));
    }
}
