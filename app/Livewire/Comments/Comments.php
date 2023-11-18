<?php

namespace App\Livewire\Comments;

use App\Models\Comments as ModelsComments;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Comments extends Component
{

    #[Locked]
    public $idBook;
    public $comment;

    public function mount($idBook=null) {
        $this->idBook = $idBook;
    }

    public function saveComment() {
        if(!Auth::check()) {
            session()->flash('error', 'Bạn cần đăng nhập để bình luận');
            return redirect('/login');
        }

        ModelsComments::create([
            'user_id' => Auth::user()->id,
            'book_id' => $this->idBook,
            'comment' => $this->comment,
        ]);

        $this->dispatch('commentSucceeded');
        $this->reset('comment');
    }

    public function render()
    {
        return view('livewire.comments.comments');
    }
}
