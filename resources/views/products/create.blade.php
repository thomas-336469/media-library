<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload</title>
    <!-- Voeg Tailwind CSS toe -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .progress-bar {
            background-color: #4CAF50;
            /* Green */
            width: 0%;
            height: 30px;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Upload a Product') }}
            </h2>
        </x-slot>

        <div class="container mx-auto px-4">
            <form id="uploadForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                    <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                    <div class="flex items-center justify-between border border-gray-400 rounded px-3 py-2">
                        <input type="file" name="image[]" id="image" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" multiple>
                        <span class="text-sm text-gray-600">Choose multiple files</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" id="submitButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
                </div>
                <div class="mt-4">
                    <div id="progressBar" class="progress-bar"></div>
                </div>
            </form>
        </div>
    </x-app-layout>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            const submitButton = document.getElementById('submitButton');
            const progressBar = document.getElementById('progressBar');

            submitButton.disabled = true;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', this.action);

            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    const percentComplete = (event.loaded / event.total) * 100;
                    progressBar.style.width = percentComplete + '%';
                }
            });

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Upload successful!');
                } else {
                    alert('Upload failed. Please try again.');
                }
                submitButton.disabled = false;
            };

            xhr.onerror = function() {
                alert('Upload failed. Please try again.');
                submitButton.disabled = false;
            };

            xhr.send(formData);
        });
    </script>
</body>

</html>