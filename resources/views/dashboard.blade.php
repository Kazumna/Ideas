@extends('layout.app')

{{-- title is passed from layout.app @yield --}}
@section('title', 'Dashboard')

@section('content')
    <div class="row">

        <div class="col-3">
            @include('shared.left-sidebar')
        </div>

        <div class="col-6">

            @include('shared.success-message')


            {{-- Share button  --}}
            @include('ideas.shared.submit-idea')

            <hr>

            {{-- if for loop $ideas is empty, it will execute empty area --}}
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('ideas.shared.idea-card')
                </div>
            @empty
                <p class="text-center mt-4">No Results found.</p>
            @endforelse


            <div class="mt-3">
                {{-- pagination links --}}

                {{ $ideas->withQueryString()->links() }}
            </div>

        </div>
        <div class="col-3">

            @include('shared.search-bar')

            @include('shared.follow-box')

        </div>
    </div>
@endsection
