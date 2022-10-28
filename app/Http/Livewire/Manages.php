<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Manage;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Manages extends LivewireDatatable
{
    public $model = Manage::class;
	public $search;
    public $postId,$title,$description;
    public $isOpen = 0;

	public function render()
    {       
        $searchParams = '%'.$this->search.'%';
        return view('livewire.manage', [
            'manages' => Manage::where('name','email', $searchParams)->latest()->paginate(5)
        ]);
    }

    function columns()
    {
    	return [
    		NumberColumn::name('id')->label('ID')->sortBy('id'),
    		Column::name('name')->label('Name'),
    		Column::name('email')->label('Email Address'),
    		Column::name('gender')->label('Gender'),
    		DateColumn::name('created_at')->label('Creation Date')
    	];
    }

	public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

	public function store(){
        $this->validate(
            [
                'name' => 'required',
                'email' => 'required',
				'gender' => 'required',
			]
        );

        Manage::updateOrCreate(['id' => $this->postId], [
            'name' => $this->title,
            'email' => $this->email,
			'gender' => $this->gender,
        ]);

        $this->hideModal();

        session()->flash('info', $this->postId ? 'Post Update Successfully' : 'Post Created Successfully' );

        $this->postId = '';
        $this->title = '';
        $this->gender = '';
    }

	public function edit($id){
        $manage = Manage::findOrFail($id);
        $this->postId = $id;
        $this->name = $manage->name;
        $this->gender = $manage->gender;

        $this->showModal();
    }

    public function delete($id){
        Manage::find($id)->delete();
        session()->flash('delete','Post Successfully Deleted');
    }
}

