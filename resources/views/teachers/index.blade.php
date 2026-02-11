<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 p-6 md:p-10 font-sans">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-indigo-900 uppercase tracking-tight">
                    <i class="fas fa-chalkboard-teacher mr-2 text-indigo-600"></i> Faculty Management
                </h2>
                <p class="text-gray-500 font-medium">Add, search, and manage university teachers list.</p>
            </div>
            
            <a href="{{ url('/') }}" class="bg-gray-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-gray-700 shadow-md transition-all flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-xl shadow-sm">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-10">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-plus-circle text-indigo-600 mr-2"></i> Register New Teacher
            </h3>
            <form action="{{ route('teachers.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <input type="text" name="name" placeholder="Full Name" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                    <input type="email" name="email" placeholder="Email Address" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                    <input type="text" name="phone" placeholder="Phone Number" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                    <input type="text" name="subject" placeholder="Primary Subject" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5 items-end">
                    <input type="text" name="address" placeholder="Residential Address" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                    <select name="qualification" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                        <option value="">Qualification</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="PhD">PhD</option>
                    </select>
                    <input type="number" name="salary" placeholder="Salary ($)" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                    <button type="submit" class="bg-indigo-900 text-white font-bold rounded-xl hover:bg-indigo-800 transition shadow-lg py-3.5">
                        <i class="fas fa-save mr-1"></i> SAVE DATA
                    </button>
                </div>
            </form>
        </div>

        <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
            <form action="{{ route('teachers.index') }}" method="GET" class="flex w-full md:w-1/2 gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search teachers..." class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none">
                <button type="submit" class="bg-indigo-600 text-white px-6 rounded-xl font-bold hover:bg-indigo-700 transition">Search</button>
                @if(request('search'))
                    <a href="{{ route('teachers.index') }}" class="bg-gray-100 text-gray-600 px-4 py-3 rounded-xl font-bold">Clear</a>
                @endif
            </form>
            <div class="text-gray-500 font-bold bg-gray-50 px-4 py-2.5 rounded-xl border border-gray-100">
                Total: <span class="text-indigo-600">{{ $teachers->count() }}</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-indigo-900 text-white">
                    <tr class="text-[11px] uppercase tracking-widest font-black">
                        <th class="p-5">Name</th>
                        <th class="p-5">Email</th>
                        <th class="p-5">Phone</th>
                        <th class="p-5">Subject</th>
                        <th class="p-5">Qualification</th>
                        <th class="p-5">Salary</th>
                        <th class="p-5 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($teachers as $teacher)
                    <tr class="hover:bg-indigo-50/50 transition-colors">
                        <td class="p-5 font-bold text-gray-900 capitalize">{{ $teacher->name }}</td>
                        <td class="p-5 text-indigo-600 text-sm italic">{{ $teacher->email }}</td>
                        <td class="p-5 text-gray-600 text-sm font-bold">{{ $teacher->phone }}</td>
                        <td class="p-5 text-gray-700 font-medium">{{ $teacher->subject }}</td>
                        <td class="p-5">
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-[10px] font-black uppercase">
                                {{ $teacher->qualification }}
                            </span>
                        </td>
                        <td class="p-5 font-black text-emerald-600">${{ number_format($teacher->salary, 2) }}</td>
                        <td class="p-5">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg border border-blue-50">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg border border-red-50">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-20 text-center text-gray-400">No data found in the system.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>