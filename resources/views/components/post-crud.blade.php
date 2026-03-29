<?php

use Livewire\Component;
use App\Models\Post;

return new class extends Component
{
    public $posts, $title, $content, $post_id;
    public $updateMode = false;

    public function mount()
    {
        // $this->posts = Post::all();
    }

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.post-crud');
    }
};
?>

<div>
    <h1>Post CRUD</h1>
    <input type="text" wire:model="title" placeholder="Title">
    <textarea wire:model="content" placeholder="Content"></textarea>
    <button wire:click="store()">Create Post</button>

    @foreach($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <button wire:click="edit({{ $post->id }})">Edit</button>
            <button wire:click="delete({{ $post->id }})">Delete</button>
        </div>
    @endforeach
</div>