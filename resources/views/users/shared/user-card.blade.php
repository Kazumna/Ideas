<div class="card">
    <div class="px-3 pt-4 pb-2">

        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center">

                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                    alt="{{ $user->name }}">

                <div>

                    <h3 class="card-title mb-0"><a href="{{ route('users.show', $user->id) }}"> {{ $user->name }} </a></h3>
                    <span class="fs-6 text-muted"> {{ $user->email }} </span>

                </div>

            </div>

            <div>
                    {{-- Old Method --}}
                    {{-- @auth --}}
                        {{-- checking logged in user === the Id we are viewing --}}
                        {{-- @if (Auth::id() === $user->id)
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        @endif --}}
                    {{-- @endauth --}}

                    {{-- only show edit button if viewing own profile --}}
                    {{-- New Method , this is getting from Policy. can method also check Authorisation --}}
                    @can('update', $user)
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                    @endcan

            </div>

        </div>

        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>


            <p class="fs-6 fw-light">
                {{ $user->bio }}
            </p>


            @include('users.shared.user-stats')

            @auth
                {{-- if id of the login user is not identical to the user we are viewing, dont show this button --}}
                {{-- Old Version --}}
                {{-- @if (Auth::id() !== $user->id) --}}

                {{-- New Version --}}
                @if (Auth::user()->isNot($user))
                    <div class="mt-3">
                        @if (Auth::user()->follows($user))
                            <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"> UnFollow </button>
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth



        </div>

    </div>
</div>
