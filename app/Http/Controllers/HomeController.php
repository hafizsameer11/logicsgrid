<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\MarqueeItem;
use App\Models\ProblemCard;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WhyReason;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'settings' => array_merge(
                SiteSetting::group('site'),
                SiteSetting::group('hero'),
                SiteSetting::group('sections')
            ),
            'heroStats' => Stat::where('context', 'hero')->orderBy('sort_order')->get(),
            'marqueeItems' => MarqueeItem::orderBy('sort_order')->get(),
            'problemCards' => ProblemCard::orderBy('sort_order')->get(),
            'services' => Service::where('is_published', true)->orderBy('sort_order')->get(),
            'whyReasons' => WhyReason::orderBy('sort_order')->get(),
            'processSteps' => ProcessStep::orderBy('sort_order')->get(),
            'featuredProjects' => Project::where('is_published', true)
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->limit(3)
                ->get(),
            'industries' => Industry::where('is_published', true)->orderBy('sort_order')->get(),
            'aboutStats' => Stat::where('context', 'about')->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::where('is_published', true)
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->limit(3)
                ->get(),
            'teamMembers' => TeamMember::where('is_published', true)
                ->where('section', 'home')
                ->orderBy('sort_order')
                ->limit(4)
                ->get(),
        ]);
    }
}
