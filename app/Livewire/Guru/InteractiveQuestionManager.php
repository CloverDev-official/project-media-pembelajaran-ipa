<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\InteractiveVideo;
use App\Models\InteractiveQuestion;

class InteractiveQuestionManager extends Component
{
    public $video;
    public $questions = [];
    public $newQuestion = [
        'time_marker' => '',
        'question' => '',
        'option_a' => '',
        'option_b' => '',
        'option_c' => '',
        'option_d' => '',
        'correct_answer' => '',
    ];

    public function mount($video)
    {
        $this->video = InteractiveVideo::with('questions')->findOrFail($video);
        $this->questions = $this->video->questions->map(function ($question) {
            return [
                'id' => $question->id,
                'time_marker' => $question->time_marker,
                'question' => $question->question,
                'option_a' => $question->option_a,
                'option_b' => $question->option_b,
                'option_c' => $question->option_c,
                'option_d' => $question->option_d,
                'correct_answer' => $question->correct_answer,
            ];
        })->toArray();
    }

    public function addQuestion()
    {
        // Validasi manual tanpa $rules
        if (empty($this->newQuestion['time_marker']) || !is_numeric($this->newQuestion['time_marker']) || $this->newQuestion['time_marker'] < 0) {
            session()->flash('error', 'Waktu muncul harus berupa angka positif.');
            return;
        }
        
        if (empty($this->newQuestion['question']) || empty($this->newQuestion['option_a']) || empty($this->newQuestion['option_b']) || empty($this->newQuestion['option_c']) || empty($this->newQuestion['option_d']) || empty($this->newQuestion['correct_answer'])) {
            session()->flash('error', 'Semua field harus diisi.');
            return;
        }

        $this->video->questions()->create([
            'time_marker' => $this->newQuestion['time_marker'],
            'question' => $this->newQuestion['question'],
            'option_a' => $this->newQuestion['option_a'],
            'option_b' => $this->newQuestion['option_b'],
            'option_c' => $this->newQuestion['option_c'],
            'option_d' => $this->newQuestion['option_d'],
            'correct_answer' => $this->newQuestion['correct_answer'],
        ]);

        $this->reset('newQuestion');
        $this->mount($this->video->id); // Refresh data
        session()->flash('message', 'Pertanyaan berhasil ditambahkan!');
    }

    public function deleteQuestion($id)
    {
        $question = InteractiveQuestion::findOrFail($id);
        $question->delete();
        $this->mount($this->video->id); // Refresh data
        session()->flash('message', 'Pertanyaan berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.guru.interactive-question-manager')
            ->layout('components.layouts.app-guru');
    }
}