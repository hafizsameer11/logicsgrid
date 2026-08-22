<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index();
            $table->string('key')->index();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();
            $table->unique(['group', 'key']);
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('body_html')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('number')->default(1);
            $table->string('category_label');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->json('tags')->nullable();
            $table->longText('body_html')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('client_name')->nullable();
            $table->string('location')->nullable();
            $table->string('category')->nullable();
            $table->string('year')->nullable();
            $table->string('engagement_type')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('challenge')->nullable();
            $table->text('approach')->nullable();
            $table->text('outcome')->nullable();
            $table->string('duration')->nullable();
            $table->string('team_info')->nullable();
            $table->string('live_url')->nullable();
            $table->string('live_label')->nullable();
            $table->string('app_store_url')->nullable();
            $table->string('play_store_url')->nullable();
            $table->string('featured_stat_value')->nullable();
            $table->string('featured_stat_label')->nullable();
            $table->json('technologies')->nullable();
            $table->json('deliverables')->nullable();
            $table->string('meta_title')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('project_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('value');
            $table->string('label');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('project_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('number')->default(1);
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('project_screens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('number')->default(1);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_badge')->nullable();
            $table->string('title')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('location')->nullable();
            $table->string('initials')->nullable();
            $table->json('skills')->nullable();
            $table->string('section')->default('crew');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->string('author');
            $table->string('role')->nullable();
            $table->boolean('is_dark')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number');
            $table->string('phase');
            $table->string('title');
            $table->string('outcome_label')->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('why_reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('problem_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('solution_tag')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('marquee_items', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('context')->index();
            $table->string('value');
            $table->string('label');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('label');
            $table->string('url');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
        Schema::dropIfExists('social_links');
        Schema::dropIfExists('stats');
        Schema::dropIfExists('marquee_items');
        Schema::dropIfExists('problem_cards');
        Schema::dropIfExists('why_reasons');
        Schema::dropIfExists('process_steps');
        Schema::dropIfExists('industries');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('project_screens');
        Schema::dropIfExists('project_features');
        Schema::dropIfExists('project_stats');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('services');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('site_settings');
    }
};
