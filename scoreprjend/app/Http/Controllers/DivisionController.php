<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Classes;
use App\Models\Division;
use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\Teacher;
use App\Models\grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Transcript;
use App\Models\TranscriptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        session()->flash('search', $request->input('search'));
        session()->flash('status', $request->input('status'));
        $admin = Auth::guard('admin')->user();
        $adminId = $admin->id;
        $searchTerm = $request->input('search');

        // Sử dụng phương thức `search` trong model Division để tìm kiếm theo điều kiện
        $divisions = Division::search($searchTerm)->orderBy('semester', 'asc')->get();

        // Sử dụng phương thức `getStatus()` để lấy trạng thái và gán lại vào thuộc tính của mỗi division
        foreach ($divisions as $division) {
            $division->status = $division->getStatus();
        }

        $selectedStatus = $request->input('status');

        // Truyền danh sách đã sắp xếp và có trạng thái đến View
        return view('division.index', [
            'divisions' => $divisions,
            'selectedStatus' => $selectedStatus

        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $objClass= new Classes();
        $classes = $objClass->index();
        $objteacher = new Teacher();
        $teacher = $objteacher->index();
        $objgrade = new grade();
        $grade = $objgrade->index();
        $objSubject= new Subject();
        $subject = $objSubject->index();

        $objAdmin = new Admin();
        $admin = $objAdmin->index();
        return view('division.create', [
            'classes' => $classes,
            'teachers' => $teacher,
            'grades' => $grade,
            'subjects' => $subject,
            'admins' => $admin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisionRequest $request)
    {
        // Kiểm tra xem đã tồn tại bản ghi có teacher_id và subject_id tương ứng chưa
        $existingRecord = Division::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->first();

        // Kiểm tra số lượng sinh viên trong lớp học
        $studentCount = Student::where('class_id', $request->class_id)->count();

        // Lấy teacher_id và subject_id từ request
        $classId = $request->class_id;
        $teacherId = $request->teacher_id;
        $subjectId = $request->subject_id;

        // Tìm graded_id của teacher và subject
        $classgradedId = Classes::where('id', $classId)->value('grade_id');
        $teachergradedId = Teacher::where('id', $teacherId)->value('grade_id');
        $subjectgradedId = Subject::where('id', $subjectId)->value('grade_id');

        // Kiểm tra xem teacher và subject có cùng graded_id không
        if ($teachergradedId != $subjectgradedId) {
            // Nếu không, hiển thị thông báo lỗi
            Session::flash('error', 'Teacher and Subject must belong to the same graded.');
        } elseif ($teachergradedId != $classgradedId) {
            // Nếu không, hiển thị thông báo lỗi
            Session::flash('error', 'Teacher and Class must belong to the same graded.');
        } elseif ($subjectgradedId != $classgradedId) {
            // Nếu không, hiển thị thông báo lỗi
            Session::flash('error', 'Subject and Class must belong to the same graded.');
        } elseif ($studentCount == 0) {
            // Nếu không có sinh viên trong lớp học, hiển thị thông báo lỗi
            Session::flash('error', 'Zero Student in this Class so it\'s inactive.');
        } elseif (!$existingRecord) {
            // Nếu chưa tồn tại và có sinh viên trong lớp học, tạo một bản ghi mới và lưu trữ nó
            $obj = new Division();
//            $obj->division_name = $request->division_name;
            $obj->semester = $request->semester;
            $obj->class_id = $request->class_id;
            $obj->teacher_id = $request->teacher_id;
            $obj->subject_id = $request->subject_id;
            $obj->admin_id = Auth::guard('admin')->user()->id; // Lấy ID của admin đang đăng nhập
            $obj->save();

            Session::flash('success', 'Added New Record');
        } else {
            // Nếu đã tồn tại, hiển thị thông báo lỗi
            Session::flash('error', 'This division already exists or some teacher has been assigned.');
        }

        return redirect()->route('division.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        session()->flash('status', $request->input('status'));
        $teacher = Auth::guard('teacher')->user();
        $teacherId = $teacher->id;

        // Truy vấn các Division liên quan đến Teacher đó và sắp xếp theo class_count
        $divisions = Division::join('classes', 'divisions.class_id', '=', 'classes.id')
            ->join('teachers', 'divisions.teacher_id', '=', 'teachers.id')
            ->join('subjects', 'divisions.subject_id', '=', 'subjects.id')
            ->join('grades', 'subjects.grade_id', '=', 'grades.id')
            ->join('admins', 'divisions.admin_id', '=', 'admins.id')
            ->where('divisions.teacher_id', $teacherId)
            ->select([
                'divisions.*',
                'classes.class_name AS class_name',
                'teachers.teacher_name AS teacher_name',
                'grades.graded_name AS graded_name',
                'subjects.subject_name AS subject_name',
                'admins.username AS username'
            ])
            ->orderBy('divisions.semester', 'asc')
            ->get();
        $selectedStatus = $request->input('status');

//        // Lấy danh sách transcripts liên quan đến Teacher và sắp xếp theo class_count
//        $transcripts = Transcript::join('divisions', 'transcripts.division_id', '=', 'divisions.id')
//            ->join('teachers', 'divisions.teacher_id', '=', 'teachers.id')
//            ->join('subjects', 'divisions.subject_id', '=', 'subjects.id')
//            ->join('grades', 'subjects.grade_id', '=', 'grades.id')
//            ->join('classes', 'transcripts.class_id', '=', 'classes.id')
//            ->join('school_years', 'classes.school_year_id', '=', 'school_years.id')
//            ->where('teachers.id', $teacherId)
//            ->select([
//                'transcripts.*',
//                'teachers.teacher_name AS teacher_name',
//                'subjects.subject_name AS subject_name',
//                'grades.graded_name AS graded_name',
//                'classes.class_name AS class_name',
//                'school_years.sy_name AS sy_name'
//                // Các cột khác của bảng transcripts nếu cần
//            ])
//            ->orderBy('divisions.semester', 'asc')
//            ->get();

        return view('division.show', [
            'divisions' => $divisions,
            'selectedStatus' => $selectedStatus
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division, Request $request)
    {
        $objClass = new Classes();
        $classes = $objClass->index();
        $objteacher = new Teacher();
        $teachers = $objteacher->index();
        $objSubject= new Subject();
        $subjects = $objSubject->index();
        $objAdmin = new Admin();
        $admins = $objAdmin->index();
        $objDivision = new Division();
        $objDivision->id = $request->id;
        $divisions = $objDivision->edit();
        return view('division.edit', [
            'classes' => $classes,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'admins' => $admins,
            'divisions' => $divisions,
            'id' => $objDivision->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $obj = new Division();
        $obj->id = $request->id;
//        $obj->division_name = $request->division_name;
        $obj->semester = $request->semester;
        $obj->class_id = $request->class_id;
        $obj->teacher_id = $request->teacher_id;
        $obj->subject_id = $request->subject_id;
        $obj->admin_id = Auth::guard('admin')->user()->id;

            $obj->updateDivision();
            Session::flash('success', 'Updated Record Successfully');


        return redirect()->route('division.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division, Request $request)
    {
        $obj = new Division();
        $obj->id = $request->id;

        try {
            // Thử xóa bản ghi
            $obj->deleteDivision();

            // Nếu xóa thành công, hiển thị thông báo thành công
            Session::flash('success', 'Deleted Record');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra trong quá trình xóa, hiển thị thông báo lỗi chung
            Session::flash('error', 'Failed to delete the record. Please try again later.');
        }
        return Redirect::route('division.index');
    }

    // Thêm hàm isDivisionFinished() vào model Division
//    public function isDivisionFinished()
//    {
//        $transcriptsCount = Transcript::where('division_id', $this->id)->count();
//
//        // Kiểm tra số lượng transcripts
//        if ($transcriptsCount === 0) {
//            return false; // Không có transcript, trạng thái là Unwork
//        }
//
//        // Kiểm tra số lượng transcripts với class count và isFinished()
//        $finishedTranscriptsCount = Transcript::where('division_id', $this->id)
//            ->whereHas('class', function ($query) {
//                $query->whereColumn('class_count', '=', 'transcripts.class_count');
//            })
//            ->where(function ($query) {
//                $query->where('status', 'Finished')->orWhere('status', 'Done');
//            })
//            ->count();
//
//        // Trạng thái là Working nếu có transcripts với class count và isFinished()
//        if ($finishedTranscriptsCount > 0) {
//            return true;
//        }
//
//        return false; // Trạng thái là Unwork nếu không có transcripts đáp ứng điều kiện
//    }


    public function checkTranscript($id)
    {
        // Lấy thông tin graded dựa trên ID
        $divisions = Division::findOrFail($id);

        // Lấy danh sách lớp học thuộc graded đó
        $transcripts = Transcript::where('division_id', $id)->get();

        // Lấy danh sách sinh viên thuộc các lớp đó
//        $students = Student::whereIn('class_id', $classes->pluck('id'))->get();

        return view('division.checkTranscript', [
            'divisions' => $divisions,
            'transcripts' => $transcripts
//            'students' => $students,
        ]);
    }

    public function checkTransDetail($transcript_id)
    {
        // Get the class based on the class_id
        $transcript = Transcript::findOrFail($transcript_id);

        // Get the students for the specific class
        $transcriptDetails = TranscriptDetail::with('student')->where('transcript_id', $transcript_id)->get();

        return view('division.checkTransDetail', [
            'transcript' => $transcript,
            'transcriptDetails' => $transcriptDetails,
        ]);
    }
}
