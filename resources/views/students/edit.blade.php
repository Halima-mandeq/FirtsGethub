<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans p-10">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-800 uppercase">Edit Student</h1>
                <p class="text-slate-500 italic">Wax ka beddel xogta: {{ $student->name }}</p>
            </div>
            <a href="{{ route('students.index') }}" class="bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-bold hover:bg-slate-300 transition">Back to List</a>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <form action="{{ route('students.update', $student->id) }}" method="POST" class="grid grid-cols-2 gap-6">
                @csrf
                @method('PUT')

                <div class="flex flex-col">
                    <label class="font-bold text-slate-700 text-[10px] uppercase mb-2">Student ID</label>
                    <input type="text" name="student_id" value="{{ $student->student_id }}" class="p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex flex-col">
                    <label class="font-bold text-slate-700 text-[10px] uppercase mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ $student->name }}" class="p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex flex-col">
                    <label class="font-bold text-slate-700 text-[10px] uppercase mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ $student->email }}" class="p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex flex-col">
                    <label class="font-bold text-slate-700 text-[10px] uppercase mb-2">Parent Phone</label>
                    <input type="text" name="parent_phone" value="{{ $student->parent_phone }}" class="p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="col-span-2">
                    <button type="submit" class="w-full bg-blue-600 text-white p-5 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-xl shadow-blue-100">
                        Update Student Info
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>