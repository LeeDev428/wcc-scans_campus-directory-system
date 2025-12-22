<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6th Floor - WCC SCAN Campus Directory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Floor Navigator Component -->
    <x-floor-navigator :currentFloor="6" />

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="w-full max-w-7xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">6th Floor</h1>
                <p class="text-gray-600">WCC SCAN Campus Directory</p>
            </div>

            <!-- SVG Container -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- 
                    ============================================
                    PASTE YOUR 6TH FLOOR SVG HERE
                    ============================================
                    Copy and paste your Figma exported SVG code below this comment
                -->
                
                <div class="text-center text-gray-400 py-20">
                    <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-lg">SVG Placeholder - Paste your 6th floor SVG here</p>
                </div>

                <!-- 
                    ============================================
                    END OF SVG SECTION
                    ============================================
                -->
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('homepage') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Homepage
                </a>
            </div>
        </div>
    </div>
</body>
</html>
