<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'seller')
            ->get();


        return view('sellers.index', compact('sellers'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $seller)
    {
        $services = $seller->services()->paginate(12);

        return view(
            'sellers.show',
            compact(['seller', 'services'])
        );
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
    public function destroy(string $id)
    {
        //
    }
}
