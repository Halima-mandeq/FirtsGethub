<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function index() {
        // Waxaan soo qaadaynaa xogta isku xiran (Join Students & Courses)
        $enrollments = DB::table('enrollments')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select('enrollments.*', 'students.name as student_name', 'courses.course_name')
            ->latest('enrollments.created_at')
            ->get();

        $students = DB::table('students')->select('id', 'name')->get();
        $courses = DB::table('courses')->select('id', 'course_name')->get();

        return view('enrollments.index', compact('enrollments', 'students', 'courses'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'fee_amount' => 'required|numeric',
            'payment_status' => 'required|in:Paid,Unpaid,Partial'
        ]);

        DB::table('enrollments')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now()
        ]));

        return back()->with('success', 'Enrollment completed successfully!');
    }

    public function edit($id)
    {
        // Fetch the specific enrollment and join names for the header info
        $enrollment = DB::table('enrollments')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->select('enrollments.*', 'students.name as student_name')
            ->where('enrollments.id', $id)
            ->first();

        if (!$enrollment) {
            return abort(404);
        }

        $students = DB::table('students')->get();
        $courses = DB::table('courses')->get();

        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'course_id' => 'required',
            'enrollment_date' => 'required|date',
            'fee_amount' => 'required|numeric',
            'payment_status' => 'required'
        ]);

        DB::table('enrollments')->where('id', $id)->update([
            'student_id'      => $request->student_id,
            'course_id'       => $request->course_id,
            'enrollment_date' => $request->enrollment_date,
            'fee_amount'      => $request->fee_amount,
            'payment_status'  => $request->payment_status,
            'updated_at'      => now(),
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully!');
    }

    public function destroy($id) {
        DB::table('enrollments')->where('id', $id)->delete();
        return back()->with('success', 'Record deleted successfully!');
    }
}