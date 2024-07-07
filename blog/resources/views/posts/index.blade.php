<x-default-layout>
    <div class="space-y-10 md:space-y-16">

        {{-- directive de blade --}}
        @forelse ($posts as $post)
                            
        <x-post :$post list/>
        {{-- Quand l'attribut est egale à la variable en valeur  :post="$post" , utiliser le raccourci :$post --}}

            @empty
            <p class="text-slate-400 text-center">Aucun résultat.</p>

        @endforelse
        {{ $posts->links() }}

    </div>
</x-default-layout>