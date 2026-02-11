<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index() {
        // Soo qaado xogta xadiridda oo ay ku jiraan magacyada ardayda iyo maadooyinka
        $attendances = DB::table('attendances')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->join('courses', 'attendances.course_id', '=', 'courses.id')
            ->select('attendances.*', 'students.name as student_name', 'courses.course_name')
            ->latest('attendances.attendance_date')
            ->get();

        $students = DB::table('students')->select('id', 'name')->get();
        $courses = DB::table('courses')->select('id', 'course_name')->get();

        return view('attendances.index', compact('attendances', 'students', 'courses'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'course_id'       => 'required|exists:courses,id',
            'attendance_date' => 'required|date',
            'status'          => 'required|in:Present,Absent,Late',
            'description'     => 'nullable|string'
        ]);

        DB::table('attendances')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now()
        ]));

        return back()->with('success', 'Xadirinta si guul leh ayaa loo keydiyay!');
    }

    // --- SHAQO_CUSUB: Soo qaad xogta Edit-ka ---
    public function edit($id) {
        $attendance = DB::table('attendances')->where('id', $id)->first();
        
        if (!$attendance) {
            return redirect()->route('attendances.index')->with('error', 'Xogta lama helin!');
        }

        $students = DB::table('students')->select('id', 'name')->get();
        $courses = DB::table('courses')->select('id', 'course_name')->get();

        return view('attendances.edit', compact('attendance', 'students', 'courses'));
    }

    // --- SHAQO_CUSUB: Cusubaysii xogta (Update) ---
    public function update(Request $request, $id) {
        $data = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'course_id'       => 'required|exists:courses,id',
            'attendance_date' => 'required|date',
            'status'          => 'required|in:Present,Absent,Late',
            'description'     => 'nullable|string'
        ]);

        DB::table('attendances')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now()
        ]));

        return redirect()->route('attendances.index')->with('success', 'Xogta xadirinta waa la cusubaysiiyay!');
    }

    public function destroy($id) {
        DB::table('attendances')->where('id', $id)->delete();
        return back()->with('success', 'Xogta xadirinta waa la tirtiray!');
    }
}