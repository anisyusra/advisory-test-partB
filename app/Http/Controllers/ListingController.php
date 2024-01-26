<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::all();

        return view('auth.listings.index',compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Create the listing associated with the user
        $listing = $user->listings()->create($request->all());

        return redirect()->route('listings.index')
                ->with('success', 'Listing created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('auth.listings.show',compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return view('auth.listings.edit',compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'name'  => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);

        /*DB::table('users')->where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);*/
  
        $listing->update($request->all());
  
        return redirect()->route('listings.index')
                        ->with('success','Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
  
        return redirect()->route('listings.index')
                        ->with('success','Listing deleted successfully');
    }

    public function showLinkGeneratorForm()
    {
        return view('listings.index');
    }

    public function generateLink(Request $request)
    {
        $userId = $request->input('user_id');

        // Validate the input as needed

        // Generate the link based on the user ID
        $link = URL::temporarySignedRoute('listings.get', now()->addMinutes(30), ['userId' => $userId]);

        return view('auth.listings.index', ['generatedLink' => $link]);
    }

    public function getListing(Request $request, $userId)
    {
        $accessToken = $request->input('access_token');

        // Authenticate user based on the provided user_id and access_token
        // This is a simplified example; you may need to implement a more secure authentication mechanism.

        // Check if the user and access token are valid (you should implement your own logic)
        if ($this->isValidUser($userId, $accessToken)) {
            $listings = Listing::where('user_id', $userId)->get(); // Retrieve listings based on your logic

            // Customize the response data structure as needed
            $responseData = [
                'status' => 200,
                'message' => 'Success',
                'result' => [
                    'current_page' => 1,
                    'data' => [],
                ],
            ];

            foreach ($listings as $listing) {
                $responseData['result']['data'][] = [
                    'id' => $listing->id,
                    'name' => $listing->name,
                    'distance' => ($listing->longitude - $listing->latitude),
                    'created_at' => $listing->created_at->toIso8601String(),
                    'updated_at' => $listing->updated_at->toIso8601String(),
                ];
            }

            return response()->json($responseData);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    // Your own logic to check if the user and access token are valid
    private function isValidUser($userId, $accessToken)
    {
        // Implement your own logic here (e.g., check the database)
        // This is a simplified example; you may need to use Laravel Passport or Sanctum for a more robust solution.
        return true;
    }

}

