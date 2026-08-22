<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\JobListing;
use App\Models\MarqueeItem;
use App\Models\Page;
use App\Models\ProblemCard;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\ProjectScreen;
use App\Models\ProjectStat;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WhyReason;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    private string $pagesPath;

    /** @var array<string, array{file: string, title: string}> */
    private array $meta = [];

    /** @var list<string> */
    private array $serviceSlugs = [
        'software-development',
        'startup-growth',
        'ai-solutions',
        'venture-building',
        'business-digitization',
    ];

    public function run(): void
    {
        $this->pagesPath = resource_path('views/pages');
        $this->meta = json_decode(
            file_get_contents($this->pagesPath.'/meta.json'),
            true
        ) ?? [];

        $this->seedSiteSettings();
        $this->seedStats();
        $this->seedMarqueeItems();
        $this->seedProblemCards();
        $this->seedServices();
        $this->seedWhyReasons();
        $this->seedProcessSteps();
        $this->seedIndustries();
        $this->seedTestimonials();
        $this->seedTeamMembers();
        $this->seedSocialLinks();
        $this->seedJobListings();
        $this->seedPages();
        $this->seedProjects();

        $this->command?->info('ContentSeeder finished seeding all CMS tables.');
    }

    private function seedSiteSettings(): void
    {
        $settings = [
            'hero' => [
                'badge' => 'One integrated partner · Build · Scale · Operate',
                'title_line1' => 'Build, scale,',
                'title_highlight' => 'operate',
                'description' => 'LogicsGrid helps ambitious entrepreneurs, investors, and businesses launch technology products, accelerate growth, and digitize operations through software development, startup growth infrastructure, and business transformation solutions.',
                'hero_image' => 'assets/hero-cinematic-Dn9NhNBB.webp',
                'card_years_label' => 'Years operating',
                'card_years_value' => 'Since 2016',
                'card_projects_label' => 'Shipped',
                'card_projects_value' => '120+ projects',
                'cta_primary' => 'Book A Strategy Session →',
                'cta_secondary' => 'See Our Work',
            ],
            'sections' => [
                'problem_eyebrow' => 'The Problem We Solve',
                'problem_title' => 'Building is one thing. Operating it is another.',
                'problem_description' => 'Most teams stitch together an agency, a few freelancers, and a no-code tool — and end up owning the integration risk themselves. LogicsGrid replaces that with one accountable partner across software, growth, and digitization.',
                'services_eyebrow' => 'Six Ways We Partner',
                'services_title' => 'What we do, end to end.',
                'services_description' => 'Five pillars plus a custom track — one operating partner. Each runs on its own, but the value compounds when you combine them under a single contract and a single point of accountability.',
                'why_eyebrow' => 'Why LogicsGrid',
                'why_title' => 'Six reasons they stay.',
                'why_description' => "We don't pitch a deck and disappear. We embed, hold the team to the numbers, and replace anything that under-performs at our cost.",
                'process_eyebrow' => 'Process',
                'process_title' => 'Six steps from idea to compounding outcome.',
                'process_description' => 'One playbook used across every engagement — adapted to your stage, your stack, and the metric that actually matters.',
                'process_badge' => 'Avg. first deliverable · 14 days',
                'featured_eyebrow' => 'Featured Work',
                'featured_title' => "Recent things we've shipped.",
                'industries_eyebrow' => 'Industries We Serve',
                'industries_title' => 'Cross-industry, never generic.',
                'industries_description' => "We've embedded inside ten verticals — and every engagement is shaped by the operating realities of that industry, not a template from the last one.",
                'about_eyebrow' => 'About LogicsGrid',
                'about_title' => 'Artistry meeting technical precision.',
                'about_p1' => 'Founded in 2016, LogicsGrid pairs Nigerian insight with international execution — building, scaling, and operating software, growth, and digitization for founders and enterprises across ten industries.',
                'about_p2' => 'We work at the intersection of engineering discipline and editorial-grade craft. Every system we ship is a study in balance, rhythm, and purpose — and we stay invested long after launch.',
                'about_image' => 'assets/about-boardroom-Di1UV2w5.webp',
                'testimonials_eyebrow' => 'What clients say',
                'testimonials_title' => 'Quiet partners. Loud results.',
                'testimonials_count' => '3 of 40+ partnerships',
                'team_eyebrow' => 'The Team',
                'team_title' => 'Leaders, not just advisors.',
                'team_description' => 'A senior team that has built, scaled and operated the same kinds of businesses we partner with. No juniors hidden behind a slide.',
                'team_footer' => 'Plus a network of 40+ specialists across engineering, design, growth and ops.',
                'cta_eyebrow' => 'Start The Conversation',
                'cta_title' => 'Build it. Scale it. Operate it.',
                'cta_description' => "Tell us the outcome you want. We'll come back with the team, the system, and the timeline to put it on the board.",
                'cta_tagline' => 'Build New Ventures · Scale Faster · Operate Smarter',
            ],
            'site' => [
                'logo_dark' => 'assets/logicsgrid-logo-horizontal.png',
                'logo_light' => 'assets/logicsgrid-logo-horizontal.png',
                'email' => 'hi@logicsgrid.com',
                'phone' => '+234 906 393 9859',
                'address' => "Plot 1, Polyster Building, 128 Remi Olowude St,\nLekki Phase 1, Lagos · Nigeria",
                'footer_tagline' => "Have an idea worth shipping?",
                'footer_description' => 'We partner with founders and leaders to design, build and scale digital products that move the needle — not the slide deck.',
                'copyright' => '© 2026 LogicsGrid Technologies Ltd — All rights reserved.',
                'nav_cta' => 'Book A Strategy Session',
            ],
        ];

        foreach ($settings as $group => $items) {
            foreach ($items as $key => $value) {
                SiteSetting::updateOrCreate(
                    ['group' => $group, 'key' => $key],
                    ['value' => $value, 'type' => 'text']
                );
            }
        }
    }

    private function seedStats(): void
    {
        $stats = [
            ['context' => 'hero', 'value' => '9+', 'label' => 'Years operating', 'sort_order' => 1],
            ['context' => 'hero', 'value' => '120+', 'label' => 'Projects shipped', 'sort_order' => 2],
            ['context' => 'hero', 'value' => '1', 'label' => 'Accountable partner', 'sort_order' => 3],
            ['context' => 'about', 'value' => '9+', 'label' => 'Years', 'sort_order' => 1],
            ['context' => 'about', 'value' => '120+', 'label' => 'Projects', 'sort_order' => 2],
            ['context' => 'about', 'value' => '10', 'label' => 'Industries', 'sort_order' => 3],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(
                ['context' => $stat['context'], 'value' => $stat['value'], 'label' => $stat['label']],
                ['sort_order' => $stat['sort_order']]
            );
        }
    }

    private function seedMarqueeItems(): void
    {
        $items = [
            'Founded in 2016',
            'Registered Nigerian Company',
            'Global Engineering Team',
            'Nigeria + International Talent',
            'Startup Focused',
            'Long-Term Support',
        ];

        foreach ($items as $index => $text) {
            MarqueeItem::updateOrCreate(
                ['text' => $text],
                ['sort_order' => $index + 1]
            );
        }
    }

    private function seedProblemCards(): void
    {
        $cards = [
            ['number' => 1, 'title' => 'The agency', 'description' => 'Ships a product, then disappears. No accountability for the numbers.', 'solution_tag' => 'We stay on the metric.', 'sort_order' => 1],
            ['number' => 2, 'title' => 'The freelancers', 'description' => 'Disconnected output. No shared KPIs. No-one owns the outcome.', 'solution_tag' => 'One contract. One owner.', 'sort_order' => 2],
            ['number' => 3, 'title' => 'The in-house team', 'description' => 'Slow to hire. Months of detour before a single deliverable ships.', 'solution_tag' => 'Embedded in week one.', 'sort_order' => 3],
            ['number' => 4, 'title' => 'The no-code stack', 'description' => 'Works until volume arrives. Then turns into a maintenance liability.', 'solution_tag' => 'Built to outlive launch.', 'sort_order' => 4],
        ];

        foreach ($cards as $card) {
            ProblemCard::updateOrCreate(
                ['number' => $card['number']],
                $card
            );
        }
    }

    private function seedServices(): void
    {
        $services = [
            [
                'slug' => 'software-development',
                'number' => 1,
                'category_label' => 'Software Development',
                'title' => 'Transform ideas into scalable digital products.',
                'description' => 'We design and develop mobile applications, SaaS platforms, marketplaces, enterprise software, fintech solutions, and custom business systems engineered for long-term growth.',
                'image' => 'assets/pillar-software-Cc1akc0k.webp',
                'tags' => ['Mobile Apps', 'Web Applications', 'SaaS Platforms', 'Enterprise Systems'],
                'sort_order' => 1,
            ],
            [
                'slug' => 'startup-growth',
                'number' => 2,
                'category_label' => 'Startup Growth Infrastructure',
                'title' => 'Building software is only the beginning.',
                'description' => 'We recruit, vet, manage, and oversee the professionals required to grow your startup after launch, allowing founders to focus on strategic decisions instead of operational headaches.',
                'image' => 'assets/pillar-growth-Cko5Utmz.webp',
                'tags' => ['Social Media Teams', 'Content Creators', 'Customer Support', 'Paid Advertising'],
                'sort_order' => 2,
            ],
            [
                'slug' => 'ai-solutions',
                'number' => 3,
                'category_label' => 'AI Solutions',
                'title' => 'Put AI to work inside your business.',
                'description' => 'Custom AI agents, copilots, automation and intelligent workflows that cut cost, accelerate teams and unlock new revenue — built on top of your existing systems and data.',
                'image' => 'assets/ai-hero-BYTirbvT.webp',
                'tags' => ['AI Agents', 'Copilots', 'Workflow Automation', 'RAG & Knowledge'],
                'sort_order' => 3,
            ],
            [
                'slug' => 'venture-building',
                'number' => 4,
                'category_label' => 'Venture Building',
                'title' => 'We build the venture — you keep 100% equity.',
                'description' => 'For investors, business owners, HNWIs and diasporans: we bring the scalable idea, the tech, marketing and operations teams, plus the playbook to raise capital. You fund the build, we run it end-to-end.',
                'image' => 'assets/vb-hero-BKxo5rR_.webp',
                'tags' => ['Vetted Ideas', 'Full Operating Team', 'Strategy & GTM', 'Fundraise Coaching'],
                'sort_order' => 4,
            ],
            [
                'slug' => 'business-digitization',
                'number' => 5,
                'category_label' => 'Business Digitization',
                'title' => 'Modernize operations through technology and AI.',
                'description' => 'Modernize operations, improve efficiency, and reduce costs through technology, automation, and AI-powered systems.',
                'image' => 'assets/pillar-digitization-CNaVOTB8.webp',
                'tags' => ['Process Automation', 'AI Customer Support', 'Internal Portals', 'Workflow Management'],
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            $file = $this->meta[$service['slug']]['file'] ?? null;
            $bodyHtml = $file ? $this->readBlade($file) : null;

            Service::updateOrCreate(
                ['slug' => $service['slug']],
                array_merge($service, [
                    'body_html' => $bodyHtml,
                    'is_published' => true,
                ])
            );
        }
    }

    private function seedWhyReasons(): void
    {
        $reasons = [
            ['number' => 1, 'title' => 'Strategy First', 'description' => 'Every engagement begins with understanding your business goals.', 'sort_order' => 1],
            ['number' => 2, 'title' => 'Global Talent', 'description' => 'Access local expertise backed by international experience.', 'sort_order' => 2],
            ['number' => 3, 'title' => 'Long-Term Partnership', 'description' => 'We remain invested beyond launch.', 'sort_order' => 3],
            ['number' => 4, 'title' => 'Growth Focused', 'description' => 'Everything is designed around measurable outcomes.', 'sort_order' => 4],
            ['number' => 5, 'title' => 'Operational Excellence', 'description' => 'Systems built to scale efficiently.', 'sort_order' => 5],
            ['number' => 6, 'title' => 'Technology Leadership', 'description' => 'Modern tools, modern architecture, modern thinking.', 'sort_order' => 6],
        ];

        foreach ($reasons as $reason) {
            WhyReason::updateOrCreate(
                ['number' => $reason['number']],
                $reason
            );
        }
    }

    private function seedProcessSteps(): void
    {
        $steps = [
            ['number' => 1, 'phase' => 'Workshop', 'title' => 'Discover', 'outcome_label' => 'Opportunity map', 'description' => 'Understand opportunities, goals, and challenges.', 'sort_order' => 1],
            ['number' => 2, 'phase' => 'Strategy', 'title' => 'Strategize', 'outcome_label' => 'Roadmap + KPIs', 'description' => 'Develop a roadmap aligned with business objectives.', 'sort_order' => 2],
            ['number' => 3, 'phase' => 'Sprint', 'title' => 'Build', 'outcome_label' => 'Working product', 'description' => 'Design and develop the required technology.', 'sort_order' => 3],
            ['number' => 4, 'phase' => 'Launch', 'title' => 'Launch', 'outcome_label' => 'Live + monitored', 'description' => 'Deploy, test, and prepare for market adoption.', 'sort_order' => 4],
            ['number' => 5, 'phase' => 'Growth', 'title' => 'Grow', 'outcome_label' => 'Acquisition engine', 'description' => 'Build and manage growth infrastructure.', 'sort_order' => 5],
            ['number' => 6, 'phase' => 'Ongoing', 'title' => 'Optimize', 'outcome_label' => 'Quarterly review', 'description' => 'Improve operations through data and automation.', 'sort_order' => 6],
        ];

        foreach ($steps as $step) {
            ProcessStep::updateOrCreate(
                ['number' => $step['number']],
                $step
            );
        }
    }

    private function seedIndustries(): void
    {
        $industries = [
            'Fintech',
            'Education',
            'Healthcare',
            'Logistics',
            'Real Estate',
            'Hospitality',
            'Professional Services',
            'E-Commerce',
            'Manufacturing',
            'Corporate Organizations',
        ];

        foreach ($industries as $index => $name) {
            Industry::updateOrCreate(
                ['slug' => str($name)->slug()->toString()],
                [
                    'name' => $name,
                    'sort_order' => $index + 1,
                    'is_published' => true,
                ]
            );
        }
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'quote' => "They didn't just build the product — they ran the launch with us and stayed for the second cohort. Rare.",
                'author' => 'Adaeze N.',
                'role' => 'Co-founder, fintech (Series A)',
                'is_dark' => false,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'quote' => 'We replaced an agency, two freelancers, and a no-code tool with one LogicsGrid contract. Cost dropped 38%.',
                'author' => 'Marcus O.',
                'role' => 'COO, logistics scale-up',
                'is_dark' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'quote' => "First working deliverable in twelve days. The board stopped asking when, and started asking what's next.",
                'author' => 'Helena R.',
                'role' => 'CEO, hospitality group',
                'is_dark' => false,
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['author' => $testimonial['author'], 'quote' => $testimonial['quote']],
                array_merge($testimonial, ['is_published' => true])
            );
        }
    }

    private function seedTeamMembers(): void
    {
        $partners = [
            ['name' => 'Peter', 'role_badge' => 'CEO', 'title' => 'CEO · Founding Partner', 'bio' => 'Sets the direction for every LogicsGrid engagement and reads every inbound brief personally.', 'photo' => 'assets/peter-B8Rx5Lk1.webp', 'location' => 'Nigeria', 'skills' => ['Strategy', 'Product', 'Clients'], 'sort_order' => 1],
            ['name' => 'Juliana', 'role_badge' => 'COO', 'title' => 'COO · Partner', 'bio' => 'Runs operations end-to-end so the team can keep shipping. Owns delivery, hiring and client success.', 'photo' => 'assets/juliana-D96bP1Zi.webp', 'location' => 'Nigeria', 'skills' => ['Operations', 'Delivery', 'People'], 'sort_order' => 2],
            ['name' => 'Sameer', 'role_badge' => 'CTO', 'title' => 'CTO · Partner', 'bio' => 'Sets the technical bar across the bench — architecture, code review and the way we ship.', 'photo' => 'assets/sameer-BFa4leUr.webp', 'location' => 'Pakistan', 'skills' => ['Architecture', 'Platforms', 'DX'], 'sort_order' => 3],
        ];

        foreach ($partners as $partner) {
            TeamMember::updateOrCreate(
                ['name' => $partner['name'], 'section' => 'partners'],
                array_merge($partner, ['section' => 'partners', 'is_featured' => false, 'is_published' => true])
            );
        }

        $crew = [
            ['name' => 'Blaise', 'role_badge' => 'PM', 'title' => 'Project Manager', 'photo' => 'assets/blaise-CXMS_Fri.webp', 'location' => 'Nigeria', 'initials' => 'BL', 'skills' => ['Delivery', 'Planning'], 'sort_order' => 1],
            ['name' => 'Abdumalik', 'title' => 'UI & UX Designer', 'photo' => 'assets/abdumalik-QXFUMnqN.webp', 'location' => 'Nigeria', 'initials' => 'AB', 'skills' => ['UI', 'UX'], 'sort_order' => 2],
            ['name' => 'Ayaz', 'title' => 'Full Stack Developer', 'photo' => 'assets/ayaz-BhndzYzr.webp', 'location' => 'Pakistan', 'initials' => 'AY', 'skills' => ['React', 'Node'], 'sort_order' => 3],
            ['name' => 'Ramiz', 'title' => 'Full Stack Developer', 'photo' => 'assets/ramiz-DKEZGTQW.webp', 'location' => 'Pakistan', 'initials' => 'RM', 'skills' => ['TypeScript', 'APIs'], 'sort_order' => 4],
            ['name' => 'Sajjad', 'title' => 'Full Stack Developer', 'photo' => 'assets/sajjad-B4JAQfVG.webp', 'location' => 'Pakistan', 'initials' => 'SJ', 'skills' => ['Full Stack', 'Postgres'], 'sort_order' => 5],
            ['name' => 'Subhan', 'title' => 'Full Stack Developer', 'photo' => 'assets/subhan-DeNy-NWZ.webp', 'location' => 'Pakistan', 'initials' => 'SB', 'skills' => ['Integrations', 'Backend'], 'sort_order' => 6],
            ['name' => 'Ziad', 'title' => 'Full Stack Developer', 'photo' => 'assets/ziad-ooqGNril.webp', 'location' => 'Pakistan', 'initials' => 'ZD', 'skills' => ['Node', 'DB'], 'sort_order' => 7],
            ['name' => 'Hamza', 'title' => 'Front End Developer', 'photo' => 'assets/hamza-VuA7jXi0.webp', 'location' => 'Pakistan', 'initials' => 'HM', 'skills' => ['React', 'UI'], 'sort_order' => 8],
            ['name' => 'Rohail', 'title' => 'Front End Developer', 'photo' => 'assets/rohail-C58VAmsW.webp', 'location' => 'Pakistan', 'initials' => 'RH', 'skills' => ['React', 'CSS'], 'sort_order' => 9],
            ['name' => 'Sohaib', 'title' => 'Front End Developer', 'photo' => 'assets/sohaib-CpntJ_xD.webp', 'location' => 'Pakistan', 'initials' => 'SH', 'skills' => ['Design Systems', 'React'], 'sort_order' => 10],
            ['name' => 'Hassan', 'title' => 'Cybersecurity Expert', 'photo' => 'assets/hassan-DwNa6p2t.webp', 'location' => 'Pakistan', 'initials' => 'HS', 'skills' => ['Security', 'Audits'], 'sort_order' => 11],
            ['name' => 'Zain', 'title' => 'Quality Assurance Expert', 'photo' => 'assets/zain-BvRsfqit.webp', 'location' => 'Pakistan', 'initials' => 'ZN', 'skills' => ['QA', 'Automation'], 'sort_order' => 12],
        ];

        foreach ($crew as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name'], 'section' => 'crew'],
                array_merge($member, ['section' => 'crew', 'is_featured' => false, 'is_published' => true])
            );
        }

        $homeTeam = [
            ['name' => 'Peter', 'role_badge' => 'CEO', 'title' => 'CEO · Founding Partner', 'bio' => 'Sets the direction for every LogicsGrid engagement and reads every inbound brief personally.', 'photo' => 'assets/peter-B8Rx5Lk1.webp', 'sort_order' => 1],
            ['name' => 'Juliana', 'role_badge' => 'COO', 'title' => 'COO · Partner', 'bio' => 'Runs operations end-to-end so the team can keep shipping. Owns delivery, hiring and client success.', 'photo' => 'assets/juliana-D96bP1Zi.webp', 'sort_order' => 2],
            ['name' => 'Sameer', 'role_badge' => 'CTO', 'title' => 'CTO · Partner', 'bio' => 'Sets the technical bar across the bench — architecture, code review and the way we ship.', 'photo' => 'assets/sameer-BFa4leUr.webp', 'sort_order' => 3],
            ['name' => 'Blaise', 'role_badge' => 'PM', 'title' => 'Project Manager', 'bio' => 'Keeps scope, timelines and stakeholders aligned without ever raising a voice.', 'photo' => 'assets/blaise-CXMS_Fri.webp', 'sort_order' => 4],
        ];

        foreach ($homeTeam as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name'], 'section' => 'home'],
                array_merge($member, ['section' => 'home', 'is_featured' => true, 'is_published' => true])
            );
        }
    }

    private function seedSocialLinks(): void
    {
        $links = [
            ['platform' => 'instagram', 'label' => 'Ig', 'url' => 'https://www.instagram.com/logicsgrid/', 'sort_order' => 1],
            ['platform' => 'facebook', 'label' => 'Fb', 'url' => 'https://web.facebook.com/LogicsGrid.Technologies', 'sort_order' => 2],
            ['platform' => 'tiktok', 'label' => 'Tk', 'url' => 'https://www.tiktok.com/@logicsgrid', 'sort_order' => 3],
            ['platform' => 'linkedin', 'label' => 'In', 'url' => 'https://www.linkedin.com/company/logicsgrid-digital-agency', 'sort_order' => 4],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                $link
            );
        }
    }

    private function seedJobListings(): void
    {
        $jobs = [
            ['title' => 'Senior Product Engineer', 'location' => 'Barcelona · Remote EU', 'sort_order' => 1],
            ['title' => 'Staff Designer (Brand + Product)', 'location' => 'Remote EU / LATAM', 'sort_order' => 2],
            ['title' => 'Growth Strategist', 'location' => 'Barcelona', 'sort_order' => 3],
        ];

        foreach ($jobs as $job) {
            JobListing::updateOrCreate(
                ['title' => $job['title']],
                array_merge($job, ['is_published' => true])
            );
        }
    }

    private function seedPages(): void
    {
        $sortOrder = 0;

        foreach ($this->meta as $slug => $info) {
            if (str_starts_with($slug, 'portfolio/')) {
                continue;
            }

            if (in_array($slug, $this->serviceSlugs, true)) {
                continue;
            }

            $sortOrder++;
            $title = html_entity_decode($info['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $metaTitle = $title;

            Page::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $this->pageTitleFromMeta($title),
                    'meta_title' => $metaTitle,
                    'body_html' => $this->readBlade($info['file']),
                    'is_published' => true,
                ]
            );
        }
    }

    private function seedProjects(): void
    {
        $featuredSlugs = ['kokolet-luxury', 'billspro-fintech', 'colala-mall'];
        $engagementTypes = [
            'kokolet-luxury' => 'Build + Operate',
            'billspro-fintech' => 'Build + Launch',
            'colala-mall' => 'Build + Operate',
        ];

        $coverOverrides = [
            'above-lifestyle' => 'assets/above-20-D_8XLF6i.webp',
        ];

        $sortOrder = 0;

        foreach ($this->meta as $slug => $info) {
            if (! str_starts_with($slug, 'portfolio/')) {
                continue;
            }

            $sortOrder++;
            $shortSlug = str_replace('portfolio/', '', $slug);
            $rawHtml = $this->readBladeRaw($info['file']);
            $extracted = $this->extractProjectData($rawHtml);

            $coverImage = $coverOverrides[$shortSlug]
                ?? $extracted['cover_image']
                ?? null;

            $project = Project::updateOrCreate(
                ['slug' => $shortSlug],
                array_merge($extracted, [
                    'cover_image' => $coverImage,
                    'meta_title' => html_entity_decode($info['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                    'engagement_type' => $engagementTypes[$shortSlug] ?? null,
                    'live_url' => isset($extracted['live_label']) && str_contains($extracted['live_label'], '.')
                        ? 'https://'.$extracted['live_label']
                        : null,
                    'sort_order' => $sortOrder,
                    'is_featured' => in_array($shortSlug, $featuredSlugs, true),
                    'is_published' => true,
                ])
            );

            if ($shortSlug === 'kokolet-luxury') {
                $this->seedKokoletLuxuryRelations($project);
            }
        }
    }

    private function seedKokoletLuxuryRelations(Project $project): void
    {
        $stats = [
            ['value' => '4+', 'label' => 'Years partnered', 'sort_order' => 1],
            ['value' => '2', 'label' => 'iOS + Android stores', 'sort_order' => 2],
            ['value' => '4', 'label' => 'Loyalty tiers', 'sort_order' => 3],
        ];

        foreach ($stats as $stat) {
            ProjectStat::updateOrCreate(
                ['project_id' => $project->id, 'value' => $stat['value'], 'label' => $stat['label']],
                ['sort_order' => $stat['sort_order']]
            );
        }

        $features = [
            ['number' => 1, 'title' => 'Boutique Shopping Experience', 'description' => 'Curated categories, latest drops and product galleries designed to feel like a luxury flagship — not a marketplace.', 'sort_order' => 1],
            ['number' => 2, 'title' => 'Kokolet Luxury Circle', 'description' => 'Four-tier loyalty program — Member, Silver, Gold and Platinum — with transparent spend thresholds and benefits at every level.', 'sort_order' => 2],
            ['number' => 3, 'title' => 'Points & Rewards', 'description' => 'Earn points from every purchase and successful referral. 1 point = ₦30, redeemable directly at checkout for instant discounts.', 'sort_order' => 3],
            ['number' => 4, 'title' => 'Referral Engine', 'description' => 'Every shopper gets a personal referral code worth points per signup — built-in share sheet for one-tap invites.', 'sort_order' => 4],
            ['number' => 5, 'title' => 'Latest Drops', 'description' => 'A hero drop modal on app open surfaces the newest sneaker release immediately, driving urgency around launches.', 'sort_order' => 5],
            ['number' => 6, 'title' => 'Full Self-Serve Support', 'description' => 'Order tracking, payments, refund and policy pages, plus WhatsApp, email and phone support from inside the app.', 'sort_order' => 6],
        ];

        foreach ($features as $feature) {
            ProjectFeature::updateOrCreate(
                ['project_id' => $project->id, 'number' => $feature['number']],
                $feature
            );
        }

        $screens = [
            ['number' => 1, 'title' => 'Home', 'description' => 'Curated categories, new arrivals and latest drops in a clean editorial layout.', 'image' => 'assets/home-DTKEbwD2.webp', 'sort_order' => 1],
            ['number' => 2, 'title' => 'Shop', 'description' => 'Browse Dunks, Jordans, SB Dunks, Air Force and accessories with live search and filters.', 'image' => 'assets/shop-DtlQsaG3.webp', 'sort_order' => 2],
            ['number' => 3, 'title' => 'Product Details', 'description' => 'Full product gallery, size picker, size guide and one-tap Buy Now or Add to Bag.', 'image' => 'assets/product-CiJ-h-G_.webp', 'sort_order' => 3],
            ['number' => 4, 'title' => 'Cart', 'description' => 'Edit quantities, move items to wishlist and review totals before checkout.', 'image' => 'assets/cart-B2rs4r7s.webp', 'sort_order' => 4],
            ['number' => 5, 'title' => 'Latest Drops', 'description' => 'Hero drop modal surfaces the newest release the moment users open the app.', 'image' => 'assets/drop-BQLvuDA3.webp', 'sort_order' => 5],
            ['number' => 6, 'title' => 'My Account', 'description' => 'Orders, points, tier, referral code and a personal dashboard in one place.', 'image' => 'assets/account-P9OP54GL.webp', 'sort_order' => 6],
            ['number' => 7, 'title' => 'Kokolet Luxury Circle', 'description' => 'Tiered loyalty program — Member → Silver → Gold → Platinum, with points redeemable at checkout.', 'image' => 'assets/loyalty-BH4tWAMn.webp', 'sort_order' => 7],
            ['number' => 8, 'title' => 'Account Settings', 'description' => 'Shopping, account, support and policies grouped into a clean settings tree.', 'image' => 'assets/settings-D5BeYM3F.webp', 'sort_order' => 8],
            ['number' => 9, 'title' => 'Help Center', 'description' => 'Order tracking, payments, policies and direct WhatsApp / email / phone support.', 'image' => 'assets/help-CTN790gA.webp', 'sort_order' => 9],
        ];

        foreach ($screens as $screen) {
            ProjectScreen::updateOrCreate(
                ['project_id' => $project->id, 'number' => $screen['number']],
                $screen
            );
        }
    }

    private function readBladeRaw(string $filename): string
    {
        return file_get_contents($this->pagesPath.'/'.$filename);
    }

    private function readBlade(string $filename): string
    {
        return render_cms_html($this->readBladeRaw($filename));
    }

    private function pageTitleFromMeta(string $metaTitle): string
    {
        $title = preg_replace('/\s*—\s*LogicsGrid\s*$/', '', $metaTitle) ?? $metaTitle;

        return trim($title);
    }

    /**
     * @return array<string, mixed>
     */
    private function extractProjectData(string $html): array
    {
        $data = [];

        if (preg_match('/aspect-\[16\/9\].*?asset\(\x27assets\/([^\x27]+)\x27\)/s', $html, $match)) {
            $data['cover_image'] = 'assets/'.$match[1];
        } else {
            preg_match_all("/asset\(\x27assets\/([^\x27]+)\x27\)/", $html, $assets);
            foreach ($assets[1] as $asset) {
                if (str_contains($asset, '-cover-') || str_starts_with($asset, 'cover-')) {
                    $data['cover_image'] = 'assets/'.$asset;
                    break;
                }
            }
        }

        if (preg_match('/>Client<\/div><div[^>]*>([^<]+)</', $html, $match)) {
            $data['client_name'] = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        if (preg_match('/>Year<\/div><div[^>]*>([^<]+)</', $html, $match)) {
            $data['year'] = trim($match[1]);
        }

        if (preg_match('/>Duration<\/div><div[^>]*>([^<]+)</', $html, $match)) {
            $data['duration'] = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        if (preg_match('/>Team<\/div><div[^>]*>([^<]+)</', $html, $match)) {
            $data['team_info'] = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        if (preg_match('/>Live<\/div><div[^>]*>([^<]+)</', $html, $match)) {
            $data['live_label'] = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        if (preg_match('/background:#000000;color:#4ECDC4">([^<]+)<\/span>/', $html, $match)) {
            $data['category'] = trim($match[1]);
        }

        if (preg_match('/<h1[^>]*>.*?<span class="block"[^>]*>(.*?)<\/span>/s', $html, $match)) {
            $data['title'] = trim(html_entity_decode(strip_tags($match[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        if (preg_match('/<h1[^>]*>.*?<\/h1>\s*<p class="mt-8[^"]*"[^>]*>(.*?)<\/p>/s', $html, $match)) {
            $data['excerpt'] = html_entity_decode(strip_tags($match[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        foreach (['The Challenge' => 'challenge', 'Our Approach' => 'approach', 'The Outcome' => 'outcome'] as $label => $key) {
            $pattern = '/'.preg_quote($label, '/').'<\/span>.*?<p class="col-span-12 md:col-span-8[^"]*"[^>]*>(.*?)<\/p>/s';
            if (preg_match($pattern, $html, $match)) {
                $data[$key] = html_entity_decode(strip_tags($match[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
        }

        if (preg_match_all('/tabular-nums leading-none[^>]*>([^<]+)<\/div>\s*<div class="text-\[10px\][^>]*>([^<]+)</s', $html, $stats, PREG_SET_ORDER)) {
            $data['featured_stat_value'] = trim($stats[0][1]);
            $data['featured_stat_label'] = trim($stats[0][2]);
        }

        if (preg_match('/href="(https:\/\/apps\.apple\.com[^"]+)"/', $html, $match)) {
            $data['app_store_url'] = $match[1];
        }

        if (preg_match('/href="(https:\/\/play\.google\.com[^"]+)"/', $html, $match)) {
            $data['play_store_url'] = $match[1];
        }

        if (preg_match('/Technologies<\/span>.*?<div class="mt-8 flex flex-wrap gap-2">(.*?)<\/div>/s', $html, $match)) {
            preg_match_all('/>([^<]+)<\/span>/', $match[1], $techs);
            $data['technologies'] = array_values(array_filter(array_map('trim', $techs[1] ?? [])));
        }

        if (preg_match('/What we delivered<\/span>.*?<ul class="mt-8 space-y-3">(.*?)<\/ul>/s', $html, $match)) {
            preg_match_all('/<li[^>]*>.*?<span[^>]*><\/span>([^<]+)<\/li>/s', $match[1], $deliverables);
            $data['deliverables'] = array_map(
                fn (string $item) => html_entity_decode(trim($item), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                $deliverables[1] ?? []
            );
        }

        return $data;
    }
}
