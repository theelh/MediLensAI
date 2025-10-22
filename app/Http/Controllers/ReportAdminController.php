<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ReportQuestion;
use App\Models\Question;

class ReportAdminController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'file'])->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    public function review(Report $report)
    {
        $report->update(['status' => 'reviewed']);
        return back()->with('success', 'Report marked as reviewed');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return back()->with('success', 'Report deleted');
    }

    public function quesindex()
{
    $reports = ReportQuestion::with('question', 'reporter')->latest()->get();
    return view('admin.reports.quesIndex', compact('reports'));
}

public function quesdestroy($id)
{
    ReportQuestion::findOrFail($id)->delete();
    return back()->with('success', 'Report deleted');
}

public function show($id)
{
    $question = Question::with('answers.doctor')->findOrFail($id);
    return view('admin.reports.questions.show', compact('question'));
}

public function destroyQuestion($id)
{
    Question::destroy($id);
    return redirect()->route('admin.reportsques.index')->with('success', 'Question deleted successfully.');
}


}
