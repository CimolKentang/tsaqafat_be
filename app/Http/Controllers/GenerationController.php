<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\Generation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GenerationController extends Controller
{
    public function index()
    {
      $generations = Generation::get();

      $response = new DataResource(true, 'Data list fetched!', $generations);

      return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'order' => 'required|min:1'
      ]);

      if ($validator->fails()) {
        $response = new DataResource(false, $validator->errors(), null);
        return response()->json($response, Response::HTTP_BAD_REQUEST);
      }

      $generation = Generation::create([
        'name' => $request->name,
        'order' => $request->order
      ]);

      $response = new DataResource(true, 'Data added!', $generation);

      return response()->json($response, Response::HTTP_OK);
    }

    public function show($id)
    {
      $generation = Generation::find($id);

      if (!$generation) {
        $response = new DataResource(false, 'Data not found!', null);
        return response()->json($response, Response::HTTP_NOT_FOUND);
      }

      $response = new DataResource(true, 'Data fetched!', $generation);

      return response()->json($response, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'order' => 'min:1'
      ]);

      if ($validator->fails()) {
        $response = new DataResource(false, $validator->errors(), null);
        return response()->json($response, Response::HTTP_BAD_REQUEST);
      }

      $generation = Generation::find($id);
      if (!$generation) {
        $response = new DataResource(false, 'Data not found!', null);
        return response()->json($response, Response::HTTP_NOT_FOUND);
      }

      $generation->update([
        'name' => $request->name,
        'order' => $request->order
      ]);

      $response = new DataResource(true, 'Data updated!', $generation);
      return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
      $generation = Generation::find($id);

      if (!$generation) {
        $response = new DataResource(false, 'Data not found!', null);
        return response()->json($response, Response::HTTP_NOT_FOUND);
      }

      $generation->delete();

      $response = new DataResource(true, 'Data deleted!', null);
      return response()->json($response, Response::HTTP_OK);
    }
}
