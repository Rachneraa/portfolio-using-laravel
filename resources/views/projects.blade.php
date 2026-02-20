<x-layouts.app :title="'Projects'" :socialMedia="$socialMedia">
    <section class="py-20 bg-[#FBF4EB] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center text-[#C43670] mb-4">All Projects</h1>
            <p class="text-center text-[#F283AF]/80 mb-12">Explore all my projects and portfolio works</p>

            <!-- Project Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $project)
                    <div class="project-card bg-white rounded-xl overflow-hidden shadow-lg">
                        <div class="h-48 bg-[#F3CC97] overflow-hidden">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#FBD9E5] to-[#F3CC97]">
                                    <svg class="w-16 h-16 text-[#F283AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            @if($project->category)
                                <span
                                    class="inline-block bg-[#FBD9E5] text-[#C43670] text-xs px-3 py-1 rounded-full mb-3">{{ $project->category }}</span>
                            @endif
                            <h3 class="font-bold text-[#C43670] text-lg mb-2">{{ $project->title }}</h3>
                            <p class="text-[#C43670]/70 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                            <a href="{{ route('projects.show', $project) }}"
                                class="text-[#F283AF] hover:text-[#C43670] text-sm font-medium flex items-center gap-1">
                                Lihat Detail
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-[#C43670]/60">Belum ada project yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $projects->links() }}
            </div>

            <!-- Back button -->
            <div class="text-center mt-8">
                <a href="{{ route('home') }}#projects"
                    class="inline-flex items-center gap-2 text-[#F283AF] hover:text-[#C43670] font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Kembali ke Home
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>