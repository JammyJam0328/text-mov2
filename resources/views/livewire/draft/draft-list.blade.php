<div>
    <div>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <x-input icon="search"
                    wire:model.debounce.500ms="search"
                    placeholder="Search..." />
            </div>

        </div>
        <div class="flex flex-col mt-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($drafts as $message)
                                    <tr class="hover:bg-slate-100">
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 text-gray-600"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $message->body }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $message->created_at->diffForHumans() }}
                                        </td>
                                        <td
                                            class="relative flex justify-end py-2 pl-3 pr-4 space-x-2 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                            <x-button wire:click="view({{ $message->id }})">
                                                View
                                            </x-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="flex items-center justify-center py-4 space-x-3 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6 text-gray-700"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span> No messages found.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        {{ $drafts->links() }}
                    </div>
                </div>
            </div>
        </div>
        {{-- <x-modal.card wire:model.defer="create"
            title="Create Message">
            <form class="space-y-4">
                @csrf
                <div id="message_body">
                    <x-textarea label="Message"
                        wire:model.defer="body"
                        placeholder="Start typing... " />
                </div>
                <div id="departments_list">
                    <div x-data="{ isOpen: false }"
                        x-on:click.away="isOpen=false">
                        <label for="combobox"
                            class="block text-sm font-medium text-gray-700">Select Department</label>
                        <div class="relative mt-1">
                            <x-button class="w-full"
                                x-on:click="isOpen=!isOpen">
                                Select {{ count($receivers) }}
                            </x-button>
                            <ul x-cloak
                                x-show="isOpen"
                                class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                id="options"
                                role="listbox">

                                @foreach ($departments as $key => $department)
                                    <li wire:key="{{ $key }}-select"
                                        x-on:click="$wire.select({{ $department->id }})"
                                        class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9 hover:bg-gray-100"
                                        id="option-0"
                                        role="option"
                                        tabindex="-1">
                                        <span class="block truncate">
                                            {{ $department->name }}
                                        </span>
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                            @if (in_array($department->id, $receivers))
                                                <svg class="w-5 h-5"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <div id="upload_attachement">
                    <x-input label="Attachements"
                        wire:model="attachments"
                        type="file" />
                    <span wire:loading
                        wire:target="attachments">
                        loading ....
                    </span>
                    @if ($attachments)
                        <span class="text-green-500">
                            File is ready
                        </span>
                    @endif
                </div>

            </form>
            <x-slot name="footer">
                <div class="flex space-x-3">
                    <x-button wire:click="continueSendAsDraftHandler">
                        Save as draft
                    </x-button>
                    <x-button wire:click="clickSendHandler"
                        primary>
                        Send
                    </x-button>
                </div>
            </x-slot>
        </x-modal.card> --}}
        <x-modal.card wire:model.defer="view"
            title="Message Details">
            <div class="overflow-hidden ">
                <div class="px-4 py-5 border-gray-200 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Sender</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $view_details?->sender }}
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Message</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $view_details?->body }}
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Selected Colleges
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $view_details?->receivers->count() }}
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Attachements</dt>
                            <dd class="mt-1 space-y-2 text-sm text-gray-900 sm:mt-0 sm:col-span-2 ">
                                @if ($view_details)
                                    @foreach ($view_details?->attachments as $key => $attachment)
                                        <a href="{{ Storage::url($attachment->path) }}"
                                            class="text-blue-600 underline">
                                            Attachement {{ $key + 1 }}
                                        </a>
                                    @endforeach
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex space-x-3">
                    <x-button wire:click="clickResendHandler"
                        spinner="clickContinueHandler"
                        info>
                        Resend
                    </x-button>
                </div>
            </x-slot>
        </x-modal.card>
    </div>
</div>
