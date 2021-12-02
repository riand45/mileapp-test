<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return [
            "success" => true,
            "data" => $packages,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Package::create($data);
        return [
            "success" => true,
            "message" => "Success create",
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::where("_id", $id)->first();

        return [
            "success" => true,
            "data" => ($package === null) ? 'Not found' : $package,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function put(Request $request, $id)
    {
        $package = Package::where('_id', $id)->first();

        if ($package == null) {
            abort(422, 'Package not exist.');
            return false;
        }

        $package->update($request->all());

        return [
            "success" => true,
            "message" => "Success update",
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patch(Request $request, $id)
    {
        $package = Package::where('_id', $id)->first();

        if ($package == null) {
            abort(422, 'Package not exist.');
            return false;
        }

        $package->update([
            'transaction_state' => $request->transaction_state
        ]);

        return [
            "success" => true,
            "message" => "Success update",
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::where('_id', $id)->first();

        if ($package == null) {
            abort(422, 'Package not exist.');
            return false;
        }

        $package->delete();

        return [
            "success" => true,
            "message" => "Success delete",
        ];
    }
}
