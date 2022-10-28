<div>
    <button wire:click="showModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded mb-2">
        Create Post
</button>
    <livewire:datatable model="App\Models\Manage" name="all-users" />
</div>
<div>
    @if($isOpen)
    @include('livewire.create')
    @endif



