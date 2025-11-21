<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submit Ticket - WCC SCAN</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gradient-bg {
            background: linear-gradient(180deg, #0d4d3d 0%, #1a8b6f 100%);
        }
    </style>
</head>
<body class="antialiased overflow-hidden">
    <div class="gradient-bg h-screen w-screen flex flex-col overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-end p-6">
            <!-- WCC SCAN Logo -->
            <div class="flex items-center space-x-3">
                <div class="border-2 border-white p-2 rounded">
                    <img src="{{ asset('img/wcc-scans.png') }}" alt="WCC" class="h-12 w-auto">
                </div>
                <div class="text-white">
                    <h1 class="text-4xl font-bold tracking-wider">SCAN</h1>
                    <p class="text-[8px] tracking-[0.2em] mt-1">SMART CAMPUS ASSISTANT & NAVIGATOR</p>
                </div>
            </div>
        </div>

        <!-- Title -->
        <div class="px-8 py-6">
            <h1 class="text-white text-5xl font-bold tracking-wider">SUBMIT TICKET</h1>
        </div>

        <!-- Form Area -->
        <div class="flex-1 px-8 py-6">
            <div class="max-w-2xl mx-auto">
                <form method="POST" action="#" class="space-y-4">
                    @csrf
                    
                    <!-- Input Field -->
                    <div>
                        <input 
                            type="text" 
                            name="ticket_message" 
                            class="w-full px-6 py-4 rounded-lg text-gray-700 text-lg focus:outline-none focus:ring-2 focus:ring-white"
                            placeholder="Enter your feedback or concern..."
                            required
                        >
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-4">
                        <button 
                            type="submit" 
                            class="bg-white text-green-800 font-bold px-12 py-3 rounded-lg hover:bg-gray-100 transition text-lg"
                        >
                            SUBMIT
                        </button>
                    </div>
                </form>

                <!-- Description Text -->
                <div class="mt-8 text-center">
                    <p class="text-white text-sm leading-relaxed">
                        WE ARE COMMITTED TO IMPROVING YOUR LEARNING ENVIRONMENT.<br>
                        THIS IS A CONFIDENTIAL CHANNEL FOR YOU TO PROVIDE FEEDBACK<br>
                        ON YOUR CLASSROOM SITUATION, INSTRUCTORS, AND MORE. YOUR<br>
                        HONEST INPUT HELPS US MAKE A DIFFERENCE.
                    </p>
                </div>
            </div>
        </div>

        <!-- Back to Homepage -->
        <div class="text-center pb-8">
            <a href="{{ route('homepage') }}" class="text-white text-sm font-semibold tracking-wider hover:underline">BACK TO HOMEPAGE</a>
        </div>
    </div>
</body>
</html>
