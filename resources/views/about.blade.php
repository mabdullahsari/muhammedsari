<x-page name="About" class="max-w-5xl grid grid-cols-1 gap-y-16 lg:grid-cols-2 lg:grid-rows-[auto_1fr] lg:gap-y-12">
    <i class="lg:pl-20">
        <i class="max-w-xs px-2.5 lg:max-w-none">
            <img alt="Muhammed"
                 src="{{ asset('img/cross-armed.jpg') }}"
                 width="800"
                 height="800"
                 class="aspect-square rotate-3 rounded-2xl object-cover bg-zinc-800"
            />
        </i>
    </i>

    <i class="lg:order-first lg:row-span-2">
        <x-heading as="2">I’m Muhammed, a proud Ghentian.</x-heading>

        <i class="mt-6 space-y-7 text-base text-zinc-600 dark:text-zinc-400">
            <p>Hello! I'm Muhammed, a passionate software enthusiast dedicated to using code to solve real-world problems. I strive to develop robust applications that meets every expectation.</p>
            <p>Knowledge sharing, collaboration and teamwork are at the heart of my approach. I find genuine joy in supporting and empowering others in my team, fostering a friendly and supportive environment.</p>
            <p>Programming languages and technologies are only <em>a means to an end</em>, though. What really matters is the problems that must be solved in order to make others' lives easier.</p>

            <details>
                <summary class="outline-none hover:cursor-pointer hover:text-amber-500 focus:text-amber-500">See tech stack</summary>

                My daily drivers are PHP and JavaScript. <br /> Framework? I like using Laravel these days. <br /> Have I created (native) mobile apps? Yes, using React Native.
            </details>

            <p>I also run a smallish, invite only Discord server for people who have a great appetite for software design and architecture. <em>The</em> way to keep your reality in check and avoid echo chambers, aka being pragmatic instead of dogmatic.</p>
        </i>
    </i>

    <i class="lg:pl-20">
        <ul role="list">
            <li class="flex">
                <a class="outline-none group flex text-sm font-medium transition text-zinc-200 hover:text-cyan-500 focus:text-cyan-500" href="https://twitter.com/mabdullahsari" rel="noopener noreferrer">
                    <x-icon name="twitter" class="w-5 h-5 flex-none fill-zinc-500 transition group-hover:fill-cyan-500 group-focus:fill-cyan-500" />

                    <span class="ml-4 group-focus:underline">Follow on Twitter</span>
                </a>
            </li>

            <li class="mt-4 flex">
                <a class="outline-none group flex text-sm font-medium transition text-zinc-200 hover:text-white focus:text-white" href="https://github.com/mabdullahsari" rel="noopener noreferrer">
                    <x-icon name="github" class="w-5 h-5 flex-none fill-zinc-500 transition group-hover:fill-white group-focus:fill-white" />

                    <span class="ml-4 group-focus:underline">Follow on GitHub</span>
                </a>
            </li>

            <li class="mt-4 flex">
                <a class="outline-none group flex text-sm font-medium transition text-zinc-200 hover:text-blue-500 focus:text-blue-500" href="/about#">
                    <x-icon name="linkedin" class="w-5 h-5 flex-none fill-zinc-500 transition group-hover:fill-blue-500 group-focus:fill-blue-500" />

                    <span class="ml-4 group-focus:underline">Follow on LinkedIn</span>
                </a>
            </li>

            <li class="mt-8 border-t border-zinc-100 pt-8 dark:border-zinc-700/40 flex">
                <x-contact.get-in-touch />
            </li>
        </ul>
    </i>
</x-page>
