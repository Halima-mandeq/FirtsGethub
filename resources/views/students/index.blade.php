<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-slate-900">

    <div class="p-6 md:p-12">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                <div class="flex items-center gap-5">
                     <a href="{{ url('/') }}" class="bg-gray-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-gray-700 shadow-md transition-all flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>

                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight uppercase leading-none">Student Directory</h1>
                        <p class="text-slate-500 font-medium italic mt-1">Manage and view all registered students</p>
                    
                    </div>
                </div>


                <a href="{{ route('students.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-black transition shadow-xl flex items-center gap-3 uppercase text-sm w-full md:w-auto justify-center">
                    <i class="fa-solid fa-user-plus text-lg"></i> Add New Student
                </a>
            </div>

            <div class="mb-6">
                <form action="{{ route('students.index') }}" method="GET" class="relative max-w-md">
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                           placeholder="Search by name, ID or email..." 
                           class="w-full bg-white border border-slate-200 py-3 px-12 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm italic text-sm">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-slate-400"></i>
                </form>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="p-6 font-bold uppercase text-[10px] tracking-widest text-slate-300">ID Card</th>
                            <th class="p-6 font-bold uppercase text-[10px] tracking-widest text-slate-300">Student Info</th>
                            <th class="p-6 font-bold uppercase text-[10px] tracking-widest text-slate-300 text-center">Gender</th>
                            <th class="p-6 font-bold uppercase text-[10px] tracking-widest text-slate-300">Class</th>
                            <th class="p-6 font-bold uppercase text-[10px] tracking-widest text-slate-300 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($students as $student)
                        <tr class="hover:bg-blue-50/40 transition duration-150">
                            <td class="p-6">
                                <span class="bg-blue-50 text-blue-700 font-bold px-3 py-1.5 rounded-lg border border-blue-100 text-xs">
                                    #{{ $student->student_id }}
                                </span>
                            </td>

                            <td class="p-6">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800 text-sm leading-tight">{{ $student->name }}</span>
                                    <span class="text-slate-400 text-[11px] italic">{{ $student->email }}</span>
                                </div>
                            </td>

                            <td class="p-6 text-center">
                                <span class="text-xs font-bold text-slate-500 uppercase">{{ $student->gender }}</span>
                            </td>

                            <td class="p-6">
                                <span class="text-blue-600 font-black text-xs uppercase tracking-tighter">{{ $student->class_level }}</span>
                            </td>

                            <td class="p-6">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('students.edit', $student->id) }}" class="text-emerald-500 hover:bg-emerald-50 p-2.5 rounded-xl transition border border-transparent hover:border-emerald-100">
                                        <i class="fa-solid fa-pen-to-square text-lg"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Delete this student permanently?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-400 hover:bg-rose-50 p-2.5 rounded-xl transition border border-transparent hover:border-rose-100">
                                            <i class="fa-solid fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-24 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <i class="fa-solid fa-folder-open text-7xl text-slate-200"></i>
                                    <p class="text-slate-400 font-bold uppercase text-sm tracking-widest">No student records found</p>
                                    <a href="{{ route('students.create') }}" class="text-blue-500 font-bold hover:underline">Register first student</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-between items-center px-4">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                    Total Population: <span class="text-slate-900">{{ $students->count() }} Students</span>
                </p>
            </div>

        </div>
    </div>

</body>
</html>