@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@section('content')
    <div class="px-4">
        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::CHANGE_PASSWORD_PAGE_TITLE] }}</span>
            <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::CHANGE_PASSWORD_PAGE_DESCRIPTION] }}</p>
        </div>

        <form action="{{ route('user.changePasswordAction') }}" method="post">
            @csrf

            <div class="space-y-4">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div class="mt-2">
                            <div>
                                <label for="old_password"
                                       class="block text-sm font-medium leading-6 text-gray-900 dark:text-[#8899A6]">Old password</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input value="{{ old('old_password') }}" required type="password" name="old_password" id="old_password"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 "
                                           placeholder="********">
                                </div>
                                @error('old_password')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-2">
                            <div>
                                <label for="new_password"
                                       class="block text-sm font-medium leading-6 text-gray-900 dark:text-[#8899A6]">New password</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input value="{{ old('new_password') }}" required type="password" name="new_password" id="new_password"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 "
                                           placeholder="********">
                                </div>
                                @error('new_password')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-2">
                            <div>
                                <label for="new_password_confirmation"
                                       class="block text-sm font-medium leading-6 text-gray-900 dark:text-[#8899A6]">Confirm new password</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input value="{{ old('new_password_confirmation') }}" required type="password" name="new_password_confirmation" id="new_password_confirmation"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 "
                                           placeholder="********">
                                </div>
                                @error('new_password_confirmation')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                        class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ $t[Translation::CHANGE_PASSWORD_SUBMIT_BUTTON_TEXT] }}
                </button>
            </div>
        </form>
    </div>

@endsection
