<div>
    <h1>dashboard</h1>
    <form class="d-flex" method="POST" action="{{ route('logout') }}">
        @method('POST')
        @csrf
        <button class="btn btn-danger" type="submit">Log Keluar</button>
    </form>
</div>
