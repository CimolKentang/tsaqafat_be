<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\Biography;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BiographyController extends Controller
{
  public function index()
  {
    $biographies = Biography::with('fields', 'generation')->latest()->get();

    $response = new DataResource(true, 'Data list fetched!', $biographies);

    return response()->json($response, Response::HTTP_OK);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'generation_id' => 'required',
      'field_ids' => 'required',
      'name' => 'required',
      'death' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      $response = new DataResource(false, $validator->errors(), $request->all());
      return response()->json($response, Response::HTTP_BAD_REQUEST);
    }

    $biography = Biography::create([
      'generation_id' => $request->generation_id,
      'name' => $request->name,
      'birth' => $request->birth,
      'death' => $request->death,
      'description' => $request->description,
    ]);

    $biography->fields()->attach($request->field_ids);

    $response = new DataResource(true, 'Data added!', $biography->load('fields', 'generation'));

    return response()->json($response, Response::HTTP_OK);
  }

  public function show($id)
  {
    $biography = Biography::with('fields')->find($id);

    if (!$biography) {
      $response = new DataResource(false, 'Data not found!', null);
      return response()->json($response, Response::HTTP_NOT_FOUND);
    }

    $response = new DataResource(true, 'Data fetched!', $biography);

    return response()->json($response, Response::HTTP_OK);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'field_id' => 'required',
      'name' => 'required',
      'death' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $biography = Biography::find($id);

    $biography->update([
      'field_id' => $request->field_id,
      'name' => $request->name,
      'birth' => $request->birth,
      'death' => $request->death,
      'description' => $request->description,
      'works' => $request->works
    ]);

    return new DataResource(true, 'Success', $biography->load('fields'));
  }

  public function destroy($id)
  {
    $biography = Biography::find($id);

    $biography->delete();

    return new DataResource(true, 'Data deleted!', null);
  }
}
