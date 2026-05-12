<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherFeedback extends Model
{
    use HasFactory;

    protected $table = 'teacher_feedback';

    protected $fillable = [
        'teacher_id',
        'student_id',
        'comment',
        'status',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
