<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Management | SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 p-6 md:p-10 font-sans text-slate-900">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-indigo-900 uppercase tracking-tight">
                    <i class="fas fa-user-plus mr-2 text-indigo-600"></i> Course Enrollment
                </h2>
                <p class="text-gray-500 font-medium">Register students for new courses and manage tuition fees.</p>
            </div>
            <a href="{{ url('/') }}" class="bg-gray-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-gray-700 shadow-md flex items-center transition">
                <i class="fas fa-house mr-2"></i> Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-xl shadow-sm">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-10">
            <form action="{{ route('enrollments.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Select Student</label>
                        <select name="student_id" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                            <option value="">-- Choose Student --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Select Course</label>
                        <select name="course_id" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                            <option value="">-- Choose Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Enrollment Date</label>
                        <input type="date" name="enrollment_date" value="{{ date('Y-m-d') }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Fee Amount ($)</label>
                        <input type="number" name="fee_amount" placeholder="e.g. 150" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Payment Status</label>
                        <select name="payment_status" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 transition" required>
                            <option value="Unpaid">Unpaid</option>
                            <option value="Partial">Partial</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-900 text-white font-bold rounded-xl py-3.5 hover:bg-indigo-800 transition shadow-lg uppercase tracking-wider text-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Complete Enrollment
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-indigo-900 text-white text-[11px] uppercase tracking-widest font-black">
                    <tr>
                        <th class="p-5">Student Name</th>
                        <th class="p-5">Course Title</th>
                        <th class="p-5">Reg. Date</th>
                        <th class="p-5">Amount</th>
                        <th class="p-5">Status</th>
                        <th class="p-5 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($enrollments as $enroll)
                    <tr class="hover:bg-indigo-50/50 transition-colors">
                        <td class="p-5 font-bold text-gray-900">{{ $enroll->student_name }}</td>
                        <td class="p-5 text-indigo-600 font-semibold">{{ $enroll->course_name }}</td>
                        <td class="p-5 text-gray-500 text-sm">{{ $enroll->enrollment_date }}</td>
                        <td class="p-5 font-bold text-gray-900">${{ number_format($enroll->fee_amount, 2) }}</td>
                        <td class="p-5">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase
                                {{ $enroll->payment_status == 'Paid' ? 'bg-emerald-100 text-emerald-600' : ($enroll->payment_status == 'Partial' ? 'bg-amber-100 text-amber-600' : 'bg-red-100 text-red-600') }}">
                                {{ $enroll->payment_status }}
                            </span>
                        </td>
                        <td class="p-5">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('enrollments.edit', $enroll->id) }}" class="text-amber-500 hover:text-amber-600 transition p-2 hover:bg-amber-50 rounded-lg" title="Edit Record">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>

                                <form action="{{ route('enrollments.destroy', $enroll->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enrollment record?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition p-2 hover:bg-red-50 rounded-lg" title="Delete Record">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-10 text-center text-gray-400 font-medium">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fas fa-folder-open text-4xl text-gray-200"></i>
                                <span>No enrollment records found.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>