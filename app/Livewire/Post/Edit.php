<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Category;
use App\Models\Poll;
use App\Traits\HasNotifications;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use HasNotifications;
    use WithFileUploads;

    public $post;
    public $tags = [];
    public $tagsString = '';
    public $title;
    public $sub_title;
    public $summary;
    public $content;
    public $category_id;
    public $featured_image;
    public $image_caption;
    public $video_url;
    public $keywords;
    public $status;
    public $is_featured;
    public $is_breaking;
    public $is_slider;
    public $section;
    public $published_at;
    public $meta_title;
    public $meta_description;
    public $categories;
    public $poll_id;

    public function mount($id)
    {
        $this->post = Post::findOrFail($id);

        $this->title = $this->post->title;
        $this->sub_title = $this->post->sub_title;
        $this->summary = $this->post->summary;
        $this->content = $this->post->content;
        $this->category_id = $this->post->category_id;
        $this->image_caption = $this->post->image_caption;
        $this->video_url = $this->post->video_url;
        $this->keywords = $this->post->keywords;
        $this->status = $this->post->status;
        $this->is_featured = $this->post->is_featured;
        $this->is_breaking = $this->post->is_breaking;
        $this->is_slider = $this->post->is_slider;
        $this->section = $this->post->section;
        $this->published_at = $this->post->published_at ? $this->post->published_at->format('Y-m-d\TH:i') : null;
        $this->meta_title = $this->post->meta_title;
        $this->meta_description = $this->post->meta_description;
        $this->categories = Category::all();
        $this->poll_id = $this->post->poll_id;

        // Convert keywords to tags array
        $this->tags = array_filter(array_map('trim', explode(',', $this->post->keywords)));
        $this->tagsString = implode(',', $this->tags);
    }

    public function update()
    {
        $validated = $this->validate([
            'title'         => 'required|min:3',
            'sub_title'     => 'nullable',
            'summary'       => 'nullable',
            'content'       => 'required',
            'category_id'   => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|max:1024',
            'image_caption' => 'nullable|string|max:255',
            'video_url'     => 'nullable|url',
            'keywords'      => 'nullable|string|max:255',
            'status'        => 'required|in:draft,pending,published,archived',
            'is_featured'   => 'required|in:0,1',
            'is_breaking'   => 'required|in:0,1',
            'is_slider'     => 'required|in:0,1,2',
            'section'       => 'integer',
            'published_at'  => 'nullable|date',
            'meta_title'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tagsString'    => 'nullable|string',
            'poll_id'       => 'nullable',
        ]);

        // Convert tagsString CSV → array
        $this->tags = array_filter(array_map('trim', explode(',', $this->tagsString)));

        // Handle image upload
        if ($this->featured_image) {
            if ($this->post->featured_image) {
                Storage::disk('public')->delete($this->post->featured_image);
            }
            $imageName = "post-" . time() . '.' . $this->featured_image->getClientOriginalExtension();
            $validated['featured_image'] = $this->featured_image->storeAs('posts', $imageName, 'public');
        } else {
            // Preserve existing image if no new image is uploaded
            $validated['featured_image'] = $this->post->featured_image;
        }

        try {
            // Update post
            $this->post->update(array_merge($validated, [
                'keywords' => implode(',', $this->tags),
                'poll_id' => $this->poll_id,
            ]));

            $this->succsessNotify("Post updated successfully!");
            return $this->redirect(route('posts.index'), navigate: true);
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Post update failed: " . $th->getMessage());
            // Optionally you can stay on page and not redirect here
        }
    }

    public function render()
    {
        return view('livewire.post.edit', [
            'polls' => Poll::where('status','active')->where('start_date', '<=', now())->where('end_date', '>=', now())->latest()->get(),
        ]);
    }
}