<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 p-6 md:p-10 font-sans">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
               <h2 class="text-3xl font-extrabold text-indigo-900 uppercase tracking-tight">
    <i class="fas fa-book-open mr-2 text-indigo-600"></i> Course Management
</h2>
<p class="text-gray-500 font-medium">Manage academic courses and assigned instructors.</p>
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
                <i class="fas fa-plus-circle text-indigo-600 mr-2"></i> Register New Course
            </h3>
            
            <form action="{{ route('courses.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1">COURSE CODE</label>
                        <input type="text" name="course_code" placeholder="e.g. CS102" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1">COURSE NAME</label>
                        <input type="text" name="course_name" placeholder="Web Development" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1">ASSIGN TEACHER</label>
                        <select name="teacher_id" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1">DESCRIPTION</label>
                        <input type="text" name="description" placeholder="Brief info" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-900 text-white font-bold rounded-xl py-3.5 px-12 hover:bg-indigo-800 transition shadow-lg">
                        <i class="fas fa-save mr-2"></i> SAVE COURSE
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-indigo-900 text-white">
                    <tr class="text-[11px] uppercase tracking-widest font-black">
                        <th class="p-5">Code</th>
                        <th class="p-5">Course Name</th>
                        <th class="p-5">Teacher</th>
                        <th class="p-5 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($courses as $course)
                    <tr class="hover:bg-indigo-50/50 transition-colors">
                        <td class="p-5 font-bold text-indigo-600">{{ $course->course_code }}</td>
                        <td class="p-5">
                            <div class="font-bold text-gray-900">{{ $course->course_name }}</div>
                            <div class="text-xs text-gray-400 truncate max-w-xs">{{ $course->description }}</div>
                        </td>
                        <td class="p-5 text-gray-700 font-medium">
                            <i class="fas fa-user-circle text-gray-300 mr-1"></i> {{ $course->teacher_name ?? 'Unassigned' }}
                        </td>
                        <td class="p-5">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('courses.edit', $course->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg border border-blue-50 transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Ma hubtaa inaad tirtirto?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg border border-red-50 transition" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-20 text-center text-gray-400 italic">Maaddooyin lama helin.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>