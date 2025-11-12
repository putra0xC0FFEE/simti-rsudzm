<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/mdm', function () {
    return view('masda');
})->middleware('auth');

// Daftar pengguna
Route::get('/pengguna', function () {
    $users = User::orderBy('name')->paginate(10);
    return view('users.user', compact('users'));
})->name('users.index')->middleware('auth');

// Form tambah pengguna
Route::get('/pengguna/tambah', function () {
    return view('users/adduser');
})->name('users.create')->middleware('auth');

// Simpan pengguna baru
Route::post('/pengguna', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
        'role' => ['required', 'in:admin,staff'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    // Password akan otomatis di-hash oleh cast di model User
    $user = new User($data); // email tidak fillable
    // Jika kolom email ada, set email dummy unik; jika tidak ada, lewati
    if (Schema::hasColumn('users', 'email')) {
        $base = strtolower(preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $data['username']));
        $email = $base . '@example.local';
        $i = 1;
        while (User::where('email', $email)->exists()) {
            $email = $base . "+$i@example.local";
            $i++;
        }
        $user->email = $email;
    }
    $user->save();

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
})->name('users.store')->middleware('auth');

// Halaman edit pengguna (id via query ?id=)
Route::get('/pengguna/edit', function (Request $request) {
    $user = User::findOrFail($request->query('id'));
    return view('users.edituser', compact('user'));
})->name('users.edit')->middleware('auth');

// Update pengguna
Route::put('/pengguna/{user}', function (Request $request, User $user) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique('users', 'username')->ignore($user->id)],
        'role' => ['required', 'in:admin,staff'],
        'password' => ['nullable', 'string', 'min:8'],
    ]);

    if (empty($data['password'])) {
        unset($data['password']);
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
})->name('users.update')->middleware('auth');

// Hapus pengguna
Route::delete('/pengguna/{user}', function (Request $request, User $user) {
    $user->delete();
    return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
})->name('users.destroy')->middleware('auth');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::get('/auth/login', function () {
    return view('auth/login');
})->name('login');

// Proses login (POST, sembunyikan kredensial dari URL)
Route::post('/auth/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required','string'],
        'password' => ['required','string'],
    ]);

    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        return redirect()->intended('/home');
    }

    return back()->withInput($request->only('username'))->with('error', 'Username atau password salah.');
})->name('auth.login');

// Logout (POST)
Route::post('/auth/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('success', 'Anda telah keluar.');
})->name('logout')->middleware('auth');

// (Opsional) redirect jalur lama ke baru
Route::get('/pengguna/daftar', function () {
    return redirect()->route('users.index');
})->middleware('auth');
