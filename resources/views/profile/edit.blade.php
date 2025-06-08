<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl tracking-tight text-green-400 drop-shadow-lg">
            Profile
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-tr from-black via-gray-900 to-black p-8">
        <div class="glass max-w-4xl mx-auto rounded-3xl p-8 space-y-10 shadow-lg shadow-black/70">

            <!-- Profile Info -->
            <section class="glass p-6 rounded-2xl shadow-inner shadow-black/80">
                <h3 class="text-xl font-semibold mb-4 text-green-400">Profile Information</h3>
                @include('profile.partials.update-profile-information-form')
            </section>

            <!-- Update Password -->
            <section class="glass p-6 rounded-2xl shadow-inner shadow-black/80">
                <h3 class="text-xl font-semibold mb-4 text-green-400">Update Password</h3>
                @include('profile.partials.update-password-form')
            </section>

            <!-- Delete Account -->
            <section class="glass p-6 rounded-2xl shadow-inner shadow-black/80">
                <h3 class="text-xl font-semibold mb-4 text-green-400">Delete Account</h3>
                @include('profile.partials.delete-user-form')
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

        /* Override text colors inside forms for better dark mode visibility */
        section.glass header h2,
        section.glass header p,
        section.glass form label,
        section.glass form p,
        section.glass form input,
        section.glass form textarea,
        section.glass form select {
            color: #D1F299;
            /* soft green text */
        }

        /* Inputs and buttons */
        section.glass form input,
        section.glass form select,
        section.glass form textarea {
            background-color: rgba(255 255 255 / 0.1);
            border-color: rgba(209, 242, 153, 0.5);
            color: #D1F299;
        }

        section.glass form input::placeholder,
        section.glass form select::placeholder,
        section.glass form textarea::placeholder {}

        /* Focus styles */
        section.glass form input:focus,
        section.glass form select:focus,
        section.glass form textarea:focus {
            outline: none;
            background-color: rgba(255 255 255 / 0.15);
            color: #D1F299;
        }

        /* Buttons */
        section.glass form button,
        section.glass form .btn-primary {
            color: #ffffff;
            font-weight: 700;
            border-radius: 9999px;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s ease;
        }

        section.glass form button:hover,
        section.glass form .btn-primary:hover {
            color: #111;
        }
    </style>
</x-app-layout>
