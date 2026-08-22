<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(Request $request, string $slug): View
    {
        $slug = trim($slug, '/');

        $service = Service::where('slug', $slug)->where('is_published', true)->first();
        if ($service && $service->body_html) {
            return view('dynamic.service', [
                'service' => $service,
                'title' => $service->title.' — LogicsGrid',
            ]);
        }

        $page = Page::where('slug', $slug)->where('is_published', true)->first();

        if ($page) {
            return view('dynamic.page', [
                'page' => $page,
                'title' => html_entity_decode($page->meta_title ?? $page->title.' — LogicsGrid'),
            ]);
        }

        $view = str_replace('/', '-', $slug);
        $metaPath = resource_path('views/pages/meta.json');
        $pages = file_exists($metaPath) ? json_decode(file_get_contents($metaPath), true) ?? [] : [];
        $info = $pages[$slug] ?? [];
        $title = html_entity_decode($info['title'] ?? ucwords(str_replace(['/', '-'], [' — ', ' '], $slug)).' — LogicsGrid');

        return view('pages.show', compact('view', 'title'));
    }
}
