<div class="saf" id="session-class">
    <div class="card">
        <div class="card-header" id="session-class">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#session-data" aria-expanded="true" aria-controls="session-data">
                    Session Data
                </button>
            </h2>
        </div>

        <div id="session-data" class="collapse" aria-labelledby="session-class" data-parent="#session-class">
            <div class="card-body">
                <pre>{{ json_encode(Session::all(), JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
    </div>
</div>
