<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Enrollment | SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 p-6 md:p-10 font-sans text-slate-900">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-indigo-900 uppercase tracking-tight">
                    <i class="fas fa-edit mr-2 text-indigo-600"></i> Edit Enrollment
                </h2>
                <p class="text-gray-500 font-medium">Modify registration details for this student</p>
            </div>
            <a href="{{ route('enrollments.index') }}" class="bg-white border border-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-bold hover:bg-gray-100 transition shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i> Cancel
            </a>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Student</label>
                        <select name="student_id" class="border border-gray-200 p-3 rounded-xl w-full bg-gray-50 transition" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Course</label>
                        <select name="course_id" class="border border-gray-200 p-3 rounded-xl w-full bg-gray-50 transition" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $enrollment->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Date</label>
                        <input type="date" name="enrollment_date" value="{{ $enrollment->enrollment_date }}" class="border border-gray-200 p-3 rounded-xl w-full transition" required>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Fee ($)</label>
                        <input type="number" name="fee_amount" value="{{ $enrollment->fee_amount }}" class="border border-gray-200 p-3 rounded-xl w-full transition" required>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase ml-1">Status</label>
                        <select name="payment_status" class="border border-gray-200 p-3 rounded-xl w-full transition" required>
                            <option value="Unpaid" {{ $enrollment->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="Partial" {{ $enrollment->payment_status == 'Partial' ? 'selected' : '' }}>Partial</option>
                            <option value="Paid" {{ $enrollment->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-900 text-white font-black rounded-xl py-4 hover:bg-indigo-800 transition shadow-lg uppercase tracking-widest text-sm mt-4">
                    <i class="fas fa-save mr-2"></i> Update Enrollment Record
                </button>
            </form>
        </div>
    </div>
</body>
</html>