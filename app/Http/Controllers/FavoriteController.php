<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display the listing of the user's favorite units.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.index');
        }

        $favorites = $user->units;

        return view('pages.page.favorite', compact('favorites'));
    }

    /**
     * Toggle a unit in the user's favorites.
     */
    public function store(Request $request, string $id)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login.index');
        }

        $unit = Unit::find($id);

        if (!$unit) {
            session()->flash('error', 'Unit not found!');

            return redirect('/favorite');
        }

        if ($user->units->contains($unit)) {
            $user->units()->detach($unit->id);
            session()->flash('success', 'Unit removed from favorites!');

            return redirect()->back();
        }

        $user->units()->attach($unit->id);
        session()->flash('success', 'Unit added to favorites!');

        return redirect()->back();
    }

    /**
     * Remove one unit from the user's favorites.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login.index');
        }

        $unit = Unit::find($id);

        if (!$unit) {
            session()->flash('error', 'Unit not found!');

            return redirect('/favorite');
        }

        $user->units()->detach($unit->id);
        session()->flash('success', 'Unit removed from favorites!');

        return redirect('/favorite');
    }

    /**
     * Remove every unit from the user's favorites.
     */
    public function destroyall()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login.index');
        }

        $user->units()->detach();
        session()->flash('success', 'All favorites removed!');

        return redirect('/favorite');
    }
}
