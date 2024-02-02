<div class="card">
    <div class="px-3 pt-4 pb-2">

        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center">

                <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                    src="{{ $user->getImageURL() }}" alt="Mario Avatar">

                <div>

                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }} </a></h3>
                    <span class="fs-6 text-muted"> {{ $user->email }} </span>

                </div>

            </div>

            <div>
                {{-- only show edit button if viewing own profile --}}
                @auth
                    @if (Auth::id() === $user->id)
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                    @endif
                @endauth
            </div>

        </div>

        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>


            <p class="fs-6 fw-light">
                {{ $user->bio }}
            </p>


            <div class="d-flex justify-content-start">
                {{-- Followers --}}
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1"></span> 0
                    Followers </a>

                {{-- Number of ideas,  Getting data from User models, call user model and access ideas method --}}
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1"></span>
                    {{ $user->ideas()->count() }} </a>

                {{-- comments --}}
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1"></span>
                    {{ $user->comments()->count() }} </a>

            </div>

            @auth
                {{-- if id of the login user is not identical to the user we are viewing, dont show this button --}}
                @if (Auth::id() !== $user->id)
                    <div class="mt-3">
                        <button class="btn btn-primary btn-sm"> Follow </button>
                    </div>
                @endif
            @endauth



        </div>

    </div>
</div>
