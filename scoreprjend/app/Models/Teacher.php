<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teacher extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;
    public $timestamps = false;
//    protected $fillable = ['teacher_name', 'email', 'phone', 'password', 'grade_id'];
//    public function grades(){
//        return $this->belongsTo(Grade::class);
//    }
    public function index()
    {
        $query = DB::table('teachers')
            ->join('grades', 'teachers.grade_id', '=', 'grades.id')
            ->select(['teachers.*',
                'grades.grade_name AS grade_name'
            ])
            ->get();

        return $query;
    }

    public function store()
    {
        DB::table('teachers')
            ->insert([
                'teacher_name' => $this->teacher_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => $this->password,
                'grade_id' => $this->grade_id

            ]);
    }

    public function edit()
    {
        $teachers = DB::table('teachers')
            ->where('id', $this->id)
            ->get();
        return $teachers;
    }

    public function updateteacher()
    {
        DB::table('teachers')
            ->where('id', $this->id)
            ->update([
                'teacher_name' => $this->teacher_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => $this->password,
                'grade_id' => $this->grade_id
            ]);
    }

    public function deleteteacher()
    {
        DB::table('teachers')
            ->where('id', $this->id)
            ->delete();
    }
    public function grades(){
        return $this->belongsTo(Grade::class);
    }
}
