<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ProfileResource::collection(Profile::all())->resolve();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = [
            'user_id'     => User::inRandomOrder()->get()->first()->id,
            'first_name'  => fake()->firstName(),
            'second_name' => fake()->lastName(),
            'third_name'  => fake()->name(),
        ];

        return Profile::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return ProfileResource::make($profile)->resolve();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return Response::HTTP_NO_CONTENT;
    }
}
