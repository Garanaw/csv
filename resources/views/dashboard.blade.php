<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col flex-grow mb-3">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form name="file-form" method="post" action="{{ route('csv.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <div id="file-upload" class="block w-full py-2 px-3 relative bg-white appearance-none border-2 border-gray-300 border-solid rounded-md hover:shadow-outline-gray">
                                <input
                                    type="file"
                                    id="csv-input"
                                    name="csv_file"
                                    accept=".csv, text/csv, application/csv"
                                    class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                                >
                                <div class="flex flex-col space-y-1">
                                    <div class="flex flex-row items-center space-x-2">
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-2 items-center justify-center">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-currentColor"></i>
                                    <p class="text-gray-700">
                                        Drag your files here or click in this area.
                                    </p>
                                    <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative hidden" role="alert">
                                        <strong class="font-bold">Holy smokes!</strong>
                                        <span class="block sm:inline">Something seriously bad happened.</span>
                                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                        </span>
                                    </div>
                                    <a href="javascript:void(0)" class="flex items-center mx-auto py-2 px-4 text-white text-center font-medium border border-transparent rounded-md outline-none bg-red-700">Select a file</a>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="block bg-green-500 hover:bg-green-700 text-white uppercase text-lg mx-auto mt-10 p-4 rounded"
                            >
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script type="text/javascript" src="{{ mix('js/dashboard.js') }}"></script>
    </x-slot>
</x-app-layout>
