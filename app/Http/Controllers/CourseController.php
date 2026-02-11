<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index() {
        // Waxaan ku darnay 'join' si aan u helno magaca macallinka
        $courses = DB::table('courses')
            ->leftJoin('teachers', 'courses.teacher_id', '=', 'teachers.id')
            ->select('courses.*', 'teachers.name as teacher_name')
            ->latest('courses.created_at')
            ->get();

        // Liiska macallimiinta si looga doorto Form-ka
        $teachers = DB::table('teachers')->select('id', 'name')->get();

        return view('courses.index', compact('courses', 'teachers'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'course_code' => 'required|unique:courses',
            'course_name' => 'required',
            'description' => 'nullable|string',
            'teacher_id'  => 'required|exists:teachers,id'
        ]);

        DB::table('courses')->insert(array_merge($data, [
            'created_at' => now(), 
            'updated_at' => now()
        ]));

        return back()->with('success', 'Maaddada si guul leh ayaa loo daray!');
    }

    // --- Qaybta Edit-ka ---
    public function edit($id) {
        $course = DB::table('courses')->where('id', $id)->first();
        $teachers = DB::table('teachers')->select('id', 'name')->get();
        
        if (!$course) {
            return abort(404);
        }
        
        return view('courses.edit', compact('course', 'teachers'));
    }

    // --- Qaybta Update-ka ---
    public function update(Request $request, $id) {
        $data = $request->validate([
            'course_code' => 'required|unique:courses,course_code,'.$id,
            'course_name' => 'required',
            'description' => 'nullable|string',
            'teacher_id'  => 'required|exists:teachers,id'
        ]);

        DB::table('courses')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now()
        ]));

        return redirect()->route('courses.index')->with('success', 'Maaddada waa la cusubaysiiyay!');
    }

    public function destroy($id) {
        DB::table('courses')->where('id', $id)->delete();
        return back()->with('success', 'Maaddada waa la tirtiray!');
    }
}