<x-layouts.app :title="'Projects'" :socialMedia="$socialMedia">
    <section class="py-20 bg-[#F2D6CE] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center text-[#292421] mb-4">All Projects</h1>
            <p class="text-center text-[#292421]/60 mb-12">Explore all my projects and portfolio works</p>

            <!-- Project Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $project)
                    <div class="project-card bg-white rounded-xl overflow-hidden shadow-lg">
                        <div class="h-48 bg-[#D9B99F] overflow-hidden">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#F2D6CE] to-[#D9B99F]">
                                    <svg class="w-16 h-16 text-[#CA8E82]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    class="inline-block bg-[#BAE0DA] text-[#7A958F] text-xs px-3 py-1 rounded-full mb-3">{{ $project->category }}</span>
                            @endif
                            <h3 class="font-bold text-[#A75F37] text-lg mb-2">{{ $project->title }}</h3>
                            <p class="text-[#292421]/70 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                            <a href="{{ route('projects.show', $project) }}"
                                class="text-[#A75F37] hover:text-[#8B4F2E] text-sm font-medium flex items-center gap-1">
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
                        <p class="text-[#292421]/60">Belum ada project yang ditambahkan.</p>
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
                    class="inline-flex items-center gap-2 text-[#A75F37] hover:text-[#8B4F2E] font-medium transition">
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