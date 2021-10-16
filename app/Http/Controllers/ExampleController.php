<?php

namespace App\Http\Controllers;

use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Redis;

class ExampleController extends Controller
{
    use JsonResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //
    public function index()
    {
        try {
            $data = Redis::get('foo');

            return $this->succcess('Success!', $data);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }
}
