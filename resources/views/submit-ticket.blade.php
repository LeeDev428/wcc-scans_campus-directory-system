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
        <div class="flex-1 px-8 py-6 overflow-y-auto">
            <div class="max-w-3xl mx-auto">
                @if(session('success'))
                    <div class="bg-white text-green-800 px-6 py-4 rounded-lg mb-6 text-center font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Rating Section -->
                <div class="border-2 border-white p-6 rounded-lg mb-6">
                    <h2 class="text-white text-2xl font-bold text-center mb-6 tracking-wider">PLEASE RATE YOUR EXPERIENCE</h2>
                    
                    <form method="POST" action="{{ route('ticket.store') }}" id="ticketForm" class="space-y-6">
                        @csrf
                        
                        <!-- Emoji Rating -->
                        <div class="flex justify-center items-center space-x-4">
                            <input type="hidden" name="rating" id="ratingInput" required>
                            
                            <!-- Angry Red -->
                            <div class="emoji-rating" data-rating="1" title="Very Unhappy">
                                <svg class="w-16 h-16" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="#ef4444"/>
                                    <circle cx="35" cy="40" r="5" fill="#000"/>
                                    <circle cx="65" cy="40" r="5" fill="#000"/>
                                    <path d="M 30 70 Q 50 55 70 70" stroke="#000" stroke-width="3" fill="none"/>
                                </svg>
                            </div>

                            <!-- Sad Orange -->
                            <div class="emoji-rating" data-rating="2" title="Unhappy">
                                <svg class="w-16 h-16" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="#f97316"/>
                                    <circle cx="35" cy="40" r="5" fill="#000"/>
                                    <circle cx="65" cy="40" r="5" fill="#000"/>
                                    <path d="M 30 65 Q 50 55 70 65" stroke="#000" stroke-width="3" fill="none"/>
                                </svg>
                            </div>

                            <!-- Neutral Yellow -->
                            <div class="emoji-rating" data-rating="3" title="Neutral">
                                <svg class="w-16 h-16" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="#eab308"/>
                                    <circle cx="35" cy="40" r="5" fill="#000"/>

    <script>
        // Handle emoji rating selection
        document.querySelectorAll('.emoji-rating').forEach(emoji => {
            emoji.addEventListener('click', function() {
                // Remove selected class from all emojis
                document.querySelectorAll('.emoji-rating').forEach(e => e.classList.remove('selected'));
                
                // Add selected class to clicked emoji
                this.classList.add('selected');
                
                // Set the rating value
                document.getElementById('ratingInput').value = this.dataset.rating;
            });
        });
    </script>
</body                            <line x1="30" y1="65" x2="70" y2="65" stroke="#000" stroke-width="3"/>
                                </svg>
                            </div>

                            <!-- Slightly Happy Light Green -->
                            <div class="emoji-rating" data-rating="4" title="Satisfied">
                                <svg class="w-16 h-16" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="#84cc16"/>
                                    <circle cx="35" cy="40" r="5" fill="#000"/>
                                    <circle cx="65" cy="40" r="5" fill="#000"/>
                                    <path d="M 30 60 Q 50 70 70 60" stroke="#000" stroke-width="3" fill="none"/>
                                </svg>
                            </div>

                            <!-- Happy Green -->
                            <div class="emoji-rating" data-rating="5" title="Happy">
                                <svg class="w-16 h-16" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="#22c55e"/>
                                    <circle cx="35" cy="40" r="5" fill="#000"/>
                                    <circle cx="65" cy="40" r="5" fill="#000"/>
                                    <path d="M 30 55 Q 50 75 70 55" stroke="#000" stroke-width="3" fill="none"/>
                                </svg>
                            </div>

                            <!-- Very Happy Teal -->
                            <div class="emoji-rating" data-rating="6" title="Very Happy">
                                <svg class="w-16 h-16" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="#14b8a6"/>
                                    <circle cx="35" cy="35" r="5" fill="#000"/>
                                    <circle cx="65" cy="35" r="5" fill="#000"/>
                                    <path d="M 25 55 Q 50 80 75 55" stroke="#000" stroke-width="3" fill="none"/>
                                </svg>
                            </div>
                        </div>

                        @error('rating')
                            <p class="text-red-300 text-center text-sm">{{ $message }}</p>
                        @enderror

                        <!-- Text Input Field -->
                        <div>
                            <textarea 
                                name="ticket_message" 
                                rows="4"
                                class="w-full px-6 py-4 rounded-lg text-gray-700 text-lg focus:outline-none focus:ring-2 focus:ring-white"
                                placeholder="Enter your feedback or concern..."
                                required
                            ></textarea>
                            @error('ticket_message')
                                <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                </div>

                <!-- Description Text -->
                <div class="text-center">
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
</script>
</html>
