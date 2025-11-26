<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\InteractiveVideo;
use App\Models\InteractiveQuestion;
use Illuminate\Support\Facades\Storage;

class InteractiveVideoPlayer extends Component
{
    // TAMBAHKAN BARIS INI
    protected $layout = 'layouts.app';

    public $videoId;
    public $video;
    public $interactiveQuestions = [];
    public $videoUrl;

    public function mount($videoId)
    {
        $this->videoId = $videoId;
        $this->video = InteractiveVideo::with('interactiveQuestions')->findOrFail($this->videoId);
        
        // Load questions sorted by time_marker
        $this->interactiveQuestions = $this->video->interactiveQuestions
            ->sortBy('time_marker')
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'time_marker' => $question->time_marker,
                    'question' => $question->question,
                    'option_a' => $question->option_a,
                    'option_b' => $question->option_b,
                    'option_c' => $question->option_c,
                    'option_d' => $question->option_d,
                    'correct_answer' => $question->correct_answer,
                    'shown' => false // For tracking
                ];
            })
            ->toArray();
        
        $this->videoUrl = Storage::url($this->video->video_path);
    }

    public function render()
    {
        return view('livewire.interactive-video-player');
    }
}