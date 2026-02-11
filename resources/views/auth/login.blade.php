<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SMS PRO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 flex items-center justify-center h-screen px-4">

    <div class="bg-white/95 backdrop-blur-sm p-10 rounded-[2rem] shadow-2xl w-full max-w-md border border-white/20">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl shadow-lg shadow-blue-500/30 mb-4">
                <i class="fa-solid fa-graduation-cap text-3xl text-white"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tight uppercase">SMS <span class="text-blue-600">PRO</span></h2>
           
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                <p class="text-red-700 text-xs font-bold">{{ $errors->first() }}</p>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            
            <div class="relative group">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2 mb-1 block">Email Address</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition"></i>
                    <input type="email" name="email" placeholder="admin@example.com" 
                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" required>
                </div>
            </div>

            <div class="relative group">
                <div class="flex justify-between items-center mb-1">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2 block">Password</label>
                    <a href="#" class="text-[10px] font-bold text-blue-600 hover:underline">Forgot?</a>
                </div>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition"></i>
                    <input type="password" name="password" placeholder="••••••••" 
                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" required>
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-blue-500/20 transition-all active:scale-[0.98] uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                Login System <i class="fa-solid fa-arrow-right-long text-xs"></i>
            </button>
        </form>

        <div class="mt-10 text-center">
            <p class="text-slate-400 text-[10px] font-medium uppercase tracking-widest">
                &copy; 2026 SMS PRO - All Rights Reserved
            </p>
        </div>
    </div>

</body>
</html>