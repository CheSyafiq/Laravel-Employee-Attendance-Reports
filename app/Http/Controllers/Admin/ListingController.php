<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\User;
use App\Listing;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ListingRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\MassDestroyListingRequest;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listing = Listing::all();

        return view('admin.listings.index', compact('listing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->pluck('name', 'id');

        return view('admin.listings.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request)
    {
        $listing = Listing::create($request->all());

        return redirect()->route('admin.listing.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        $users = User::all()->pluck('name', 'id');

        return view('admin.listings.edit', compact('listing', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        $listing->update($request->all());

        return redirect()->route('admin.listing.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return back();
    }

    public function massDestroy(MassDestroyListingRequest $request)
    {
        Listing::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();

            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            $success['role_id'] = $user->role_type;

            return response()->json($success, 200);
        }else{
            return response()->json(['error'=>'Unauthorised']);
        }
    }

    public function listing(Request $request)
    {
        $data = $request->only('user_id', 'latitude', 'longitude');
        $validator = Validator::make($data, [
            'user_id' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user_count = Listing::where('user_id', $request->user_id)->count();

        if($user_count){
            $listing_arr = Listing::where('user_id', $request->user_id)->get();
            $listing = [];
            foreach ($listing_arr as $key => $value) {
                $latitudeFrom = $request->latitude;
                $longitudeFrom = $request->longitude;

                $latitudeTo = $value->latitude;
                $longitudeTo = $value->longitude;

                //Calculate distance from latitude and longitude
                $theta = $longitudeFrom - $longitudeTo;
                $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;

                $distance = round(($miles * 1.609344), 2).' km';

                $listing[$key]['id'] = $value->id;
                $listing[$key]['list_name'] = $value->name;
                $listing[$key]['distance'] = $distance;
            }

            $success['listing'] = $listing;
            $success['status'] = [
                'code' => 200,
                'message' => "Listing successfully retrieved"
            ];

            return response()->json($success, 200);
        }else{
            return response()->json(['error'=>'No user id found']);
        }
    }
}
