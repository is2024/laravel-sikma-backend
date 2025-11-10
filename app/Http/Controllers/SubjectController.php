<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->input('title');

        $subjects = DB::table('subjects')
            ->join('users', 'subjects.lecturer_id', '=', 'users.id')
            ->select('users.name', 'subjects.id', 'subjects.description', 'subjects.title', 'subjects.semester', 'subjects.academic_year', 'subjects.sks', 'subjects.code')
            ->where('users.name', 'like', '%' . $title . '%')
            ->orWhere('subjects.title', 'like', '%' . $title . '%')
            ->paginate(10);

        return view('pages.subject.index', compact('subjects'));
    }

    public function create()
    {
        $users = User::where('roles', 'dosen')->get();
        return view('pages.subject.create', compact('users'));
    }

    public function store(StoreSubjectRequest $request)
    {
        Subject::create($request->all());
        return redirect()->route('subject.index')->with('success', 'Subject created succesfully');
    }

    public function edit(Subject $subject)
    {
        $users = User::where('roles', 'dosen')->get();
        return view('pages.subject.edit', compact('users'))->with('subject', $subject);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $validate = $request->validated();
        $subject->update($validate);
        return redirect(route('subject.index'))->with('success', 'Edit Subject Successfully');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect(route('subject.index'))->with('success', 'Delete Subject Successfully');
    }
}