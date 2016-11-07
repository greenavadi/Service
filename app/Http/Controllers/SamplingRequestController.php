<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SamplingRequest;
use Illuminate\Http\Request;

class SamplingRequestController extends Controller {

    public function index() {
        // not supported as of now.
    }

    public function create() {
        // not supported as of now.
    }

    public function store(Request $request) {
        $userId = 1;
        if ($request->has('samplings')) {
            $samplings = $request->input('samplings');
            $sampling_array = explode(',', $samplings);
            foreach ($sampling_array as $sr) {
                $sr_data = explode(':', $sr);
                $sr = new SamplingRequest;
                $sr->user_id = $userId;
                $sr->sampling_id = $sr_data[0];
                $sr->no_of_samples = $sr_data[1];
                $sr->status = 0;
                $sr->save();
            }

            return $this->sendResponse(0, 'Your request submitted successfully.');
        }
    }

    public function show($id) {
        // not supported as of now.
    }

    public function edit($id) {
        // not supported as of now.
    }

    public function update(Request $request, $id) {
        $sr = SamplingRequest::find($id);

        if ($sr == null) {
            return $this->sendResponse(1, 'No record found for provided key.');
        }

        if ($request->has('status')) {
            $sr->status = $request->input('status');
        }
        $sr->save();
        return $this->sendResponse(0, 'Request status updated successfully.');
    }

    public function destroy($id) {
        // not supported as of now.
    }

}
