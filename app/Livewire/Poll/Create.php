<?php

namespace App\Livewire\Poll;

use App\Models\Poll;
use App\Models\PollOption;
use App\Traits\HasNotifications;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Create extends Component
{
   use HasNotifications;
   public $question;
   public $status = 'upcoming';
   public $start_date;
   public $end_date;
   public $options = [''];

   protected $rules = [
      'question' => 'required|string',
      'status' => 'required|in:active,closed,upcoming',
      'start_date' => 'nullable|date',
      'end_date' => 'nullable|date|after_or_equal:start_date',
      'options' => 'required|array|min:2',
      'options.*' => 'required|string|min:1',
   ];

   public function addOption()
   {
      $this->options[] = '';
   }

   public function removeOption($index)
   {
      if (count($this->options) > 2) {
         array_splice($this->options, $index, 1);
      }
   }

   public function submit()
   {
      $this->validate();
      $poll = Poll::create([
         'question' => $this->question,
         'status' => $this->status,
         'start_date' => $this->start_date,
         'end_date' => $this->end_date,
      ]);
      foreach ($this->options as $option) {
         PollOption::create([
            'poll_id' => $poll->id,
            'option_text' => $option,
         ]);
      }
      // session()->flash('success', ' successfully!');
      $this->succsessNotify("Poll created successfully!");
      if (Auth::user()->can('post.maintenance')) {
          return $this->redirect(route('posts.polls.index'), navigate: true);
      } else {
          return $this->redirect(route('settings.posts'), navigate: true);
      }
   }

   public function render()
   {
      return view('livewire.poll.create');
   }
}