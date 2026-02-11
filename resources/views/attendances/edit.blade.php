<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 p-6 md:p-10 font-sans">
    <div class="max-w-2xl mx-auto">
        
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-extrabold text-indigo-900 uppercase tracking-tight">
                <i class="fas fa-edit mr-2 text-indigo-600"></i>Edit Attendance
            </h2>
            <a href="{{ route('attendances.index') }}" class="text-gray-500 hover:text-gray-700 font-bold flex items-center transition">
                <i class="fas fa-times mr-1"></i> Jooji
            </a>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 ml-1">STUDENT NAME</label>
                    <select name="student_id" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $attendance->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 ml-1">COURSE</label>
                    <select name="course_id" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $attendance->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1">DATE</label>
                        <input type="date" name="attendance_date" value="{{ $attendance->attendance_date }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 ml-1">STATUS</label>
                        <select name="status" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                            <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present </option>
                            <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent </option>
                            <option value="Late" {{ $attendance->status == 'Late' ? 'selected' : '' }}>Late</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 ml-1">DESCRIPTION</label>
                    <input type="text" name="description" value="{{ $attendance->description }}" placeholder="Sharaxaad kooban..." class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-indigo-900 text-white font-bold rounded-xl py-3.5 hover:bg-indigo-800 transition shadow-lg uppercase tracking-wider text-sm">
                        <i class="fas fa-sync-alt mr-2"></i> Update Attendance
                    </button>
                    <a href="{{ route('attendances.index') }}" class="flex-1 bg-gray-100 text-gray-600 text-center font-bold rounded-xl py-3.5 hover:bg-gray-200 transition uppercase tracking-wider text-sm">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>