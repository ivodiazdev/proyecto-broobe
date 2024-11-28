<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetricHistoryRun;


class MetricHistoryController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $metrics = MetricHistoryRun::with('strategy')->get();
        return view('metricData', compact('metrics'));
    }

    public function saveMetric(Request $request)
    {
        try{
            $categories = $request->input('data.categories');
            $data = [
                'url' => $request->input('data.url'),
                'strategy_id' => $request->input('data.strategy_id'),
            ];
            foreach($categories as $key => $score)
            {
                $key = str_replace('-', '_', $key);
                $key = $key.'_metric';
                $data[$key] = $score;
            }
            $metric = MetricHistoryRun::create($data);

            if($metric)
            {
                $response = [
                    'ok' => true, 
                    'message' => 'Se registro correctamente la metrica'
                ];
            } else {
                $response = [
                    'ok' => false, 
                    'error' => 'Ocurrio un error!', 
                    'details' => 'No se pudo registrar la metrica'
                ];
            }
        } catch (\Throwable $th) {
            $response = [
                'error' => 'Ocurrio un error!',
                'details' => $th->getMessage(),
                'ok' => false
            ];
        }

        return response()->json($response);
    }
}
