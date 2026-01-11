<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\About;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Hero;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::active()->first();
        $about = About::active()->with('items')->first();
        $skillsRow1 = Skill::active()->row(1)->orderBy('order')->get();
        $skillsRow2 = Skill::active()->row(2)->orderBy('order')->get();
        $projects = Project::active()->orderBy('order')->take(6)->get();
        $experiences = Experience::active()->orderBy('start_date', 'desc')->get();
        $socialMedia = SocialMedia::active()->orderBy('order')->get();

        return view('home', compact(
            'hero',
            'about',
            'skillsRow1',
            'skillsRow2',
            'projects',
            'experiences',
            'socialMedia'
        ));
    }

    public function projects()
    {
        $projects = Project::active()->orderBy('order')->paginate(12);
        $socialMedia = SocialMedia::active()->orderBy('order')->get();

        return view('projects', compact('projects', 'socialMedia'));
    }

    public function projectDetail(Project $project)
    {
        if (!$project->is_active) {
            abort(404);
        }

        $socialMedia = SocialMedia::active()->orderBy('order')->get();

        return view('project-detail', compact('project', 'socialMedia'));
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Simpan ke database
        Contact::create($validated);

        // Kirim email
        $emailSent = true;
        try {
            Mail::to(env('MAIL_TO_ADDRESS', 'Fadillatasya5@gmail.com'))
                ->send(new ContactFormMail(
                    $validated['name'],
                    $validated['email'],
                    $validated['message']
                ));
        } catch (\Exception $e) {
            // Log error tapi tetap lanjut (pesan sudah tersimpan di database)
            \Log::error('Failed to send contact email: ' . $e->getMessage());
            $emailSent = false;
        }

        // Return JSON for AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim! Terima kasih telah menghubungi kami.',
                'email_sent' => $emailSent
            ]);
        }

        return back()->with('success', 'Pesan berhasil dikirim! Terima kasih telah menghubungi kami.');
    }

    public function downloadCV()
    {
        $hero = Hero::active()->first();

        if ($hero && $hero->cv_file) {
            $path = storage_path('app/public/' . $hero->cv_file);
            if (file_exists($path)) {
                return response()->download($path);
            }
        }

        return back()->with('error', 'CV tidak tersedia.');
    }

    public function timelineData()
    {
        $experiences = Experience::active()->orderBy('start_date', 'desc')->get();

        $events = $experiences->map(function ($exp) {
            return $exp->toTimelineEvent();
        })->filter(function ($event) {
            return $event !== null;
        })->values()->toArray();

        return response()->json([
            'title' => [
                'text' => [
                    'headline' => 'Experience Timeline',
                    'text' => 'my career journey and experiences.',
                ],
            ],
            'events' => $events,
        ]);
    }
}
