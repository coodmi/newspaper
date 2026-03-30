<?php

namespace App\Livewire\Poll;

use App\Models\Poll;
use App\Traits\HasNotifications;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
   use WithPagination, HasNotifications;

   public $search = '';
   public $editingPollId = null;
   public $editData = [
      'question' => '',
      'status' => '',
      'start_date' => '',
      'end_date' => '',
   ];
   public $editOptions = [];

   protected $updatesQueryString = ['search'];

   public function updatingSearch()
   {
      $this->resetPage();
   }

   public function edit($id)
   {
      $poll = Poll::with('options')->findOrFail($id);
      $this->editingPollId = $id;
      $this->editData = [
         'question' => $poll->question,
         'status' => $poll->status,
         'start_date' => $poll->start_date,
         'end_date' => $poll->end_date,
      ];
      $this->editOptions = $poll->options->pluck('option_text')->toArray();
   }

   public function addOptionField()
   {
      $this->editOptions[] = '';
   }

   public function removeOptionField($index)
   {
      if (count($this->editOptions) > 2) {
         array_splice($this->editOptions, $index, 1);
      }
   }

   public function update()
   {
      $this->validate([
         'editData.question' => 'required|string',
         'editData.status' => 'required|in:active,closed,upcoming',
         'editData.start_date' => 'nullable|date',
         'editData.end_date' => 'nullable|date|after_or_equal:editData.start_date',
         'editOptions' => 'required|array|min:2',
         'editOptions.*' => 'required|string|min:1',
      ]);
      $poll = Poll::with('options')->findOrFail($this->editingPollId);
      $poll->update($this->editData);
      // Update poll options
      $poll->options()->delete();
      foreach ($this->editOptions as $optionText) {
         $poll->options()->create(['option_text' => $optionText]);
      }
      $this->editingPollId = null;
      // session()->flash('message', ' successfully!');
      $this->succsessNotify("Poll updated successfully!");
   }

   public function cancel()
   {
      $this->editingPollId = null;
      $this->editOptions = [];
   }

   public function render()
   {
      $polls = Poll::query()
         ->when($this->search, function ($query) {
            $query->where('question', 'like', '%' . $this->search . '%');
         })
         ->orderByDesc('id')
         ->paginate(10);
      return view('livewire.poll.index', [
         'polls' => $polls,
      ]);
   }
}