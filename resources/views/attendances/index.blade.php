<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management | SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 p-6 md:p-10 font-sans">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-indigo-900 uppercase tracking-tight">
                    <i class="fas fa-calendar-check mr-2 text-indigo-600"></i> Student Attendance
                </h2>
                <p class="text-gray-500 font-medium">Record and manage daily student attendance logs.</p>
            </div>
            <a href="{{ url('/') }}" class="bg-gray-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-gray-700 shadow-md flex items-center transition">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-xl shadow-sm">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-10">
            <form action="{{ route('attendances.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1 uppercase text-slate-400">Student Name</label>
                        <select name="student_id" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                            <option value="">-- Select Student --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1 uppercase text-slate-400">Course</label>
                        <select name="course_id" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                            <option value="">-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1 uppercase text-slate-400">Date</label>
                        <input type="date" name="attendance_date" value="{{ date('Y-m-d') }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1 uppercase text-slate-400">Attendance Status</label>
                        <select name="status" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                            <option value="Late">Late</option>
                        </select>
                    </div>

                    <div class="space-y-1 lg:col-span-2">
                        <label class="text-xs font-bold text-gray-500 ml-1 uppercase text-slate-400">Description / Remarks</label>
                        <input type="text" name="description" placeholder="e.g. Doctor's appointment, traffic delay, etc." class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-indigo-900 text-white font-bold rounded-xl py-3.5 px-12 hover:bg-indigo-800 transition shadow-lg uppercase tracking-wider text-sm">
                        <i class="fas fa-save mr-2"></i> Submit Attendance
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-indigo-900 text-white text-[11px] uppercase tracking-widest font-black">
                    <tr>
                        <th class="p-5 text-center">Date</th>
                        <th class="p-5">Student Name</th>
                        <th class="p-5">Course</th>
                        <th class="p-5 text-center">Status</th>
                        <th class="p-5">Description</th>
                        <th class="p-5 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($attendances as $attendance)
                    <tr class="hover:bg-indigo-50/50 transition-colors">
                        <td class="p-5 text-center text-sm font-medium text-gray-600">{{ $attendance->attendance_date }}</td>
                        <td class="p-5 font-bold text-gray-900">{{ $attendance->student_name }}</td>
                        <td class="p-5 text-indigo-600 font-semibold">{{ $attendance->course_name }}</td>
                        <td class="p-5 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase
                                {{ $attendance->status == 'Present' ? 'bg-emerald-100 text-emerald-600' : ($attendance->status == 'Late' ? 'bg-amber-100 text-amber-600' : 'bg-red-100 text-red-600') }}">
                                {{ $attendance->status }}
                            </span>
                        </td>
                        <td class="p-5 text-gray-500 text-xs italic">{{ $attendance->description ?? 'N/A' }}</td>
                        
                        <td class="p-5">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('attendances.edit', $attendance->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg border border-blue-50 transition" title="Edit Entry">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('Delete this attendance record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 p-2 rounded-lg border border-red-50 transition" title="Delete Entry">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-10 text-center text-gray-400 font-medium">
                            <i class="fas fa-info-circle mr-2"></i> No attendance records found for today.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>