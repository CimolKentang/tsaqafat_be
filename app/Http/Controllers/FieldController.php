<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use Illuminate\Http\Request;
use App\Models\Field;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FieldController extends Controller
{
  public function index()
  {
    $fields = Field::with('biographies')->latest()->get();

    $response = new DataResource(true, 'Data list fetched!', $fields);

    return response()->json($response, Response::HTTP_OK);
  }

  public function show($id)
  {
    $field = Field::find($id);

    if (!$field) {
      $response = new DataResource(false, 'Data not found!', null);
      return response()->json($response, Response::HTTP_NOT_FOUND);
    }

    $response = new DataResource(true, 'Data fetched!', $field);

    return response()->json($response, Response::HTTP_OK);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required'
    ]);

    if ($validator->fails()) {
      $response = new DataResource(false, $validator->errors(), null);
      return response()->json($response, Response::HTTP_BAD_REQUEST);
    }

    $field = Field::create([
      'name' => $request->name
    ]);

    $response = new DataResource(true, 'Data added!', $field);

    return response()->json($response, Response::HTTP_OK);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required'
    ]);

    if ($validator->fails()) {
      $response = new DataResource(false, $validator->errors(), null);
      return response()->json($response, Response::HTTP_BAD_REQUEST);
    }

    $field = Field::find($id);
    if (!$field) {
      $response = new DataResource(false, 'Data not found!', null);
      return response()->json($response, Response::HTTP_NOT_FOUND);
    }

    $field->update([
      'name' => $request->name
    ]);

    return new DataResource(true, 'Data updated', $field);
  }

  public function destroy($id)
  {
    $field = Field::find($id);

    if (!$field) {
      $response = new DataResource(false, 'Data not found!', null);
      return response()->json($response, Response::HTTP_NOT_FOUND);
    }

    $field->delete();

    $response = new DataResource(true, 'Data deleted!', null);
    return response()->json($response, Response::HTTP_OK);
  }
}
