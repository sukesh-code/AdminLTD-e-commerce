<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload File</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

    <h2 class="text-2xl font-bold mb-6 text-center">Upload File to S3</h2>

    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Drag & Drop Area -->
        <div id="drop-area"
             class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-blue-500 transition">

            <input type="file" name="file" id="fileElem" class="hidden" required>

            <p class="text-gray-500">Drag & Drop file here</p>
            <p class="text-sm text-gray-400">or click to browse</p>
        </div>

        <!-- File Preview -->
        <div id="preview" class="mt-4 hidden">
            <p class="text-sm text-gray-600">Selected File:</p>
            <p id="fileName" class="font-medium text-blue-600"></p>
        </div>

        <!-- Upload Button -->
        <button type="submit"
                class="w-full mt-6 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Upload
        </button>

    </form>

</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const preview = document.getElementById('preview');
    const fileName = document.getElementById('fileName');

    dropArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        fileName.innerText = file.name;
        preview.classList.remove('hidden');
    });

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('border-blue-500');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-blue-500');
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileInput.files = e.dataTransfer.files;

        const file = fileInput.files[0];
        fileName.innerText = file.name;
        preview.classList.remove('hidden');
    });
</script>

</body>
</html>
