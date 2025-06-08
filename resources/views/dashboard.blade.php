<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl tracking-tight text-green-400 drop-shadow-lg">
            Dashboard
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-tr from-black via-gray-900 to-black p-8">
        <div class="glass max-w-7xl mx-auto rounded-3xl p-8 space-y-6 shadow-lg shadow-black/70">
            <section class="text-gray-300">
                <h3 class="text-xl font-semibold mb-4 text-green-500">Welcome Back, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-400 max-w-3xl leading-relaxed">
                    This is your dashboard, designed with a sleek dark glass effect for a clean, focused workspace.
                </p>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass p-6 rounded-2xl shadow-inner shadow-black/80">
                    <h4 class="font-semibold text-green-400 mb-2">Stats</h4>
                    <p class="text-gray-400">You have <span class="text-green-500 font-bold">42</span> active projects.
                    </p>
                </div>
                <div class="glass p-6 rounded-2xl shadow-inner shadow-black/80">
                    <h4 class="font-semibold text-green-400 mb-2">Notifications</h4>
                    <p class="text-gray-400">3 new messages waiting for you.</p>
                </div>
                <div class="glass p-6 rounded-2xl shadow-inner shadow-black/80">
                    <h4 class="font-semibold text-green-400 mb-2">Tasks</h4>
                    <p class="text-gray-400">5 tasks due this week.</p>
                </div>
            </section>

            <section>
                <a href="{{ route('profile.edit') }}"
                    class="inline-block mt-6 px-6 py-3 rounded-full bg-green-600 bg-opacity-90 hover:bg-opacity-100 text-gray-100 font-semibold shadow-lg shadow-green-700/90 transition">
                    Edit Profile
                </a>
            </section>
        </div>
    </div>

    <style>
        .glass {
            backdrop-filter: saturate(180%) blur(30px);
            -webkit-backdrop-filter: saturate(180%) blur(30px);
            background-color: rgba(20, 20, 20, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.07);
            box-shadow:
                0 8px 32px 0 rgba(0, 0, 0, 0.85),
                inset 0 0 10px rgba(255, 255, 255, 0.05);
        }
    </style>
</x-app-layout>
