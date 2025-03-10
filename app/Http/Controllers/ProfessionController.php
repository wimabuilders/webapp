<?php

namespace App\Http\Controllers;

use App\Models\ProfessionUser;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function destroy(ProfessionUser $profession)
    {
        $profession->delete();
        return redirect()->route('professions.index');
    }
}
