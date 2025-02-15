<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-green-100 to-blue-500">
    <div class="w-full max-w-md bg-white p-8 shadow-xl rounded-2xl border border-gray-200">
        <div class="flex justify-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/609/609061.png" alt="Pharmacy Icon" class="w-16 h-16">
        </div>
        <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">تسجيل الدخول</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input id="email" type="email" name="email" required autofocus class="mt-1 p-3 w-full border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                <input id="password" type="password" name="password" required class="mt-1 p-3 w-full border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
            </div>

            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="flex items-center text-gray-700">
                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 border-gray-300 rounded text-green-600">
                    <span class="ml-2 text-sm">تذكرني</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">هل نسيت كلمة المرور؟</a>
            </div>

            <button type="submit" class="w-full py-3 text-white bg-green-600 hover:bg-green-900 rounded-lg shadow-md transition duration-300">
                تسجيل الدخول
            </button>
        </form>
    </div>
</body>
</html>
