<div id="add-modal">
    <div class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
            class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg"
            >
                <p class="font-semibold text-gray-800">{{ $title }}</p>
                <a style="cursor: pointer" wire:click="closeModal">
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </a>
            </div>

            @if ($action == 'create' || $action == 'edit')
            <form wire:submit.prevent="saveData">
                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-semibold text-gray-700">Full Name</label>
                        <x-input class="border py-2 px-3 text-grey-800" wire:model="fullName"/>
                        @error('fullName') <span class="text-red-500 error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-semibold text-gray-700">Bussiness Name</label>
                        <x-input class="border py-2 px-3 text-grey-800" wire:model="bussinessName"/>
                        @error('bussinessName') <span class="text-red-500 error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-semibold text-gray-700">Email</label>
                        <x-input class="border py-2 px-3 text-grey-800" wire:model="email"/>
                        @error('email') <span class="text-red-500 error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-semibold text-gray-700">Phone Number</label>
                        <x-input class="border py-2 px-3 text-grey-800" wire:model="phone"/>
                        @error('phone') <span class="text-red-500 error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div
                class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg"
                >
                    <a style="cursor: pointer" wire:click="closeModal" class="font-semibold text-gray-600">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-white font-semibold bg-blue-500 rounded">
                        Save
                    </button>
                </div>
            </form>
            @endif

            @if ($action == 'delete')
            <form wire:submit.prevent="destroy">
                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    <h4>Are you sure you want to remove this Participant?</h4>
                </div>

                <div
                class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg"
                >
                    <a style="cursor: pointer" wire:click="closeModal" class="font-semibold text-gray-600">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-white font-semibold bg-red-500 rounded">
                        Remove
                    </button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>
