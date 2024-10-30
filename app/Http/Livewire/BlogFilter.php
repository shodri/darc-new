<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class BlogFilter extends Component
{
    public $selectedCategory;
    public $selectedTag;

    public function mount()
    {
        // Inicializar los filtros desde la sesión si están presentes
        $this->selectedCategory = session()->get('blog_category_filter');
        $this->selectedTag = session()->get('blog_tag_filter');
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->selectedTag = null;
        session()->put('blog_category_filter', $this->selectedCategory);
        session()->forget('blog_tag_filter');
    }

    public function filterByTag($tagId)
    {
        $this->selectedTag = $tagId;
        $this->selectedCategory = null;
        session()->put('blog_tag_filter', $this->selectedTag);
        session()->forget('blog_category_filter');
    }

    public function resetFilters()
    {
        $this->selectedCategory = null;
        $this->selectedTag = null;
        session()->forget('blog_category_filter');
        session()->forget('blog_tag_filter');
    }

    public function render()
    {
        $query = Post::orderBy('created_at', 'desc');

        if (!is_null($this->selectedCategory)) {
            $selectedCategory = Category::findOrFail($this->selectedCategory);
            $query->where('category_id', $selectedCategory->id);
        }

        if (!is_null($this->selectedTag)) {
            $selectedTag = Tag::findOrFail($this->selectedTag);
            $query->whereHas('tags', function ($q) {
                $q->where('tags.id', $this->selectedTag);
            });
        }

        $posts = $query->paginate(2);
        $categories = Category::has('posts')->get();
        $tags = Tag::has('posts')->get();

        return view('livewire.blog-filter', compact('posts', 'categories', 'tags'));
    }
}
