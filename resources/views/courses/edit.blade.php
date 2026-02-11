<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course | SMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-slate-900">

    <div class="p-6 md:p-12">
        <div class="max-w-3xl mx-auto">
            
            <div class="flex items-center gap-4 mb-10">
                <a href="{{ route('courses.index') }}" class="bg-white border border-slate-200 text-slate-600 p-3 rounded-xl hover:bg-slate-100 transition shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-800 uppercase">Edit Course</h1>
                    <p class="text-slate-500 font-medium italic">Update the information for {{ $course->course_name }}</p>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
                <form action="{{ route('courses.update', $course->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Course Code</label>
                            <input type="text" name="course_code" value="{{ old('course_code', $course->course_code) }}" 
                                   class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                            @error('course_code') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Course Name</label>
                            <input type="text" name="course_name" value="{{ old('course_name', $course->course_name) }}" 
                                   class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                            @error('course_name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Assigned Teacher</label>
                        <select name="teacher_id" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition appearance-none">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-black py-5 rounded-2xl shadow-xl transition uppercase tracking-widest text-sm flex items-center justify-center gap-3">
                            <i class="fa-solid fa-floppy-disk"></i> Update Course Details
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>