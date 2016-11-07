<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GeneralContent;

class GeneralContentsController extends Controller {

    public function index() {
        $gc = GeneralContent::all();
        return $this->sendResponse(0, $gc);
    }

    public function create() {
        // not supported as of now.
    }

    public function store() {
        // not supported as of now.
    }

    public function show($id) {
        $gc = GeneralContent::find($id);
        if ($gc == null) {
            return $this->sendResponse(1, 'Content not available');
        } else {
            return $this->sendResponse(0, $gc);
        }
    }

    public function edit($id) {
        // not supported as of now.
    }

    public function update(Request $request, $id) {
        $gc = GeneralContent::find($id);

        if ($gc == null) {
            return $this->sendResponse(1, 'No record found for provided key.');
        }

        if ($request->has('content')) {
            $gc->content = $request->input('content');
        }
        $gc->save();

        return $this->sendResponse(0, 'Content updated successfully.');
    }

    public function destroy($id) {
        // not supported as of now.
    }

}
