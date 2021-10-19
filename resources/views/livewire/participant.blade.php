<div>
    <div class="mb-3 flex flex-col items-end">
        <x-create-button wire:click="openModal('create')">
            Add Participant
        </x-create-button>
    </div>

    <div>
        @if (session()->has('message'))
            <div class="w-full p-6 mb-3 bg-green-300">
                {{ session('message') }}
            </div>
        @endif

        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">Full Name</th>
                    <th class="py-3 px-6">Bussiness Name</th>
                    <th class="py-3 px-6">Email</th>
                    <th class="py-3 px-6">Phone Number</th>
                    <th class="py-3 px-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($participants->count() > 0)
                    
                @foreach ($participants as $participant)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-4 py-2 font-medium">{{ $participant->full_name }}</td>
                    <td class="px-4 py-2 font-medium">{{ $participant->bussiness_name }}</td>
                    <td class="px-4 py-2 font-medium">{{ $participant->email }}</td>
                    <td class="px-4 py-2 font-medium">{{ $participant->phone }}</td>
                    <td class="px-4 py-2 font-medium">
                        <div class="flex item-center justify-center">
                            <a wire:click="edit({{ $participant->id }})" style="cursor: pointer">
                                <div class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                            </a>
                            <a wire:click="openModal('delete', {{ $participant->id }})" style="cursor: pointer;">
                                <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
    
                @else
                    
                <tr>
                    <td colspan="5" class="border px-4 py-2 font-medium text-center">No Participant.</td> 
                </tr>
    
                @endif
            </tbody>
        </table>
    
        {{ $participants->links() }}
    
        @if ($modalVisible)
            @switch($action)
                @case('create')
                    <x-create-modal title="Add a Participant" action="create"/>
                    
                    @break
                
                @case('edit')
                    <x-create-modal title="Edit Participant Data" action="edit"/>
                    
                    @break

                @case('delete')
                    <x-create-modal title="Remove a Participant" action="delete"/>            
                    
                    @break
                @default
                    
            @endswitch
        @endif

    </div>
</div>
