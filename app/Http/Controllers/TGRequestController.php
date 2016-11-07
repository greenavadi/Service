<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TerraceGardenRequest;
use Illuminate\Http\Request;

class TGRequestController extends Controller {

    public function index() {
        // not supported as of now.
    }

    public function create() {
        // not supported as of now.
    }

    public function store(Request $request) {
        $userId = 1;
        $tgr = new TerraceGardenRequest;
        $tgr->user_id = $userId;
        $tgr->status = 0;
        $tgr->save();
        return $this->sendResponse(0, 'Your request submitted successfully.');
    }

    public function show($id) {
// not supported as of now.
    }

    public function edit($id) {
// not supported as of now.
    }

    public function update(Request $request, $id) {
        $tgr = TerraceGardenRequest::find($id);

        if ($tgr == null) {
            return $this->sendResponse(1, 'No record found for provided key.');
        }

        if ($request->has('status')) {
            $tgr->status = $request->input('status');
        }
        $tgr->save();
        return $this->sendResponse(0, 'Request status updated successfully.');
    }

    public function destroy($id) {
// not supported as of now.
    }

}
