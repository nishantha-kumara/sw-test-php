<?php

namespace App\Http\Controllers;

use App\Repositories\AppRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    private $dataRepository;

    public function __construct(AppRepository $repository)
    {
        $this->dataRepository = $repository;
    }

    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), ['query' => 'required']);

        // validate request [query string exist or not - if not return all the data]
        if ($validator->fails()) {
            return view('index', ['data' => $this->dataRepository->makeDataSet()]);
        }

        // query string is exist, filter data
        return view(
            'index',
            ['data' => $this->dataRepository->filterData($request->get('query'))]
        );
    }
}
