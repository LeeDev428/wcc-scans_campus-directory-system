<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8th Floor - WCC SCAN Campus Directory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .floor-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 1rem 1rem 1rem 7rem;
            box-sizing: border-box;
        }
        .svg-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .svg-wrapper svg {
            max-width: 90%;
            max-height: 85%;
            width: auto;
            height: auto;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Floor Navigator Component -->
    <x-floor-navigator :currentFloor="8" />

    <!-- Main Content -->
    <div class="floor-container">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">8th Floor</h1>
            <p class="text-sm text-gray-600">WCC SCAN Campus Directory</p>
        </div>

        <!-- SVG Container -->
        <div class="svg-wrapper">
 

        </div>

        <!-- Back Button -->
        <div class="text-center mt-2 mb-2">
            <a href="{{ route('homepage') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white text-sm font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Homepage
            </a>
        </div>
    </div>
</body>
</html>
