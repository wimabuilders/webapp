<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index');
    }
}
