<x-filament::widget>
    <x-filament::card>
        <a href="{{ url()->to('horizon') }}" target="_blank" rel="noopener noreferrer" @class([
            'flex justify-center items-center space-x-2 rtl:space-x-reverse text-3xl font-semibold text-gray-800 hover:text-primary-500 transition',
            'dark:text-primary-500 dark:hover:text-primary-400' => config('filament.dark_mode'),
        ])>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="w-12 h-12 mr-3">
                <path fill="currentColor" d="M5.26176342 26.4094389C2.04147988 23.6582233 0 19.5675182 0 15c0-4.1421356 1.67893219-7.89213562 4.39339828-10.60660172C7.10786438 1.67893219 10.8578644 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15-3.716753 0-7.11777662-1.3517984-9.73823658-3.5905611zM4.03811305 15.9222506C5.70084247 14.4569342 6.87195416 12.5 10 12.5c5 0 5 5 10 5 3.1280454 0 4.2991572-1.9569336 5.961887-3.4222502C25.4934253 8.43417206 20.7645408 4 15 4 8.92486775 4 4 8.92486775 4 15c0 .3105915.01287248.6181765.03811305.9222506z"></path>
            </svg>

            <span>Horizon</span>
        </a>
    </x-filament::card>
</x-filament::widget>
