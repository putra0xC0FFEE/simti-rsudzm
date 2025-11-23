<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Room;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware('auth');

$roomCategories = [
    'Rawat Jalan' => 'RJ',
    'Rawat Inap' => 'RI',
    'Ruang Khusus' => 'RK',
    'Penunjang Medis' => 'PM',
    'Administrasi' => 'AM',
    'Penunjang Umum' => 'PU',
    'Sanitasi & Limbah' => 'SL',
];

if (!function_exists('generateRoomCode')) {
    function generateRoomCode(string $category, array $roomCategories): string
    {
        if (!isset($roomCategories[$category])) {
            abort(422, 'Kategori ruangan tidak valid.');
        }

        $prefix = $roomCategories[$category];
        $last = Room::where('room_id', 'like', $prefix . '-%')
            ->orderByDesc('room_id')
            ->first();

        $next = 1;
        if ($last && preg_match('/' . preg_quote($prefix, '/') . '-(\d{2})$/', $last->room_id, $matches)) {
            $next = (int) $matches[1] + 1;
        }

        return sprintf('%s-%02d', $prefix, $next);
    }
}

// ---------------- Pengguna ----------------
Route::get('/pengguna', function (Request $request) {
    $search = $request->query('q');
    $users = User::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
        })
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();

    return view('users.user', compact('users', 'search'));
})->name('users.index')->middleware('auth');

Route::get('/pengguna/tambah', function () {
    return view('users.adduser');
})->name('users.create')->middleware('auth');

Route::post('/pengguna', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
        'role' => ['required', 'in:admin,staff'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    $user = new User($data);

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

Route::get('/pengguna/{encoded}/edit', function (string $encoded) {
    try {
        $username = decrypt($encoded);
    } catch (DecryptException $e) {
        abort(404);
    }
    $user = User::findOrFail($username);
    return view('users.edituser', ['user' => $user, 'encoded' => $encoded]);
})->name('users.edit')->middleware('auth');

Route::put('/pengguna/{encoded}', function (Request $request, string $encoded) {
    try {
        $username = decrypt($encoded);
    } catch (DecryptException $e) {
        abort(404);
    }
    $user = User::findOrFail($username);

    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique('users', 'username')->ignore($user->username, 'username')],
        'role' => ['required', 'in:admin,staff'],
        'password' => ['nullable', 'string', 'min:8'],
    ]);

    if (empty($data['password'])) {
        unset($data['password']);
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
})->name('users.update')->middleware('auth');

Route::delete('/pengguna/{encoded}', function (string $encoded) {
    try {
        $username = decrypt($encoded);
    } catch (DecryptException $e) {
        abort(404);
    }
    $user = User::findOrFail($username);
    $user->delete();
    return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
})->name('users.destroy')->middleware('auth');

// ---------------- Ruangan ----------------
Route::get('/ruangan', function (Request $request) {
    $search = $request->query('q');
    $rooms = Room::query()
        ->when($search, function ($query, $search) {
            $query->where('room_id', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        })
        ->orderBy('room_id')
        ->paginate(20)
        ->withQueryString();

    return view('ruangan.ruangan', compact('rooms', 'search'));
})->name('rooms.index')->middleware('auth');

Route::get('/ruangan/tambah', function () use ($roomCategories) {
    return view('ruangan.addruangan', ['categories' => $roomCategories]);
})->name('rooms.create')->middleware('auth');

Route::post('/ruangan', function (Request $request) use ($roomCategories) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'kategori' => ['required', 'string', Rule::in(array_keys($roomCategories))],
    ]);

    $roomId = generateRoomCode($data['kategori'], $roomCategories);

    Room::create([
        'room_id' => $roomId,
        'kategori' => $data['kategori'],
        'name' => $data['name'],
    ]);

    return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan.');
})->name('rooms.store')->middleware('auth');

Route::get('/ruangan/{encoded}/edit', function (string $encoded) use ($roomCategories) {
    try {
        $roomId = decrypt($encoded);
    } catch (DecryptException $e) {
        abort(404);
    }
    $room = Room::findOrFail($roomId);
    return view('ruangan.editruangan', ['room' => $room, 'encoded' => $encoded, 'categories' => $roomCategories]);
})->name('rooms.edit')->middleware('auth');

Route::put('/ruangan/{encoded}', function (Request $request, string $encoded) use ($roomCategories) {
    try {
        $roomId = decrypt($encoded);
    } catch (DecryptException $e) {
        abort(404);
    }
    $room = Room::findOrFail($roomId);

    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'kategori' => ['required', 'string', Rule::in(array_keys($roomCategories))],
    ]);

    if ($room->kategori !== $data['kategori']) {
        $data['room_id'] = generateRoomCode($data['kategori'], $roomCategories);
    }

    $room->update($data);

    return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diperbarui.');
})->name('rooms.update')->middleware('auth');

Route::delete('/ruangan/{encoded}', function (string $encoded) {
    try {
        $roomId = decrypt($encoded);
    } catch (DecryptException $e) {
        abort(404);
    }

    $room = Room::findOrFail($roomId);
    try {
        $room->delete();
    } catch (QueryException $e) {
        if ($e->getCode() === '23000') {
            return redirect()->route('rooms.index')->with('error', 'Ruangan tidak dapat dihapus karena sedang digunakan. Silakan ubah terlebih dahulu.');
        }
        throw $e;
    }

    return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dihapus.');
})->name('rooms.destroy')->middleware('auth');

// ---------------- Lainnya ----------------
Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/auth/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        return redirect()->intended('/home');
    }

    return back()->withInput($request->only('username'))
        ->withErrors(['username' => 'Username atau password salah']);
})->name('auth.login');

Route::post('/auth/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('success', 'Anda telah keluar.');
})->name('logout')->middleware('auth');
