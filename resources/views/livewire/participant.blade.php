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
                            <div class="has-tooltip">
                                <span class='tooltip rounded text-sm shadow-lg py-1 px-3 bg-gray-100 -mt-8'>Edit</span>

                                <a wire:click="edit({{ $participant->id }})" style="cursor: pointer">
                                    <div class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <div class="has-tooltip">
                                <span class='tooltip rounded text-sm shadow-lg py-1 px-3 bg-gray-100 -mt-8'>Delete</span>

                                <a wire:click="openModal('delete', {{ $participant->id }})" style="cursor: pointer;">
                                    <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <div class="has-tooltip">
                                <span class='tooltip rounded text-sm shadow-lg py-1 px-3 bg-gray-100 -mt-8'>Print Certificate</span>

                                <a href="{{ route('print', [ 'type' => 'certificate', 'id' => $participant->id ]) }}" style="cursor: pointer;">
                                    <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <div class="has-tooltip">
                                <span class='tooltip rounded text-sm shadow-lg py-1 px-3 bg-gray-100 -mt-8'>Print Name Tag</span>

                                <a href="{{ route('print', [ 'type' => 'nametag', 'id' =>  $participant->id ]) }}" style="cursor: pointer;">
                                    <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
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
