<?php

namespace App\Http\Controllers;


use App\Models\Products;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return Products::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required",
            "price" => "required",
            "slug" => "required"
        ]);

        Log::info('Skipping ********************'.PHP_EOL);
        Log::info('This is some useful information.'.PHP_EOL.PHP_EOL, 
            [
                $request->all(),
                $request->url(),
                $request->isMethod('POST'),
                $request->bearerToken(),
                $ipAddress = $request->ip(),
                $request->query(),
                $request->getContent()
            ]
        );
        Log::info(PHP_EOL.PHP_EOL.'Skipping ********************'.PHP_EOL.PHP_EOL);
        // return Products::create($request->all());
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Products::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $products = Products::find($id);
        return $products->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Products::destroy($id);
    }

    /**
     * Search by product name
     * @param str $name
     *@return \Illuminate\Http\Response
     */
    public function search($name){
        return Products::where('name', 'like', '%'.$name.'%')->get();
    }
}
