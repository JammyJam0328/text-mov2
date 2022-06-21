<div>
    <div>
        <div class="sm:flex sm:items-center">
            <div class="flex w-full space-x-3">
                <x-input icon="search"
                    wire:model.debounce.500ms="search"
                    placeholder="Search..." />
                <x-native-select wire:model="filter">
                    <option value="">All</option>
                    <option value="1">Complete</option>
                    <option value="0">Ongoing</option>
                </x-native-select>
            </div>
            <div class="flex justify-end w-full mt-4 sm:mt-0 sm:ml-16">
                <x-button primary
                    wire:click="$set('create',true)">
                    Add Event
                </x-button>
            </div>
        </div>
        <div class="flex flex-col mt-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Event Title
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Event Description
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Start Date
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        End Date
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($events as $event)
                                    <tr>
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            {{ $event->title }}
                                        </td>
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            {{ $event->description }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $event->start_date }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $event->end_date }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{-- {{ $event->status == '0' ? 'Not Complete' : 'Complete' }} --}}
                                            @if ($event->status == '0')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Not Complete </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Complete </span>
                                            @endif
                                        </td>
                                        <td
                                            class="relative flex justify-end py-4 pl-3 pr-4 space-x-2 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                            <div class="flex space-x-2">
                                                <x-button warning>
                                                    Edit
                                                </x-button>
                                                <x-button negative>
                                                    Delete
                                                </x-button>
                                            </div>
                                            <div>
                                                @if ($event->status == '0')
                                                    <x-button
                                                        wire:click="clickMarkAsCompleteHandler({{ $event->id }})"
                                                        positive>
                                                        Mark Complete
                                                    </x-button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="py-4 text-center text-gray-500">
                                            No events found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="create_modal">
            <x-modal.card wire:model.defer="create"
                title="Create Event">
                <form class="space-y-4">
                    <x-input label="Title"
                        wire:model.defer="title" />
                    <x-textarea wire:model="description"
                        label="Description"
                        placeholder="Enter event description" />
                    <x-input label="Date Start"
                        type="date"
                        wire:model.defer="start_date" />
                    <x-input label="Date End"
                        type="date"
                        wire:model.defer="end_date" />
                </form>
                <x-slot name="footer">
                    <x-button primary
                        spinner="clickCreateHandler"
                        wire:click="clickCreateHandler">
                        Save
                    </x-button>
                </x-slot>
            </x-modal.card>
        </div>
        {{-- <div id="edit_modal">
            <x-modal.card wire:model.defer="edit"
                title="Update Department">
                <form class="space-y-4">
                    <x-input label="Name"
                        wire:model.defer="edit_name" />
                    <x-input label="Abbreviation"
                        wire:model.defer="edit_abbreviation" />
                </form>
                <x-slot name="footer">
                    <x-button primary
                        spinner="clickUpdateHandler"
                        wire:click="clickUpdateHandler">
                        Save update
                    </x-button>
                </x-slot>
            </x-modal.card>
        </div> --}}
    </div>
</div>
