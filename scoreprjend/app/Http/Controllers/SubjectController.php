<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subject::query()
            ->join('grades', 'subjects.grade_id', '=', 'grades.id')
            ->select([
                'subjects.*',
                'grades.grade_name AS grade_name'
            ]);

        // Thêm điều kiện tìm kiếm nếu có tên lớp học hoặc năm học được nhập
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('subject_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('graded_name', 'like', '%' . $searchTerm . '%');
        }

        $subjects = $query->get();

        return view('subject.index', [
            'subjects' => $subjects
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $objgrade = new grade();
        $grade = $objgrade->index();
        return view('subject.create', [
            'grades' => $grade
        ]);
//        $grades = grade::all();
//        return view('subject.create', [
//            'grades' =>$grades
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        $existingSubject = Subject::where('subject_name', $request->subject_name)
            ->exists();
        if ($existingSubject) {
            // Nếu graded_name đã tồn tại, bạn có thể trả về một thông báo lỗi hoặc chuyển hướng người dùng về trang tương ứng.
            // Ví dụ:
            Session::flash('error', 'Record already exists.');
            return Redirect::route('subject.index');

        }
        $obj = new Subject();
        $obj->subject_name = $request->subject_name;
        $obj->semester = $request->semester;
        $obj->text_book = $request->text_book;
        $obj->grade_id = $request->grade_id;
        $obj->store();
        Session::flash('success', 'Added New Record');
        return Redirect::route('subject.index');
//        Subject::create($request->all());
//        return Redirect::route('subject.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject, Request $request)
    {
        $objgrade = new grade();
        $grades = $objgrade->index();
        $objSubject = new Subject();
        $objSubject->id = $request->id;
        $subjects = $objSubject->edit();
        return view('subject.edit', [
            'grades' => $grades,
            'subjects' => $subjects,
            'id' => $objSubject->id
        ]);
//        $grades = grade::all();
//        return view('subject.edit', [
//            'subject' => $subject,
//            'grades' => $grades
//        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $existingSubject = Subject::where('subject_name', $request->subject_name)
            ->exists();
        if ($existingSubject) {
            // Nếu graded_name đã tồn tại, bạn có thể trả về một thông báo lỗi hoặc chuyển hướng người dùng về trang tương ứng.
            // Ví dụ:
            Session::flash('error', 'Record already exists.');
            return Redirect::route('subject.index');

        }
        $obj = new Subject();
        $obj->id = $request->id;
        $obj->subject_name = $request->subject_name;
        $obj->semester = $request->semester;
        $obj->text_book = $request->text_book;
        $obj->grade_id = $request->grade_id;
        $obj->updateSubject();
        Session::flash('success', 'Added New Record');
        return Redirect::route('subject.index');
//        $subject->update($request->all());
//        return Redirect::route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject, Request $request)
    {
        $obj = new Subject();
        $obj->id = $request->id;

        try {
            // Thử xóa bản ghi
            $obj->deleteSubject();

            // Nếu xóa thành công, hiển thị thông báo thành công
            Session::flash('success', 'Deleted Record');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra trong quá trình xóa, hiển thị thông báo lỗi chung
            Session::flash('error', 'Failed to delete the record. Please try again later.');
        }

        return Redirect::route('subject.index');
    }

//        $subject->delete();
//        return Redirect::route('subject.index');

}
