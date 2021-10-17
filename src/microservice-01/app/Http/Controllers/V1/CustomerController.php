<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Post;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    use JsonResponse;

    public function __construct(Customer $table)
    {
        $this->table = $table;
    }

    public function index()
    {
        try {
            $customers  = $this->table->all()->take(5);
            return $this->succcess('Success!', $customers);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function show($id)
    {
        try {
            $customer  = $this->table->where('CustomerID', $id)->get();
            return $this->succcess('Success!', $customer);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function store(Request $request)
    {
        try {
            $customer = new Post();
            $customer->title    = $request->title;
            $customer->body     = $request->body;
            $customer->slug     = $request->slug;

            $customer->save();

            return $this->succcess('Success!', $customer);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function update(Request $request)
    {
        try {
            $customer = $this->table->find($request->_id);

            $customer->title = $request->title;
            $customer->body = $request->body;
            $customer->slug = $request->slug;
            $customer->save();

            return $this->succcess('Success!', $customer);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $result = $this->table->destroy($request->_id);

            return $this->succcess('Success!', $result);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }
}
