<div>
    <div>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <x-input icon="search"
                    wire:model.debounce.500ms="search"
                    placeholder="Search..." />
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <x-button primary
                    wire:click="$set('create',true)">
                    Add College
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
                                        #ID
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Name</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Abbreviation
                                    </th>
                                    <th scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($departments as $department)
                                    <tr>
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            {{ $department->id }}</td>
                                        </td>
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            {{ $department->name }}</td>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $department->abbreviation }}
                                        </td>

                                        <td
                                            class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                            <div class="flex justify-end space-x-3">
                                                <x-button wire:click="clickEditHandler({{ $department->id }})"
                                                    warning>
                                                    Edit
                                                </x-button>
                                                <x-button wire:click="clickDeleteHandler({{ $department->id }})"
                                                    negative>
                                                    Delete
                                                </x-button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"
                                            class="py-4 text-center">
                                            No departments found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div id="create_modal">
            <x-modal.card wire:model.defer="create"
                title="Create College">
                <form class="space-y-4">
                    <x-input label="Name"
                        placeholder="ex: College of Medicine"
                        wire:model.defer="name" />
                    <x-input label="Abbreviation"
                        placeholder="ex: COM"
                        wire:model.defer="abbreviation" />
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
        <div id="edit_modal">
            <x-modal.card wire:model.defer="edit"
                title="Update College">
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
        </div>
    </div>
</div>
