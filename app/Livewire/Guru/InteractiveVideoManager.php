<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\InteractiveVideo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InteractiveVideoManager extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $videoFile;
    public $thumbnailFile;
    public $isUploading = false;
    public $uploadProgress = 0;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'videoFile' => 'required|file|mimes:mp4,mov,avi,mkv|max:51200',
        'thumbnailFile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ];

    public function render()
    {
        $videos = InteractiveVideo::all();
        return view('livewire.guru.interactive-video-manager', ['videos' => $videos])
            ->layout('components.layouts.app-guru');
    }

    public function saveVideo()
    {
        $validatedData = $this->validate();

        $this->isUploading = true;
        $this->uploadProgress = 0;

        // Handle video file
        $fileName = Str::slug($validatedData['title']) . '_' . time() . '.' . $this->videoFile->getClientOriginalExtension();
        $filePath = $this->videoFile->storeAs('videos', $fileName, 'public');

        // Handle thumbnail file if provided
        $thumbnailPath = null;
        if ($this->thumbnailFile) {
            $thumbnailName = Str::slug($validatedData['title']) . '_thumb_' . time() . '.' . $this->thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $this->thumbnailFile->storeAs('thumbnails', $thumbnailName, 'public');
        }

        InteractiveVideo::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'video_path' => $filePath,
            'thumbnail_path' => $thumbnailPath,
        ]);

        $this->reset(['title', 'description', 'videoFile', 'thumbnailFile']);
        $this->isUploading = false;
        
        session()->flash('message', 'Video berhasil diunggah!');
    }

    public function deleteVideo($id)
    {
        $video = InteractiveVideo::find($id);

        if ($video) {
            // Delete video file
            if (Storage::disk('public')->exists($video->video_path)) {
                Storage::disk('public')->delete($video->video_path);
            }

            // Delete thumbnail if exists
            if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }

            $video->delete();
            session()->flash('message', 'Video berhasil dihapus!');
        }
    }
}