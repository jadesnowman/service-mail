<?php

namespace App\Http\Controllers;

use App\Traits\JsonResponse;
use Predis\Client;
use Illuminate\Support\Facades\Redis;

class ExampleController extends Controller
{
    use JsonResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    //
    public function index()
    {
        try {
            $data = Redis::get('foo');

            return response()->json([
                'success' => $data
            ]);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }
}
