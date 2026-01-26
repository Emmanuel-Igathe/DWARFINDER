<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Dwarfinder</title>
    <style>
        body { background: #1a202c; color: white; padding: 20px; font-family: Arial; }
        .container { max-width: 800px; margin: 0 auto; }
        .success-box { background: #2d3748; padding: 30px; border-radius: 10px; }
        h1 { color: #8b5cf6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-box">
            <h1>🎉 Registration Successful!</h1>
            <p>Welcome to Dwarfinder, {{ $user->profile->display_name ?? $user->name }}!</p>
            <p>Email: {{ $user->email }}</p>
            <p>Profile created: {{ $user->profile ? 'Yes' : 'No' }}</p>
            <p>Preferences created: {{ $user->preferences ? 'Yes' : 'No' }}</p>
            
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                @csrf
                <button type="submit" style="background: #e53e3e; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>