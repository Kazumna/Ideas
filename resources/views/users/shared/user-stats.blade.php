<div class="d-flex justify-content-start">
    {{-- Followers --}}
    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1"></span> {{ $user->followers()->count() }} Followers </a>

    {{-- Number of ideas,  Getting data from User models, call user model and access ideas method --}}
    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1"></span> {{ $user->ideas()->count() }} </a>

    {{-- comments --}}
    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-comment me-1"></span> {{ $user->comments()->count() }} </a>

    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1"></span> {{ $user->likes()->count() }} </a>

</div>
