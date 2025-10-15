<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class StudentController extends Controller
{
    public function index(Request $request): \Illuminate\View\View
    {
        $q = $request->string('q')->toString();
        $only = $request->string('only')->toString(); // '', 'trashed', 'all'
        $sort = $request->string('sort', 'id')->toString(); // id, name, email, created_at
        $dir  = $request->string('dir', 'desc')->toString(); // asc, desc

        $students = \App\Models\Student::query()
            ->when($only === 'trashed', fn($qB) => $qB->onlyTrashed())
            ->when($only === 'all', fn($qB) => $qB->withTrashed())
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('first_name','like',"%{$q}%")
                    ->orWhere('last_name','like',"%{$q}%")
                    ->orWhere('email','like',"%{$q}%")
                    ->orWhere('roll_no','like',"%{$q}%");
                });
            })
            ->when($sort === 'name', fn($qb) => $qb->orderBy('first_name', $dir)->orderBy('last_name', $dir))
            ->when($sort === 'email', fn($qb) => $qb->orderBy('email', $dir))
            ->when($sort === 'created_at', fn($qb) => $qb->orderBy('created_at', $dir))
            ->when(! in_array($sort, ['name','email','created_at']), fn($qb) => $qb->orderBy('id', $dir))
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students','q','only','sort','dir'));
    }


    public function create(): View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('students', 'public');
        }

        $student = Student::create($data);

        return redirect()->route('students.show', $student)->with('status', 'Student created');
    }

    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($data);

        return redirect()->route('students.show', $student)->with('status', 'Student updated');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index')->with('status', 'Student deleted');
    }

    public function restore($id)
    {
        $student = \App\Models\Student::withTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route('students.index')->with('status','Student restored');
    }

    public function forceDelete($id)
    {
        $student = \App\Models\Student::withTrashed()->findOrFail($id);
        $student->forceDelete();
        return redirect()->route('students.index')->with('status','Student permanently deleted');
    }
}
