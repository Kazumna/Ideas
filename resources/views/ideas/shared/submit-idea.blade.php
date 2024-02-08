@auth
    <h4> Share yours ideas </h4>
    <div class="row">

        <form action="{{ route('ideas.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark mb-2"> Share </button>
            </div>

        </form>
    </div>
@endauth

@guest
    {{-- __ is a helper method with Laravel Function --}}
    {{-- This value is getting from lang/en/ideas.php --}}
    <h4> {{__('ideas.login_to_share')}} </h4>
@endguest
