<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sampling;

class SamplingsController extends Controller {

    public function index() {
        $samplings = Sampling::where('status', '=', '1')->get();
        return $this->sendResponse(0, $samplings);
    }

    public function create() {
        // not supported as of now.
    }

    public function store() {
        //not supported as of now.
    }

    public function show($id) {
        //TODO: for admin;
    }

    public function edit($id) {
        //not supported as of now.
    }

    public function update(Request $request, $id) {
        $sampling = Sampling::find($id);

        if ($sampling == null) {
            return $this->sendResponse(1, 'No record found for provided key.');
        }

        if ($request->has('name')) {
            $sampling->name = $request->input('name');
        }

        if ($request->has('description')) {
            $sampling->description = $request->input('description');
        }

        if ($request->has('status')) {
            $sampling->status = $request->input('status');
        }
        $sampling->save();

        return $this->sendResponse(0, 'Sampling updated successfully.');
    }

    public function destroy($id) {
        //not supported as of now.
    }

}
