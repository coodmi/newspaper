<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Category;
use App\Models\Poll;
use App\Traits\HasNotifications;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use HasNotifications;
    use WithFileUploads;

    // public $title, $slug, $sub_title, $summary, $content;
    public $title, $slug, $sub_title, $summary;
    public $content = '';
    public $section = 0;
    public $tags = []; // tags as array
    public $tagsString = ''; // to hold tags as CSV string for binding
    public $featured_image, $image_caption, $video_url;
    public $category_id, $status = 'draft', $is_featured = false;
    public $is_breaking = false, $is_slider = '0', $published_at;
    public $meta_title, $meta_description;
    public $poll_id;

    public function mount()
    {
        $this->published_at = now()->format('Y-m-d\TH:i');
    }

    public function updateTags($tags)
    {
        $this->tags = $tags;
        $this->tagsString = implode(',', $tags);
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function updatedContent($value)
    {
        $this->content = $value;
    }

    public function submit()
    {

        // $this->tags = array_filter(array_map('trim', explode(',', $this->tagsString)));
        $validated = $this->validate([
            'title'          => 'required',
            'category_id'    => 'required|exists:categories,id',
            'content'        => 'required',
            'featured_image' => 'nullable|image|max:1024',
            'status'         => 'required|in:draft,pending,published,archived',
            'sub_title'      => 'nullable|string',
            'summary'        => 'nullable|string',
            'image_caption'  => 'nullable|string|max:255',
            'video_url'      => 'nullable|url',
            'is_featured'    => 'boolean',
            'is_breaking'    => 'boolean',
            'is_slider'      => 'integer|min:0',
            'section'        => 'integer|min:0', // Assuming section is an integer 0-10
            'meta_title'     => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tagsString'     => 'nullable|string', // CSV string, not array
            'poll_id'        => 'nullable|exists:polls,id',
        ]);

        // Convert tagsString CSV into array & clean
        $this->tags = array_filter(array_map('trim', explode(',', $this->tagsString)));

        if ($this->featured_image) {
            $imageName = "post-" . time() . '.' . $this->featured_image->getClientOriginalExtension();
            // $imagePath = $this->featured_image->storeAs('public/posts', $imageName);
            $imagePath = $this->featured_image->storeAs('posts', $imageName, 'public');
        }

        try {
            // dd($this->tags);
            $post = Post::create([
                'user_id' => Auth::id(),
                'published_at' => $this->published_at,
                'title' => $this->title,
                'sub_title' => $this->sub_title,
                'summary' => $this->summary,
                'content' => $this->content,
                'category_id' => $this->category_id,
                'status' => $this->status,
                'featured_image' => $imagePath ?? null,
                'slug' => Str::slug($this->title) . '-' . uniqid(),
                'image_caption' => $this->image_caption,
                'video_url' => $this->video_url,
                'keywords' => implode(',', $this->tags), // save tags as CSV string
                'is_featured' => $this->is_featured,
                'is_breaking' => $this->is_breaking,
                'is_slider' => $this->is_slider,
                'section' => $this->section,
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
                'created_by' => Auth::id(),
                'poll_id' => $this->poll_id,
            ]);

            $this->succsessNotify("Post created successfully!");
            if (Auth::user()->can('post.maintenance')) {
                return $this->redirect(route('posts.index'), navigate: true);
            } else {
                return $this->redirect(route('settings.posts'), navigate: true);
            }
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Post creation failed: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.post.create', [
            'categories' => Category::all(),
            'polls' => Poll::where('status','active')->where('start_date', '<=', now())->where('end_date', '>=', now())->latest()->get(),
        ]);
    }
}