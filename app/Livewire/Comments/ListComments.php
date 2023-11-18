<?php

namespace App\Livewire\Comments;

use App\Models\Comments;
use App\Models\ReComments;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ListComments extends Component
{

    #[Locked]
    public $idBook;

    public $recomment;

    public $showInputReComments = false;


    public function mount($idBook=null) {
        $this->idBook = $idBook;
    }

    public function saveReComment($id=null) {
        ReComments::create([
            'user_id' => Auth::user()->id,
            'comment_id' => $id,
            'comment' => $this->recomment
        ]);

        $this->reset('recomment');
        $this->showInputReComments = false;
        $this->dispatch('renderReComment');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <svg>...</svg>
        </div>
        HTML;
    }


    #[On('renderReComment')]
    #[On('commentSucceeded')]
    public function render()
    {
        $comments = Comments::with('recomment')->where('book_id', $this->idBook)->orderBy('created_at', 'desc')->get();
        // dd($comments);
        return view('livewire.comments.list-comments',[
            'comments' => $comments
        ]);
    }
}
