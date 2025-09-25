<?php

namespace App\Http\Controllers;

use App\Models\CashBox;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $cashboxes = CashBox::with(['bookings' => function ($query) {
            $query->orderBy('booking_date', 'desc')->orderBy('id', 'desc')->take(20);
        }, 'bookings.category'])->orderBy('name')->get();
        // inverse the bookings for each cashbox for frontend
        $cashboxes->each(function ($cashbox) {
            $cashbox->bookings = $cashbox->bookings->sortBy([
                ['booking_date', 'asc'],
                ['id', 'asc'],
            ])->values(); // ->values() um die Indizes neu zu setzen
        });
        return view('home', [
            'cashboxes' => $cashboxes,
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Die angegebenen Anmeldeinformationen sind ungültig.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
