<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student | SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans p-5 md:p-10">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('students.index') }}" class="flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold transition">
                <i class="fa-solid fa-arrow-left"></i> Back to Students List
            </a>
            <h1 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Student Registration</h1>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200 border border-slate-100 overflow-hidden">
            <div class="h-3 bg-blue-600 w-full"></div> <form action="{{ route('students.store') }}" method="POST" class="p-8 md:p-12">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <div>
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Student ID</label>
                        <input type="text" name="student_id" required class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold" placeholder="e.g. STD-1001">
                    </div>

                    <div>
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Full Name</label>
                        <input type="text" name="name" required class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold" placeholder="Enter name">
                    </div>

                    <div>
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Email Address</label>
                        <input type="email" name="email" required class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold" placeholder="student@example.com">
                    </div>

                    <div>
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Class Level</label>
                        <select name="class_level" required class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold cursor-pointer text-slate-600">
                            <option value="">Select Class</option>
                            <option value="Grade 1">Grade 1</option>
                            <option value="Grade 2">Grade 2</option>
                            <option value="Grade 3">Grade 3</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Gender</label>
                        <select name="gender" required class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold cursor-pointer text-slate-600">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold">
                    </div>

                    <div>
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Parent Phone</label>
                        <input type="text" name="parent_phone" class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold" placeholder="+252...">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-2">Address</label>
                        <input type="text" name="address" class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 outline-none transition font-semibold" placeholder="Enter residential address">
                    </div>
                </div>

                <div class="mt-12 flex gap-4">
                    <button type="submit" class="flex-1 bg-blue-600 text-white p-5 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Save Student Data
                    </button>
                    <a href="{{ route('students.index') }}" class="bg-slate-100 text-slate-500 p-5 rounded-2xl font-black uppercase tracking-widest hover:bg-slate-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>