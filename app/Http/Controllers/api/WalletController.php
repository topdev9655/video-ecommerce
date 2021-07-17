<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Wallet;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallet = Wallet::all();

        return response(['status' => 'success', 'data' => $wallet], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $find = Wallet::where('user_id', $request->user_id)->get();

        if ($find->count() > 0) {
            $wallet = Wallet::find($find[0]->id);

            $wallet->points = ++$wallet->points;

            $wallet->save();
        } else {
            $wallet = new Wallet;

            $wallet->user_id = $request->user_id;
            $wallet->points = 1;
            $wallet->wallet = 0;
            $wallet->last_claim = null;
            $wallet->last_point_claim = 0;

            $wallet->save();
        }
        return response(['status' => 'success', 'data' => $wallet], 201);
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
        $wallet = Wallet::where('user_id', $id)->get()[0];

        if ($wallet->points > 0) {
            if ($wallet->last_claim == date('Y-m-d') && $wallet->last_point_claim >= '3') {
                $wallet->points = 0;
                $wallet->save();
                
                return response(['status' => 'error', 'message' => 'You have reached the maximum claim today'], 406);
            } else {
                $wallet->wallet = $wallet->wallet + ($wallet->points > 3 ? 3 : $wallet->points);
                $wallet->last_claim = date('Y-m-d');
                $wallet->last_point_claim = $wallet->last_point_claim + $wallet->points <= 3 ? $wallet->last_point_claim + $wallet->points : 3;
                $wallet->points = 0;

                $wallet->save();
                
                return response(['status' => 'success', 'data' => $wallet], 201);
            }
        } else {
            return response(['status' => 'error', 'message' => 'at least 1 point to claim'], 406);
        }
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
    }
}
