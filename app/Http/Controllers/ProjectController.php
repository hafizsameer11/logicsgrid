<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function show(string $slug): View
    {
        $project = Project::where('slug', $slug)
            ->where('is_published', true)
            ->with(['stats', 'features', 'screens'])
            ->firstOrFail();

        $allProjects = Project::where('is_published', true)->orderBy('sort_order')->get();
        $currentIndex = $allProjects->search(fn ($p) => $p->id === $project->id);
        $prevProject = $currentIndex > 0 ? $allProjects[$currentIndex - 1] : null;
        $nextProject = $currentIndex < $allProjects->count() - 1 ? $allProjects[$currentIndex + 1] : null;
        $relatedProjects = $allProjects->where('id', '!=', $project->id)->take(3);

        return view('dynamic.project', [
            'project' => $project,
            'prevProject' => $prevProject,
            'nextProject' => $nextProject,
            'relatedProjects' => $relatedProjects,
            'title' => html_entity_decode($project->meta_title ?? $project->title.' — LogicsGrid'),
        ]);
    }
}
