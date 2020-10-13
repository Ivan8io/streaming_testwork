<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function xyzpayment(User $user)
    {
      return view('forms.xyz', [
        'id' => $user->id
      ]);
    }

    public function oldpay(User $user)
    {
      return view('forms.old', [
        'id' => $user->id
      ]);
    }
}
