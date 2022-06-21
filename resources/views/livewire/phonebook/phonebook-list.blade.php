<div>
    <div>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <x-input icon="search"
                    wire:model.debounce.500ms="search"
                    placeholder="Search..." />
            </div>
            <div class="mt-4 space-x-3 sm:mt-0 sm:ml-16 sm:flex-none">
                <x-button primary
                    wire:click="$set('create',true)">
                    Add Phonebook
                </x-button>
                <x-button gray
                    wire:click="$set('importing',true)">
                    Import Phonebook
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
                                        class="py-3.5 pl-4 pr-3 flex space-x-2 items-center text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        <input type="checkbox"
                                            wire:model="selectAll"
                                            name="selectAll"
                                            @checked($selectAll)
                                            id="selectAll">
                                        @if ($selecteds)
                                            <x-button negative
                                                wire:click="deleteSelecteds"
                                                icon="trash"
                                                sm>

                                            </x-button>
                                        @endif
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Name</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Phone Number
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">College
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Year Level
                                    </th>
                                    <th scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($phonebooks as $key=>$phonebook)
                                    <tr>
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            <input wire:model="selecteds"
                                                wire:key="{{ $key }}-checbox"
                                                value="{{ $phonebook->id }}"
                                                type="checkbox"
                                                name="selectAll"
                                                id="selectAll"
                                                @checked(in_array($phonebook->id, $selecteds))>
                                        </td>
                                        </td>
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            {{ $phonebook->name }}</td>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $phonebook->contact_number }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $phonebook->department->name }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $phonebook->year_level }}
                                        </td>
                                        <td
                                            class="relative flex justify-end py-4 pl-3 pr-4 space-x-3 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                            <x-button warning
                                                wire:click="clickEditHandler({{ $phonebook->id }})">
                                                Edit
                                            </x-button>
                                            <x-button negative
                                                wire:click="clickDeleteHandler({{ $phonebook->id }})">
                                                Delete
                                            </x-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="py-4 text-center">No phonebooks found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        {{ $phonebooks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="create_modal">
        <x-modal.card wire:model.defer="create"
            title="Create Contact">
            <form class="space-y-4">
                <x-input label="Name"
                    wire:model.defer="name" />
                <x-input label="Contact Number"
                    wire:model.defer="phone_number" />
                <x-native-select label="College"
                    wire:model.defer="department_id">
                    <option value=""
                        selected>-select--</option>
                    @foreach (\App\Models\Department::get() as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </x-native-select>
                <x-native-select label="Year Level"
                    wire:model.defer="year_level">
                    <option value=""
                        selected>-select--</option>
                    @for ($i = 1; $i <= 6; $i++)
                        <option>{{ $i }}</option>
                    @endfor
                </x-native-select>
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
            title="Update Contact">
            <form class="space-y-4">
                <x-input label="Name"
                    wire:model.defer="edit_name" />
                <x-input label="Contact Number"
                    wire:model.defer="edit_phone_number" />
                <x-native-select label="College"
                    wire:model.defer="edit_department_id">
                    <option value=""
                        selected>-select--</option>
                    @foreach (\App\Models\Department::get() as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </x-native-select>
                <x-native-select label="Year Level"
                    wire:model.defer="edit_year_level">
                    <option value=""
                        selected>-select--</option>
                    @for ($i = 1; $i <= 6; $i++)
                        <option>{{ $i }}</option>
                    @endfor
                </x-native-select>
            </form>
            <x-slot name="footer">
                <x-button primary
                    spinner="clickUpdateHandler"
                    wire:click="clickUpdateHandler">
                    Save
                </x-button>
            </x-slot>
        </x-modal.card>
    </div>
    <div id="importing_modal">
        <x-modal.card wire:model.defer="importing"
            title="Import Phonebook">
            <form class="grid space-y-4">
                <div class="flex items-center justify-center w-full bg-grey-lighter">
                    <label
                        class="flex flex-col items-center w-64 px-4 py-6 tracking-wide uppercase bg-white border rounded-lg shadow-lg cursor-pointer text-blue border-blue hover:bg-blue ">
                        <div wire:loading.class="animate-bounce"
                            wire:target="csv_file">
                            <svg class="w-8 h-8"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                        </div>
                        <span class="mt-2 text-base leading-normal">Select a file </span>
                        <input type="file"
                            wire:model.defer="csv_file"
                            class="hidden" />
                    </label>

                </div>
                <div class="flex justify-center mt-4 text-gray-600">
                    <h1> Format : (Name/Number/Year Level/College ID)</h1>
                </div>
                <div wire:loading.flex
                    wire:target="csv_file"
                    class="flex justify-center mt-4 text-yellow-600">
                    <h1>
                        Please wait while we are preparing your file...
                    </h1>
                </div>
                <div id="message"
                    class="flex justify-center mt-4 text-yellow-600">
                    @if ($csv_file)
                        <h1 class="text-green-600">
                            Your file is ready to be imported.
                        </h1>
                    @endif
                </div>
            </form>
            <x-slot name="footer">
                <x-button primary
                    wire:click="clickImportHandler">
                    Save
                </x-button>
            </x-slot>
        </x-modal.card>
    </div>
</div>
